@extends('layouts.conference')

@section('title', __('conference.contact.title'))

@section('content')
<x-conference-hero-title 
    :title="__('conference.contact.title')" 
    :subtitle="$locale === 'en' ? 'Official contact information for the Organizing Committee, Scientific Secretariat, and Logistics Division' : 'Thông tin liên hệ Ban Tổ chức, Ban Thư ký Chuyên môn và Ban Hậu cần'" 
    :badge="$locale === 'en' ? 'CONTACT & SECRETARIAT' : 'THÔNG TIN LIÊN HỆ'" 
/>

<section class="py-14 md:py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 space-y-12">
        
        <!-- Official Secretariat Email Box -->
        <div class="bg-gradient-to-r from-emerald-900 via-emerald-800 to-slate-900 text-white rounded-3xl p-8 sm:p-10 shadow-lg space-y-4">
            <span class="text-xs font-bold text-amber-300 uppercase tracking-widest block">
                {{ $locale === 'en' ? 'ORGANIZING COMMITTEE OFFICIAL EMAIL' : 'EMAIL CHÍNH THỨC CỦA BAN TỔ CHỨC' }}
            </span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-white">
                {{ __('conference.secretariat_email') }}
            </h2>
            <p class="text-xs sm:text-sm text-emerald-100 max-w-2xl leading-relaxed">
                {{ __('conference.contact.inquiries') }}
            </p>
            <div class="pt-2">
                <a href="mailto:{{ __('conference.secretariat_email') }}" class="btn-hero-primary text-xs">
                    {{ $locale === 'en' ? 'Send Email Inquiries ✉️' : 'Gửi Email Tới Ban Tổ Chức ✉️' }}
                </a>
            </div>
        </div>

        <!-- 3 Contact Cards from Google Doc -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Secretariat -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-800 flex items-center justify-center font-bold text-xl">
                    📚
                </div>
                <div>
                    <span class="text-xs font-bold text-emerald-800 uppercase tracking-wider block">
                        {{ __('conference.contact.sec_academic_title') }}
                    </span>
                    <h3 class="font-bold text-slate-900 text-lg mt-1">
                        {{ __('conference.contact.sec_academic_name') }}
                    </h3>
                </div>
                <div class="text-xs sm:text-sm text-slate-700 space-y-2 pt-3 border-t border-slate-100">
                    <div>
                        <span class="text-slate-400 block text-[11px]">{{ $locale === 'en' ? 'Telephone:' : 'Điện thoại:' }}</span>
                        <a href="tel:+84904218389" class="font-bold text-emerald-800 hover:underline">{{ __('conference.contact.sec_academic_tel') }}</a>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[11px]">Email:</span>
                        <a href="mailto:{{ __('conference.contact.sec_academic_email') }}" class="text-slate-800 hover:underline">{{ __('conference.contact.sec_academic_email') }}</a>
                    </div>
                </div>
            </div>

            <!-- Logistics 1 -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-900 flex items-center justify-center font-bold text-xl">
                    🏨
                </div>
                <div>
                    <span class="text-xs font-bold text-amber-800 uppercase tracking-wider block">
                        {{ __('conference.contact.logistics_title') }}
                    </span>
                    <h3 class="font-bold text-slate-900 text-lg mt-1">
                        {{ __('conference.contact.logistics_p1_name') }}
                    </h3>
                </div>
                <div class="text-xs sm:text-sm text-slate-700 space-y-2 pt-3 border-t border-slate-100">
                    <div>
                        <span class="text-slate-400 block text-[11px]">{{ $locale === 'en' ? 'Telephone:' : 'Điện thoại:' }}</span>
                        <a href="tel:+84948996688" class="font-bold text-emerald-800 hover:underline">{{ __('conference.contact.logistics_p1_tel') }}</a>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[11px]">Email:</span>
                        <a href="mailto:{{ __('conference.contact.logistics_p1_email') }}" class="text-slate-800 hover:underline">{{ __('conference.contact.logistics_p1_email') }}</a>
                    </div>
                </div>
            </div>

            <!-- Logistics 2 -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-900 flex items-center justify-center font-bold text-xl">
                    🤝
                </div>
                <div>
                    <span class="text-xs font-bold text-blue-800 uppercase tracking-wider block">
                        {{ __('conference.contact.logistics_title') }}
                    </span>
                    <h3 class="font-bold text-slate-900 text-lg mt-1">
                        {{ __('conference.contact.logistics_p2_name') }}
                    </h3>
                </div>
                <div class="text-xs sm:text-sm text-slate-700 space-y-2 pt-3 border-t border-slate-100">
                    <div>
                        <span class="text-slate-400 block text-[11px]">{{ $locale === 'en' ? 'Telephone:' : 'Điện thoại:' }}</span>
                        <a href="tel:+84917738321" class="font-bold text-emerald-800 hover:underline">{{ __('conference.contact.logistics_p2_tel') }}</a>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[11px]">Email:</span>
                        <a href="mailto:{{ __('conference.contact.logistics_p2_email') }}" class="text-slate-800 hover:underline">{{ __('conference.contact.logistics_p2_email') }}</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Headquarters Card -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm text-xs sm:text-sm text-slate-600 space-y-2">
            <strong class="text-slate-900 text-sm sm:text-base block">
                {{ __('conference.organizer') }}
            </strong>
            <div>{{ $locale === 'en' ? 'Headquarters: 40 Trang Thi Street, Hoan Kiem District, Hanoi, Vietnam' : 'Trụ sở chính: 40 Tràng Thi, quận Hoàn Kiếm, Hà Nội, Việt Nam' }}</div>
            <div>{{ $locale === 'en' ? 'Conference Venue (Nov 19, 2026): National Convention Center, No. 01 Thang Long Avenue (Pham Hung Street), Nam Tu Liem, Hanoi' : 'Địa điểm diễn ra Hội nghị (19/11/2026): Trung tâm Hội nghị Quốc gia, Số 01 Đại lộ Thăng Long (Đường Phạm Hùng), Nam Từ Liêm, Hà Nội' }}</div>
        </div>

    </div>
</section>
@endsection
