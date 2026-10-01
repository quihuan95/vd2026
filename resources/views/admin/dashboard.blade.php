@extends('admin.layout')

@section('title', 'Bảng Điều Khiển')

@section('admin_content')
<div class="space-y-8">
    
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Tổng Quan Hệ Thống VDUH 2026</h1>
            <p class="text-xs text-slate-500 mt-1">Theo dõi số liệu đăng ký đại biểu, nộp báo cáo khoa học và tiến độ check-in</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.checkin') }}" class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm transition flex items-center gap-1.5">
                <span>📱</span>
                <span>Mở Trạm Quét QR Check-in</span>
            </a>
        </div>
    </div>

    <!-- Stats 4 cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-2xs space-y-2">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Tổng Đại Biểu</span>
                <span class="p-2 rounded-lg bg-blue-50 text-blue-700 font-bold">👥</span>
            </div>
            <div class="text-3xl font-extrabold text-slate-900">{{ $stats['total_registrations'] }}</div>
            <div class="text-xs text-slate-400">Đã đăng ký qua hệ thống</div>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-2xs space-y-2">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Đã Thanh Toán / Miễn Phí</span>
                <span class="p-2 rounded-lg bg-emerald-50 text-emerald-700 font-bold">💳</span>
            </div>
            <div class="text-3xl font-extrabold text-emerald-700">{{ $stats['paid_registrations'] + $stats['complimentary_registrations'] }}</div>
            <div class="text-xs text-emerald-600 font-semibold">{{ $stats['pending_registrations'] }} đang chờ đối soát</div>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-2xs space-y-2">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Đã Check-in Sự Kiện</span>
                <span class="p-2 rounded-lg bg-amber-50 text-amber-700 font-bold">🎟️</span>
            </div>
            <div class="text-3xl font-extrabold text-amber-600">{{ $stats['checked_in_count'] }}</div>
            <div class="text-xs text-slate-400">Đã quét QR tại hội trường</div>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-2xs space-y-2">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Báo Cáo Tóm Tắt (Abstracts)</span>
                <span class="p-2 rounded-lg bg-purple-50 text-purple-700 font-bold">📝</span>
            </div>
            <div class="text-3xl font-extrabold text-purple-900">{{ $stats['total_abstracts'] }}</div>
            <div class="text-xs text-purple-700 font-semibold">{{ $stats['accepted_abstracts'] }} báo cáo đã chấp thuận</div>
        </div>
    </div>

    <!-- Recent Tables Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- Recent Registrations -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
            <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                <h3 class="font-bold text-slate-900 text-sm">Đại Biểu Mới Đăng Ký</h3>
                <a href="{{ route('admin.registrations') }}" class="text-xs font-bold text-[#ed680e] hover:underline">Xem tất cả →</a>
            </div>
            <div class="divide-y divide-slate-100 text-xs">
                @forelse($recentRegistrations as $reg)
                <div class="p-4 flex items-center justify-between gap-4">
                    <div>
                        <div class="font-bold text-slate-900">{{ $reg->full_name }}</div>
                        <div class="text-slate-500">{{ $reg->delegate_id }} • {{ $reg->organization }}</div>
                    </div>
                    <div class="text-right">
                        <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold border {{ $reg->getPaymentStatusBadgeClass() }}">
                            {{ $reg->payment_status }}
                        </span>
                        <div class="text-[11px] text-slate-400 mt-1">{{ $reg->created_at->format('d/m H:i') }}</div>
                    </div>
                </div>
                @empty
                <div class="p-8 text-center text-slate-400">Chưa có đại biểu nào đăng ký.</div>
                @endforelse
            </div>
        </div>

        <!-- Recent Abstracts -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
            <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                <h3 class="font-bold text-slate-900 text-sm">Báo Cáo Tóm Tắt Mới Nộp</h3>
                <a href="{{ route('admin.abstracts') }}" class="text-xs font-bold text-[#ed680e] hover:underline">Xem tất cả →</a>
            </div>
            <div class="divide-y divide-slate-100 text-xs">
                @forelse($recentAbstracts as $abs)
                <div class="p-4 flex items-center justify-between gap-4">
                    <div class="max-w-xs">
                        <div class="font-bold text-slate-900 truncate">{{ $abs->title }}</div>
                        <div class="text-slate-500">{{ $abs->abstract_id }} • Chuyên đề: {{ $abs->specialty }}</div>
                    </div>
                    <div class="text-right whitespace-nowrap">
                        <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold border {{ $abs->getReviewStatusBadgeClass() }}">
                            {{ $abs->review_status }}
                        </span>
                        <div class="text-[11px] text-slate-400 mt-1">{{ $abs->created_at->format('d/m H:i') }}</div>
                    </div>
                </div>
                @empty
                <div class="p-8 text-center text-slate-400">Chưa có báo cáo khoa học nào được nộp.</div>
                @endforelse
            </div>
        </div>

    </div>

</div>
@endsection
