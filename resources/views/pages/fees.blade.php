@extends('layouts.conference')

@section('title', __('conference.nav.fees'))

@section('content')
<x-conference-hero-title 
    :title="__('conference.nav.fees')" 
    :subtitle="$locale === 'en' ? 'Continuing Medical Education (CME) certification & Registration fee policy' : 'Quy định cấp chứng chỉ CME & Thông tin phí tham dự'" 
    :badge="$locale === 'en' ? 'REGISTRATION & CME' : 'LỆ PHÍ & CME'" 
/>

<section class="py-14 md:py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 space-y-8">
        
        <!-- CME information card directly from Google Doc -->
        <div class="bg-white rounded-3xl p-6 sm:p-10 border border-slate-200 shadow-sm space-y-4">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800">
                ⭐ {{ $locale === 'en' ? '3 CME CREDITS' : 'CẤP CHỨNG CHỈ CME (3 GIỜ TÍN CHỈ)' }}
            </span>
            <h2 class="text-xl sm:text-2xl font-bold text-slate-900">
                {{ $locale === 'en' ? 'Continuing Medical Education (CME) Regulations' : 'Quy Định Cấp Chứng Chỉ Đào Tạo Y Khoa Liên Tục (CME)' }}
            </h2>
            <div class="p-5 rounded-2xl bg-emerald-50/60 border border-emerald-200 text-sm text-slate-800 leading-relaxed">
                <p class="font-bold text-emerald-950 mb-1">
                    {{ $locale === 'en' ? 'Eligibility for CME Certification:' : 'Điều kiện cấp chứng chỉ CME:' }}
                </p>
                <p>
                    {{ $locale === 'en' 
                        ? 'Delegates who attend at least 70% of the Conference duration will be awarded a 3-credit CME certificate.' 
                        : 'Nếu tham gia đủ 70% thời lượng của Hội nghị, Đại biểu sẽ được cấp CME (3 giờ tín chỉ).' }}
                </p>
            </div>
            <div class="pt-2">
                <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'register']) }}" class="btn-primary text-xs">
                    {{ __('conference.cta.register_now') }} →
                </a>
            </div>
        </div>

        <x-updating-state 
            :title="$locale === 'en' ? 'Fee Policies & Categories' : 'Biểu phí & Quy định lệ phí'" 
            :subtitle="$locale === 'en' ? 'Detailed delegate fee policies and sponsorship packages are currently being updated by the Organizing Committee.' : 'Các quy định chi tiết về biểu phí tham dự đang được Ban Tổ chức cập nhật.'" 
        />

    </div>
</section>
@endsection
