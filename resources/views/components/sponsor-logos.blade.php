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

<div
    class="space-y-8"
    x-data="{ active: null }"
    x-effect="document.body.classList.toggle('overflow-hidden', active !== null)"
    @keydown.escape.window="active = null"
>
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
                    @if (! empty($logo['posts']))
                        <button
                            type="button"
                            class="group relative flex min-h-0 cursor-pointer items-center justify-center overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-200 hover:-translate-y-1 hover:border-emerald-700 hover:shadow-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-700 {{ $tier['card'] }}"
                            aria-label="Xem bài đăng {{ $logo['name'] }}"
                            @click="active = {{ \Illuminate\Support\Js::from(['name' => $logo['name'], 'posts' => $logo['posts']]) }}"
                        >
                            <img
                                src="{{ $logo['url'] }}"
                                alt="{{ $logo['name'] }}"
                                class="h-full w-full min-h-0 object-contain transition duration-200 group-hover:scale-105"
                                loading="lazy"
                            >
                            <span class="pointer-events-none absolute inset-x-3 bottom-3 rounded-full bg-emerald-800 px-3 py-1 text-xs font-bold text-white opacity-100 transition sm:opacity-0 sm:group-hover:opacity-100">Xem bài đăng</span>
                        </button>
                    @else
                        <div class="flex min-h-0 items-center justify-center overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm {{ $tier['card'] }}">
                            <img
                                src="{{ $logo['url'] }}"
                                alt="{{ $logo['name'] }}"
                                class="h-full w-full min-h-0 object-contain"
                                loading="lazy"
                            >
                        </div>
                    @endif
                @endforeach
            </div>
        </section>
    @endforeach

    <template x-teleport="body">
        <div
            x-show="active"
            x-cloak
            class="fixed inset-0 z-50 overflow-y-auto p-4 sm:p-8"
            role="dialog"
            aria-modal="true"
            aria-labelledby="sponsor-post-title"
        >
            <button type="button" class="fixed inset-0 bg-slate-950/70" @click="active = null" aria-label="Đóng bài đăng"></button>
            <div class="relative z-10 mx-auto w-full max-w-3xl rounded-3xl bg-white p-4 shadow-2xl sm:p-6">
                <div class="mb-4 flex items-start justify-between gap-4">
                    <h3 id="sponsor-post-title" class="text-lg font-extrabold text-slate-950" x-text="active?.name"></h3>
                    <button type="button" class="shrink-0 rounded-full bg-slate-100 px-4 py-2 text-sm font-bold text-slate-700 transition hover:bg-slate-200" @click="active = null">Đóng</button>
                </div>
                <div class="space-y-4">
                    <template x-for="(page, index) in active?.posts ?? []" :key="index">
                        <img :src="page" :alt="active?.name" class="w-full rounded-xl border border-slate-200">
                    </template>
                </div>
            </div>
        </div>
    </template>
</div>
