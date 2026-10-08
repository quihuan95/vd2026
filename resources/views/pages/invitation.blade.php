@extends('layouts.conference')

@section('title', __('conference.nav.invitation'))

@section('content')
  @php
    $locale = $locale ?? app()->getLocale();

    $anniversaryScheduleVi = [
        ['08h00 – 08h30', 'Đón tiếp đại biểu'],
        ['08h30 – 08h50', 'Chương trình nghệ thuật chào mừng'],
        ['08h50 – 09h00', 'Tuyên bố lý do, giới thiệu đại biểu'],
        ['09h00 – 09h15', 'Diễn văn khai mạc'],
        ['09h15 – 09h25', 'Phim tài liệu lịch sử Kỷ niệm 120 năm thành lập Bệnh viện Hữu nghị Việt Đức'],
        ['09h25 – 09h35', 'Phát biểu chỉ đạo của Lãnh đạo Cơ quan Trung ương'],
        ['09h35 – 09h45', 'Công bố Quyết định khen thưởng và thực hiện Nghi thức trao tặng phần thưởng cao quý cho Bệnh viện'],
        ['09h45 – 10h00', 'Chụp ảnh lưu niệm · Kết thúc chương trình'],
    ];

    $anniversaryScheduleEn = [
        ['08:00 – 08:30', 'Reception of Delegates & Distinguished Guests'],
        ['08:30 – 08:50', 'Welcome Art Performance'],
        ['08:50 – 09:00', 'Introduction of Dignitaries & Event Announcement'],
        ['09:00 – 09:15', 'Opening Address'],
        ['09:15 – 09:25', 'Historical Documentary: 120th Anniversary of Viet Duc University Hospital'],
        ['09:25 – 09:35', 'Keynote Speech by Central Government Leaders'],
        ['09:35 – 09:45', 'Announcement of Commendations & Award Conferment Ceremony'],
        ['09:45 – 10:00', 'Commemorative Photo Session · Program Concludes'],
    ];

    $anniversarySchedule = $locale === 'en' ? $anniversaryScheduleEn : $anniversaryScheduleVi;
  @endphp

  <x-conference-hero-title 
    :title="__('conference.nav.invitation')" 
    :subtitle="$locale === 'en' ? 'Hanoi, November 20, 2026 · Viet Duc University Hospital 120th Anniversary Celebration Ceremony' : 'Hà Nội, ngày 20/11/2026 · Lễ Kỷ niệm 120 năm thành lập Bệnh viện Hữu nghị Việt Đức'" 
    :badge="$locale === 'en' ? '120TH ANNIVERSARY CELEBRATION' : 'CHƯƠNG TRÌNH LỄ KỶ NIỆM'" 
  />

  <section class="py-14 md:py-20 bg-slate-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 space-y-8">
      
      <!-- Day 2: Lễ Kỷ niệm 120 năm -->
      <section id="le-ky-niem" aria-labelledby="le-ky-niem-title" class="scroll-mt-32 bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 sm:p-8 space-y-3 border-b border-slate-200 bg-amber-50/50">
          <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-amber-100 text-amber-800">
            {{ $locale === 'en' ? 'Nov 20, 2026 · 120th Anniversary' : '20/11/2026 · Chương trình dự kiến' }}
          </span>
          <h2 id="le-ky-niem-title" class="text-xl sm:text-2xl font-bold text-slate-900">
            {{ $locale === 'en' ? 'Viet Duc University Hospital 120th Anniversary Celebration Ceremony' : 'Lễ Kỷ niệm 120 năm thành lập Bệnh viện Hữu nghị Việt Đức' }}
          </h2>
          <p class="text-sm text-slate-600">
            <strong class="text-slate-800">{{ $locale === 'en' ? 'Time:' : 'Thời gian:' }}</strong> 
            {{ $locale === 'en' ? '08:00 – 10:00, Friday, November 20, 2026' : '08h00 – 10h00, thứ Sáu, ngày 20/11/2026' }}
          </p>
          <p class="text-sm text-slate-600">
            <strong class="text-slate-800">{{ $locale === 'en' ? 'Venue:' : 'Địa điểm:' }}</strong> 
            {{ $locale === 'en' ? 'Viet Xo Friendship Labour Cultural Palace, 91 Tran Hung Dao, Hoan Kiem, Hanoi' : 'Cung Văn hóa Lao động Hữu nghị Việt – Xô, 91 Trần Hưng Đạo, phường Cửa Nam, Hà Nội' }}
          </p>
        </div>
        <ol class="divide-y divide-slate-100">
          @foreach ($anniversarySchedule as [$time, $activity])
            <li class="grid sm:grid-cols-12 gap-2 sm:gap-6 px-6 sm:px-8 py-5 hover:bg-amber-50/50 transition-colors">
              <div class="sm:col-span-3 text-sm font-bold text-emerald-800">{{ $time }}</div>
              <h3 class="sm:col-span-9 text-sm sm:text-base font-semibold text-slate-900">{{ $activity }}</h3>
            </li>
          @endforeach
        </ol>
      </section>

      <!-- Action Buttons -->
      <div class="flex flex-wrap justify-center gap-3 pt-2">
        <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'program']) }}" class="btn-primary">
          {{ __('conference.nav.program') }} →
        </a>
        <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'register']) }}" class="btn-secondary">
          {{ __('conference.cta.register_now') }}
        </a>
        <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'venue']) }}" class="btn-secondary">
          {{ __('conference.nav.venue') }}
        </a>
      </div>

    </div>
  </section>
@endsection
