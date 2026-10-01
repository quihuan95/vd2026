@extends('layouts.conference')

@section('title', __('conference.register_form.title'))

@section('content')
<x-conference-hero-title 
    :title="__('conference.register_form.title')" 
    :subtitle="$locale === 'en' ? 'Registration portal is currently being prepared and will open soon' : 'Cổng đăng ký tham dự Hội nghị đang được chuẩn bị và sẽ sớm mở trong thời gian tới'" 
    :badge="$locale === 'en' ? 'REGISTRATION' : 'ĐĂNG KÝ THAM DỰ'" 
/>

<x-updating-state 
    :title="__('conference.register_form.title')" 
    :subtitle="$locale === 'en' ? 'The official registration portal for the Viet Duc University Hospital International Scientific Conference 2026 is currently being prepared and will be opened soon by the Organizing Committee. Please stay tuned for official announcements.' : 'Cổng đăng ký tham dự Hội nghị Khoa học Quốc tế Bệnh viện Hữu nghị Việt Đức 2026 đang được Ban Tổ chức chuẩn bị và sẽ sớm mở trong thời gian tới. Quý Đại biểu vui lòng theo dõi các thông báo chính thức tiếp theo.'" 
/>
@endsection
