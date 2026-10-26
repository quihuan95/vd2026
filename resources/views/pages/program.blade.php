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
    x-data="{
        searchQuery: '',
        matches(value) {
            return !this.searchQuery.trim() || value.toLocaleLowerCase('vi').includes(this.searchQuery.trim().toLocaleLowerCase('vi'));
        }
    }"
>
    <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6">
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

            <div class="overflow-x-auto" tabindex="0" role="region" aria-label="Chương trình hội thảo song ngữ">
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
                        @foreach ($programRows as $row)
                            @if ($row['kind'] === 'hall')
                                <tr class="bg-emerald-950 text-white">
                                    <th colspan="4" class="px-5 py-5 text-base font-extrabold sm:text-lg">
                                        @foreach ($row['cells'][0] as $line)
                                            <span class="block {{ $loop->first ? '' : 'mt-1 text-sm font-semibold text-emerald-100' }}">{{ $line }}</span>
                                        @endforeach
                                    </th>
                                </tr>
                            @elseif ($row['kind'] === 'session')
                                <tr class="bg-emerald-50 text-slate-900">
                                    <th colspan="4" class="px-5 py-4">
                                        @foreach ($row['cells'][0] as $line)
                                            <span class="block {{ $loop->first ? 'font-extrabold text-emerald-950' : 'mt-1 text-xs font-semibold text-slate-600' }}">{{ $line }}</span>
                                        @endforeach
                                    </th>
                                </tr>
                            @else
                                @php
                                    $searchableRow = implode(' ', array_merge(...$row['cells']));
                                @endphp
                                <tr
                                    x-show="matches($el.dataset.search)"
                                    data-search="{{ $searchableRow }}"
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
