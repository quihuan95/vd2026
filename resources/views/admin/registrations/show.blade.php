@extends('admin.layout')

@section('title', 'Chi Tiết Đại Biểu ' . $registration->delegate_id)

@section('admin_content')
<div class="space-y-6 max-w-5xl">
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.registrations') }}" class="text-xs font-bold text-slate-500 hover:text-slate-900">← Quay lại danh sách</a>
            <h1 class="text-2xl font-extrabold text-slate-900 mt-1">Đại Biểu: {{ $registration->full_name }}</h1>
            <p class="text-xs text-slate-500 font-mono">{{ $registration->delegate_id }}</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('conference.ticket', ['locale' => 'vi', 'token' => $registration->qr_code_token]) }}" target="_blank" class="px-3 py-2 rounded-xl bg-emerald-700 text-white font-bold text-xs shadow-sm hover:bg-emerald-800 transition">
                🪪 Xem Thẻ Check-in
            </a>
            <form action="{{ route('admin.registrations.checkin', $registration) }}" method="POST">
                @csrf
                <button type="submit" class="px-3 py-2 rounded-xl {{ $registration->checked_in_at ? 'bg-amber-600 hover:bg-amber-700' : 'bg-blue-600 hover:bg-blue-700' }} text-white font-bold text-xs shadow-sm transition">
                    {{ $registration->checked_in_at ? 'Hủy Check-in' : 'Xác Nhận Check-in' }}
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Details 2 cols -->
        <div class="lg:col-span-2 bg-white rounded-2xl p-6 border border-slate-200 shadow-2xs space-y-4 text-xs">
            <h3 class="font-bold text-slate-900 text-sm border-b pb-2">Thông Tin Cá Nhân & Chuyên Môn</h3>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <span class="text-slate-400 block">Học hàm / Học vị:</span>
                    <strong class="text-slate-800">{{ $registration->academic_title ?? '---' }}</strong>
                </div>
                <div>
                    <span class="text-slate-400 block">Họ và tên:</span>
                    <strong class="text-slate-800">{{ $registration->full_name }}</strong>
                </div>
                <div>
                    <span class="text-slate-400 block">Giới tính:</span>
                    <strong class="text-slate-800">{{ $registration->gender }}</strong>
                </div>
                <div>
                    <span class="text-slate-400 block">Ngày sinh:</span>
                    <strong class="text-slate-800">{{ $registration->dob ? $registration->dob->format('d/m/Y') : '---' }}</strong>
                </div>
                <div>
                    <span class="text-slate-400 block">Cơ quan:</span>
                    <strong class="text-slate-800">{{ $registration->organization }}</strong>
                </div>
                <div>
                    <span class="text-slate-400 block">Khoa / Phòng:</span>
                    <strong class="text-slate-800">{{ $registration->department ?? '---' }}</strong>
                </div>
                <div>
                    <span class="text-slate-400 block">Chức vụ:</span>
                    <strong class="text-slate-800">{{ $registration->job_title ?? '---' }}</strong>
                </div>
                <div>
                    <span class="text-slate-400 block">Quốc gia:</span>
                    <strong class="text-slate-800">{{ $registration->country }}</strong>
                </div>
                <div>
                    <span class="text-slate-400 block">Email:</span>
                    <strong class="text-slate-800">{{ $registration->email }}</strong>
                </div>
                <div>
                    <span class="text-slate-400 block">Số điện thoại:</span>
                    <strong class="text-slate-800">{{ $registration->phone }}</strong>
                </div>
            </div>

            <h3 class="font-bold text-slate-900 text-sm border-b pt-4 pb-2">Dịch Vụ & Hội Nghị</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <span class="text-slate-400 block">Phân loại đại biểu:</span>
                    <strong class="text-slate-800">{{ $registration->category_label }}</strong>
                </div>
                <div>
                    <span class="text-slate-400 block">Hạng đại biểu:</span>
                    <strong class="text-slate-800">{{ $registration->professional_title }}</strong>
                </div>
                <div>
                    <span class="text-slate-400 block">Tham dự Gala Dinner:</span>
                    <strong class="text-slate-800">{{ $registration->attend_dinner ? '✓ Có tham dự' : 'Không' }}</strong>
                </div>
                <div>
                    <span class="text-slate-400 block">Đăng ký CME (3 tín chỉ):</span>
                    <strong class="text-slate-800">{{ $registration->request_cme ? '✓ Đăng ký (' . ($registration->cme_id_number ?? 'chưa cấp CCCD') . ')' : 'Không' }}</strong>
                </div>
            </div>

            @if($registration->payment_proof_path)
            <div class="pt-4 border-t">
                <span class="text-slate-400 block mb-2">Chứng từ chuyển khoản đính kèm:</span>
                <a href="{{ Storage::url($registration->payment_proof_path) }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-800 font-bold border border-emerald-300">
                    <span>📄 Xem chứng từ thanh toán</span>
                </a>
            </div>
            @endif
        </div>

        <!-- Payment Update Box 1 col -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-2xs space-y-4 text-xs">
            <h3 class="font-bold text-slate-900 text-sm border-b pb-2">Cập Nhật Thanh Toán</h3>

            <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 space-y-1">
                <span class="text-slate-400">Số tiền quy định:</span>
                <div class="text-xl font-extrabold text-slate-900">{{ $registration->formatted_amount }}</div>
            </div>

            <form action="{{ route('admin.registrations.payment', $registration) }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Trạng thái thanh toán:</label>
                    <select name="payment_status" class="form-input text-xs">
                        <option value="pending_verification" {{ $registration->payment_status == 'pending_verification' ? 'selected' : '' }}>Chờ xác nhận (Pending)</option>
                        <option value="paid" {{ $registration->payment_status == 'paid' ? 'selected' : '' }}>Đã thanh toán (Paid)</option>
                        <option value="complimentary" {{ $registration->payment_status == 'complimentary' ? 'selected' : '' }}>Miễn phí (Complimentary)</option>
                        <option value="cancelled" {{ $registration->payment_status == 'cancelled' ? 'selected' : '' }}>Đã hủy (Cancelled)</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Ghi chú đối soát nội bộ:</label>
                    <textarea name="notes" rows="3" class="form-input text-xs" placeholder="Ghi chú kế toán...">{{ $registration->notes }}</textarea>
                </div>

                <button type="submit" class="w-full py-2.5 rounded-xl bg-[#ed680e] hover:bg-[#d55b0a] text-white font-bold transition">
                    Lưu Thay Đổi
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
