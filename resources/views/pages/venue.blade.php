@extends('layouts.conference')

@section('title', __('conference.venue_page.name'))

@section('content')
<x-conference-hero-title 
    :title="__('conference.venue_page.badge')" 
    :subtitle="__('conference.venue_page.hero_subtitle')" 
    :badge="$locale === 'en' ? 'CONFERENCE VENUE' : 'ĐỊA ĐIỂM TỔ CHỨC'" 
/>

<section class="py-14 md:py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 space-y-12">
        
        <!-- Main Venue Details Card -->
        <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-sm border border-slate-200">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <div class="lg:col-span-6 space-y-5">
                    <span class="inline-block px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold uppercase tracking-wider">
                        {{ __('conference.event_dates') }} • {{ __('conference.format') }}
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">
                        {{ __('conference.venue_page.name') }}
                    </h2>
                    
                    <div class="space-y-2 text-sm text-slate-700 bg-slate-50 p-5 rounded-2xl border border-slate-200">
                        <div class="flex items-start gap-2">
                            <span class="text-emerald-700 font-bold">📍</span>
                            <span><strong>{{ $locale === 'en' ? 'Address 1:' : 'Địa chỉ:' }}</strong> {{ __('conference.venue_page.addr_1') }}</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-emerald-700 font-bold">📍</span>
                            <span><strong>{{ $locale === 'en' ? 'Address 2:' : 'Địa chỉ thay thế:' }}</strong> {{ __('conference.venue_page.addr_2') }}</span>
                        </div>
                    </div>

                    <div class="pt-2 flex flex-wrap gap-3">
                        <a href="{{ __('conference.venue_map_url') }}" target="_blank" class="btn-primary text-xs">
                            {{ __('conference.cta.open_maps') }} 📍
                        </a>
                        <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'register']) }}" class="btn-secondary text-xs">
                            {{ __('conference.cta.register_now') }} →
                        </a>
                    </div>
                </div>

                <!-- Google Maps Embed -->
                <div class="lg:col-span-6 rounded-2xl overflow-hidden border border-slate-300 shadow-inner h-80 lg:h-96">
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

        <!-- Updating notices: Bản đồ hướng dẫn gửi xe & Sơ đồ phòng họp -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Parking Map updating -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-amber-200/80 shadow-2xs space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-amber-800 bg-amber-100 px-3 py-1 rounded-full">
                        ⏳ {{ $locale === 'en' ? 'Updating' : 'Đang cập nhật' }}
                    </span>
                    <span class="text-2xl">🚗</span>
                </div>
                <h3 class="text-lg font-bold text-slate-900">
                    {{ __('conference.venue_page.parking_map_title') }}
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    {{ $locale === 'en' 
                        ? 'Detailed delegate parking instructions (automobile and motorcycle bays) are being prepared and will be released prior to the event.'
                        : 'Sơ đồ luồng di chuyển và vị trí bãi đỗ xe ô tô, xe máy dành riêng cho đại biểu đang được Ban Hậu cần cập nhật và sẽ thông báo trước ngày diễn ra sự kiện.' }}
                </p>
                <div class="text-xs text-amber-700 font-medium pt-2 border-t border-slate-100">
                    {{ __('conference.venue_page.parking_map_status') }}
                </div>
            </div>

            <!-- Rooms Map updating -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-amber-200/80 shadow-2xs space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-amber-800 bg-amber-100 px-3 py-1 rounded-full">
                        ⏳ {{ $locale === 'en' ? 'Updating' : 'Đang cập nhật' }}
                    </span>
                    <span class="text-2xl">🏛️</span>
                </div>
                <h3 class="text-lg font-bold text-slate-900">
                    {{ __('conference.venue_page.rooms_map_title') }}
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    {{ $locale === 'en' 
                        ? 'Floor plan allocation for 15 specialized tracks at the National Convention Center is being finalized by the Organizing Committee.'
                        : 'Sơ đồ phân bổ chi tiết các phòng họp cho 15 chuyên đề tại Trung tâm Hội nghị Quốc gia đang được Ban Tổ chức hoàn thiện.' }}
                </p>
                <div class="text-xs text-amber-700 font-medium pt-2 border-t border-slate-100">
                    {{ __('conference.venue_page.rooms_map_status') }}
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
