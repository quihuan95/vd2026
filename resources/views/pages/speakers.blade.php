@extends('layouts.conference')

@section('title', __('conference.nav.speakers'))

@section('content')
<!-- Hero Section -->
<x-conference-hero-title 
    :title="$locale === 'en' ? 'Chairs & Speakers Directory' : 'Chủ toạ & Báo cáo viên'" 
    :subtitle="$locale === 'en' 
        ? 'Directory of distinguished chairs, keynote professors, doctors, and domestic & international experts at the VDUH International Scientific Conference 2026.' 
        : 'Hội tụ các chủ toạ, chuyên gia đầu ngành, giáo sư, tiến sĩ, bác sĩ và báo cáo viên uy tín trong nước và quốc tế tại Hội nghị Khoa học Quốc tế Bệnh viện Hữu nghị Việt Đức 2026.'" 
    :badge="$locale === 'en' ? 'FACULTY & SPEAKERS' : 'CHỦ TỌA & BÁO CÁO VIÊN'" 
/>

<!-- Main Interactive Directory -->
<div 
    class="bg-slate-50/70 min-h-screen py-10 sm:py-14"
    x-data="{
        searchQuery: '',
        categoryFilter: 'all',
        affiliationFilter: 'all',
        viewMode: 'grid',
        displayLimit: 48,
        selectedSpeaker: null,
        speakers: {{ Js::from($speakers) }},

        get filteredSpeakers() {
            const q = this.searchQuery.trim().toLowerCase();
            return this.speakers.filter(item => {
                // Text search match
                if (q !== '') {
                    const name = (item.name || '').toLowerCase();
                    const fullNameVi = (item.full_name_vi || '').toLowerCase();
                    const fullNameEn = (item.full_name_en || '').toLowerCase();
                    const degVi = (item.degree_vi || '').toLowerCase();
                    const degEn = (item.degree_en || '').toLowerCase();
                    const posVi = (item.position_vi || '').toLowerCase();
                    const posEn = (item.position_en || '').toLowerCase();
                    const orgVi = (item.organization_vi || '').toLowerCase();
                    const orgEn = (item.organization_en || '').toLowerCase();
                    const sessionsText = (item.chair_sessions || []).join(' ').toLowerCase();
                    const presText = (item.presentations || []).map(p => (p.title || '') + ' ' + (p.title_en || '') + ' ' + (p.time || '')).join(' ').toLowerCase();

                    const matched = name.includes(q) ||
                        fullNameVi.includes(q) ||
                        fullNameEn.includes(q) ||
                        degVi.includes(q) ||
                        degEn.includes(q) ||
                        posVi.includes(q) ||
                        posEn.includes(q) ||
                        orgVi.includes(q) ||
                        orgEn.includes(q) ||
                        sessionsText.includes(q) ||
                        presText.includes(q);

                    if (!matched) return false;
                }

                // Category filter
                if (this.categoryFilter === 'chair') {
                    if (!item.chair_sessions || item.chair_sessions.length === 0) return false;
                } else if (this.categoryFilter === 'presenter') {
                    if (!item.presentations || item.presentations.length === 0) return false;
                } else if (this.categoryFilter === 'prof') {
                    if (item.degree_group !== 'prof' && item.degree_group !== 'assoc_prof') return false;
                } else if (this.categoryFilter === 'phd_specialist') {
                    if (item.degree_group !== 'phd_specialist') return false;
                } else if (this.categoryFilter === 'msc_md') {
                    if (item.degree_group !== 'msc_md') return false;
                } else if (this.categoryFilter === 'international') {
                    if (!item.is_international) return false;
                } else if (this.categoryFilter === 'nursing') {
                    if (item.degree_group !== 'nursing') return false;
                }

                // Affiliation filter
                if (this.affiliationFilter === 'vduh') {
                    if (!item.is_vduh) return false;
                } else if (this.affiliationFilter === 'non_vduh') {
                    if (item.is_vduh) return false;
                }

                return true;
            });
        },

        get visibleSpeakers() {
            return this.filteredSpeakers.slice(0, this.displayLimit);
        },

        resetFilters() {
            this.searchQuery = '';
            this.categoryFilter = 'all';
            this.affiliationFilter = 'all';
            this.displayLimit = 48;
        },

        loadMore() {
            this.displayLimit += 48;
        },

        showAll() {
            this.displayLimit = this.speakers.length;
        }
    }"
    @keydown.escape.window="selectedSpeaker = null"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 space-y-8">

        <!-- Filter & Search Toolbar Container -->
        <section class="bg-white rounded-3xl border border-slate-200 shadow-sm p-5 sm:p-7 space-y-5">
            <!-- Search & Mode Row -->
            <div class="flex flex-col md:flex-row gap-4 items-stretch md:items-center justify-between">
                <!-- Search bar -->
                <div class="relative flex-grow max-w-2xl">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </span>
                    <input 
                        type="search" 
                        x-model="searchQuery"
                        placeholder="{{ $locale === 'en' ? 'Search by name, title (Prof, PhD, MD...), position, institution...' : 'Tìm theo họ tên, học hàm học vị (GS, PGS, TS...), chức vụ hoặc cơ quan công tác...' }}"
                        class="w-full pl-11 pr-10 py-3 rounded-2xl border border-slate-200 bg-slate-50 text-sm text-slate-800 placeholder-slate-400 outline-none transition focus:border-emerald-700 focus:bg-white focus:ring-4 focus:ring-emerald-700/10"
                    >
                    <button 
                        x-show="searchQuery.length > 0" 
                        @click="searchQuery = ''" 
                        type="button" 
                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600"
                        aria-label="Clear search"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <!-- Right controls: View mode & Count -->
                <div class="flex items-center justify-between md:justify-end gap-3 flex-shrink-0">
                    <span class="text-xs font-semibold text-slate-500 whitespace-nowrap">
                        {{ $locale === 'en' ? 'Showing' : 'Hiển thị' }}: 
                        <strong class="text-emerald-800 text-sm" x-text="filteredSpeakers.length"></strong>
                    </span>

                    <!-- Grid / List Switcher -->
                    <div class="inline-flex rounded-xl bg-slate-100 p-1 border border-slate-200">
                        <button 
                            @click="viewMode = 'grid'" 
                            type="button"
                            :class="viewMode === 'grid' ? 'bg-white text-emerald-800 shadow-sm font-bold' : 'text-slate-500 hover:text-slate-800 font-medium'"
                            class="px-3 py-1.5 rounded-lg text-xs flex items-center gap-1.5 transition"
                            title="{{ $locale === 'en' ? 'Grid View' : 'Dạng lưới' }}"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                            <span class="hidden sm:inline">{{ $locale === 'en' ? 'Grid' : 'Thẻ' }}</span>
                        </button>
                        <button 
                            @click="viewMode = 'table'" 
                            type="button"
                            :class="viewMode === 'table' ? 'bg-white text-emerald-800 shadow-sm font-bold' : 'text-slate-500 hover:text-slate-800 font-medium'"
                            class="px-3 py-1.5 rounded-lg text-xs flex items-center gap-1.5 transition"
                            title="{{ $locale === 'en' ? 'Table View' : 'Dạng danh sách' }}"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                            <span class="hidden sm:inline">{{ $locale === 'en' ? 'List' : 'Danh sách' }}</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Filter Pills Row -->
            <div class="flex flex-wrap items-center gap-2 pt-2 border-t border-slate-100">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 mr-1">
                    {{ $locale === 'en' ? 'Filter by:' : 'Phân loại:' }}
                </span>

                <!-- Category Pills -->
                <button 
                    @click="categoryFilter = 'all'" 
                    type="button"
                    :class="categoryFilter === 'all' ? 'bg-emerald-800 text-white font-bold shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200 font-medium'"
                    class="px-3 py-1.5 rounded-full text-xs transition whitespace-nowrap"
                >
                    {{ $locale === 'en' ? 'All' : 'Tất cả' }}
                </button>

                <button 
                    @click="categoryFilter = 'chair'" 
                    type="button"
                    :class="categoryFilter === 'chair' ? 'bg-emerald-800 text-white font-bold shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200 font-medium'"
                    class="px-3 py-1.5 rounded-full text-xs transition whitespace-nowrap"
                >
                    {{ $locale === 'en' ? 'Chairs' : 'Chủ toạ' }}
                </button>

                <button 
                    @click="categoryFilter = 'presenter'" 
                    type="button"
                    :class="categoryFilter === 'presenter' ? 'bg-emerald-800 text-white font-bold shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200 font-medium'"
                    class="px-3 py-1.5 rounded-full text-xs transition whitespace-nowrap"
                >
                    {{ $locale === 'en' ? 'Speakers' : 'Báo cáo viên' }}
                </button>

                <button 
                    @click="categoryFilter = 'prof'" 
                    type="button"
                    :class="categoryFilter === 'prof' ? 'bg-amber-600 text-white font-bold shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200 font-medium'"
                    class="px-3 py-1.5 rounded-full text-xs transition whitespace-nowrap"
                >
                    {{ $locale === 'en' ? 'Prof. & Assoc. Prof.' : 'GS & PGS' }}
                </button>

                <button 
                    @click="categoryFilter = 'phd_specialist'" 
                    type="button"
                    :class="categoryFilter === 'phd_specialist' ? 'bg-teal-700 text-white font-bold shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200 font-medium'"
                    class="px-3 py-1.5 rounded-full text-xs transition whitespace-nowrap"
                >
                    {{ $locale === 'en' ? 'PhD & Specialist II' : 'TS & BSCKII' }}
                </button>

                <button 
                    @click="categoryFilter = 'msc_md'" 
                    type="button"
                    :class="categoryFilter === 'msc_md' ? 'bg-slate-800 text-white font-bold shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200 font-medium'"
                    class="px-3 py-1.5 rounded-full text-xs transition whitespace-nowrap"
                >
                    {{ $locale === 'en' ? 'MSc & MD' : 'ThS & Bác sĩ' }}
                </button>

                <button 
                    @click="categoryFilter = 'international'" 
                    type="button"
                    :class="categoryFilter === 'international' ? 'bg-blue-600 text-white font-bold shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200 font-medium'"
                    class="px-3 py-1.5 rounded-full text-xs transition whitespace-nowrap flex items-center gap-1"
                >
                    <span>🌐</span>
                    <span>{{ $locale === 'en' ? 'International' : 'Chuyên gia quốc tế' }}</span>
                </button>

                <button 
                    @click="categoryFilter = 'nursing'" 
                    type="button"
                    :class="categoryFilter === 'nursing' ? 'bg-purple-700 text-white font-bold shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200 font-medium'"
                    class="px-3 py-1.5 rounded-full text-xs transition whitespace-nowrap"
                >
                    {{ $locale === 'en' ? 'Nursing' : 'Điều dưỡng & KTV' }}
                </button>

                <!-- Affiliation Pills (Divider) -->
                <span class="text-slate-300 hidden md:inline">|</span>

                <button 
                    @click="affiliationFilter = affiliationFilter === 'vduh' ? 'all' : 'vduh'" 
                    type="button"
                    :class="affiliationFilter === 'vduh' ? 'bg-emerald-900 text-amber-300 font-bold border border-amber-400/40 shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200 font-medium'"
                    class="px-3 py-1.5 rounded-full text-xs transition whitespace-nowrap flex items-center gap-1"
                >
                    <span>🏥</span>
                    <span>{{ $locale === 'en' ? 'Viet Duc Hospital' : 'BV HN Việt Đức' }}</span>
                </button>

                <button 
                    @click="affiliationFilter = affiliationFilter === 'non_vduh' ? 'all' : 'non_vduh'" 
                    type="button"
                    :class="affiliationFilter === 'non_vduh' ? 'bg-slate-800 text-white font-bold shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200 font-medium'"
                    class="px-3 py-1.5 rounded-full text-xs transition whitespace-nowrap"
                >
                    {{ $locale === 'en' ? 'Other Institutions' : 'Đơn vị khác & Quốc tế' }}
                </button>

                <!-- Reset Filter button if active -->
                <button 
                    x-show="searchQuery || categoryFilter !== 'all' || affiliationFilter !== 'all'"
                    @click="resetFilters()"
                    type="button"
                    class="text-xs font-semibold text-rose-600 hover:text-rose-800 hover:underline ml-auto flex items-center gap-1"
                >
                    <span>✕</span>
                    <span>{{ $locale === 'en' ? 'Clear filters' : 'Đặt lại bộ lọc' }}</span>
                </button>
            </div>
        </section>

        <!-- GRID VIEW -->
        <div x-show="viewMode === 'grid'" class="space-y-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <template x-for="item in visibleSpeakers" :key="item.stt">
                    <div 
                        class="group relative flex flex-col rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:shadow-xl hover:border-emerald-500/50 hover:-translate-y-1 transition-all duration-300 overflow-hidden cursor-pointer"
                        @click="selectedSpeaker = item"
                    >
                        <!-- Top Image Banner -->
                        <div class="aspect-[4/5] bg-slate-100 relative overflow-hidden flex items-center justify-center">
                            <!-- Speaker Image if present -->
                            <template x-if="item.photo_path">
                                <img 
                                    :src="'/' + item.photo_path" 
                                    :alt="item.name" 
                                    :style="{ objectPosition: item.photo_position || 'center top' }"
                                    loading="lazy" 
                                    class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105"
                                >
                            </template>

                            <!-- Fallback Elegant Avatar if no image -->
                            <template x-if="!item.photo_path">
                                <div class="w-full h-full bg-gradient-to-br from-emerald-900 via-teal-950 to-slate-900 flex flex-col items-center justify-center text-white p-4 relative">
                                    <div class="absolute inset-0 bg-[radial-gradient(rgba(255,255,255,0.08)_1px,transparent_1px)] [background-size:12px_12px]"></div>
                                    <div class="w-20 h-20 rounded-full bg-emerald-800/80 border-2 border-amber-400/50 flex items-center justify-center text-2xl font-black text-amber-300 shadow-inner mb-2 relative z-10">
                                        <span x-text="item.name.split(' ').map(w => w[0]).filter(Boolean).slice(-2).join('').toUpperCase()"></span>
                                    </div>
                                    <div class="text-[10px] uppercase font-bold tracking-wider text-emerald-200/80 relative z-10">
                                        {{ $locale === 'en' ? 'Faculty Profile' : 'Hồ sơ chuyên gia' }}
                                    </div>
                                </div>
                            </template>

                            <!-- Gradient Bottom Overlay -->
                            <div class="absolute inset-x-0 bottom-0 h-20 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent pointer-events-none"></div>

                            <!-- International / Special Tag -->
                            <template x-if="item.is_international">
                                <span class="absolute top-3 left-3 px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-600/90 backdrop-blur-md text-white shadow-sm flex items-center gap-1">
                                    <span>🌐</span>
                                    <span x-text="item.country ? item.country.split('/')[0].trim() : 'Quốc tế'"></span>
                                </span>
                            </template>

                            <!-- Degree Pill Overlay on image bottom -->
                            <div class="absolute bottom-2.5 left-3 right-3 flex items-center justify-between text-white pointer-events-none">
                                <template x-if="item.degree_vi">
                                    <span 
                                        :class="{
                                            'bg-amber-400 text-slate-950 font-extrabold': item.degree_group === 'prof' || item.degree_group === 'assoc_prof',
                                            'bg-emerald-600 text-white font-bold': item.degree_group === 'phd_specialist',
                                            'bg-slate-800/90 text-white font-semibold': item.degree_group !== 'prof' && item.degree_group !== 'assoc_prof' && item.degree_group !== 'phd_specialist'
                                        }"
                                        class="px-2 py-0.5 rounded text-[11px] tracking-wide shadow-sm"
                                        x-text="{{ $locale === 'en' ? 'item.degree_en || item.degree_vi' : 'item.degree_vi' }}"
                                    ></span>
                                </template>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-4 sm:p-5 flex flex-col flex-grow justify-between bg-white">
                            <div>
                                <!-- Role Badge -->
                                <div class="mb-2 flex flex-wrap items-center gap-1.5">
                                    <template x-if="item.role === 'both'">
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-900 border border-amber-300">
                                            <span>🎙️</span>
                                            <span>{{ $locale === 'en' ? 'Chair & Speaker' : 'Chủ toạ & Báo cáo viên' }}</span>
                                        </span>
                                    </template>
                                    <template x-if="item.role === 'chair'">
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-purple-50 text-purple-900 border border-purple-200">
                                            <span>🏛️</span>
                                            <span>{{ $locale === 'en' ? 'Session Chair' : 'Chủ toạ' }}</span>
                                        </span>
                                    </template>
                                    <template x-if="item.role === 'presenter'">
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-900 border border-emerald-200">
                                            <span>🎤</span>
                                            <span>{{ $locale === 'en' ? 'Speaker' : 'Báo cáo viên' }}</span>
                                        </span>
                                    </template>
                                </div>

                                <!-- Full Name -->
                                <h3 
                                    class="text-base sm:text-lg font-extrabold text-slate-950 group-hover:text-emerald-800 transition line-clamp-2 leading-tight"
                                    x-text="item.name"
                                ></h3>

                                <!-- Position / Chức vụ -->
                                <template x-if="item.position_vi">
                                    <p 
                                        class="mt-1.5 text-xs font-semibold text-emerald-900/90 line-clamp-2 leading-snug"
                                        x-text="{{ $locale === 'en' ? 'item.position_en || item.position_vi' : 'item.position_vi' }}"
                                    ></p>
                                </template>

                                <!-- Organization / Đơn vị công tác -->
                                <div class="mt-2.5 pt-2 border-t border-slate-100 flex items-start gap-1.5 text-xs text-slate-600">
                                    <svg class="w-3.5 h-3.5 text-slate-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                    <span 
                                        class="line-clamp-2"
                                        x-text="{{ $locale === 'en' ? 'item.organization_en || item.organization_vi' : 'item.organization_vi' }}"
                                    ></span>
                                </div>

                                <!-- Program Activities Counts -->
                                <div class="mt-2.5 flex flex-wrap gap-1.5 text-[11px]">
                                    <template x-if="item.chair_sessions && item.chair_sessions.length > 0">
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-purple-50 text-purple-800 border border-purple-200/60 font-medium">
                                            <span>🏛️</span>
                                            <span x-text="item.chair_sessions.length + ' {{ $locale === 'en' ? 'session(s)' : 'phiên chủ toạ' }}'"></span>
                                        </span>
                                    </template>
                                    <template x-if="item.presentations && item.presentations.length > 0">
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-800 border border-emerald-200/60 font-medium">
                                            <span>🎤</span>
                                            <span x-text="item.presentations.length + ' {{ $locale === 'en' ? 'topic(s)' : 'bài báo cáo' }}'"></span>
                                        </span>
                                    </template>
                                </div>
                            </div>

                            <!-- Card Footer Action -->
                            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-emerald-700 group-hover:text-emerald-900 transition">
                                <span>{{ $locale === 'en' ? 'View profile' : 'Xem thông tin' }}</span>
                                <span class="transition-transform group-hover:translate-x-1">→</span>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Load More / Show All Controls -->
            <div 
                x-show="filteredSpeakers.length > visibleSpeakers.length" 
                class="pt-6 text-center space-y-3"
            >
                <div class="text-xs font-medium text-slate-500">
                    {{ $locale === 'en' ? 'Displayed' : 'Đang hiển thị' }} 
                    <strong class="text-slate-900" x-text="visibleSpeakers.length"></strong> 
                    / <strong class="text-slate-900" x-text="filteredSpeakers.length"></strong> 
                    {{ $locale === 'en' ? 'speakers' : 'chủ toạ & báo cáo viên' }}
                </div>
                <div class="flex items-center justify-center gap-3">
                    <button 
                        @click="loadMore()" 
                        type="button" 
                        class="btn-primary text-xs !py-2.5 !px-5"
                    >
                        <span>{{ $locale === 'en' ? 'Load 48 more faculty' : 'Xem thêm 48 báo cáo viên' }}</span>
                        <span>↓</span>
                    </button>
                    <button 
                        @click="showAll()" 
                        type="button" 
                        class="btn-secondary text-xs !py-2.5 !px-5"
                    >
                        {{ $locale === 'en' ? 'Show all' : 'Hiển thị tất cả' }} (<span x-text="filteredSpeakers.length"></span>)
                    </button>
                </div>
            </div>
        </div>

        <!-- TABLE / DIRECTORY LIST VIEW -->
        <div x-show="viewMode === 'table'" class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[800px] border-collapse text-left text-sm">
                    <thead class="bg-emerald-950 text-white">
                        <tr>
                            <th class="py-3.5 px-4 text-xs font-bold uppercase tracking-wider text-amber-300 w-16">STT</th>
                            <th class="py-3.5 px-4 text-xs font-bold uppercase tracking-wider w-20">{{ $locale === 'en' ? 'Photo' : 'Ảnh' }}</th>
                            <th class="py-3.5 px-4 text-xs font-bold uppercase tracking-wider">{{ $locale === 'en' ? 'Faculty Name & Degree' : 'Họ và tên & Học hàm' }}</th>
                            <th class="py-3.5 px-4 text-xs font-bold uppercase tracking-wider">{{ $locale === 'en' ? 'Position' : 'Chức vụ' }}</th>
                            <th class="py-3.5 px-4 text-xs font-bold uppercase tracking-wider">{{ $locale === 'en' ? 'Institution / Organization' : 'Đơn vị công tác' }}</th>
                            <th class="py-3.5 px-4 text-xs font-bold uppercase tracking-wider text-right w-28">{{ $locale === 'en' ? 'Action' : 'Chi tiết' }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <template x-for="item in visibleSpeakers" :key="item.stt">
                            <tr 
                                class="hover:bg-emerald-50/50 transition cursor-pointer"
                                @click="selectedSpeaker = item"
                            >
                                <td class="py-3.5 px-4 font-semibold text-slate-500 text-xs" x-text="item.stt"></td>
                                <td class="py-3.5 px-4">
                                    <div class="w-11 h-11 rounded-lg overflow-hidden bg-slate-100 flex-shrink-0 border border-slate-200">
                                        <template x-if="item.photo_path">
                                            <img :src="'/' + item.photo_path" :alt="item.name" :style="{ objectPosition: item.photo_position || 'center top' }" loading="lazy" class="w-full h-full object-cover object-top">
                                        </template>
                                        <template x-if="!item.photo_path">
                                            <div class="w-full h-full bg-emerald-900 flex items-center justify-center text-xs font-bold text-amber-300">
                                                <span x-text="item.name.charAt(0)"></span>
                                            </div>
                                        </template>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <div class="font-extrabold text-slate-900 text-sm hover:text-emerald-800 transition" x-text="item.name"></div>
                                    <div class="mt-1 flex flex-wrap items-center gap-1.5">
                                        <template x-if="item.degree_vi">
                                            <span 
                                                class="inline-block text-[11px] font-semibold text-emerald-800"
                                                x-text="{{ $locale === 'en' ? 'item.degree_en || item.degree_vi' : 'item.degree_vi' }}"
                                            ></span>
                                        </template>
                                        <template x-if="item.is_international">
                                            <span class="inline-block text-[10px] px-1.5 py-0.2 rounded bg-blue-100 text-blue-800 font-bold">
                                                🌐 <span x-text="item.country ? item.country.split('/')[0].trim() : 'Quốc tế'"></span>
                                            </span>
                                        </template>
                                        <template x-if="item.role === 'both'">
                                            <span class="px-1.5 py-0.2 rounded text-[10px] font-bold bg-amber-100 text-amber-900 border border-amber-200">
                                                {{ $locale === 'en' ? 'Chair & Speaker' : 'Chủ toạ & Báo cáo viên' }}
                                            </span>
                                        </template>
                                        <template x-if="item.role === 'chair'">
                                            <span class="px-1.5 py-0.2 rounded text-[10px] font-bold bg-purple-100 text-purple-900 border border-purple-200">
                                                {{ $locale === 'en' ? 'Chair' : 'Chủ toạ' }}
                                            </span>
                                        </template>
                                        <template x-if="item.role === 'presenter'">
                                            <span class="px-1.5 py-0.2 rounded text-[10px] font-bold bg-emerald-100 text-emerald-900 border border-emerald-200">
                                                {{ $locale === 'en' ? 'Speaker' : 'Báo cáo viên' }}
                                            </span>
                                        </template>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4 text-xs font-medium text-slate-700 max-w-xs">
                                    <span x-text="{{ $locale === 'en' ? 'item.position_en || item.position_vi || \'—\'' : 'item.position_vi || \'—\'' }}"></span>
                                </td>
                                <td class="py-3.5 px-4 text-xs text-slate-600 max-w-sm">
                                    <span x-text="{{ $locale === 'en' ? 'item.organization_en || item.organization_vi' : 'item.organization_vi' }}"></span>
                                </td>
                                <td class="py-3.5 px-4 text-right">
                                    <button 
                                        type="button" 
                                        class="px-2.5 py-1 text-xs font-bold text-emerald-700 bg-emerald-50 hover:bg-emerald-100 rounded-md transition"
                                        @click.stop="selectedSpeaker = item"
                                    >
                                        {{ $locale === 'en' ? 'View' : 'Xem' }}
                                    </button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>

            <!-- Table Pagination Controls -->
            <div 
                x-show="filteredSpeakers.length > visibleSpeakers.length" 
                class="p-4 bg-slate-50 border-t border-slate-200 text-center space-x-3"
            >
                <button 
                    @click="loadMore()" 
                    type="button" 
                    class="btn-primary text-xs !py-2 !px-4"
                >
                    {{ $locale === 'en' ? 'Load 48 more' : 'Tải thêm 48 hồ sơ' }}
                </button>
                <button 
                    @click="showAll()" 
                    type="button" 
                    class="btn-secondary text-xs !py-2 !px-4"
                >
                    {{ $locale === 'en' ? 'Show all' : 'Hiển thị toàn bộ' }} (<span x-text="filteredSpeakers.length"></span>)
                </button>
            </div>
        </div>

        <!-- Empty State (No Search Results) -->
        <div 
            x-show="filteredSpeakers.length === 0" 
            class="bg-white rounded-3xl border border-dashed border-slate-300 p-12 text-center space-y-4"
        >
            <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 mx-auto flex items-center justify-center text-2xl">
                🔍
            </div>
            <h3 class="text-lg font-bold text-slate-900">
                {{ $locale === 'en' ? 'No matching faculty members found' : 'Không tìm thấy chủ toạ hoặc báo cáo viên phù hợp' }}
            </h3>
            <p class="text-sm text-slate-500 max-w-md mx-auto">
                {{ $locale === 'en' 
                    ? 'Try searching with a different name, degree keyword, or reset the filters.' 
                    : 'Vui lòng thử tìm kiếm bằng từ khoá tên, học vị khác hoặc đặt lại bộ lọc để xem toàn bộ danh sách.' }}
            </p>
            <div>
                <button 
                    @click="resetFilters()" 
                    type="button" 
                    class="btn-primary text-xs !py-2.5 !px-5"
                >
                    {{ $locale === 'en' ? 'Reset All Filters' : 'Đặt lại bộ lọc' }}
                </button>
            </div>
        </div>

    </div>

    <!-- DETAIL MODAL -->
    <div 
        x-show="selectedSpeaker" 
        x-cloak 
        class="fixed inset-0 z-50 overflow-y-auto"
        role="dialog" 
        aria-modal="true"
    >
        <!-- Modal Backdrop -->
        <div 
            x-show="selectedSpeaker" 
            x-transition:enter="ease-out duration-200" 
            x-transition:enter-start="opacity-0" 
            x-transition:enter-end="opacity-100" 
            x-transition:leave="ease-in duration-150" 
            x-transition:leave-start="opacity-100" 
            x-transition:leave-end="opacity-0" 
            class="fixed inset-0 bg-slate-950/70 backdrop-blur-sm transition-opacity" 
            @click="selectedSpeaker = null"
        ></div>

        <!-- Modal Panel -->
        <div class="min-h-full flex items-center justify-center p-4 sm:p-6">
            <div 
                x-show="selectedSpeaker" 
                x-transition:enter="ease-out duration-200" 
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                x-transition:leave="ease-in duration-150" 
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                class="relative w-full max-w-2xl bg-white rounded-3xl shadow-2xl border border-slate-200 overflow-hidden transform transition-all z-10"
                @click.outside="selectedSpeaker = null"
            >
                <!-- Modal Top Accent Banner -->
                <div class="h-3 bg-gradient-to-r from-emerald-800 via-amber-400 to-emerald-950"></div>

                <!-- Close Button -->
                <button 
                    @click="selectedSpeaker = null" 
                    type="button" 
                    class="absolute top-5 right-5 w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-800 flex items-center justify-center transition"
                    aria-label="Close"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>

                <!-- Modal Content -->
                <div class="p-6 sm:p-8" x-if="selectedSpeaker">
                    <div class="flex flex-col sm:flex-row gap-6 items-start">
                        <!-- Portrait Photo -->
                        <div class="w-36 h-48 sm:w-44 sm:h-56 rounded-2xl overflow-hidden bg-slate-100 flex-shrink-0 border-2 border-emerald-900/10 shadow-md relative mx-auto sm:mx-0">
                            <template x-if="selectedSpeaker && selectedSpeaker.photo_path">
                                <img 
                                    :src="'/' + selectedSpeaker.photo_path" 
                                    :style="{ objectPosition: selectedSpeaker.photo_position || 'center top' }"
                                    :alt="selectedSpeaker.name" 
                                    class="w-full h-full object-cover object-top"
                                >
                            </template>
                            <template x-if="selectedSpeaker && !selectedSpeaker.photo_path">
                                <div class="w-full h-full bg-gradient-to-br from-emerald-900 to-slate-900 flex flex-col items-center justify-center text-white p-4">
                                    <div class="w-16 h-16 rounded-full bg-emerald-800 border-2 border-amber-400 flex items-center justify-center text-xl font-bold text-amber-300">
                                        <span x-text="selectedSpeaker.name.split(' ').map(w => w[0]).filter(Boolean).slice(-2).join('').toUpperCase()"></span>
                                    </div>
                                    <span class="mt-2 text-[10px] text-emerald-200 font-semibold uppercase">No photo</span>
                                </div>
                            </template>
                        </div>

                        <!-- Info Column -->
                        <div class="flex-grow space-y-4 text-left w-full">
                            <div>
                                <div class="flex flex-wrap items-center gap-1.5 mb-2">
                                    <!-- Degree Badge -->
                                    <template x-if="selectedSpeaker && selectedSpeaker.degree_vi">
                                        <span 
                                            class="inline-block px-3 py-1 rounded-md text-xs font-bold uppercase tracking-wider bg-amber-100 text-amber-900 border border-amber-300"
                                            x-text="{{ $locale === 'en' ? 'selectedSpeaker.degree_en || selectedSpeaker.degree_vi' : 'selectedSpeaker.degree_vi' }}"
                                        ></span>
                                    </template>
                                    
                                    <!-- Role Badge in Modal -->
                                    <template x-if="selectedSpeaker && selectedSpeaker.role">
                                        <span 
                                            :class="{
                                                'bg-amber-100 text-amber-900 border-amber-300': selectedSpeaker.role === 'both',
                                                'bg-purple-100 text-purple-900 border-purple-300': selectedSpeaker.role === 'chair',
                                                'bg-emerald-100 text-emerald-900 border-emerald-300': selectedSpeaker.role === 'presenter'
                                            }"
                                            class="inline-block px-3 py-1 rounded-md text-xs font-bold uppercase tracking-wider border"
                                            x-text="{{ $locale === 'en' ? 'selectedSpeaker.role_en' : 'selectedSpeaker.role_vi' }}"
                                        ></span>
                                    </template>

                                    <template x-if="selectedSpeaker && selectedSpeaker.is_international">
                                        <span class="inline-block px-2.5 py-1 rounded-md text-xs font-bold bg-blue-100 text-blue-900 border border-blue-200">
                                            🌐 <span x-text="selectedSpeaker.country"></span>
                                        </span>
                                    </template>
                                </div>

                                <!-- Full Name -->
                                <h2 class="text-xl sm:text-2xl font-black text-slate-950" x-text="selectedSpeaker ? selectedSpeaker.name : ''"></h2>
                            </div>

                            <!-- Position / Chức vụ -->
                            <div class="space-y-1">
                                <div class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                    {{ $locale === 'en' ? 'Position / Role' : 'Chức vụ' }}
                                </div>
                                <div 
                                    class="text-sm font-semibold text-emerald-950 whitespace-pre-line leading-relaxed" 
                                    x-text="{{ $locale === 'en' ? 'selectedSpeaker ? (selectedSpeaker.position_en || selectedSpeaker.position_vi || \'—\') : \'—\'' : 'selectedSpeaker ? (selectedSpeaker.position_vi || \'—\') : \'—\'' }}"
                                ></div>
                            </div>

                            <!-- Organization / Đơn vị công tác -->
                            <div class="space-y-1">
                                <div class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                    {{ $locale === 'en' ? 'Institution / Affiliation' : 'Đơn vị công tác' }}
                                </div>
                                <div 
                                    class="text-sm text-slate-800 whitespace-pre-line leading-relaxed font-medium" 
                                    x-text="{{ $locale === 'en' ? 'selectedSpeaker ? (selectedSpeaker.organization_en || selectedSpeaker.organization_vi) : \'\' ' : 'selectedSpeaker ? selectedSpeaker.organization_vi : \'\' ' }}"
                                ></div>
                            </div>

                            <!-- Chairing Sessions List in Modal -->
                            <template x-if="selectedSpeaker && selectedSpeaker.chair_sessions && selectedSpeaker.chair_sessions.length > 0">
                                <div class="p-3.5 bg-purple-50/80 rounded-xl border border-purple-200 text-xs space-y-2">
                                    <div class="font-bold text-purple-950 flex items-center gap-1.5 uppercase tracking-wide text-[11px]">
                                        <span>🏛️</span>
                                        <span>{{ $locale === 'en' ? 'Chairing Sessions' : 'Phiên chủ tọa trong chương trình' }}</span>
                                        <span class="ml-auto bg-purple-200 text-purple-900 font-extrabold px-1.5 py-0.2 rounded-full text-[10px]" x-text="selectedSpeaker.chair_sessions.length"></span>
                                    </div>
                                    <ul class="space-y-1.5 pl-1">
                                        <template x-for="(sessionTitle, sIdx) in selectedSpeaker.chair_sessions" :key="sIdx">
                                            <li class="flex items-start gap-2 text-purple-900 font-medium leading-snug">
                                                <span class="text-purple-500 font-bold">•</span>
                                                <span x-text="sessionTitle"></span>
                                            </li>
                                        </template>
                                    </ul>
                                </div>
                            </template>

                            <!-- Presentations List in Modal -->
                            <template x-if="selectedSpeaker && selectedSpeaker.presentations && selectedSpeaker.presentations.length > 0">
                                <div class="p-3.5 bg-emerald-50/80 rounded-xl border border-emerald-200 text-xs space-y-2">
                                    <div class="font-bold text-emerald-950 flex items-center gap-1.5 uppercase tracking-wide text-[11px]">
                                        <span>🎤</span>
                                        <span>{{ $locale === 'en' ? 'Scientific Presentations' : 'Bài báo cáo khoa học' }}</span>
                                        <span class="ml-auto bg-emerald-200 text-emerald-900 font-extrabold px-1.5 py-0.2 rounded-full text-[10px]" x-text="selectedSpeaker.presentations.length"></span>
                                    </div>
                                    <ul class="space-y-2 pl-1">
                                        <template x-for="(pres, pIdx) in selectedSpeaker.presentations" :key="pIdx">
                                            <li class="space-y-0.5 border-b border-emerald-100 last:border-0 pb-1.5 last:pb-0">
                                                <div class="flex items-start gap-1.5">
                                                    <span class="text-emerald-600 font-bold mt-0.5">•</span>
                                                    <div class="flex-grow">
                                                        <span class="text-emerald-950 font-semibold leading-snug block" x-text="pres.title"></span>
                                                        <template x-if="pres.title_en && pres.title_en !== pres.title">
                                                            <span class="mt-1 block leading-snug text-slate-600" lang="en" x-text="pres.title_en"></span>
                                                        </template>
                                                        <template x-if="pres.time">
                                                            <span class="inline-block mt-1 px-2 py-0.5 rounded text-[10px] font-bold bg-white text-emerald-800 border border-emerald-200">
                                                                ⏰ <span x-text="pres.time"></span>
                                                            </span>
                                                        </template>
                                                    </div>
                                                </div>
                                            </li>
                                        </template>
                                    </ul>
                                </div>
                            </template>

                            <!-- Bilingual reference info if available -->
                            <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/80 text-xs text-slate-600 space-y-1">
                                <div class="flex items-start gap-2">
                                    <span class="font-bold text-slate-700 min-w-[70px]">Tiếng Việt:</span>
                                    <span x-text="selectedSpeaker ? (selectedSpeaker.full_name_vi + (selectedSpeaker.organization_vi ? ' — ' + selectedSpeaker.organization_vi : '')) : ''"></span>
                                </div>
                                <div class="flex items-start gap-2">
                                    <span class="font-bold text-slate-700 min-w-[70px]">English:</span>
                                    <span x-text="selectedSpeaker ? (selectedSpeaker.full_name_en + (selectedSpeaker.organization_en ? ' — ' + selectedSpeaker.organization_en : '')) : ''"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Actions -->
                    <div class="mt-8 pt-5 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3">
                        <a 
                            :href="'/{{ $locale }}/program?search=' + encodeURIComponent(selectedSpeaker ? selectedSpeaker.name : '')" 
                            class="inline-flex items-center gap-2 text-xs font-bold text-emerald-800 hover:text-emerald-950 bg-emerald-50 hover:bg-emerald-100 px-4 py-2.5 rounded-xl transition"
                        >
                            <span>📅</span>
                            <span>{{ $locale === 'en' ? 'Search in Scientific Program' : 'Xem trong chương trình khoa học' }}</span>
                        </a>

                        <button 
                            @click="selectedSpeaker = null" 
                            type="button" 
                            class="btn-secondary text-xs !py-2 !px-4 ml-auto"
                        >
                            {{ $locale === 'en' ? 'Close' : 'Đóng' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
