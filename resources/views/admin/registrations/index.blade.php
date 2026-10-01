@extends('admin.layout')

@section('title', 'Quản Lý Đại Biểu')

@section('admin_content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Danh Sách Đại Biểu Đăng Ký</h1>
            <p class="text-xs text-slate-500 mt-1">Tìm kiếm, xác nhận thanh toán chuyển khoản và kích hoạt thẻ check-in</p>
        </div>
    </div>

    <!-- Filter & Search Bar -->
    <form method="GET" action="{{ route('admin.registrations') }}" class="bg-white p-4 rounded-2xl border border-slate-200 shadow-2xs flex flex-wrap items-center gap-3 text-xs">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm theo Mã ĐB, Họ tên, Email, Cơ quan..." class="form-input text-xs max-w-xs">
        
        <select name="payment_status" class="form-input text-xs max-w-xs">
            <option value="">-- Tất cả trạng thái thanh toán --</option>
            <option value="pending_verification" {{ request('payment_status') == 'pending_verification' ? 'selected' : '' }}>Chờ xác nhận chuyển khoản</option>
            <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Đã thanh toán (Paid)</option>
            <option value="complimentary" {{ request('payment_status') == 'complimentary' ? 'selected' : '' }}>Miễn phí (Complimentary)</option>
        </select>

        <select name="category" class="form-input text-xs max-w-xs">
            <option value="">-- Tất cả phân loại --</option>
            <option value="independent_delegate" {{ request('category') == 'independent_delegate' ? 'selected' : '' }}>Đại biểu tự do</option>
            <option value="invited_speaker" {{ request('category') == 'invited_speaker' ? 'selected' : '' }}>Diễn giả khách mời</option>
            <option value="vduh_staff" {{ request('category') == 'vduh_staff' ? 'selected' : '' }}>Cán bộ BV Việt Đức</option>
            <option value="vip" {{ request('category') == 'vip' ? 'selected' : '' }}>Khách mời VIP</option>
        </select>

        <button type="submit" class="px-4 py-2 bg-[#ed680e] hover:bg-[#d55b0a] text-white rounded-lg font-bold">
            Tìm kiếm
        </button>
        <a href="{{ route('admin.registrations') }}" class="px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg font-bold">
            Đặt lại
        </a>
    </form>

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-700 uppercase font-bold border-b border-slate-200">
                    <tr>
                        <th class="p-3.5">Mã ĐB</th>
                        <th class="p-3.5">Họ Và Tên</th>
                        <th class="p-3.5">Cơ Quan / Đơn Vị</th>
                        <th class="p-3.5">Email / SĐT</th>
                        <th class="p-3.5 text-right">Mức Phí</th>
                        <th class="p-3.5 text-center">Thanh Toán</th>
                        <th class="p-3.5 text-center">Check-in</th>
                        <th class="p-3.5 text-right">Thao Tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($registrations as $reg)
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="p-3.5 font-mono font-bold text-slate-900">{{ $reg->delegate_id }}</td>
                        <td class="p-3.5">
                            <div class="font-bold text-slate-900">{{ $reg->academic_title ? $reg->academic_title . ' ' : '' }}{{ $reg->full_name }}</div>
                            <div class="text-[11px] text-slate-500">{{ $reg->category_label }}</div>
                        </td>
                        <td class="p-3.5 text-slate-600 max-w-[200px] truncate">{{ $reg->organization }}</td>
                        <td class="p-3.5 text-slate-600">
                            <div>{{ $reg->email }}</div>
                            <div class="text-slate-400">{{ $reg->phone }}</div>
                        </td>
                        <td class="p-3.5 text-right font-bold text-slate-900 font-mono">{{ $reg->formatted_amount }}</td>
                        <td class="p-3.5 text-center">
                            <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $reg->getPaymentStatusBadgeClass() }}">
                                {{ $reg->payment_status }}
                            </span>
                        </td>
                        <td class="p-3.5 text-center">
                            @if($reg->checked_in_at)
                                <span class="text-emerald-700 font-bold">✓ {{ $reg->checked_in_at->format('H:i d/m') }}</span>
                            @else
                                <span class="text-slate-400">Chưa</span>
                            @endif
                        </td>
                        <td class="p-3.5 text-right whitespace-nowrap">
                            <a href="{{ route('admin.registrations.show', $reg) }}" class="px-2.5 py-1.5 rounded bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold">
                                Chi tiết →
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="p-8 text-center text-slate-400">Không tìm thấy đại biểu nào phù hợp.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($registrations->hasPages())
        <div class="p-4 border-t border-slate-100">
            {{ $registrations->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
