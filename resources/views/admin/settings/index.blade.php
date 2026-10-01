@extends('admin.layout')

@section('title', 'Cấu Hình Hệ Thống')

@section('admin_content')
<div class="space-y-6 max-w-4xl">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900">Cấu Hình Hệ Thống & Thông Tin Hội Nghị</h1>
        <p class="text-xs text-slate-500 mt-1">Cập nhật thông tin ban thư ký, hotline, thời hạn nộp bài và tài khoản ngân hàng</p>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" class="bg-white rounded-2xl p-8 border border-slate-200 shadow-2xs space-y-6 text-xs sm:text-sm">
        @csrf

        <div class="space-y-4">
            <h3 class="font-bold text-slate-900 border-b pb-2 text-sm">1. Thông Tin Ban Thư Ký & Tiếp Nhận</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 mb-1 text-xs">Email Hội Nghị</label>
                    <input type="email" name="secretariat_email" value="{{ $settings['secretariat_email'] ?? 'eventvietduc@vduh.org' }}" class="form-input text-xs">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1 text-xs">Hotline Hỗ Trợ</label>
                    <input type="text" name="hotline" value="{{ $settings['hotline'] ?? '+84 948 996 688' }}" class="form-input text-xs">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1 text-xs">Email Thư Ký Chuyên Môn (TS. Bùi Mai Anh)</label>
                    <input type="email" name="sec_dr_maianh_email" value="{{ $settings['sec_dr_maianh_email'] ?? 'Drbuimaianh@gmail.com' }}" class="form-input text-xs">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1 text-xs">SĐT Thư Ký Chuyên Môn</label>
                    <input type="text" name="sec_dr_maianh_phone" value="{{ $settings['sec_dr_maianh_phone'] ?? '+84 904 218 389' }}" class="form-input text-xs">
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <h3 class="font-bold text-slate-900 border-b pb-2 text-sm">2. Hạn Chót (Deadlines)</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 mb-1 text-xs">Hạn Cuối Nộp Báo Cáo Tóm Tắt (Abstract)</label>
                    <input type="date" name="abstract_deadline" value="{{ $settings['abstract_deadline'] ?? '2026-10-15' }}" class="form-input text-xs">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1 text-xs">Hạn Đăng Ký Sớm (Early Bird)</label>
                    <input type="date" name="early_bird_deadline" value="{{ $settings['early_bird_deadline'] ?? '2026-10-01' }}" class="form-input text-xs">
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <h3 class="font-bold text-slate-900 border-b pb-2 text-sm">3. Thông Tin Ngân Hàng Thụ Hưởng</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 mb-1 text-xs">Tên Đơn Vị Thụ Hưởng</label>
                    <input type="text" name="bank_account_name" value="{{ $settings['bank_account_name'] ?? 'BỆNH VIỆN HỮU NGHỊ VIỆT ĐỨC' }}" class="form-input text-xs">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1 text-xs">Số Tài Khoản</label>
                    <input type="text" name="bank_account_number" value="{{ $settings['bank_account_number'] ?? '12310000033700' }}" class="form-input text-xs">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1 text-xs">Ngân Hàng & Chi Nhánh</label>
                    <input type="text" name="bank_name" value="{{ $settings['bank_name'] ?? 'BIDV - Chi nhánh Quang Trung, Hà Nội' }}" class="form-input text-xs">
                </div>
            </div>
        </div>

        <div class="pt-4 border-t">
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#ed680e] hover:bg-[#d55b0a] text-white font-bold transition text-xs">
                Lưu Toàn Bộ Cài Đặt
            </button>
        </div>
    </form>
</div>
@endsection
