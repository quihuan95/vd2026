@extends('layouts.conference')

@section('title', __('conference.nav.travel'))

@section('content')
<x-conference-hero-title 
    :title="__('conference.nav.travel')" 
    :subtitle="$locale === 'en' ? 'Logistics, accommodation, and travel guidance are currently being updated' : 'Thông tin hậu cần, lưu trú và di chuyển đang được cập nhật'" 
    :badge="$locale === 'en' ? 'LOGISTICS & TRAVEL' : 'HẬU CẦN & LƯU TRÚ'" 
/>

<x-updating-state 
    :title="__('conference.nav.travel')" 
    :subtitle="$locale === 'en' ? 'Detailed guidance on hotels, visa procedures, airport transfers, and Hanoi travel is currently being updated by the Logistics Committee.' : 'Thông tin chi tiết về khách sạn, visa, phương tiện di chuyển và hướng dẫn tham quan Hà Nội đang được Ban Hậu cần cập nhật. Đầu mối liên hệ: TS. Bùi Trung Nghĩa (+84 948 996 688) & Bà Phạm Bích Vân (+84 917 738 321).'" 
/>
@endsection
