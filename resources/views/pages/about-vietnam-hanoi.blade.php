@extends('layouts.conference')

@section('title', $locale === 'en' ? 'About Hanoi, Vietnam' : 'Về Hà Nội, Việt Nam')

@section('content')
<x-conference-hero-title 
    :title="$locale === 'en' ? 'About Hanoi, Vietnam' : 'Về Hà Nội, Việt Nam'" 
    :subtitle="$locale === 'en' ? 'Discovering Hanoi during November autumn' : 'Khám phá mùa thu Hà Nội và di sản văn hóa nghìn năm'" 
    :badge="$locale === 'en' ? 'DESTINATION HANOI' : 'HÀ NỘI 2026'" 
/>

<x-updating-state 
    :title="$locale === 'en' ? 'About Hanoi, Vietnam' : 'Về Hà Nội, Việt Nam'" 
    :subtitle="$locale === 'en' ? 'Destination recommendations and cultural guide for international delegates visiting Hanoi will be updated soon.' : 'Cẩm nang khám phá văn hóa, ẩm thực và du lịch Thủ đô Hà Nội dành cho đại biểu đang được cập nhật.'" 
/>
@endsection
