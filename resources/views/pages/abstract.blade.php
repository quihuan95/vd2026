@extends('layouts.conference')

@section('title', __('conference.nav.abstract'))

@section('content')
<x-conference-hero-title 
    :title="__('conference.nav.abstract')" 
    :subtitle="$locale === 'en' ? 'Scientific abstract submission portal is currently being updated' : 'Cổng tiếp nhận báo cáo khoa học đang được cập nhật'" 
    :badge="$locale === 'en' ? 'ABSTRACT SUBMISSION' : 'NỘP BÁO CÁO KHOA HỌC'" 
/>

<x-updating-state 
    :title="__('conference.nav.abstract')" 
    :subtitle="$locale === 'en' ? 'The online submission portal for scientific abstracts across 15 tracks is currently being updated by the Scientific Council.' : 'Hệ thống tiếp nhận tóm tắt báo cáo khoa học trực tuyến cho 15 chuyên đề đang được Ban Thư ký chuyên môn cập nhật. Mọi thông tin xin liên hệ email: eventvietduc@vduh.org'" 
/>
@endsection
