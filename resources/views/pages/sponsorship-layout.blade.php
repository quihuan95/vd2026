@extends('layouts.conference')

@section('title', __('conference.nav.sponsorship_layout'))

@section('content')
<x-conference-hero-title 
    :title="__('conference.nav.sponsorship_layout')" 
    :subtitle="$locale === 'en' ? 'Sponsorship and exhibition floor plan is being updated' : 'Sơ đồ gian hàng triển lãm và tài trợ đang được cập nhật'" 
    :badge="$locale === 'en' ? 'EXHIBITION LAYOUT' : 'SƠ ĐỒ GIAN HÀNG'" 
/>

<x-updating-state 
    :title="__('conference.nav.sponsorship_layout')" 
    :subtitle="$locale === 'en' ? 'The exhibition floor plan and booth layout at National Convention Center are currently being updated by the Organizing Committee.' : 'Sơ đồ gian hàng triển lãm và khu vực trưng bày tại Trung tâm Hội nghị Quốc gia đang được Ban Tổ chức cập nhật và sẽ thông báo trong thời gian tới.'" 
/>
@endsection
