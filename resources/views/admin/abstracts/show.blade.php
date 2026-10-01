@extends('admin.layout')

@section('title', 'Phản Biện Báo Cáo ' . $abstract->abstract_id)

@section('admin_content')
<div class="space-y-6 max-w-5xl">
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.abstracts') }}" class="text-xs font-bold text-slate-500 hover:text-slate-900">← Quay lại danh sách</a>
            <h1 class="text-2xl font-extrabold text-slate-900 mt-1">{{ $abstract->title }}</h1>
            <p class="text-xs text-slate-500 font-mono">{{ $abstract->abstract_id }} • Chuyên đề: {{ $abstract->specialty }}</p>
        </div>
        @if($abstract->file_path)
        <a href="{{ Storage::url($abstract->file_path) }}" target="_blank" class="px-4 py-2 rounded-xl bg-emerald-700 text-white font-bold text-xs shadow-sm hover:bg-emerald-800 transition flex items-center gap-1.5">
            <span>📥</span>
            <span>Tải Tệp Báo Cáo (DOC/PDF)</span>
        </a>
        @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Details 2 cols -->
        <div class="lg:col-span-2 bg-white rounded-2xl p-6 border border-slate-200 shadow-2xs space-y-4 text-xs">
            <h3 class="font-bold text-slate-900 text-sm border-b pb-2">Thông Tin Bài Báo & Tác Giả</h3>
            
            <div class="space-y-3">
                <div>
                    <span class="text-slate-400 block">Tiêu đề bài báo cáo:</span>
                    <strong class="text-slate-900 text-sm block mt-0.5">{{ $abstract->title }}</strong>
                </div>

                <div>
                    <span class="text-slate-400 block">Danh sách tác giả:</span>
                    <p class="text-slate-800 whitespace-pre-line mt-0.5">{{ $abstract->authors }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4 pt-2">
                    <div>
                        <span class="text-slate-400 block">Báo cáo viên chính:</span>
                        <strong class="text-slate-800">{{ $abstract->presenter_name ?? '---' }}</strong>
                    </div>
                    <div>
                        <span class="text-slate-400 block">Đơn vị công tác:</span>
                        <strong class="text-slate-800">{{ $abstract->institution ?? '---' }}</strong>
                    </div>
                    <div>
                        <span class="text-slate-400 block">Email liên hệ:</span>
                        <strong class="text-slate-800">{{ $abstract->email }}</strong>
                    </div>
                    <div>
                        <span class="text-slate-400 block">Số điện thoại:</span>
                        <strong class="text-slate-800">{{ $abstract->phone }}</strong>
                    </div>
                    <div>
                        <span class="text-slate-400 block">Loại hình bài báo:</span>
                        <strong class="text-slate-800 capitalize">{{ $abstract->submission_type }}</strong>
                    </div>
                    <div>
                        <span class="text-slate-400 block">Hình thức trình bày:</span>
                        <strong class="text-slate-800 capitalize">{{ $abstract->presentation_type }}</strong>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status update 1 col -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-2xs space-y-4 text-xs">
            <h3 class="font-bold text-slate-900 text-sm border-b pb-2">Kết Quả Phản Biện</h3>

            <form action="{{ route('admin.abstracts.status', $abstract) }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Trạng thái phê duyệt:</label>
                    <select name="review_status" class="form-input text-xs">
                        <option value="submitted" {{ $abstract->review_status == 'submitted' ? 'selected' : '' }}>Mới nộp (Submitted)</option>
                        <option value="under_review" {{ $abstract->review_status == 'under_review' ? 'selected' : '' }}>Đang phản biện (Under Review)</option>
                        <option value="accepted" {{ $abstract->review_status == 'accepted' ? 'selected' : '' }}>Chấp thuận (Accepted)</option>
                        <option value="revision_requested" {{ $abstract->review_status == 'revision_requested' ? 'selected' : '' }}>Yêu cầu sửa (Revision)</option>
                        <option value="rejected" {{ $abstract->review_status == 'rejected' ? 'selected' : '' }}>Từ chối (Rejected)</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Nhận xét của Hội đồng chuyên môn:</label>
                    <textarea name="review_notes" rows="4" class="form-input text-xs" placeholder="Ghi chú phản biện hoặc hướng dẫn sửa đổi...">{{ $abstract->review_notes }}</textarea>
                </div>

                <button type="submit" class="w-full py-2.5 rounded-xl bg-[#ed680e] hover:bg-[#d55b0a] text-white font-bold transition">
                    Lưu Kết Quả Phản Biện
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
