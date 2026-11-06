@props([
    'sponsors' => [],
])

@php
    $tiers = [
        'diamond' => ['label' => 'Kim cương', 'grid' => 'mx-auto max-w-5xl grid-cols-1 sm:grid-cols-2', 'card' => 'h-40 p-5 sm:h-56 sm:p-8', 'panel' => 'border-amber-300 bg-gradient-to-b from-amber-50 to-white shadow-md', 'title' => 'text-amber-900', 'line' => 'bg-amber-300'],
        'platinum' => ['label' => 'Bạch kim', 'grid' => 'mx-auto max-w-5xl grid-cols-1 sm:grid-cols-3', 'card' => 'h-32 p-4 sm:h-40 sm:p-6', 'panel' => 'border-emerald-300 bg-gradient-to-b from-emerald-50 to-white shadow-sm', 'title' => 'text-emerald-950', 'line' => 'bg-emerald-300'],
        'gold' => ['label' => 'Vàng', 'grid' => 'mx-auto max-w-xs grid-cols-1', 'card' => 'h-28 p-4 sm:h-32', 'panel' => 'border-amber-200 bg-amber-50/80', 'title' => 'text-amber-800', 'line' => 'bg-amber-300'],
        'silver' => ['label' => 'Bạc', 'grid' => 'mx-auto max-w-4xl grid-cols-1 sm:grid-cols-3', 'card' => 'h-24 p-3 sm:h-28', 'panel' => 'border-slate-300 bg-slate-100', 'title' => 'text-slate-700', 'line' => 'bg-slate-300'],
        'bronze' => ['label' => 'Đồng', 'grid' => 'grid-cols-2 sm:grid-cols-3 lg:grid-cols-4', 'card' => 'h-20 p-3 sm:h-24', 'panel' => 'border-orange-200 bg-orange-50', 'title' => 'text-orange-900', 'line' => 'bg-orange-200'],
        'co_sponsor' => ['label' => 'Đồng tài trợ', 'grid' => 'grid-cols-2 sm:grid-cols-3 lg:grid-cols-5', 'card' => 'h-16 p-2 sm:h-20', 'panel' => 'border-emerald-100 bg-white shadow-sm', 'title' => 'text-emerald-800', 'line' => 'bg-emerald-200'],
    ];
@endphp

<div class="space-y-8">
    @foreach ($tiers as $key => $tier)
        @continue(empty($sponsors[$key]))

        <section class="rounded-3xl border px-4 py-8 sm:px-8 {{ $tier['panel'] }}">
            <div class="mb-6 flex items-center justify-center gap-3">
                <span class="h-px w-10 sm:w-16 {{ $tier['line'] }}"></span>
                <h2 class="text-center text-base sm:text-lg font-extrabold uppercase tracking-widest {{ $tier['title'] }}">{{ $tier['label'] }}</h2>
                <span class="h-px w-10 sm:w-16 {{ $tier['line'] }}"></span>
            </div>

            <div class="grid gap-4 {{ $tier['grid'] }}">
                @foreach ($sponsors[$key] as $logo)
                    <div class="flex min-h-0 items-center justify-center overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm {{ $tier['card'] }}">
                        <img
                            src="{{ $logo['url'] }}"
                            alt="{{ $logo['name'] }}"
                            class="h-full w-full min-h-0 object-contain"
                            loading="lazy"
                        >
                    </div>
                @endforeach
            </div>
        </section>
    @endforeach
</div>
