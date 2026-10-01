<?php

namespace App\Http\Controllers;

use App\Models\AbstractSubmission;
use App\Models\Registration;
use App\Models\Setting;
use App\Models\Speaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'total_abstracts' => AbstractSubmission::count(),
            'accepted_abstracts' => AbstractSubmission::where('review_status', 'accepted')->count(),
            'total_speakers' => Speaker::count(),
        ];

        $recentRegistrations = Registration::orderByDesc('id')->limit(8)->get();
        $recentAbstracts = AbstractSubmission::orderByDesc('id')->limit(8)->get();

        return view('admin.dashboard', compact('stats', 'recentRegistrations', 'recentAbstracts'));
    }

    public function registrations(Request $request)
    {
        $query = Registration::query();

        if ($request->filled('search')) {
            $s = $request->input('search');
            $query->where(function ($q) use ($s) {
                $q->where('delegate_id', 'like', "%{$s}%")
                  ->orWhere('full_name', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%")
                  ->orWhere('organization', 'like', "%{$s}%");
            });
        }

        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->input('payment_status'));
        }

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        $registrations = $query->orderByDesc('id')->paginate(20)->withQueryString();

        return view('admin.registrations.index', compact('registrations'));
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

    public function abstracts(Request $request)
    {
        $query = AbstractSubmission::query();

        if ($request->filled('search')) {
            $s = $request->input('search');
            $query->where(function ($q) use ($s) {
                $q->where('abstract_id', 'like', "%{$s}%")
                  ->orWhere('title', 'like', "%{$s}%")
                  ->orWhere('authors', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%");
            });
        }

        if ($request->filled('specialty')) {
            $query->where('specialty', $request->input('specialty'));
        }

        if ($request->filled('review_status')) {
            $query->where('review_status', $request->input('review_status'));
        }

        $abstracts = $query->orderByDesc('id')->paginate(20)->withQueryString();

        return view('admin.abstracts.index', compact('abstracts'));
    }

    public function showAbstract(AbstractSubmission $abstract)
    {
        return view('admin.abstracts.show', compact('abstract'));
    }

    public function updateAbstractStatus(AbstractSubmission $abstract, Request $request)
    {
        $validated = $request->validate([
            'review_status' => 'required|string|in:submitted,under_review,accepted,revision_requested,rejected',
            'review_notes' => 'nullable|string',
        ]);

        $abstract->update($validated);

        return back()->with('success', "Đã cập nhật trạng thái báo cáo {$abstract->abstract_id}.");
    }

    public function speakers()
    {
        $speakers = Speaker::orderBy('sort_order')->get();
        return view('admin.speakers.index', compact('speakers'));
    }

    public function storeSpeaker(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'affiliation' => 'nullable|string|max:255',
            'topic' => 'nullable|string|max:500',
            'session_time' => 'nullable|string|max:100',
            'bio_vi' => 'nullable|string',
            'bio_en' => 'nullable|string',
            'sort_order' => 'integer|default:0',
            'is_published' => 'boolean',
        ]);

        $validated['is_published'] = $request->boolean('is_published');
        Speaker::create($validated);

        return back()->with('success', 'Đã thêm diễn giả mới thành công.');
    }

    public function updateSpeaker(Speaker $speaker, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'affiliation' => 'nullable|string|max:255',
            'topic' => 'nullable|string|max:500',
            'session_time' => 'nullable|string|max:100',
            'bio_vi' => 'nullable|string',
            'bio_en' => 'nullable|string',
            'sort_order' => 'integer',
        ]);

        $validated['is_published'] = $request->boolean('is_published');
        $speaker->update($validated);

        return back()->with('success', "Đã cập nhật thông tin diễn giả {$speaker->name}.");
    }

    public function deleteSpeaker(Speaker $speaker)
    {
        $speaker->delete();
        return back()->with('success', 'Đã xóa diễn giả thành công.');
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
                if (!$reg->checked_in_at) {
                    $reg->update(['checked_in_at' => now()]);
                    $result = [
                        'success' => true,
                        'message' => 'Check-in thành công!',
                        'registration' => $reg,
                    ];
                } else {
                    $result = [
                        'warning' => true,
                        'message' => 'Đại biểu này đã check-in vào lúc ' . $reg->checked_in_at->format('H:i d/m/Y'),
                        'registration' => $reg,
                    ];
                }
            } else {
                $result = [
                    'error' => true,
                    'message' => 'Không tìm thấy thông tin đại biểu tương ứng với mã ' . $token,
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
