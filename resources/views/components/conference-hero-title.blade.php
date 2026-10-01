@props([
    'title' => '',
    'subtitle' => null,
    'badge' => null,
])

<section class="relative bg-gradient-to-b from-emerald-950 via-emerald-900 to-slate-900 text-white py-14 md:py-20 border-b border-emerald-800/40 overflow-hidden">
    <!-- Ambient glows -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-amber-400/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-10 w-80 h-80 bg-emerald-500/15 rounded-full blur-3xl"></div>
        <div class="absolute inset-0 bg-[radial-gradient(rgba(255,255,255,0.04)_1px,transparent_1px)] [background-size:20px_20px]"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
        @if($badge)
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-400/15 border border-amber-400/40 text-amber-300 text-xs font-bold uppercase tracking-wider mb-4">
                <span>{{ $badge }}</span>
            </div>
        @endif

        <h1 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white mb-3 max-w-4xl">
            {{ $title }}
        </h1>

        @if($subtitle)
            <p class="text-sm sm:text-base text-emerald-200/90 max-w-3xl leading-relaxed">
                {{ $subtitle }}
            </p>
        @endif
    </div>
</section>
