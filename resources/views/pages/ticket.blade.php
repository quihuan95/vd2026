<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ ($locale ?? 'vi') === 'en' ? 'Digital Delegate Pass' : 'Thẻ Đại Biểu Điện Tử' }} — {{ $registration->delegate_id }}</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/vietduc-logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    <style>
        @media print {
            body { background: white !important; padding: 0 !important; }
            .no-print { display: none !important; }
            .badge-card { box-shadow: none !important; border: 2px solid #000 !important; }
        }
    </style>
</head>
<body class="bg-slate-100 min-h-screen py-10 px-4 flex flex-col items-center justify-center font-sans">

    <!-- Action bar -->
    <div class="no-print max-w-md w-full mb-6 flex items-center justify-between">
        <a href="{{ route('conference.home', ['locale' => $locale]) }}" class="text-xs font-bold text-emerald-800 hover:underline">
            {{ ($locale ?? 'vi') === 'en' ? '← Back to Home' : '← Trở về Trang Chủ' }}
        </a>
        <button onclick="window.print()" class="btn-primary text-xs !py-1.5 !px-3">
            {{ ($locale ?? 'vi') === 'en' ? '🖨️ Print Badge / Save PDF' : '🖨️ In Thẻ / Lưu PDF' }}
        </button>
    </div>

    <!-- Badge Card -->
    <div class="badge-card bg-white rounded-3xl border-2 border-emerald-700 shadow-2xl max-w-md w-full overflow-hidden text-center">
        <!-- Top header -->
        <div class="bg-gradient-to-r from-emerald-950 via-emerald-900 to-emerald-950 p-6 text-white border-b-4 border-amber-400">
            <div class="flex items-center justify-center gap-3 mb-2">
                <img src="{{ asset('assets/images/vietduc-logo.png') }}" alt="VDUH" class="h-10 w-auto">
                <div class="text-left">
                    <div class="font-extrabold text-xs tracking-tight">
                        {{ ($locale ?? 'vi') === 'en' ? 'VIET DUC UNIVERSITY HOSPITAL' : 'BỆNH VIỆN HỮU NGHỊ VIỆT ĐỨC' }}
                    </div>
                    <div class="text-[10px] text-amber-300 font-bold uppercase">
                        {{ ($locale ?? 'vi') === 'en' ? '120 YEARS (1906 – 2026)' : '120 NĂM (1906 – 2026)' }}
                    </div>
                </div>
            </div>
            <h1 class="text-sm font-extrabold uppercase tracking-wide text-amber-300 mt-2">
                {{ ($locale ?? 'vi') === 'en' ? 'OFFICIAL DELEGATE PASS' : 'THẺ ĐẠI BIỂU CHÍNH THỨC' }}
            </h1>
            <p class="text-[11px] text-emerald-200">
                {{ ($locale ?? 'vi') === 'en' ? 'International Scientific Conference • Hanoi 2026' : 'Hội Nghị Khoa Học Quốc Tế • Hà Nội 2026' }}
            </p>
        </div>

        <!-- Delegate Info -->
        <div class="p-6 space-y-4">
            <div>
                <span class="inline-block px-3 py-1 rounded-full bg-emerald-100 text-emerald-900 text-xs font-bold uppercase tracking-wider mb-2">
                    {{ $registration->category_label }}
                </span>
                <h2 class="text-xl font-extrabold text-slate-900">
                    {{ $registration->academic_title ? $registration->academic_title . ' ' : '' }}{{ $registration->full_name }}
                </h2>
                <div class="text-xs font-semibold text-emerald-800 mt-0.5">
                    {{ $registration->job_title ?? (($locale ?? 'vi') === 'en' ? 'Delegate' : 'Đại biểu') }}
                </div>
                <div class="text-xs text-slate-500">{{ $registration->organization }}</div>
            </div>

            <!-- QR code visual block -->
            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 inline-block">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data={{ urlencode($registration->qr_code_token) }}" 
                     alt="Check-in QR Code" 
                     class="w-40 h-40 mx-auto rounded-lg shadow-2xs">
                <div class="mt-2 font-mono text-xs font-bold text-slate-700 tracking-wider">
                    {{ $registration->delegate_id }}
                </div>
            </div>

            <!-- Attendance / Check-in badges -->
            <div class="grid grid-cols-2 gap-3 text-left text-xs bg-slate-50 p-3 rounded-xl border border-slate-200">
                <div>
                    <span class="text-slate-400 block text-[10px]">{{ ($locale ?? 'vi') === 'en' ? 'CME Credit:' : 'Cấp chứng chỉ CME:' }}</span>
                    <strong class="text-slate-800">
                        @if(($locale ?? 'vi') === 'en')
                            {{ $registration->request_cme ? '✓ Yes (3 Credits)' : 'No' }}
                        @else
                            {{ $registration->request_cme ? '✓ Đăng ký (3 TC)' : 'Không' }}
                        @endif
                    </strong>
                </div>
                <div>
                    <span class="text-slate-400 block text-[10px]">{{ ($locale ?? 'vi') === 'en' ? 'Gala Dinner:' : 'Tiệc tối Gala:' }}</span>
                    <strong class="text-slate-800">
                        @if(($locale ?? 'vi') === 'en')
                            {{ $registration->attend_dinner ? '✓ Attending' : 'No' }}
                        @else
                            {{ $registration->attend_dinner ? '✓ Có tham dự' : 'Không' }}
                        @endif
                    </strong>
                </div>
            </div>

            <!-- Check-in status -->
            <div class="pt-2 text-xs">
                @if($registration->checked_in_at)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 font-bold">
                        <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                        {{ ($locale ?? 'vi') === 'en' ? 'Checked-in: ' : 'Đã Check-in: ' }}{{ $registration->checked_in_at->format('H:i d/m/Y') }}
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-100 text-amber-900 font-bold">
                        <span class="w-2 h-2 rounded-full bg-amber-600"></span>
                        {{ ($locale ?? 'vi') === 'en' ? 'Pending Check-in at Reception Desk' : 'Chưa Check-in tại quầy đón tiếp' }}
                    </span>
                @endif
            </div>

            <div class="text-[11px] text-slate-400 pt-2 border-t border-slate-100">
                {{ ($locale ?? 'vi') === 'en'
                    ? 'Please present this digital pass QR code at the National Convention Center reception desks to receive your physical badge and conference materials.'
                    : 'Vui lòng xuất trình mã QR này tại Quầy tiếp đón Trung tâm Hội nghị Quốc gia để làm thủ tục nhận thẻ và tài liệu.' }}
            </div>
        </div>
    </div>

</body>
</html>
