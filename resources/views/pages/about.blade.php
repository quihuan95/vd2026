@extends('layouts.conference')

@section('title', __('conference.welcome_letter.title'))

@section('content')
<x-conference-hero-title 
    :title="__('conference.welcome_letter.title')" 
    :subtitle="$locale === 'en' ? 'Official welcome message from the Director of Viet Duc University Hospital' : 'Thư chào mừng chính thức từ Giám đốc Bệnh viện Hữu nghị Việt Đức'" 
    :badge="$locale === 'en' ? 'WELCOME MESSAGE' : 'THƯ CHÀO MỪNG'" 
/>

<section class="py-14 md:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        
        <div class="bg-gradient-to-br from-slate-50 via-white to-emerald-50/30 rounded-3xl p-8 sm:p-14 border border-slate-200 shadow-sm relative">
            
            <div class="flex items-center justify-between pb-6 mb-8 border-b border-slate-200">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('assets/images/vietduc-logo.png') }}" alt="VDUH" class="h-14 w-auto">
                    <div>
                        <div class="font-extrabold text-slate-900 text-sm sm:text-base">{{ __('conference.organizer') }}</div>
                        <div class="text-xs text-amber-700 font-bold">{{ __('conference.anniversary_title') }}</div>
                    </div>
                </div>
                <span class="text-xs text-slate-500 font-medium hidden sm:inline">{{ __('conference.event_dates') }}</span>
            </div>

            <!-- Letter Body (Exact from Google Doc) -->
            <div class="space-y-6 text-slate-800 text-base sm:text-lg leading-relaxed text-justify">
                <p class="font-bold text-emerald-950 text-lg sm:text-xl">
                    {{ __('conference.welcome_letter.salutation') }}
                </p>

                <p>
                    {{ __('conference.welcome_letter.p1') }}
                </p>

                <p>
                    {{ __('conference.welcome_letter.p2') }}
                </p>

                <p>
                    {{ __('conference.welcome_letter.p3') }}
                </p>

                <p>
                    {{ __('conference.welcome_letter.p4') }}
                </p>

                <p>
                    {{ __('conference.welcome_letter.p5') }}
                </p>
            </div>

            <!-- Signature block -->
            <div class="pt-10 mt-10 border-t border-slate-200 flex flex-col items-end text-right">
                <div class="text-slate-600 text-sm italic mb-3">{{ __('conference.welcome_letter.sign_salutation') }}</div>
                <div class="text-lg sm:text-xl font-extrabold text-slate-900">{{ __('conference.welcome_letter.sign_name') }}</div>
                <div class="text-sm font-semibold text-emerald-800">{{ __('conference.welcome_letter.sign_title') }}</div>
                <div class="text-xs text-slate-500 font-medium">{{ __('conference.welcome_letter.sign_org') }}</div>
            </div>

            <!-- Bottom CTAs -->
            <div class="mt-10 pt-6 border-t border-slate-200 flex flex-wrap gap-4 items-center justify-between">
                <a href="{{ route('conference.home', ['locale' => $locale]) }}" class="btn-secondary text-xs">
                    {{ $locale === 'en' ? '← Back to Home' : '← Về Trang Chủ' }}
                </a>
                <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'register']) }}" class="btn-primary text-xs">
                    {{ __('conference.cta.register_now') }} →
                </a>
            </div>

        </div>

    </div>
</section>
@endsection
