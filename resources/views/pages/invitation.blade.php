@extends('layouts.conference')

@section('title', __('conference.nav.invitation'))

@section('content')
  @php
    $locale = $locale ?? app()->getLocale();

    $conferenceScheduleVi = [
        ['07h30 – 07h50', 'Tiếp đón đại biểu', 'Ban Tổ chức'],
        ['07h50 – 08h00', 'Phát biểu Khai mạc', 'PGS. TS. Dương Đức Hùng — Giám đốc Bệnh viện Hữu nghị Việt Đức'],
        ['08h00 – 10h00', 'Phiên Tổng quan', 'Toàn bộ đại biểu'],
        ['10h00 – 10h15', 'Tiệc trà', null],
        ['10h15 – 11h30', 'Phiên 2', 'Toàn bộ đại biểu'],
        ['11h30 – 13h00', 'Ăn trưa', null],
        ['13h00 – 14h25', 'Phiên 3', 'Toàn bộ đại biểu'],
        ['14h25 – 14h40', 'Tiệc trà', null],
        ['14h40 – 16h15', 'Phiên 4', 'Toàn bộ đại biểu'],
        ['17h00 – 20h00', 'Tiệc tối', null],
    ];

    $conferenceScheduleEn = [
        ['07:30 – 07:50', 'Delegate Reception & Welcome', 'Organizing Committee'],
        ['07:50 – 08:00', 'Opening Remarks', 'Assoc. Prof. Duong Duc Hung, MD, PhD — Director of VDUH'],
        ['08:00 – 10:00', 'Plenary Session', 'All Delegates'],
        ['10:00 – 10:15', 'Tea Break', null],
        ['10:15 – 11:30', 'Session 2', 'All Delegates'],
        ['11:30 – 13:00', 'Lunch Break', null],
        ['13:00 – 14:25', 'Session 3', 'All Delegates'],
        ['14:25 – 14:40', 'Tea Break', null],
        ['14:40 – 16:15', 'Session 4', 'All Delegates'],
        ['17:00 – 20:00', 'Gala Dinner', null],
    ];

    $conferenceSchedule = $locale === 'en' ? $conferenceScheduleEn : $conferenceScheduleVi;

    $hallScheduleVi = [
        ['Phòng Khánh tiết', 'Phiên Tổng quan', 'Chấn thương chỉnh hình', 'Chấn thương chỉnh hình', 'Chấn thương chỉnh hình'],
        ['Hội trường 1', 'Phiên Tổng quan', 'Cột sống', 'Nam học – Tiết niệu', 'Nam học – Tiết niệu'],
        ['Hội trường 2', 'Phiên Tổng quan', 'Nội – Cận lâm sàng', 'Gây mê hồi sức', 'Gây mê hồi sức'],
        ['Hội trường 3', 'Phiên Tổng quan', 'Ghép tạng', 'Ghép tạng', 'Ghép tạng'],
        ['Hội trường 4', 'Phiên Tổng quan', 'Ghép tạng', 'Phẫu thuật Thần kinh', 'Phẫu thuật Thần kinh'],
        ['Hội trường 5', 'Phiên Tổng quan', 'Ghép tạng', 'Gan mật – Tụy', 'Gan mật – Tụy'],
        ['Hội trường 6', 'Phiên Tổng quan', 'Dược lâm sàng', 'Tiêu hóa – Bệnh lý sàn chậu', 'Tiêu hóa – Bệnh lý sàn chậu'],
        ['Hội trường 7', 'Phiên Tổng quan', 'Điều dưỡng', 'Điều dưỡng', 'Điều dưỡng'],
        ['Hội trường 8', 'Phiên Tổng quan', 'Tim mạch – Lồng ngực', 'Tim mạch – Lồng ngực', 'Tim mạch – Lồng ngực'],
        ['Hội trường 9', 'Phiên Tổng quan', 'Chẩn đoán hình ảnh', 'Phẫu thuật Tạo hình – Thẩm mỹ', 'Phẫu thuật Tạo hình – Thẩm mỹ'],
    ];

    $hallScheduleEn = [
        ['Grand Hall (Khanh Tiet)', 'Plenary Session', 'Orthopaedics & Traumatology', 'Orthopaedics & Traumatology', 'Orthopaedics & Traumatology'],
        ['Hall 1', 'Plenary Session', 'Spine Surgery', 'Andrology & Urology', 'Andrology & Urology'],
        ['Hall 2', 'Plenary Session', 'Internal Medicine & Paraclinical', 'Anesthesiology & Resuscitation', 'Anesthesiology & Resuscitation'],
        ['Hall 3', 'Plenary Session', 'Organ Transplantation', 'Organ Transplantation', 'Organ Transplantation'],
        ['Hall 4', 'Plenary Session', 'Organ Transplantation', 'Neurosurgery', 'Neurosurgery'],
        ['Hall 5', 'Plenary Session', 'Organ Transplantation', 'Hepatobiliary & Pancreatic', 'Hepatobiliary & Pancreatic'],
        ['Hall 6', 'Plenary Session', 'Clinical Pharmacy', 'Gastroenterology & Pelvic Floor', 'Gastroenterology & Pelvic Floor'],
        ['Hall 7', 'Plenary Session', 'Surgical Nursing', 'Surgical Nursing', 'Surgical Nursing'],
        ['Hall 8', 'Plenary Session', 'Cardiovascular & Thoracic Surgery', 'Cardiovascular & Thoracic Surgery', 'Cardiovascular & Thoracic Surgery'],
        ['Hall 9', 'Plenary Session', 'Diagnostic Imaging', 'Plastic & Aesthetic Surgery', 'Plastic & Aesthetic Surgery'],
    ];

    $hallSchedule = $locale === 'en' ? $hallScheduleEn : $hallScheduleVi;

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
    :subtitle="$locale === 'en' ? 'Hanoi, November 19–20, 2026 · Viet Duc University Hospital 120th Anniversary Program' : 'Hà Nội, ngày 19–20/11/2026 · Chương trình Hội nghị Khoa học & Lễ Kỷ niệm 120 năm thành lập Bệnh viện Hữu nghị Việt Đức'" 
    :badge="$locale === 'en' ? 'TENTATIVE PROGRAM' : 'CHƯƠNG TRÌNH DỰ KIẾN'" 
  />

  <section class="py-14 md:py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 space-y-8">
      
      <!-- Day 1: Hội nghị Khoa học Quốc tế -->
      <section id="hoi-nghi" aria-labelledby="hoi-nghi-title" class="scroll-mt-32 bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 sm:p-8 space-y-3 border-b border-slate-200">
          <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800">
            {{ $locale === 'en' ? 'Nov 19, 2026 · Scientific Conference' : '19/11/2026 · Chương trình dự kiến' }}
          </span>
          <h2 id="hoi-nghi-title" class="text-xl sm:text-2xl font-bold text-slate-900">
            {{ $locale === 'en' ? 'Viet Duc University Hospital International Scientific Conference 2026' : 'Hội nghị Khoa học Quốc tế Bệnh viện Hữu nghị Việt Đức 2026' }}
          </h2>
          <p class="text-sm text-slate-600">
            <strong class="text-slate-800">{{ $locale === 'en' ? 'Time:' : 'Thời gian:' }}</strong> 
            {{ $locale === 'en' ? '07:30 – 17:00, Thursday, November 19, 2026' : '07h30 – 17h00, thứ Năm, ngày 19/11/2026' }}
          </p>
          <p class="text-sm text-slate-600">
            <strong class="text-slate-800">{{ $locale === 'en' ? 'Venue:' : 'Địa điểm:' }}</strong> 
            {{ $locale === 'en' ? 'National Convention Center, Thang Long Avenue, Nam Tu Liem, Hanoi' : 'Trung tâm Hội nghị Quốc gia, Đại lộ Thăng Long, Từ Liêm, Hà Nội' }}
          </p>
        </div>
        <div class="overflow-x-auto focus-visible:outline-2 focus-visible:outline-emerald-700" tabindex="0" role="region" aria-labelledby="hoi-nghi-title">
          <table class="w-full min-w-[640px] text-sm text-left">
            <caption class="sr-only">Chương trình ngày 19/11/2026</caption>
            <thead class="bg-primary text-white">
              <tr>
                <th scope="col" class="w-1/4 px-6 sm:px-8 py-4 font-semibold border-r border-white/20">{{ $locale === 'en' ? 'Time' : 'Thời gian' }}</th>
                <th scope="col" class="w-1/3 px-6 py-4 font-semibold border-r border-white/20">{{ $locale === 'en' ? 'Program / Content' : 'Nội dung' }}</th>
                <th scope="col" class="px-6 sm:px-8 py-4 font-semibold">{{ $locale === 'en' ? 'Person in Charge / Participants' : 'Phụ trách' }}</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
              @foreach ($conferenceSchedule as [$time, $activity, $responsible])
                <tr class="odd:bg-white even:bg-slate-50 hover:bg-emerald-50/60">
                  <th scope="row" class="px-6 sm:px-8 py-5 font-bold text-emerald-800 whitespace-nowrap border-r border-slate-200">{{ $time }}</th>
                  <td class="px-6 py-5 font-semibold text-slate-900 border-r border-slate-200">{{ $activity }}</td>
                  <td class="px-6 sm:px-8 py-5 text-slate-600">{{ $responsible ?? '—' }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </section>

      <!-- Hall Breakdown -->
      <section aria-labelledby="hall-schedule-title" class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 sm:p-8 space-y-3">
          <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800">
            {{ $locale === 'en' ? 'Scientific Tracks' : 'Các phiên khoa học' }}
          </span>
          <h2 id="hall-schedule-title" class="text-xl sm:text-2xl font-bold text-slate-900">
            {{ $locale === 'en' ? 'Conference Program by Hall & Specialty' : 'Tóm tắt chương trình Hội nghị theo hội trường' }}
          </h2>
          <p id="hall-schedule-help" class="text-xs sm:text-sm text-slate-600">
            {{ $locale === 'en' ? 'Plenary Session (08:00 – 10:00) applies to all halls. On smaller screens, swipe horizontally to view all sessions.' : 'Phiên Tổng quan (08h00 – 10h00) áp dụng cho tất cả các hội trường. Trên màn hình nhỏ, vuốt ngang để xem đầy đủ các phiên.' }}
          </p>
        </div>
        <div class="overflow-x-auto focus-visible:outline-2 focus-visible:outline-emerald-700" tabindex="0" role="region" aria-labelledby="hall-schedule-title"
          aria-describedby="hall-schedule-help">
          <table class="w-full min-w-[900px] text-sm text-left">
            <caption class="sr-only">Phân bổ chuyên đề tại các hội trường ngày 19/11/2026</caption>
            <thead class="bg-primary text-white">
              <tr>
                <th scope="col" class="px-6 py-5 font-semibold">{{ $locale === 'en' ? 'Hall' : 'Hội trường' }}</th>
                @php
                  $sessions = $locale === 'en' ? [
                    ['Plenary Session', '08:00 – 10:00'],
                    ['Session 2', '10:15 – 11:30'],
                    ['Session 3', '13:00 – 14:25'],
                    ['Session 4', '14:40 – 16:15']
                  ] : [
                    ['Phiên Tổng quan', '08h00 – 10h00'],
                    ['Phiên 2', '10h15 – 11h30'],
                    ['Phiên 3', '13h00 – 14h25'],
                    ['Phiên 4', '14h40 – 16h15']
                  ];
                @endphp
                @foreach ($sessions as [$session, $time])
                  <th scope="col" class="px-4 py-5 font-semibold">
                    <span class="block">{{ $session }}</span>
                    <span class="block mt-1 text-xs font-normal text-emerald-100">{{ $time }}</span>
                  </th>
                @endforeach
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
              @foreach ($hallSchedule as $hall)
                <tr class="odd:bg-white even:bg-slate-50 hover:bg-emerald-50/60">
                  <th scope="row" class="px-6 py-5 font-semibold text-emerald-900 whitespace-nowrap">{{ $hall[0] }}</th>
                  @foreach (array_slice($hall, 1) as $topic)
                    <td class="px-4 py-5 text-slate-700">{{ $topic ?? '—' }}</td>
                  @endforeach
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </section>

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
        <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'register']) }}" class="btn-primary">
          {{ __('conference.cta.register_now') }} →
        </a>
        <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'venue']) }}" class="btn-secondary">
          {{ __('conference.nav.venue') }}
        </a>
      </div>

    </div>
  </section>
@endsection
