@extends('layouts.conference')

@section('title', $locale === 'en' ? 'Visa Guidelines' : 'Thủ Tục Thị Thực')

@section('content')
<x-conference-hero-title 
    :title="$locale === 'en' ? 'Visa Guidelines' : 'Thủ Tục Thị Thực (Visa)'" 
    :subtitle="$locale === 'en' ? 'Visa procedures for international delegates are currently being updated' : 'Hướng dẫn thủ tục thị thực cho đại biểu quốc tế đang được cập nhật'" 
    :badge="$locale === 'en' ? 'VISA GUIDELINES' : 'THỊ THỰC & VISA'" 
/>

<x-updating-state 
    :title="$locale === 'en' ? 'Visa Guidelines' : 'Thủ Tục Thị Thực (Visa)'" 
    :subtitle="$locale === 'en' ? 'For international delegates requiring official invitation letters for visa purposes, please contact: eventvietduc@vduh.org.' : 'Đại biểu quốc tế cần thư mời chính thức để làm thủ tục thị thực, vui lòng liên hệ Ban Tổ chức qua email: eventvietduc@vduh.org.'" 
/>
@endsection
