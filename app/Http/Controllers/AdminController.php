<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Setting;
use App\Support\RegistrationExcelExport;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AdminController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác hoặc tài khoản không có quyền truy cập.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        $stats = [
            'total_registrations' => Registration::count(),
            'paid_registrations' => Registration::where('payment_status', 'paid')->count(),
            'pending_registrations' => Registration::where('payment_status', 'pending_verification')->count(),
            'complimentary_registrations' => Registration::where('payment_status', 'complimentary')->count(),
            'checked_in_count' => Registration::whereNotNull('checked_in_at')->count(),
        ];

        $recentRegistrations = Registration::orderByDesc('id')->limit(8)->get();

        return view('admin.dashboard', compact('stats', 'recentRegistrations'));
    }

    public function registrations(Request $request)
    {
        $registrations = $this->registrationQuery($request)
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        return view('admin.registrations.index', compact('registrations'));
    }

    public function exportRegistrations(
        Request $request,
        RegistrationExcelExport $excelExport,
    ): BinaryFileResponse {
        $temporaryPath = tempnam(sys_get_temp_dir(), 'vduh-registrations-');

        if ($temporaryPath === false) {
            throw new RuntimeException('Không thể tạo file Excel tạm thời.');
        }

        $excelExport->export(
            $this->registrationQuery($request)->orderByDesc('id')->cursor(),
            $temporaryPath,
        );

        return response()
            ->download(
                $temporaryPath,
                'danh-sach-dai-bieu-'.now()->format('Y-m-d-His').'.xlsx',
                ['Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'],
            )
            ->deleteFileAfterSend();
    }

    public function showRegistration(Registration $registration)
    {
        return view('admin.registrations.show', compact('registration'));
    }

    public function updateRegistrationPayment(Registration $registration, Request $request)
    {
        $status = $request->input('payment_status');
        $registration->update([
            'payment_status' => $status,
            'paid_at' => in_array($status, ['paid', 'complimentary']) ? ($registration->paid_at ?? now()) : null,
            'notes' => $request->input('notes', $registration->notes),
        ]);

        return back()->with('success', "Đã cập nhật trạng thái thanh toán của đại biểu {$registration->delegate_id}.");
    }

    public function checkInDelegate(Registration $registration)
    {
        $registration->update([
            'checked_in_at' => $registration->checked_in_at ? null : now(),
        ]);

        $status = $registration->checked_in_at ? 'Đã check-in thành công' : 'Đã hủy check-in';

        return back()->with('success', "{$status} cho đại biểu {$registration->full_name} ({$registration->delegate_id}).");
    }

    public function destroyRegistration(Registration $registration): RedirectResponse
    {
        $delegateId = $registration->delegate_id;
        $uploadedFiles = array_filter([
            $registration->identity_path,
            $registration->payment_proof_path,
        ]);

        $registration->delete();

        if ($uploadedFiles !== []) {
            Storage::disk('public')->delete($uploadedFiles);
        }

        return redirect()
            ->route('admin.registrations')
            ->with('success', "Đã xóa đại biểu {$delegateId}.");
    }

    private function registrationQuery(Request $request): Builder
    {
        $query = Registration::query();

        if ($request->filled('search')) {
            $search = $request->string('search')->toString();
            $query->where(function (Builder $query) use ($search): void {
                $query->where('delegate_id', 'like', "%{$search}%")
                    ->orWhere('full_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('organization', 'like', "%{$search}%");
            });
        }

        return $query;
    }

    public function settings()
    {
        $settings = Setting::all()->pluck('value', 'key');

        return view('admin.settings.index', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $inputs = $request->except(['_token']);
        foreach ($inputs as $key => $val) {
            Setting::set($key, $val, 'general');
        }

        return back()->with('success', 'Đã lưu cài đặt hệ thống thành công.');
    }

    public function checkInScanner(Request $request)
    {
        $result = null;
        if ($request->filled('token')) {
            $token = trim($request->input('token'));
            $reg = Registration::where('qr_code_token', $token)
                ->orWhere('delegate_id', $token)
                ->first();

            if ($reg) {
                if (! $reg->checked_in_at) {
                    $reg->update(['checked_in_at' => now()]);
                    $result = [
                        'success' => true,
                        'message' => 'Check-in thành công!',
                        'registration' => $reg,
                    ];
                } else {
                    $result = [
                        'warning' => true,
                        'message' => 'Đại biểu này đã check-in vào lúc '.$reg->checked_in_at->format('H:i d/m/Y'),
                        'registration' => $reg,
                    ];
                }
            } else {
                $result = [
                    'error' => true,
                    'message' => 'Không tìm thấy thông tin đại biểu tương ứng với mã '.$token,
                ];
            }
        }

        $recentCheckIns = Registration::whereNotNull('checked_in_at')
            ->orderByDesc('checked_in_at')
            ->limit(10)
            ->get();

        return view('admin.checkin', compact('result', 'recentCheckIns'));
    }
}
