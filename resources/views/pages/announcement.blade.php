@extends('layouts.conference')

@section('title', __('conference.nav.announcement'))

@section('content')
<x-conference-hero-title 
    :title="__('conference.nav.announcement')" 
    :subtitle="$locale === 'en' ? 'Official conference announcements are currently being updated' : 'Các thông báo chính thức của Hội nghị đang được cập nhật'" 
    :badge="$locale === 'en' ? 'ANNOUNCEMENTS' : 'THÔNG BÁO'" 
/>

<x-updating-state 
    :title="__('conference.nav.announcement')" 
    :subtitle="$locale === 'en' ? 'Official notifications and documents from the Organizing Committee will be published here.' : 'Các thông báo chính thức từ Ban Tổ chức Hội nghị sẽ được đăng tải tại đây.'" 
/>
@endsection
