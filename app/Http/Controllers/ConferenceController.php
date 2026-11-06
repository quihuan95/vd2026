<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationConfirmed;
use App\Models\AbstractSubmission;
use App\Models\Registration;
use App\Models\Speaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ConferenceController extends Controller
{
    /**
     * Whitelist of valid public pages
     */
    protected array $whitelist = [
        'welcome',
        'about',
        'invitation',
        'committees',
        'venue',
        'layout',
        'program',
        'speakers',
        'chairs-speakers',
        'fees',
        'guidelines',
        'abstract-guidelines',
        'sponsorship',
        'sponsorship-layout',
        'announcement',
        'travel',
        'visa',
        'transportation',
        'accommodation',
        'about-vietnam-hanoi',
        'faq',
        'contact',
        'register',
        'abstract',
    ];

    /**
     * Home page
     */
    public function home(string $locale = 'vi')
    {
        if (! in_array($locale, ['vi', 'en'])) {
            return redirect('/vi');
        }

        $speakers = Speaker::where('is_published', true)
            ->orderBy('sort_order')
            ->limit(4)
            ->get();

        $sponsors = $this->getSponsorLogos();

        return view('pages.welcome', compact('locale', 'speakers', 'sponsors'));
    }

    /**
     * Dynamic page handler
     */
    public function page(string $locale, string $page)
    {
        if (! in_array($locale, ['vi', 'en'])) {
            return redirect("/vi/{$page}");
        }

        if ($page === 'abstract-guidelines') {
            return redirect("/{$locale}/guidelines");
        }

        if (! in_array($page, $this->whitelist)) {
            abort(404);
        }

        if ($page === 'welcome') {
            return redirect("/{$locale}");
        }

        // Dedicated handlers for pages that require dynamic data
        return match ($page) {
            'invitation' => $this->invitation($locale),
            'speakers', 'chairs-speakers' => $this->speakersList($locale),
            'sponsorship' => $this->sponsorship($locale),
            'register' => $this->registerView($locale),
            'abstract' => $this->abstractView($locale),
            default => view("pages.{$page}", [
                'locale' => $locale,
                'page' => $page,
                'sponsors' => $this->getSponsorLogos(),
            ]),
        };
    }

    /**
     * 120th Anniversary Invitation Page (Bilingual interactive viewer & PDF downloads)
     */
    public function invitation(string $locale)
    {
        return view('pages.invitation', [
            'locale' => $locale,
            'page' => 'invitation',
        ]);
    }

    /**
     * Speakers / Chairs & Presenters Page
     */
    public function speakersList(string $locale)
    {
        $jsonPath = resource_path('speakers.json');
        if (File::exists($jsonPath)) {
            $speakers = json_decode(File::get($jsonPath), true);
        } else {
            $speakers = Speaker::where('is_published', true)
                ->orderBy('sort_order')
                ->get()
                ->toArray();
        }

        return view('pages.speakers', [
            'locale' => $locale,
            'page' => 'speakers',
            'speakers' => $speakers,
        ]);
    }

    /**
     * Sponsorship Page with folder scanning
     */
    public function sponsorship(string $locale)
    {
        $sponsors = $this->getSponsorLogos();

        return view('pages.sponsorship', compact('locale', 'sponsors'));
    }

    /**
     * Registration Page View
     */
    public function registerView(string $locale)
    {
        return view('pages.register', compact('locale'));
    }

    /**
     * Process Delegate Registration
     */
    public function registerSubmit(string $locale, Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female,other',
            'dob' => 'nullable|date',
            'organization' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'job_title' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'attend_dinner' => 'nullable',
        ], [
            'full_name.required' => 'Vui lòng nhập họ và tên.',
            'full_name.max' => 'Họ và tên không được vượt quá 255 ký tự.',
            'gender.required' => 'Vui lòng chọn giới tính.',
            'gender.in' => 'Giới tính không hợp lệ.',
            'dob.date' => 'Ngày tháng năm sinh không hợp lệ.',
            'organization.max' => 'Cơ quan không được vượt quá 255 ký tự.',
            'department.max' => 'Khoa/Phòng không được vượt quá 255 ký tự.',
            'job_title.max' => 'Chức vụ không được vượt quá 255 ký tự.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.max' => 'Số điện thoại không được vượt quá 50 ký tự.',
        ]);

        $delegateId = Registration::generateDelegateId();
        $qrToken = 'VDUH26-'.strtoupper(Str::random(12));
        $attendDinner = $request->input('attend_dinner') === '1' || $request->input('attend_dinner') === 'yes' || $request->boolean('attend_dinner');

        $registration = Registration::create([
            'delegate_id' => $delegateId,
            'category' => 'independent_delegate',
            'academic_title' => null,
            'full_name' => $validated['full_name'],
            'gender' => $validated['gender'],
            'dob' => $validated['dob'] ?? null,
            'organization' => $validated['organization'] ?? null,
            'department' => $validated['department'] ?? null,
            'job_title' => $validated['job_title'] ?? null,
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'country' => 'VN',
            'professional_title' => 'non_member',
            'attend_dinner' => $attendDinner,
            'request_cme' => true,
            'cme_id_number' => null,
            'form_language' => 'vi',
            'payment_method' => 'free',
            'payment_status' => 'complimentary',
            'amount_vnd' => 0,
            'identity_path' => null,
            'payment_proof_path' => null,
            'qr_code_token' => $qrToken,
            'email_status' => 'pending',
            'paid_at' => now(),
        ]);

        try {
            Mail::to($registration->email)->send(new RegistrationConfirmed($registration));
            $registration->update([
                'email_status' => 'sent',
                'email_sent_at' => now(),
            ]);
        } catch (\Throwable $exception) {
            Log::error('Không gửi được email xác nhận đăng ký.', [
                'delegate_id' => $registration->delegate_id,
                'error' => $exception->getMessage(),
            ]);
            $registration->update(['email_status' => 'failed']);
        }

        return redirect("/{$locale}/register?success=1&id={$registration->delegate_id}&token={$qrToken}");
    }

    /**
     * Abstract Submission View
     */
    public function abstractView(string $locale)
    {
        return view('pages.abstract', compact('locale'));
    }

    /**
     * Process Abstract Submission
     */
    public function abstractSubmit(string $locale, Request $request)
    {
        $validated = $request->validate([
            'specialty' => 'required|string|max:50',
            'track_other' => 'nullable|string|max:255',
            'title' => 'required|string|max:500',
            'authors' => 'required|string|max:2000',
            'presenter_name' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'country' => 'required|string|max:16',
            'institution' => 'nullable|string|max:255',
            'submission_type' => 'required|string|in:research,case_report,review,poster',
            'presentation_type' => 'required|string|in:oral,poster,either',
            'abstract_file' => 'required|file|mimes:doc,docx,pdf|max:10240',
        ]);

        $abstractId = AbstractSubmission::generateAbstractId($validated['specialty']);
        $filePath = $request->file('abstract_file')->store('abstracts', 'public');
        $formLanguage = strtoupper($validated['country']) === 'VN' ? 'vi' : 'en';

        $abstract = AbstractSubmission::create([
            'abstract_id' => $abstractId,
            'specialty' => $validated['specialty'],
            'track_other' => $validated['track_other'] ?? null,
            'title' => $validated['title'],
            'authors' => $validated['authors'],
            'presenter_name' => $validated['presenter_name'] ?? null,
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'country' => $validated['country'],
            'institution' => $validated['institution'] ?? null,
            'submission_type' => $validated['submission_type'],
            'presentation_type' => $validated['presentation_type'],
            'file_path' => $filePath,
            'form_language' => $formLanguage,
            'review_status' => 'submitted',
            'email_status' => 'pending',
        ]);

        return redirect("/{$locale}/abstract?success=1&id={$abstract->abstract_id}");
    }

    /**
     * Check QR Token / Delegate Ticket
     */
    public function checkTicket(string $locale, string $token)
    {
        $registration = Registration::where('qr_code_token', $token)->firstOrFail();

        return view('pages.ticket', compact('locale', 'registration'));
    }

    /**
     * @return array<string, array<int, array{name: string, url: string}>>
     */
    protected function getSponsorLogos(): array
    {
        $tiers = ['diamond', 'platinum', 'gold', 'silver', 'bronze', 'co_sponsor'];
        $results = [];

        foreach ($tiers as $tier) {
            $dir = public_path("images/sponsors/{$tier}");
            if (! File::isDirectory($dir)) {
                continue;
            }

            $files = File::files($dir);
            usort($files, fn ($left, $right): int => strnatcasecmp($left->getFilename(), $right->getFilename()));

            $logos = [];
            foreach ($files as $file) {
                $extension = strtolower($file->getExtension());
                if (! in_array($extension, ['png', 'jpg', 'jpeg', 'webp', 'svg', 'gif'], true)) {
                    continue;
                }

                $name = preg_replace('/^\d+-/', '', pathinfo($file->getFilename(), PATHINFO_FILENAME)) ?? '';

                $logos[] = [
                    'name' => $name,
                    'url' => asset("images/sponsors/{$tier}/".rawurlencode($file->getFilename())),
                ];
            }

            if ($logos !== []) {
                $results[$tier] = $logos;
            }
        }

        return $results;
    }
}
