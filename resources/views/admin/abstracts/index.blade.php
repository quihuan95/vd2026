@extends('admin.layout')

@section('title', 'Quản Lý Báo Cáo Tóm Tắt')

@section('admin_content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Danh Sách Báo Cáo Tóm Tắt (Abstracts)</h1>
            <p class="text-xs text-slate-500 mt-1">Phản biện khoa học, xét duyệt hình thức báo cáo (Oral / Poster) và tải file tệp</p>
        </div>
    </div>

    <!-- Filter & Search Bar -->
    <form method="GET" action="{{ route('admin.abstracts') }}" class="bg-white p-4 rounded-2xl border border-slate-200 shadow-2xs flex flex-wrap items-center gap-3 text-xs">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm theo Mã báo cáo, Tiêu đề, Tác giả, Email..." class="form-input text-xs max-w-xs">
        
        <select name="specialty" class="form-input text-xs max-w-xs">
            <option value="">-- Tất cả 15 chuyên đề --</option>
            @foreach(__('conference.specialties') as $code => $name)
                <option value="{{ $code }}" {{ request('specialty') == $code ? 'selected' : '' }}>{{ $code }} - {{ $name }}</option>
            @endforeach
        </select>

        <select name="review_status" class="form-input text-xs max-w-xs">
            <option value="">-- Trạng thái duyệt --</option>
            <option value="submitted" {{ request('review_status') == 'submitted' ? 'selected' : '' }}>Mới nộp (Submitted)</option>
            <option value="under_review" {{ request('review_status') == 'under_review' ? 'selected' : '' }}>Đang phản biện</option>
            <option value="accepted" {{ request('review_status') == 'accepted' ? 'selected' : '' }}>Chấp thuận (Accepted)</option>
            <option value="revision_requested" {{ request('review_status') == 'revision_requested' ? 'selected' : '' }}>Yêu cầu sửa</option>
            <option value="rejected" {{ request('review_status') == 'rejected' ? 'selected' : '' }}>Từ chối (Rejected)</option>
        </select>

        <button type="submit" class="px-4 py-2 bg-[#ed680e] hover:bg-[#d55b0a] text-white rounded-lg font-bold">
            Tìm kiếm
        </button>
        <a href="{{ route('admin.abstracts') }}" class="px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg font-bold">
            Đặt lại
        </a>
    </form>

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-700 uppercase font-bold border-b border-slate-200">
                    <tr>
                        <th class="p-3.5">Mã Báo Cáo</th>
                        <th class="p-3.5">Chuyên Đề</th>
                        <th class="p-3.5">Tiêu Đề Bài Báo</th>
                        <th class="p-3.5">Tác Giả & Đơn Vị</th>
                        <th class="p-3.5">Hình Thức</th>
                        <th class="p-3.5 text-center">Trạng Thái</th>
                        <th class="p-3.5 text-right">Tệp Tin</th>
                        <th class="p-3.5 text-right">Thao Tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($abstracts as $abs)
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="p-3.5 font-mono font-bold text-slate-900">{{ $abs->abstract_id }}</td>
                        <td class="p-3.5 font-bold text-emerald-800">{{ $abs->specialty }}</td>
                        <td class="p-3.5 font-bold text-slate-900 max-w-xs truncate">{{ $abs->title }}</td>
                        <td class="p-3.5 text-slate-600 max-w-[180px] truncate">
                            <div>{{ $abs->presenter_name ?? $abs->authors }}</div>
                            <div class="text-[11px] text-slate-400">{{ $abs->institution }}</div>
                        </td>
                        <td class="p-3.5 text-slate-700 capitalize">{{ $abs->presentation_type }} ({{ $abs->submission_type }})</td>
                        <td class="p-3.5 text-center">
                            <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $abs->getReviewStatusBadgeClass() }}">
                                {{ $abs->review_status }}
                            </span>
                        </td>
                        <td class="p-3.5 text-right">
                            @if($abs->file_path)
                            <a href="{{ Storage::url($abs->file_path) }}" target="_blank" class="text-emerald-700 font-bold hover:underline">
                                📥 Tải file
                            </a>
                            @else
                            <span class="text-slate-400">---</span>
                            @endif
                        </td>
                        <td class="p-3.5 text-right whitespace-nowrap">
                            <a href="{{ route('admin.abstracts.show', $abs) }}" class="px-2.5 py-1.5 rounded bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold">
                                Duyệt →
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="p-8 text-center text-slate-400">Chưa có bài báo cáo nào phù hợp.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($abstracts->hasPages())
        <div class="p-4 border-t border-slate-100">
            {{ $abstracts->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
