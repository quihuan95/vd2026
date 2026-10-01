@extends('layouts.conference')

@section('title', __('conference.nav.invitation'))

@section('content')
<x-conference-hero-title 
    :title="__('conference.nav.invitation')" 
    :subtitle="__('conference.invitation_page.hero_subtitle')" 
    :badge="__('conference.invitation_page.badge')" 
/>

<section class="py-12 md:py-16 bg-slate-50" x-data="{ tab: '{{ $locale === 'en' ? 'en' : 'vi' }}' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        
        <!-- Action Toolbar -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 mb-10 flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <h2 class="text-xl font-bold text-slate-900">{{ __('conference.invitation_page.toolbar_title') }}</h2>
                <p class="text-xs text-slate-500 mt-1">
                    {{ __('conference.invitation_page.toolbar_subtitle') }}
                </p>
            </div>

            <!-- Language Tab Buttons -->
            <div class="flex items-center gap-2 p-1.5 bg-slate-100 rounded-xl border border-slate-200">
                <button type="button" @click="tab = 'vi'" 
                        :class="tab === 'vi' ? 'bg-emerald-800 text-white shadow-sm' : 'text-slate-700 hover:text-emerald-800'"
                        class="px-4 py-2 text-xs font-bold rounded-lg transition flex items-center gap-1.5">
                    <span>🇻🇳</span>
                    <span>Tiếng Việt</span>
                </button>
                <button type="button" @click="tab = 'en'" 
                        :class="tab === 'en' ? 'bg-emerald-800 text-white shadow-sm' : 'text-slate-700 hover:text-emerald-800'"
                        class="px-4 py-2 text-xs font-bold rounded-lg transition flex items-center gap-1.5">
                    <span>🇬🇧</span>
                    <span>English</span>
                </button>
            </div>
        </div>

        <!-- Download Buttons Bar -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-10">
            <a href="{{ asset('assets/docs/thu-moi-le-ky-niem-120-viet-duc-vi.pdf') }}" target="_blank" download="thu-moi-120-nam-viet-duc-vi.pdf" 
               class="p-4 rounded-xl bg-white border border-emerald-300 hover:border-emerald-600 shadow-sm hover:shadow-md transition flex items-center justify-between group">
                <div class="flex items-center gap-3">
                    <span class="p-2.5 rounded-lg bg-emerald-100 text-emerald-800 group-hover:scale-105 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </span>
                    <div>
                        <div class="text-sm font-bold text-slate-900 group-hover:text-emerald-800">{{ $locale === 'en' ? 'Download Vietnamese Invitation (PDF)' : 'Tải Thư Mời Tiếng Việt (PDF)' }}</div>
                        <div class="text-xs text-slate-500">{{ $locale === 'en' ? 'Original High-Res Print • 887 KB' : 'Bản in gốc chất lượng cao • 887 KB' }}</div>
                    </div>
                </div>
                <span class="text-xs font-bold text-emerald-700 group-hover:translate-x-1 transition-transform">{{ $locale === 'en' ? 'Download ↓' : 'Tải về ↓' }}</span>
            </a>

            <a href="{{ asset('assets/docs/invitation-viet-duc-120th-anniversary-en.pdf') }}" target="_blank" download="invitation-120th-viet-duc-hospital-en.pdf" 
               class="p-4 rounded-xl bg-white border border-amber-300 hover:border-amber-600 shadow-sm hover:shadow-md transition flex items-center justify-between group">
                <div class="flex items-center gap-3">
                    <span class="p-2.5 rounded-lg bg-amber-100 text-amber-900 group-hover:scale-105 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </span>
                    <div>
                        <div class="text-sm font-bold text-slate-900 group-hover:text-amber-900">{{ $locale === 'en' ? 'Download English Invitation (PDF)' : 'Tải Thư Mời Tiếng Anh (PDF)' }}</div>
                        <div class="text-xs text-slate-500">{{ $locale === 'en' ? 'Official High-Res Invitation • 906 KB' : 'Bản in tiếng Anh chuẩn • 906 KB' }}</div>
                    </div>
                </div>
                <span class="text-xs font-bold text-amber-700 group-hover:translate-x-1 transition-transform">{{ $locale === 'en' ? 'Download ↓' : 'Tải về ↓' }}</span>
            </a>
        </div>

        <!-- Vietnamese Invitation Display -->
        <div x-show="tab === 'vi'" x-cloak class="space-y-10">
            <div class="text-center mb-6">
                <span class="inline-block px-3 py-1 rounded-full bg-emerald-100 text-emerald-900 text-xs font-bold uppercase tracking-wider">
                    {{ $locale === 'en' ? 'Vietnamese Invitation Document (2 Pages)' : 'Bản Thư Mời Tiếng Việt (2 Trang)' }}
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Page 1 VI -->
                <div class="bg-white rounded-2xl p-4 shadow-xl border border-slate-200">
                    <div class="flex items-center justify-between text-xs font-bold text-slate-500 pb-3 mb-3 border-b border-slate-100">
                        <span>{{ $locale === 'en' ? 'Page 1: Cover Page - 120th Anniversary (VI)' : 'Trang 1: Bìa Thư Mời 120 Năm' }}</span>
                        <span class="text-emerald-700">{{ $locale === 'en' ? 'Cover' : 'Trang Bìa' }}</span>
                    </div>
                    <img src="{{ asset('assets/invitations/invitation_vi_p1.png') }}" alt="Thư mời 120 năm Bệnh viện Việt Đức - Trang 1" class="w-full h-auto rounded-lg shadow-sm border border-slate-100">
                </div>

                <!-- Page 2 VI -->
                <div class="bg-white rounded-2xl p-4 shadow-xl border border-slate-200">
                    <div class="flex items-center justify-between text-xs font-bold text-slate-500 pb-3 mb-3 border-b border-slate-100">
                        <span>{{ $locale === 'en' ? 'Page 2: Invitation Details, Date & Venue (VI)' : 'Trang 2: Nội Dung Thư Mời & Thời Gian, Địa Điểm' }}</span>
                        <span class="text-emerald-700">{{ $locale === 'en' ? 'Details' : 'Trang Nội Dung' }}</span>
                    </div>
                    <img src="{{ asset('assets/invitations/invitation_vi_p2.png') }}" alt="Thư mời 120 năm Bệnh viện Việt Đức - Trang 2" class="w-full h-auto rounded-lg shadow-sm border border-slate-100">
                </div>
            </div>
        </div>

        <!-- English Invitation Display -->
        <div x-show="tab === 'en'" x-cloak class="space-y-10">
            <div class="text-center mb-6">
                <span class="inline-block px-3 py-1 rounded-full bg-amber-100 text-amber-900 text-xs font-bold uppercase tracking-wider">
                    Official English Invitation (2 Pages)
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Page 1 EN -->
                <div class="bg-white rounded-2xl p-4 shadow-xl border border-slate-200">
                    <div class="flex items-center justify-between text-xs font-bold text-slate-500 pb-3 mb-3 border-b border-slate-100">
                        <span>Page 1: Cover Page - 120th Anniversary</span>
                        <span class="text-amber-800">Cover Page</span>
                    </div>
                    <img src="{{ asset('assets/invitations/invitation_en_p1.png') }}" alt="Viet Duc University Hospital 120th Anniversary Invitation - Page 1" class="w-full h-auto rounded-lg shadow-sm border border-slate-100">
                </div>

                <!-- Page 2 EN -->
                <div class="bg-white rounded-2xl p-4 shadow-xl border border-slate-200">
                    <div class="flex items-center justify-between text-xs font-bold text-slate-500 pb-3 mb-3 border-b border-slate-100">
                        <span>Page 2: Invitation Details & Location</span>
                        <span class="text-amber-800">Invitation Letter</span>
                    </div>
                    <img src="{{ asset('assets/invitations/invitation_en_p2.png') }}" alt="Viet Duc University Hospital 120th Anniversary Invitation - Page 2" class="w-full h-auto rounded-lg shadow-sm border border-slate-100">
                </div>
            </div>
        </div>

        <!-- Details Summary Box -->
        <div class="mt-14 bg-white rounded-2xl p-8 border border-slate-200 shadow-sm">
            <h3 class="text-lg font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100">
                {{ __('conference.invitation_page.summary_title') }}
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-slate-700">
                <div class="space-y-3">
                    <div>
                        <strong class="text-slate-900 block text-xs uppercase text-slate-400">{{ __('conference.invitation_page.time_label') }}</strong>
                        <span>{{ __('conference.invitation_page.time_val') }}</span>
                    </div>
                    <div>
                        <strong class="text-slate-900 block text-xs uppercase text-slate-400">{{ __('conference.invitation_page.venue_label') }}</strong>
                        <span>{{ __('conference.invitation_page.venue_val') }}</span>
                    </div>
                    <div>
                        <strong class="text-slate-900 block text-xs uppercase text-slate-400">{{ __('conference.invitation_page.chair_label') }}</strong>
                        <span>{{ __('conference.invitation_page.chair_val') }}</span>
                    </div>
                </div>

                <div class="space-y-3">
                    <div>
                        <strong class="text-slate-900 block text-xs uppercase text-slate-400">{{ __('conference.invitation_page.checkin_label') }}</strong>
                        <span>{{ __('conference.invitation_page.checkin_desc') }}</span>
                    </div>
                    <div>
                        <strong class="text-slate-900 block text-xs uppercase text-slate-400">{{ __('conference.invitation_page.contact_label') }}</strong>
                        <span>Email: <a href="mailto:{{ __('conference.secretariat_email') }}" class="text-emerald-700 font-semibold underline">{{ __('conference.secretariat_email') }}</a> | Hotline: {{ __('conference.hotline') }}</span>
                    </div>
                    <div class="pt-2">
                        <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'register']) }}" class="btn-primary text-xs">
                            {{ __('conference.invitation_page.btn_register') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
