@extends('layouts.conference')

@section('title', 'Chương trình / Program')

@section('content')
@php
    $programRows = json_decode(file_get_contents(resource_path('program.json')), true, flags: JSON_THROW_ON_ERROR);
@endphp

<x-conference-hero-title
    title="Chương trình Hội thảo Khoa học Quốc tế"
    subtitle="Viet Duc University Hospital International Scientific Conference Program"
    badge="CHƯƠNG TRÌNH / PROGRAM"
/>

<main
    class="bg-slate-50 py-10 sm:py-14"
    x-data="conferenceProgram({{ Js::from($programRows) }})"
    x-effect="visibleRowIndices = matchingRowIndices()"
>
    <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6">
        <section aria-labelledby="program-overview-title" class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
            <h2 id="program-overview-title" class="text-xl font-extrabold text-slate-950">Khung thời gian tổng thể / Program Overview</h2>
            <dl class="mt-5 grid gap-4 sm:grid-cols-2">
                <div class="rounded-2xl bg-emerald-50 p-5">
                    <dt class="font-bold text-emerald-800">10h15 – 12h15</dt>
                    <dd class="mt-2 font-semibold text-slate-900">Phiên 2 / Session 2</dd>
                </div>
                <div class="rounded-2xl bg-amber-50 p-5">
                    <dt class="font-bold text-amber-800">12h15 – 13h00</dt>
                    <dd class="mt-2 font-semibold text-slate-900">Ăn trưa / Lunch</dd>
                </div>
            </dl>
        </section>

        <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="flex flex-col gap-5 border-b border-slate-200 p-6 sm:p-8 lg:flex-row lg:items-end lg:justify-between">
                <div class="space-y-3">
                    <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold uppercase tracking-wider text-emerald-800">
                        19/11/2026 · November 19, 2026
                    </span>
                    <div>
                        <h1 class="text-xl font-extrabold text-slate-950 sm:text-2xl">Chương trình chi tiết song ngữ</h1>
                        <p class="mt-1 text-sm font-semibold text-emerald-800 sm:text-base">Bilingual Detailed Program</p>
                    </div>
                    <p class="text-sm text-slate-600">
                        <strong class="text-slate-800">Địa điểm / Venue:</strong>
                        Trung tâm Hội nghị Quốc gia / National Convention Center
                    </p>
                </div>

                <label class="block w-full lg:max-w-md">
                    <span class="mb-2 block text-xs font-bold uppercase tracking-wide text-slate-600">Tìm kiếm / Search</span>
                    <span class="relative block">
                        <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35m1.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                        </svg>
                        <input
                            x-model="searchQuery"
                            type="search"
                            class="w-full rounded-2xl border border-slate-300 bg-slate-50 py-3 pl-11 pr-4 text-sm text-slate-900 outline-none transition focus:border-emerald-700 focus:bg-white focus:ring-2 focus:ring-emerald-700/20"
                            placeholder="Tên bài, báo cáo viên, đơn vị / Topic, speaker, organization"
                        >
                    </span>
                </label>
            </div>

            <div class="space-y-5 border-b border-slate-200 bg-slate-50 p-6 sm:px-8">
                <fieldset>
                    <legend class="mb-3 text-xs font-bold uppercase tracking-wide text-slate-600">Chọn phòng / Choose a room</legend>
                    <div class="flex flex-wrap gap-2">
                        <button type="button" @click="selectedRoom = ''" :aria-pressed="selectedRoom === ''" :class="selectedRoom === '' ? 'border-emerald-800 bg-emerald-800 text-white' : 'border-slate-300 bg-white text-slate-700 hover:border-emerald-700'" class="rounded-xl border px-4 py-2.5 text-sm font-semibold transition">Tất cả phòng / All rooms</button>
                        <template x-for="room in rooms" :key="room.id">
                            <button type="button" @click="selectedRoom = room.id" :aria-pressed="selectedRoom === room.id" :class="selectedRoom === room.id ? 'border-emerald-800 bg-emerald-800 text-white' : 'border-slate-300 bg-white text-slate-700 hover:border-emerald-700'" class="rounded-xl border px-4 py-2.5 text-left text-sm font-semibold transition" x-text="room.label"></button>
                        </template>
                    </div>
                </fieldset>
                <div class="flex flex-col gap-4 border-t border-slate-200 pt-4 sm:flex-row sm:items-end sm:justify-between">
                    <fieldset>
                        <legend class="mb-3 text-xs font-bold uppercase tracking-wide text-slate-600">Khung phiên / Session</legend>
                        <div class="flex flex-wrap gap-2">
                            <button type="button" @click="selectedSession = ''" :aria-pressed="selectedSession === ''" :class="selectedSession === '' ? 'border-emerald-800 bg-emerald-800 text-white' : 'border-slate-300 bg-white text-slate-700 hover:border-emerald-700'" class="rounded-xl border px-4 py-2.5 text-sm font-semibold transition">Tất cả phiên / All sessions</button>
                        @foreach (range(1, 4) as $sessionNumber)
                            <button type="button" @click="selectedSession = '{{ $sessionNumber }}'" :aria-pressed="selectedSession === '{{ $sessionNumber }}'" :class="selectedSession === '{{ $sessionNumber }}' ? 'border-emerald-800 bg-emerald-800 text-white' : 'border-slate-300 bg-white text-slate-700 hover:border-emerald-700'" class="rounded-xl border px-4 py-2.5 text-sm font-semibold transition">Phiên {{ $sessionNumber }} / Session {{ $sessionNumber }}</button>
                        @endforeach
                        </div>
                    </fieldset>
                    <button type="button" @click="resetFilters()" class="shrink-0 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-emerald-800 hover:bg-emerald-50">Đặt lại bộ lọc / Reset filters</button>
                </div>
            </div>

            <p x-cloak x-show="visibleRowIndices.length === 0" role="status" class="p-8 text-center text-sm text-slate-600">Không tìm thấy nội dung phù hợp. Hãy đổi phòng, phiên hoặc từ khóa. / No matching results. Try another room, session, or keyword.</p>

            <div x-show="visibleRowIndices.length > 0" class="overflow-x-auto" tabindex="0" role="region" aria-label="Chương trình hội thảo song ngữ">
                <table class="w-full min-w-[980px] border-collapse text-left text-sm">
                    <thead class="sticky top-0 z-10 bg-emerald-900 text-white">
                        <tr>
                            <th scope="col" class="w-36 px-4 py-4 font-bold">Thời gian<br><span class="font-medium text-emerald-100">Timeline</span></th>
                            <th scope="col" class="w-[38%] px-5 py-4 font-bold">Chủ đề<br><span class="font-medium text-emerald-100">Topic</span></th>
                            <th scope="col" class="w-64 px-5 py-4 font-bold">Báo cáo viên<br><span class="font-medium text-emerald-100">Speaker</span></th>
                            <th scope="col" class="px-5 py-4 font-bold">Đơn vị công tác<br><span class="font-medium text-emerald-100">Organization</span></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach ($programRows as $rowIndex => $row)
                            @if ($row['kind'] === 'hall')
                                <tr x-show="visibleRowIndices.includes({{ $rowIndex }})" class="bg-emerald-950 text-white">
                                    <th colspan="4" class="px-5 py-5 text-base font-extrabold sm:text-lg">
                                        @foreach ($row['cells'][0] as $line)
                                            <span class="block {{ $loop->first ? '' : 'mt-1 text-sm font-semibold text-emerald-100' }}">{{ $line }}</span>
                                        @endforeach
                                    </th>
                                </tr>
                            @elseif ($row['kind'] === 'session')
                                <tr x-show="visibleRowIndices.includes({{ $rowIndex }})" class="bg-emerald-50 text-slate-900">
                                    <th colspan="4" class="px-5 py-4">
                                        @foreach ($row['cells'][0] as $line)
                                            <span class="block {{ $loop->first ? 'font-extrabold text-emerald-950' : 'mt-1 text-xs font-semibold text-slate-600' }}">{{ $line }}</span>
                                        @endforeach
                                    </th>
                                </tr>
                            @else
                                <tr
                                    x-show="visibleRowIndices.includes({{ $rowIndex }})"
                                    class="odd:bg-white even:bg-slate-50/70 hover:bg-emerald-50/60"
                                >
                                    @foreach ($row['cells'] as $cellIndex => $paragraphs)
                                        <td
                                            @if ($row['kind'] === 'break' && $cellIndex === 1) colspan="3" @endif
                                            class="px-{{ $cellIndex === 0 ? '4' : '5' }} py-4 align-top {{ $cellIndex === 0 ? 'whitespace-nowrap font-bold text-emerald-800' : '' }} {{ $row['kind'] === 'break' ? 'bg-amber-50/70 font-semibold text-amber-950' : '' }}"
                                        >
                                            @forelse ($paragraphs as $line)
                                                <span class="block leading-relaxed {{ $loop->first ? 'font-semibold text-slate-900' : 'mt-1 border-t border-slate-200/70 pt-1 text-xs text-slate-600' }}">{{ $line }}</span>
                                            @empty
                                                <span class="text-slate-400">—</span>
                                            @endforelse
                                        </td>
                                    @endforeach
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <p class="text-center text-xs text-slate-500">
            Trên màn hình nhỏ, vuốt ngang để xem đầy đủ nội dung. / Swipe horizontally on smaller screens to view the full program.
        </p>
    </div>
</main>
@endsection
