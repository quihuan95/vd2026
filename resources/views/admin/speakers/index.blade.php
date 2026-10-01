@extends('admin.layout')

@section('title', 'Quản Lý Diễn Giả')

@section('admin_content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Quản Lý Danh Sách Diễn Giả</h1>
            <p class="text-xs text-slate-500 mt-1">Thêm mới, sửa đổi thông tin diễn giả khách mời hiển thị trên website</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        
        <!-- Add speaker form 1 col -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-2xs space-y-4 text-xs">
            <h3 class="font-bold text-slate-900 text-sm border-b pb-2">Thêm Diễn Giả Mới</h3>

            <form action="{{ route('admin.speakers.store') }}" method="POST" class="space-y-3">
                @csrf

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Họ và tên diễn giả *</label>
                    <input type="text" name="name" required placeholder="GS. TS..." class="form-input text-xs">
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Chức danh / Chức vụ</label>
                    <input type="text" name="title" placeholder="Trưởng khoa, Giám đốc viện..." class="form-input text-xs">
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Đơn vị công tác</label>
                    <input type="text" name="affiliation" placeholder="Bệnh viện..." class="form-input text-xs">
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Chủ đề bài báo cáo</label>
                    <input type="text" name="topic" placeholder="Tên bài báo cáo chuyên đề..." class="form-input text-xs">
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Thời gian báo cáo</label>
                    <input type="text" name="session_time" placeholder="19/11/2026 - 08:30" class="form-input text-xs">
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Tiểu sử tóm tắt (Tiếng Việt)</label>
                    <textarea name="bio_vi" rows="3" class="form-input text-xs"></textarea>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Tiểu sử tóm tắt (Tiếng Anh)</label>
                    <textarea name="bio_en" rows="3" class="form-input text-xs"></textarea>
                </div>

                <div class="flex items-center justify-between pt-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_published" value="1" checked class="w-4 h-4 rounded text-[#ed680e]">
                        <span class="font-bold text-slate-700">Công khai hiển thị</span>
                    </label>
                </div>

                <button type="submit" class="w-full py-2.5 rounded-xl bg-[#ed680e] hover:bg-[#d55b0a] text-white font-bold transition">
                    + Thêm Diễn Giả
                </button>
            </form>
        </div>

        <!-- Speakers List 2 cols -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
            <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                <h3 class="font-bold text-slate-900 text-sm">Danh Sách Diễn Giả Hiện Có ({{ $speakers->count() }})</h3>
            </div>

            <div class="divide-y divide-slate-100 text-xs">
                @forelse($speakers as $spk)
                <div class="p-5 space-y-2">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <div class="font-bold text-slate-900 text-sm">{{ $spk->name }}</div>
                            <div class="text-emerald-800 font-semibold">{{ $spk->title }} • {{ $spk->affiliation }}</div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $spk->is_published ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-500' }}">
                                {{ $spk->is_published ? 'Hiển thị' : 'Ẩn' }}
                            </span>
                            <form action="{{ route('admin.speakers.delete', $spk) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa diễn giả này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1 rounded text-rose-600 hover:bg-rose-50 font-bold">
                                    🗑️
                                </button>
                            </form>
                        </div>
                    </div>

                    @if($spk->topic)
                    <div class="p-2.5 rounded-lg bg-slate-50 border border-slate-100 text-slate-700">
                        <strong>Chủ đề:</strong> {{ $spk->topic }}
                    </div>
                    @endif
                </div>
                @empty
                <div class="p-8 text-center text-slate-400">Chưa có diễn giả nào.</div>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection
