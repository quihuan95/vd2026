@extends('layouts.conference')

@section('title', __('conference.sponsorship_page.title'))

@section('content')
<x-conference-hero-title 
    :title="__('conference.sponsorship_page.title')" 
    :subtitle="__('conference.sponsorship_page.status')" 
    :badge="__('conference.sponsorship_page.badge')" 
/>

<x-updating-state 
    :title="__('conference.sponsorship_page.title')" 
    :subtitle="__('conference.sponsorship_page.status')" 
/>
@endsection
