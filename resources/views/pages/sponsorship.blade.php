@extends('layouts.conference')

@section('title', __('conference.sponsorship_page.title'))

@section('content')
<x-conference-hero-title
    :title="__('conference.sponsorship_page.title')"
    :subtitle="__('conference.sponsorship_page.status')"
    :badge="__('conference.sponsorship_page.badge')"
    centered
/>

<section class="bg-slate-50 py-12 md:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <x-sponsor-logos :sponsors="$sponsors" />
    </div>
</section>
@endsection
