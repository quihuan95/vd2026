@extends('layouts.conference')

@section('title', __('conference.nav.speakers'))

@section('content')
<x-conference-hero-title 
    :title="__('conference.nav.speakers')" 
    :subtitle="$locale === 'en' ? 'Keynote faculty and invited speakers list is currently being updated' : 'Danh sách chuyên gia và báo cáo viên đang được cập nhật'" 
    :badge="$locale === 'en' ? 'SPEAKERS & FACULTY' : 'DIỄN GIẢ & BÁO CÁO VIÊN'" 
/>

<x-updating-state 
    :title="__('conference.nav.speakers')" 
    :subtitle="$locale === 'en' ? 'The list of keynote speakers and international experts participating in the Viet Duc University Hospital International Scientific Conference 2026 is currently being updated.' : 'Danh sách các chuyên gia, giáo sư, bác sĩ và báo cáo viên trong nước và quốc tế tham gia Hội nghị đang được Ban Thư ký chuyên môn cập nhật.'" 
/>
@endsection
