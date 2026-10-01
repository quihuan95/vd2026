@extends('layouts.conference')

@section('title', $locale === 'en' ? 'Transportation' : 'Phương Tiện Di Chuyển')

@section('content')
<x-conference-hero-title 
    :title="$locale === 'en' ? 'Transportation' : 'Phương Tiện Di Chuyển'" 
    :subtitle="$locale === 'en' ? 'Transit guidelines to the venue are currently being updated' : 'Hướng dẫn di chuyển đến địa điểm hội nghị đang được cập nhật'" 
    :badge="$locale === 'en' ? 'TRANSPORTATION' : 'DI CHUYỂN'" 
/>

<x-updating-state 
    :title="$locale === 'en' ? 'Transportation' : 'Phương Tiện Di Chuyển'" 
    :subtitle="$locale === 'en' ? 'Information on airport transfers from Noi Bai International Airport (HAN) and city transit to National Convention Center is being updated.' : 'Thông tin đón tiễn sân bay Nội Bài và hướng dẫn di chuyển bằng taxi, phương tiện công cộng tới Trung tâm Hội nghị Quốc gia đang được cập nhật.'" 
/>
@endsection
