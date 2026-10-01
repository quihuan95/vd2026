@extends('layouts.conference')

@section('title', __('conference.nav.layout'))

@section('content')
<x-conference-hero-title 
    :title="__('conference.nav.layout')" 
    :subtitle="$locale === 'en' ? 'Meeting rooms layout and delegate parking map are currently being updated' : 'Sơ đồ phòng họp và bản đồ hướng dẫn gửi xe đang được cập nhật'" 
    :badge="$locale === 'en' ? 'FLOOR PLAN & PARKING' : 'MẶT BẰNG & SƠ ĐỒ'" 
/>

<div class="py-14 md:py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 space-y-8">
        
        <x-updating-state 
            :title="__('conference.nav.layout')" 
            :subtitle="$locale === 'en' ? 'The official floor plan of 15 specialized tracks and delegate parking map at the National Convention Center are currently being updated by the Logistics Committee.' : 'Sơ đồ phân bổ phòng họp 15 chuyên đề và bản đồ hướng dẫn vị trí đỗ xe tại Trung tâm Hội nghị Quốc gia đang được Ban Tổ chức cập nhật và sẽ thông báo trước ngày diễn ra sự kiện.'" 
        />

    </div>
</div>
@endsection
