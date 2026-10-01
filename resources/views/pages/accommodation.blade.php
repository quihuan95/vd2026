@extends('layouts.conference')

@section('title', $locale === 'en' ? 'Hotels & Accommodation' : 'Khách Sạn & Lưu Trú')

@section('content')
<x-conference-hero-title 
    :title="$locale === 'en' ? 'Hotels & Accommodation' : 'Khách Sạn & Lưu Trú'" 
    :subtitle="$locale === 'en' ? 'Partner hotels and preferred rates are currently being updated' : 'Danh sách khách sạn đối tác và chính sách giá ưu đãi đang được cập nhật'" 
    :badge="$locale === 'en' ? 'ACCOMMODATION' : 'LƯU TRÚ'" 
/>

<x-updating-state 
    :title="$locale === 'en' ? 'Hotels & Accommodation' : 'Khách Sạn & Lưu Trú'" 
    :subtitle="$locale === 'en' ? 'List of partnered 4-5 star hotels near the National Convention Center is being finalized. Contact: TS. Bui Trung Nghia (+84 948 996 688).' : 'Danh sách khách sạn đối tác 4-5 sao gần Trung tâm Hội nghị Quốc gia đang được Ban Hậu cần cập nhật. Đầu mối hỗ trợ: TS. Bùi Trung Nghĩa (+84 948 996 688).'" 
/>
@endsection
