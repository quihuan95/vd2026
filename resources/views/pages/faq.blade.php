@extends('layouts.conference')

@section('title', __('conference.nav.faq'))

@section('content')
<x-conference-hero-title 
    :title="__('conference.nav.faq')" 
    :subtitle="$locale === 'en' ? 'Frequently asked questions regarding conference format, check-in, CME credits, and materials' : 'Giải đáp các câu hỏi thường gặp về hình thức tổ chức, thủ tục check-in, cấp CME và tài liệu'" 
    :badge="$locale === 'en' ? 'FREQUENTLY ASKED QUESTIONS' : 'CÂU HỎI THƯỜNG GẶP'" 
/>

<section class="py-14 md:py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 space-y-8">
        
        <!-- Accordion FAQ items -->
        <div class="space-y-4" x-data="{ active: 0 }">
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
                <div x-show="active === {{ $idx }}" x-cloak x-transition class="px-6 pb-6 pt-1 text-sm text-slate-700 leading-relaxed border-t border-slate-100 bg-slate-50/50">
                    <p class="font-medium text-emerald-950">{{ $item['a'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Contact Box -->
        <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm text-center space-y-4">
            <h3 class="text-base sm:text-lg font-bold text-slate-900">
                {{ $locale === 'en' ? 'Have Additional Questions?' : 'Quý Đại Biểu Có Thắc Mắc Khác?' }}
            </h3>
            <p class="text-xs sm:text-sm text-slate-600 max-w-xl mx-auto">
                {{ __('conference.contact.inquiries') }}
            </p>
            <div class="flex flex-wrap justify-center gap-3 pt-2">
                <a href="mailto:{{ __('conference.secretariat_email') }}" class="btn-primary text-xs">
                    {{ __('conference.secretariat_email') }} ✉️
                </a>
                <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'contact']) }}" class="btn-secondary text-xs">
                    {{ __('conference.nav.contact') }} →
                </a>
            </div>
        </div>

    </div>
</section>
@endsection
