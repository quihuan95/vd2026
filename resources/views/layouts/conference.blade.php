<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', __('conference.conference_name')) — {{ __('conference.conference_short_name') }}</title>
    <meta name="description" content="@yield('meta_description', __('conference.home.intro_p1'))">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/vietduc-logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/vietduc-logo.png') }}">

    <!-- Google Fonts: Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600&display=swap" rel="stylesheet">

    <!-- Vite Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen flex flex-col bg-white text-slate-800 antialiased selection:bg-emerald-600 selection:text-white" x-data="{ mobileMenu: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 24)">

    <!-- Top Announcement Bar -->
    <div class="bg-gradient-to-r from-emerald-950 via-emerald-900 to-emerald-950 text-emerald-100 text-xs py-2 px-4 border-b border-emerald-800/50">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-amber-400 text-emerald-950 uppercase tracking-wider">1906 – 2026</span>
                <span class="font-medium text-emerald-200 hidden sm:inline">{{ __('conference.anniversary_title') }}</span>
                <span class="sm:hidden font-medium">{{ __('conference.conference_short_name') }}</span>
            </div>
            <div class="flex items-center gap-4 text-emerald-300">
                <a href="mailto:{{ __('conference.secretariat_email') }}" class="hover:text-white transition flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span>{{ __('conference.secretariat_email') }}</span>
                </a>
                <span class="hidden md:inline text-emerald-700">|</span>
                <a href="tel:{{ __('conference.hotline') }}" class="hover:text-white transition hidden md:flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    <span>{{ __('conference.hotline') }}</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Sticky Main Header -->
    <header :class="scrolled ? 'shadow-md border-b border-emerald-900/10 bg-white/95 backdrop-blur-md' : 'border-b border-slate-200/80 bg-white'" class="sticky top-0 z-40 transition-all duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between h-20 gap-4">
                
                <!-- Left: Logo & Branding -->
                <div class="flex items-center flex-shrink-0">
                    <a href="{{ route('conference.home', ['locale' => $locale]) }}" class="flex items-center py-2 group" title="{{ __('conference.conference_name') }}">
                        <img src="{{ asset('assets/images/vietduc-logo.png') }}" alt="VDUH Logo" class="h-12 xl:h-14 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
                    </a>
                </div>

                <!-- Right Nav & Actions (Desktop) -->
                <div class="hidden lg:flex items-center space-x-1 xl:space-x-2">
                    <nav class="flex items-center space-x-0.5 xl:space-x-1.5">
                        <a href="{{ route('conference.home', ['locale' => $locale]) }}" class="px-2.5 py-2 text-xs font-bold uppercase tracking-wider text-slate-800 hover:text-emerald-700 hover:bg-emerald-50/60 rounded-md transition {{ request()->routeIs('conference.home') ? 'text-emerald-700 font-extrabold bg-emerald-50' : '' }}">
                            {{ __('conference.nav.welcome') }}
                        </a>

                        <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'invitation']) }}" class="px-2.5 py-2 text-xs font-bold uppercase tracking-wider text-slate-800 hover:text-emerald-700 hover:bg-emerald-50/60 rounded-md transition {{ request()->is('*/invitation') ? 'text-emerald-700 font-extrabold bg-emerald-50' : '' }}">
                            {{ __('conference.nav.invitation') }}
                        </a>

                        <!-- Dropdown: Conference Info -->
                        <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                            <button @click="open = !open" class="px-2.5 py-2 text-xs font-bold uppercase tracking-wider text-slate-800 hover:text-emerald-700 rounded-md transition inline-flex items-center gap-1">
                                <span>{{ __('conference.nav.conference_info') }}</span>
                                <svg class="w-3.5 h-3.5 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-100" class="absolute left-0 mt-1 w-64 bg-white rounded-lg shadow-xl border border-slate-200 py-2 z-50">
                                <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'about']) }}" class="block px-4 py-2.5 text-xs text-slate-700 hover:bg-emerald-50 hover:text-emerald-800 font-semibold">{{ __('conference.nav.about') }}</a>
                                <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'speakers']) }}" class="block px-4 py-2.5 text-xs text-slate-700 hover:bg-emerald-50 hover:text-emerald-800 font-semibold">{{ __('conference.nav.speakers') }}</a>
                                <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'venue']) }}" class="block px-4 py-2.5 text-xs text-slate-700 hover:bg-emerald-50 hover:text-emerald-800 font-semibold">{{ __('conference.nav.venue') }}</a>
                                <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'layout']) }}" class="block px-4 py-2.5 text-xs text-slate-700 hover:bg-emerald-50 hover:text-emerald-800 font-semibold">{{ __('conference.nav.layout') }}</a>
                            </div>
                        </div>

                        <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'program']) }}" class="px-2.5 py-2 text-xs font-bold uppercase tracking-wider text-slate-800 hover:text-emerald-700 hover:bg-emerald-50/60 rounded-md transition {{ request()->is('*/program') ? 'text-emerald-700 font-extrabold bg-emerald-50' : '' }}">
                            {{ __('conference.nav.program') }}
                        </a>

                        <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'sponsorship']) }}" class="px-2.5 py-2 text-xs font-bold uppercase tracking-wider text-slate-800 hover:text-emerald-700 rounded-md transition {{ request()->is('*/sponsorship') ? 'text-emerald-700 font-extrabold bg-emerald-50' : '' }}">
                            {{ __('conference.nav.sponsorship') }}
                        </a>
                        <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'contact']) }}" class="px-2.5 py-2 text-xs font-bold uppercase tracking-wider text-slate-800 hover:text-emerald-700 rounded-md transition {{ request()->is('*/contact') ? 'text-emerald-700 font-extrabold bg-emerald-50' : '' }}">
                            {{ __('conference.nav.contact') }}
                        </a>
                    </nav>

                    <!-- Register CTA Button -->
                    <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'register']) }}" class="btn-primary text-xs !py-2 !px-3.5 whitespace-nowrap">
                        {{ __('conference.cta.register_now') }}
                    </a>
                </div>

                <!-- Mobile Hamburger Button -->
                <div class="flex lg:hidden items-center gap-2">
                    <button @click="mobileMenu = !mobileMenu" type="button" class="p-2 text-slate-700 hover:text-emerald-800 rounded-md" aria-label="Toggle menu">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!mobileMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            <path x-show="mobileMenu" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer -->
        <div x-show="mobileMenu" x-cloak class="lg:hidden border-t border-slate-200 bg-white max-h-[85vh] overflow-y-auto px-4 py-4 space-y-3 shadow-2xl">
            <a href="{{ route('conference.home', ['locale' => $locale]) }}" class="block px-3 py-2 text-sm font-bold uppercase text-slate-800 hover:bg-emerald-50 rounded">
                {{ __('conference.nav.welcome') }}
            </a>
            <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'invitation']) }}" class="block px-3 py-2 text-sm font-bold uppercase text-slate-800 hover:bg-emerald-50 rounded">{{ __('conference.nav.invitation') }}</a>
            
            <div class="pt-2 border-t border-slate-100">
                <span class="block px-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">{{ __('conference.nav.conference_info') }}</span>
                <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'about']) }}" class="block px-3 py-1.5 text-sm text-slate-700 hover:bg-slate-50">{{ __('conference.nav.about') }}</a>
                <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'speakers']) }}" class="block px-3 py-1.5 text-sm text-slate-700 hover:bg-slate-50">{{ __('conference.nav.speakers') }}</a>
                <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'venue']) }}" class="block px-3 py-1.5 text-sm text-slate-700 hover:bg-slate-50">{{ __('conference.nav.venue') }}</a>
                <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'layout']) }}" class="block px-3 py-1.5 text-sm text-slate-700 hover:bg-slate-50">{{ __('conference.nav.layout') }}</a>
            </div>

            <div class="pt-2 border-t border-slate-100 space-y-1">
                <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'program']) }}" class="block px-3 py-1.5 text-sm font-semibold text-slate-700">{{ __('conference.nav.program') }}</a>
                <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'sponsorship']) }}" class="block px-3 py-1.5 text-sm font-semibold text-slate-700">{{ __('conference.nav.sponsorship') }}</a>
                <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'contact']) }}" class="block px-3 py-1.5 text-sm font-semibold text-slate-700">{{ __('conference.nav.contact') }}</a>
            </div>

            <div class="pt-3">
                <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'register']) }}" class="btn-primary w-full text-center">
                    {{ __('conference.cta.register_now') }}
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Slot -->
    <main id="main" class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-20 bg-emerald-950 text-emerald-100 border-t-4 border-amber-400">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-14">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Col 1: Organizer info -->
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <img src="{{ asset('assets/images/vietduc-logo.png') }}" alt="VDUH Logo" class="h-12 w-auto brightness-0 invert">
                        <div>
                            <div class="font-bold text-white tracking-wide">{{ __('conference.footer.organizer') }}</div>
                            <div class="text-xs text-amber-300 font-semibold">{{ __('conference.footer.anniversary') }}</div>
                        </div>
                    </div>
                    <div class="text-xs text-emerald-400 space-y-1">
                        <div><strong>{{ __('conference.venue_conference') }}:</strong> {{ __('conference.venue_conference_address') }}</div>
                        <div><strong>{{ $locale === 'en' ? 'Date:' : 'Thời gian:' }}</strong> {{ __('conference.event_dates') }}</div>
                    </div>
                </div>

                <!-- Col 2: Secretariat & Contacts -->
                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4 border-l-2 border-amber-400 pl-2">
                        {{ __('conference.footer.secretariat_title') }}
                    </h3>
                    <ul class="text-xs text-emerald-200 space-y-2.5">
                        <li>
                            <strong class="text-white">{{ __('conference.footer.official_email') }}:</strong><br>
                            <a href="mailto:{{ __('conference.secretariat_email') }}" class="text-amber-300 hover:underline">{{ __('conference.secretariat_email') }}</a>
                        </li>
                        <li>
                            <strong class="text-white">{{ __('conference.footer.scientific_secretary') }}:</strong><br>
                            <span class="text-emerald-300">{{ __('conference.footer.scientific_secretary_val') }}</span>
                        </li>
                        <li>
                            <strong class="text-white">{{ __('conference.footer.logistics_title') }}:</strong><br>
                            <span class="text-emerald-300">{{ __('conference.footer.logistics_val1') }}</span><br>
                            <span class="text-emerald-300">{{ __('conference.footer.logistics_val2') }}</span>
                        </li>
                    </ul>
                </div>

                <!-- Col 3: Quick Links & Documents -->
                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4 border-l-2 border-amber-400 pl-2">
                        {{ __('conference.footer.docs_title') }}
                    </h3>
                    <div class="space-y-2 text-xs">
                        <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'about']) }}" class="flex items-center gap-2 p-2 rounded bg-emerald-900/60 hover:bg-emerald-800 text-amber-200 transition">
                            <span>📜</span>
                            <span class="font-semibold">{{ __('conference.footer.welcome_letter') }}</span>
                        </a>
                        <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'register']) }}" class="flex items-center gap-2 p-2 rounded bg-emerald-900/60 hover:bg-emerald-800 text-emerald-200 transition">
                            <span>📝</span>
                            <span>{{ __('conference.footer.registration') }}</span>
                        </a>
                        <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'venue']) }}" class="flex items-center gap-2 p-2 rounded bg-emerald-900/60 hover:bg-emerald-800 text-emerald-200 transition">
                            <span>📍</span>
                            <span>{{ __('conference.footer.venue') }}</span>
                        </a>
                        <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'contact']) }}" class="flex items-center gap-2 p-2 rounded bg-emerald-900/60 hover:bg-emerald-800 text-emerald-200 transition">
                            <span>✉️</span>
                            <span>{{ __('conference.nav.contact') }}</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-6 border-t border-emerald-900 flex flex-col md:flex-row items-center justify-between text-xs text-emerald-400 gap-4">
                <div>
                    {{ __('conference.footer.copyright') }}
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'about']) }}" class="hover:text-white">{{ __('conference.nav.about') }}</a>
                    <span>•</span>
                    <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'venue']) }}" class="hover:text-white">{{ __('conference.nav.venue') }}</a>
                    <span>•</span>
                    <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'program']) }}" class="hover:text-white">{{ __('conference.nav.program') }}</a>
                    <span>•</span>
                    <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'contact']) }}" class="hover:text-white">{{ __('conference.nav.contact') }}</a>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
