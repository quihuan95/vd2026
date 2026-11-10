@props(['rooms'])

@php($locale = app()->getLocale())

<div class="space-y-4">
    <div>
        <h3 class="text-lg font-bold text-slate-900">{{ $locale === 'en' ? 'Meeting room layout' : 'Sơ đồ phòng họp' }}</h3>
        <p class="mt-1 text-xs text-slate-600">
            {{ $locale === 'en'
                ? 'Room assignment for 19 November 2026 at the National Convention Center.'
                : 'Phân bổ phòng họp ngày 19/11/2026 tại Trung tâm Hội nghị Quốc gia.' }}
        </p>
    </div>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        @foreach ($rooms as $room)
            <article class="rounded-2xl border border-slate-200 bg-white p-4 shadow-2xs">
                <h4 class="text-sm font-extrabold text-emerald-900">{{ $room['name'] }}</h4>
                @if ($room['name_en'] !== '')
                    <p class="mt-0.5 text-[11px] font-semibold uppercase tracking-wide text-slate-500">{{ $room['name_en'] }}</p>
                @endif
                <ul class="mt-3 space-y-2">
                    @foreach ($room['sessions'] as $session)
                        <li class="border-t border-slate-100 pt-2 first:border-t-0 first:pt-0">
                            <p class="text-xs font-semibold text-slate-800">{{ $session['title'] }}</p>
                            @if ($session['title_en'] !== '')
                                <p class="text-[11px] text-slate-500">{{ $session['title_en'] }}</p>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </article>
        @endforeach
    </div>
</div>
