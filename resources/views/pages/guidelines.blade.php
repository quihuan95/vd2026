@extends('layouts.conference')

@section('title', __('conference.nav.guidelines'))

@section('content')
<x-conference-hero-title 
    :title="__('conference.nav.guidelines')" 
    :subtitle="$locale === 'en' ? 'Scientific presentation guidelines are currently being updated' : 'Hướng dẫn báo cáo khoa học đang được cập nhật'" 
    :badge="$locale === 'en' ? 'SUBMISSION GUIDELINES' : 'HƯỚNG DẪN BÁO CÁO'" 
/>

<x-updating-state 
    :title="__('conference.nav.guidelines')" 
    :subtitle="$locale === 'en' ? 'Guidelines and formatting requirements for scientific abstracts and presentations are currently being finalized by the Scientific Committee.' : 'Thể lệ và quy chuẩn định dạng bài báo cáo khoa học gửi về Hội đồng Chuyên môn đang được Ban Tổ chức cập nhật.'" 
/>
@endsection
