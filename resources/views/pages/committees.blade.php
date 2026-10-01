@extends('layouts.conference')

@section('title', __('conference.nav.committees'))

@section('content')
<x-conference-hero-title 
    :title="__('conference.nav.committees')" 
    :subtitle="$locale === 'en' ? 'Organizing Committee information is currently being updated' : 'Danh sách Ban Tổ chức Hội nghị đang được cập nhật'" 
    :badge="$locale === 'en' ? 'ORGANIZING COMMITTEE' : 'BAN TỔ CHỨC'" 
/>

<x-updating-state 
    :title="__('conference.nav.committees')" 
    :subtitle="$locale === 'en' ? 'The official list of the Steering Committee, Organizing Committee, and Scientific Council of Viet Duc University Hospital 2026 is currently being finalized.' : 'Danh sách Ban Chỉ đạo, Ban Tổ chức và Hội đồng Khoa học của Hội nghị Khoa học Quốc tế Bệnh viện Hữu nghị Việt Đức 2026 đang được cập nhật.'" 
/>
@endsection
