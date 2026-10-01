@extends('layouts.conference')

@section('title', __('conference.nav.program'))

@section('content')
<x-conference-hero-title 
    :title="__('conference.nav.program')" 
    :subtitle="$locale === 'en' ? 'Detailed schedule for 15 specialized tracks is currently being updated' : 'Chương trình khoa học chi tiết 15 chuyên đề đang được cập nhật'" 
    :badge="$locale === 'en' ? 'SCIENTIFIC PROGRAM' : 'CHƯƠNG TRÌNH KHOA HỌC'" 
/>

<div class="py-14 md:py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 space-y-8">
        
        <!-- Summary from Google Doc -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-4">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800">
                {{ __('conference.event_dates') }} • {{ __('conference.venue_conference') }}
            </span>
            <h2 class="text-xl sm:text-2xl font-bold text-slate-900">
                {{ $locale === 'en' ? 'Scientific Overview — 15 Tracks & 200+ Reports' : 'Tổng quan — Hơn 200 bài báo cáo khoa học thuộc 15 chuyên đề' }}
            </h2>
            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed text-justify">
                {{ __('conference.home.intro_p1') }}
            </p>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 pt-2">
                @foreach(__('conference.specialties') as $code => $name)
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-800 flex items-center gap-2">
                    <span class="text-emerald-700 font-bold">•</span>
                    <span class="truncate">{{ $name }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <x-updating-state 
            :title="__('conference.nav.program')" 
            :subtitle="$locale === 'en' ? 'The detailed timetable, session chairs, and report sequence for each hall are being finalized by the Scientific Committee.' : 'Lịch trình chi tiết các phiên báo cáo, chủ tọa đoàn và danh sách bài báo cáo từng phòng đang được Ban Tổ chức hoàn thiện và sẽ sớm công bố.'" 
        />

    </div>
</div>
@endsection
