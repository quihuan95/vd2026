@extends('layouts.conference')

@section('title', __('conference.conference_name'))

@section('content')
<!-- Home Hero Key Visual -->
<section class="relative hero-kv-bg text-white overflow-hidden pt-8 pb-16 lg:pt-16 lg:pb-24">
    <!-- Ambient mesh dots and glows -->
    <div class="absolute inset-0 hero-mesh-dots opacity-40 pointer-events-none"></div>
    <div class="absolute top-1/4 -right-20 w-96 h-96 bg-amber-400/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 left-10 w-96 h-96 bg-emerald-600/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            
            <!-- Left 7 cols: Copy & CTAs -->
            <div class="lg:col-span-7 space-y-6">
                <!-- Badges -->
                <div class="flex flex-wrap items-center gap-2.5">
                    <div class="bg-white/95 rounded-lg p-1.5 shadow-md flex items-center gap-2 border border-white/40">
                        <img src="{{ asset('assets/images/vietduc-logo.png') }}" alt="VDUH" class="h-8 w-auto">
                        <span class="text-xs font-extrabold text-emerald-950 pr-2">
                            {{ $locale === 'en' ? 'VIET DUC UNIVERSITY HOSPITAL' : 'BỆNH VIỆN HỮU NGHỊ VIỆT ĐỨC' }}
                        </span>
                    </div>
                    <div class="border border-amber-400/40 bg-amber-400/10 backdrop-blur-md px-3 py-1 rounded-lg text-amber-300 text-xs font-bold tracking-wide">
                        ⭐ {{ $locale === 'en' ? '120 YEARS (1906 – 2026)' : '120 NĂM (1906 – 2026)' }}
                    </div>
                </div>

                <!-- KV Subtitles -->
                <div class="space-y-1">
                    <p class="text-amber-300 font-bold text-xs sm:text-sm uppercase tracking-[0.18em]">
                        {{ __('conference.anniversary_title') }}
                    </p>
                    <p class="text-emerald-200/80 font-medium text-[11px] sm:text-xs uppercase tracking-[0.2em]">
                        VIET DUC UNIVERSITY HOSPITAL 120TH ANNIVERSARY
                    </p>
                </div>

                <!-- Main Hero Title -->
                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold leading-tight tracking-tight">
                    <span class="hero-kv-title block">
                        {{ __('conference.conference_name') }}
                    </span>
                    <span class="text-lg sm:text-2xl text-emerald-100 font-normal block mt-2">
                        {{ $locale === 'en' ? 'In-Person International Scientific Conference' : 'Hội Nghị Khoa Học Trực Tiếp' }}
                    </span>
                </h1>

                <!-- Meta bar -->
                <div class="flex flex-wrap items-center gap-3 text-xs sm:text-sm text-emerald-100/90 pt-1">
                    <div class="flex items-center gap-1.5 bg-black/30 backdrop-blur px-3 py-1.5 rounded-md border border-white/10">
                        <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>{{ __('conference.event_dates') }}</span>
                    </div>
                    <div class="flex items-center gap-1.5 bg-black/30 backdrop-blur px-3 py-1.5 rounded-md border border-white/10">
                        <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        <span>{{ __('conference.venue_conference') }} (Hà Nội)</span>
                    </div>
                    <div class="flex items-center gap-1.5 bg-black/30 backdrop-blur px-3 py-1.5 rounded-md border border-white/10">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>{{ __('conference.format') }}</span>
                    </div>
                </div>

                <!-- CTAs -->
                <div class="pt-2 flex flex-wrap items-center gap-4">
                    <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'register']) }}" class="btn-hero-primary">
                        <span>{{ __('conference.cta.register_now') }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>

                    <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'about']) }}" class="btn-hero-secondary">
                        <span>{{ __('conference.welcome_letter.title') }}</span>
                    </a>
                </div>
            </div>

            <!-- Right 5 cols: Official 120 Anniversary Visual -->
            <div class="lg:col-span-5 flex justify-center">
                <div class="relative w-full max-w-md group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-amber-400/40 to-emerald-500/40 rounded-2xl blur-xl opacity-75 group-hover:opacity-100 transition duration-500"></div>
                    
                    <div class="relative rounded-2xl overflow-hidden border-2 border-amber-300/40 bg-emerald-950/80 shadow-2xl backdrop-blur">
                        <img src="{{ asset('assets/images/vietduc-banner-120.jpg') }}" alt="120 Năm Bệnh viện Hữu nghị Việt Đức" class="w-full h-auto object-cover transform transition duration-500 group-hover:scale-102">
                        
                        <div class="p-4 bg-gradient-to-t from-emerald-950 via-emerald-950/90 to-transparent">
                            <div class="flex items-center justify-between text-xs text-amber-300 font-bold mb-1">
                                <span>{{ $locale === 'en' ? 'INTERNATIONAL SCIENTIFIC CONFERENCE' : 'HỘI NGHỊ KHOA HỌC QUỐC TẾ' }}</span>
                                <span>19.11.2026</span>
                            </div>
                            <p class="text-[11px] text-emerald-200 leading-tight">
                                {{ __('conference.venue_conference') }} — {{ __('conference.venue_conference_address') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Bottom Wave transition to white section -->
    <div class="absolute bottom-0 left-0 right-0 overflow-hidden leading-none pointer-events-none">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-full h-10 sm:h-16 text-white fill-current">
            <path d="M0,0 C150,90 350,-40 500,45 C650,130 900,10 1200,40 L1200,120 L0,120 Z"></path>
        </svg>
    </div>
</section>

<!-- Stats Bar Section -->
<section class="py-8 bg-white border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center divide-x divide-slate-100">
            <div class="p-4">
                <div class="text-3xl sm:text-4xl font-extrabold text-emerald-800 tracking-tight">{{ __('conference.home.stat_years') }}</div>
                <div class="text-xs sm:text-sm text-slate-500 mt-1 font-medium">{{ __('conference.home.stat_years_label') }}</div>
            </div>
            <div class="p-4">
                <div class="text-3xl sm:text-4xl font-extrabold text-amber-600 tracking-tight">{{ __('conference.home.stat_reports') }}</div>
                <div class="text-xs sm:text-sm text-slate-500 mt-1 font-medium">{{ __('conference.home.stat_reports_label') }}</div>
            </div>
            <div class="p-4">
                <div class="text-3xl sm:text-4xl font-extrabold text-emerald-800 tracking-tight">{{ __('conference.home.stat_tracks') }}</div>
                <div class="text-xs sm:text-sm text-slate-500 mt-1 font-medium">{{ __('conference.home.stat_tracks_label') }}</div>
            </div>
            <div class="p-4">
                <div class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">{{ __('conference.home.stat_format') }}</div>
                <div class="text-xs sm:text-sm text-slate-500 mt-1 font-medium">{{ __('conference.home.stat_format_label') }}</div>
            </div>
        </div>
    </div>
</section>

<!-- Section 1: Giới thiệu (Exact Content from Google Doc) -->
<section class="py-16 md:py-20 bg-slate-50/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <!-- Left 7 cols: Conference Introduction -->
            <div class="lg:col-span-7 space-y-6">
                <div>
                    <span class="text-xs font-bold text-emerald-700 uppercase tracking-widest block mb-2">
                        {{ $locale === 'en' ? 'OVERVIEW & OBJECTIVES' : 'TỔNG QUAN HỘI NGHỊ' }}
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                        {{ __('conference.home.intro_title') }}
                    </h2>
                </div>

                <div class="text-slate-700 text-sm sm:text-base leading-relaxed text-justify">
                    <p class="p-5 rounded-2xl bg-white border border-slate-200 shadow-2xs">
                        {{ __('conference.home.intro_p1') }}
                    </p>
                </div>

                <!-- Highlights checklist -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                    <div class="flex items-start gap-2.5 p-3 rounded-lg bg-white border border-slate-200">
                        <span class="text-emerald-700 font-bold">✓</span>
                        <span class="text-xs text-slate-800 font-semibold">
                            {{ $locale === 'en' ? 'More than 200 scientific presentations across 15 tracks' : 'Hơn 200 bài báo cáo khoa học thuộc 15 chuyên đề' }}
                        </span>
                    </div>
                    <div class="flex items-start gap-2.5 p-3 rounded-lg bg-white border border-slate-200">
                        <span class="text-emerald-700 font-bold">✓</span>
                        <span class="text-xs text-slate-800 font-semibold">
                            {{ $locale === 'en' ? 'Gathering domestic and international professors, doctors & healthcare experts' : 'Sự tham gia của các chuyên gia, bác sĩ, cán bộ y tế trong nước & quốc tế' }}
                        </span>
                    </div>
                    <div class="flex items-start gap-2.5 p-3 rounded-lg bg-white border border-slate-200">
                        <span class="text-emerald-700 font-bold">✓</span>
                        <span class="text-xs text-slate-800 font-semibold">
                            {{ $locale === 'en' ? '3 CME training hours awarded (minimum 70% attendance)' : 'Cấp CME (3 giờ tín chỉ) khi tham gia đủ 70% thời lượng' }}
                        </span>
                    </div>
                    <div class="flex items-start gap-2.5 p-3 rounded-lg bg-white border border-slate-200">
                        <span class="text-emerald-700 font-bold">✓</span>
                        <span class="text-xs text-slate-800 font-semibold">
                            {{ $locale === 'en' ? 'Direct in-person organization with personalized QR check-in' : 'Tổ chức trực tiếp, check-in nhanh bằng mã QR qua email' }}
                        </span>
                    </div>
                </div>

                <div class="pt-4 flex flex-wrap gap-4">
                    <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'about']) }}" class="btn-primary">
                        <span>{{ __('conference.welcome_letter.title') }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'register']) }}" class="btn-secondary">
                        <span>{{ __('conference.cta.register_now') }}</span>
                    </a>
                </div>
            </div>

            <!-- Right 5 cols: Welcome Quote from Director -->
            <div class="lg:col-span-5">
                <div class="bg-gradient-to-br from-emerald-900 to-slate-900 rounded-3xl p-6 sm:p-8 text-white shadow-xl relative overflow-hidden border border-emerald-700/40">
                    <div class="text-amber-400 font-serif text-5xl leading-none opacity-40 mb-2">“</div>
                    <p class="text-xs sm:text-sm text-emerald-100 leading-relaxed italic mb-6">
                        {{ __('conference.welcome_letter.p1') }}
                    </p>
                    <p class="text-xs text-emerald-200/80 leading-relaxed mb-6">
                        {{ __('conference.welcome_letter.p2') }}
                    </p>
                    <p class="text-xs text-emerald-200/80 leading-relaxed mb-6">
                        {{ __('conference.welcome_letter.p3') }}
                    </p>
                    <p class="text-xs text-emerald-200/80 leading-relaxed mb-6">
                        {{ __('conference.welcome_letter.p4') }}
                    </p>

                    <div class="pt-4 border-t border-emerald-800/80 flex items-center justify-between">
                        <div>
                            <div class="font-bold text-white text-sm sm:text-base">{{ __('conference.director_name') }}</div>
                            <div class="text-xs text-amber-300 font-medium">{{ __('conference.director_title') }}</div>
                        </div>
                        <img src="{{ asset('assets/images/vietduc-logo.png') }}" alt="VDUH" class="h-10 w-auto brightness-0 invert opacity-75">
                    </div>
                </div>

                <!-- View Full Welcome Message Teaser -->
                <div class="mt-6 p-5 rounded-2xl bg-amber-50 border border-amber-300 flex items-center justify-between gap-4">
                    <div>
                        <div class="text-xs font-bold text-amber-900 uppercase">
                            {{ __('conference.welcome_letter.title') }}
                        </div>
                        <div class="text-xs text-slate-700 mt-0.5">
                            {{ __('conference.director_name') }} — {{ __('conference.director_title') }}
                        </div>
                    </div>
                    <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'about']) }}" class="px-3 py-1.5 text-xs font-bold bg-amber-500 hover:bg-amber-600 text-slate-950 rounded-lg shadow-sm transition whitespace-nowrap">
                        {{ $locale === 'en' ? 'Read Letter 📄' : 'Xem Thư 📄' }}
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 15 Specialized Medical Tracks Grid (from Google Doc) -->
<section class="py-16 md:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-xs font-bold text-emerald-700 uppercase tracking-widest block mb-2">
                {{ $locale === 'en' ? 'SCIENTIFIC HIGHLIGHTS' : 'NỘI DUNG CHUYÊN MÔN' }}
            </span>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                {{ $locale === 'en' ? '15 Specialized Scientific Tracks' : '15 Chuyên Đề Báo Cáo Khoa Học' }}
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 mt-2">
                {{ $locale === 'en' 
                    ? 'Covering organ transplantation, orthopaedics, GI surgery, cardiovascular surgery, neurosurgery, urology, clinical pharmacy, diagnostic imaging, and other advanced fields.' 
                    : 'Bao gồm ghép tạng, chấn thương chỉnh hình, tiêu hóa – sàn chậu, tim mạch lồng ngực, phẫu thuật thần kinh, nam học – tiết niệu, dược lâm sàng, chẩn đoán hình ảnh và các lĩnh vực khác.' }}
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            @foreach(__('conference.specialties') as $code => $name)
            <div class="p-5 rounded-2xl border border-slate-200 hover:border-emerald-500 bg-white hover:bg-emerald-50/30 transition-all duration-200 group shadow-2xs">
                <div class="flex items-center justify-between mb-3">
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-extrabold bg-emerald-100 text-emerald-800">
                        {{ $code }}
                    </span>
                    <span class="text-xs text-slate-400 group-hover:text-emerald-600 font-semibold">
                        {{ $locale === 'en' ? 'Specialty' : 'Chuyên đề' }}
                    </span>
                </div>
                <h3 class="text-sm font-bold text-slate-900 group-hover:text-emerald-800 transition line-clamp-2">
                    {{ $name }}
                </h3>
            </div>
            @endforeach
        </div>

        <div class="mt-8 text-center">
            <p class="text-xs text-slate-500 italic mb-4">
                {{ $locale === 'en' ? '* Detailed program schedule for each track is being finalized by the Scientific Committee.' : '* Lịch trình chi tiết các phiên báo cáo đang được Ban Tổ chức cập nhật.' }}
            </p>
            <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'register']) }}" class="btn-primary">
                <span>{{ __('conference.cta.register_now') }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>
    </div>
</section>

<!-- Section 3: Địa điểm (Exact from Google Doc) -->
<section class="py-16 md:py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-xs font-bold text-emerald-700 uppercase tracking-widest block mb-2">
                {{ __('conference.venue_page.badge') }}
            </span>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                {{ __('conference.venue_page.name') }}
            </h2>
            <p class="text-xs sm:text-sm text-slate-600 mt-2">
                {{ __('conference.venue_page.addr_1') }} • {{ __('conference.venue_page.addr_2') }}
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Left 6 cols: Venue details & Maps link -->
            <div class="lg:col-span-6 space-y-6">
                <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-1 rounded bg-emerald-100 text-emerald-800 text-xs font-bold uppercase">19/11/2026</span>
                        <span class="text-xs font-semibold text-slate-600">{{ __('conference.format') }}</span>
                    </div>

                    <h3 class="text-xl font-bold text-slate-900">
                        {{ __('conference.venue_conference') }}
                    </h3>

                    <ul class="space-y-2 text-xs sm:text-sm text-slate-700">
                        <li class="flex items-start gap-2">
                            <span class="text-emerald-700 font-bold">📍</span>
                            <span>{{ __('conference.venue_page.addr_1') }}</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-emerald-700 font-bold">📍</span>
                            <span>{{ __('conference.venue_page.addr_2') }}</span>
                        </li>
                    </ul>

                    <div class="pt-2 flex flex-wrap gap-3">
                        <a href="{{ __('conference.venue_map_url') }}" target="_blank" class="btn-primary text-xs">
                            {{ __('conference.cta.open_maps') }} 📍
                        </a>
                        <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'venue']) }}" class="btn-secondary text-xs">
                            {{ $locale === 'en' ? 'Venue Details' : 'Chi tiết địa điểm' }} →
                        </a>
                    </div>
                </div>

                <!-- Updating notices for Parking & Room layout -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-5 rounded-2xl bg-white border border-amber-200/80 shadow-2xs space-y-2">
                        <div class="flex items-center gap-2 text-amber-800 font-bold text-xs uppercase">
                            <span>🚗</span>
                            <span>{{ __('conference.venue_page.parking_map_title') }}</span>
                        </div>
                        <p class="text-xs text-slate-500">
                            {{ __('conference.venue_page.parking_map_status') }}
                        </p>
                    </div>

                    <div class="p-5 rounded-2xl bg-white border border-amber-200/80 shadow-2xs space-y-2">
                        <div class="flex items-center gap-2 text-amber-800 font-bold text-xs uppercase">
                            <span>🏛️</span>
                            <span>{{ __('conference.venue_page.rooms_map_title') }}</span>
                        </div>
                        <p class="text-xs text-slate-500">
                            {{ __('conference.venue_page.rooms_map_status') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right 6 cols: Google Map Embed -->
            <div class="lg:col-span-6 rounded-3xl overflow-hidden border border-slate-300 shadow-md h-80 lg:h-96">
                <iframe 
                    title="Google Maps NCC"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.7176465452293!2d105.78363737596924!3d21.00395308862955!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135acb567d1d739%3A0x6b4904535cf21fa2!2zVHJ1bmcgdMOibSBI4buZaSBuZ2jhu4sgUXXhu5FjIGdpYQ!5e0!3m2!1svi!2svn!4v1711000000000!5m2!1svi!2svn" 
                    class="w-full h-full border-0" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</section>

<!-- Section 4: Nhà tài trợ (Update thông tin sau from Google Doc) -->
<section class="py-14 bg-white border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="bg-gradient-to-br from-amber-50/50 via-slate-50 to-emerald-50/30 rounded-3xl p-8 sm:p-10 border border-amber-200/80 text-center space-y-4">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-amber-100 text-amber-800">
                <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                {{ __('conference.sponsorship_page.badge') }}
            </span>
            <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900">
                {{ __('conference.sponsorship_page.title') }}
            </h2>
            <p class="text-xs sm:text-sm text-slate-600 max-w-lg mx-auto">
                {{ __('conference.sponsorship_page.status') }}
            </p>
            <div class="pt-2">
                <a href="mailto:{{ __('conference.secretariat_email') }}" class="btn-secondary text-xs">
                    {{ $locale === 'en' ? 'Contact Secretariat for Partnership' : 'Liên hệ Ban Tổ chức về Tài trợ' }} ✉️
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Section 5: Câu hỏi thường gặp FAQ (Exact 4 questions from Google Doc) -->
<section class="py-16 md:py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-xs font-bold text-emerald-700 uppercase tracking-widest block mb-2">
                {{ __('conference.nav.faq') }}
            </span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                {{ $locale === 'en' ? 'Frequently Asked Questions' : 'Câu Hỏi Thường Gặp' }}
            </h2>
        </div>

        <div class="max-w-4xl mx-auto space-y-4" x-data="{ active: null }">
            @foreach(__('conference.faq_items') as $idx => $item)
            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-2xs transition">
                <button type="button" @click="active = (active === {{ $idx }} ? null : {{ $idx }})" 
                        class="w-full text-left p-6 flex items-center justify-between gap-4 font-bold text-slate-900 text-sm sm:text-base hover:text-emerald-800 transition">
                    <span class="flex items-center gap-3">
                        <span class="text-xs font-bold px-2.5 py-1 rounded bg-emerald-100 text-emerald-800 shrink-0">Q{{ $idx + 1 }}</span>
                        <span>{{ $item['q'] }}</span>
                    </span>
                    <svg class="w-5 h-5 text-slate-400 transition-transform duration-200 shrink-0" :class="active === {{ $idx }} ? 'rotate-180 text-emerald-800' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="active === {{ $idx }}" x-cloak x-transition class="px-6 pb-6 pt-1 text-xs sm:text-sm text-slate-700 leading-relaxed border-t border-slate-100 bg-slate-50/50">
                    <p class="font-medium text-emerald-950">{{ $item['a'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Section: Thông tin liên hệ (Exact from Google Doc) -->
<section class="py-16 md:py-20 bg-white border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 space-y-10">
        <div class="text-center max-w-3xl mx-auto">
            <span class="text-xs font-bold text-emerald-700 uppercase tracking-widest block mb-2">
                {{ __('conference.contact.title') }}
            </span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">
                {{ $locale === 'en' ? 'Secretariat & Logistics Contacts' : 'Đầu Mối Liên Hệ Ban Tổ Chức' }}
            </h2>
            <p class="text-xs sm:text-sm text-slate-600 mt-2">
                {{ __('conference.contact.inquiries') }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Secretariat -->
            <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200 space-y-3">
                <div class="text-xs font-bold uppercase text-emerald-800 tracking-wider">
                    {{ __('conference.contact.sec_academic_title') }}
                </div>
                <div class="font-bold text-slate-900 text-base">
                    {{ __('conference.contact.sec_academic_name') }}
                </div>
                <div class="text-xs text-slate-700 space-y-1.5 pt-2 border-t border-slate-200">
                    <div>
                        <span class="text-slate-400 block text-[11px]">{{ $locale === 'en' ? 'Tel:' : 'Điện thoại:' }}</span>
                        <a href="tel:+84904218389" class="font-bold text-emerald-800 hover:underline">{{ __('conference.contact.sec_academic_tel') }}</a>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[11px]">Email:</span>
                        <a href="mailto:{{ __('conference.contact.sec_academic_email') }}" class="text-slate-800 hover:underline">{{ __('conference.contact.sec_academic_email') }}</a>
                    </div>
                </div>
            </div>

            <!-- Logistics 1 -->
            <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200 space-y-3">
                <div class="text-xs font-bold uppercase text-emerald-800 tracking-wider">
                    {{ __('conference.contact.logistics_title') }}
                </div>
                <div class="font-bold text-slate-900 text-base">
                    {{ __('conference.contact.logistics_p1_name') }}
                </div>
                <div class="text-xs text-slate-700 space-y-1.5 pt-2 border-t border-slate-200">
                    <div>
                        <span class="text-slate-400 block text-[11px]">{{ $locale === 'en' ? 'Tel:' : 'Điện thoại:' }}</span>
                        <a href="tel:+84948996688" class="font-bold text-emerald-800 hover:underline">{{ __('conference.contact.logistics_p1_tel') }}</a>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[11px]">Email:</span>
                        <a href="mailto:{{ __('conference.contact.logistics_p1_email') }}" class="text-slate-800 hover:underline">{{ __('conference.contact.logistics_p1_email') }}</a>
                    </div>
                </div>
            </div>

            <!-- Logistics 2 -->
            <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200 space-y-3">
                <div class="text-xs font-bold uppercase text-emerald-800 tracking-wider">
                    {{ __('conference.contact.logistics_title') }}
                </div>
                <div class="font-bold text-slate-900 text-base">
                    {{ __('conference.contact.logistics_p2_name') }}
                </div>
                <div class="text-xs text-slate-700 space-y-1.5 pt-2 border-t border-slate-200">
                    <div>
                        <span class="text-slate-400 block text-[11px]">{{ $locale === 'en' ? 'Tel:' : 'Điện thoại:' }}</span>
                        <a href="tel:+84917738321" class="font-bold text-emerald-800 hover:underline">{{ __('conference.contact.logistics_p2_tel') }}</a>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[11px]">Email:</span>
                        <a href="mailto:{{ __('conference.contact.logistics_p2_email') }}" class="text-slate-800 hover:underline">{{ __('conference.contact.logistics_p2_email') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Banner (Register from Google Doc) -->
<section class="bg-gradient-to-r from-emerald-900 via-emerald-800 to-slate-900 text-white py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center space-y-4">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-800/80 text-emerald-200 border border-emerald-600/40 uppercase tracking-wider">
            ⏳ {{ $locale === 'en' ? 'UPDATING SOON' : 'ĐANG CẬP NHẬT' }}
        </div>
        <h2 class="text-2xl sm:text-4xl font-extrabold tracking-tight">
            {{ __('conference.register_form.title') }}
        </h2>
        <p class="text-xs sm:text-sm text-emerald-100 max-w-2xl mx-auto">
            {{ $locale === 'en'
                ? 'The registration portal for the Viet Duc University Hospital International Scientific Conference 2026 is currently being prepared and will open soon.'
                : 'Cổng đăng ký tham dự Hội nghị Khoa học Quốc tế Bệnh viện Hữu nghị Việt Đức 2026 đang được Ban Tổ chức chuẩn bị và sẽ sớm mở trong thời gian tới.' }}
        </p>
        <div class="pt-4 flex flex-wrap justify-center gap-4">
            <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'register']) }}" class="btn-hero-primary">
                {{ $locale === 'en' ? 'Registration Portal (Updating)' : 'Cổng đăng ký (Đang cập nhật)' }}
            </a>
            <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'about']) }}" class="btn-hero-secondary">
                {{ __('conference.welcome_letter.title') }}
            </a>
        </div>
    </div>
</section>
@endsection
