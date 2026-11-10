@extends('layouts.conference')

@section('title', __('conference.nav.layout'))

@section('content')
<x-conference-hero-title 
    :title="__('conference.nav.layout')" 
    :subtitle="$locale === 'en' ? 'Meeting room assignment for 19 November 2026. The delegate parking map is still being updated.' : 'Phân bổ phòng họp ngày 19/11/2026. Bản đồ gửi xe vẫn đang được cập nhật.'" 
    :badge="$locale === 'en' ? 'FLOOR PLAN & PARKING' : 'MẶT BẰNG & SƠ ĐỒ'" 
/>

<div class="py-14 md:py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 space-y-8">
        <x-meeting-rooms :rooms="$meetingRooms" />

        <x-updating-state
            :title="__('conference.venue_page.parking_map_title')"
            :subtitle="$locale === 'en' ? 'The delegate parking map at the National Convention Center is currently being updated by the Logistics Committee.' : 'Bản đồ hướng dẫn gửi xe tại Trung tâm Hội nghị Quốc gia đang được Ban Hậu cần cập nhật và sẽ thông báo trước ngày diễn ra sự kiện.'"
        />
    </div>
</div>
@endsection
