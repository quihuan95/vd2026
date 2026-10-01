@extends('admin.layout')

@section('title', 'Quét QR Check-in Tại Chỗ')

@section('admin_content')
<div class="space-y-8 max-w-4xl">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900">Trạm Quét QR Check-in Đại Biểu</h1>
        <p class="text-xs text-slate-500 mt-1">Dành cho Ban Lễ tân tại quầy đón tiếp Trung tâm Hội nghị Quốc gia</p>
    </div>

    <!-- Scanner / Input Box -->
    <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm space-y-6">
        <form action="{{ route('admin.checkin.scan') }}" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">
                    Nhập hoặc Quét Mã QR / Mã Đại Biểu:
                </label>
                <div class="flex gap-3">
                    <input type="text" name="token" required autofocus placeholder="Ví dụ: VDUH26-DEL-0001 hoặc quét mã QR..." 
                           class="form-input text-sm sm:text-base font-mono">
                    <button type="submit" class="px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm whitespace-nowrap shadow-sm transition">
                        ✓ Check-in Ngay
                    </button>
                </div>
                <p class="text-[11px] text-slate-400 mt-1.5">
                    Hỗ trợ máy quét mã vạch/QR đầu đọc USB hoặc nhập tay mã đại biểu <code>VDUH26-DEL-XXXX</code>.
                </p>
            </div>
        </form>

        <!-- Scan Result Notification -->
        @if(isset($result))
            @if(isset($result['success']) && $result['success'])
            <div class="p-6 rounded-2xl bg-emerald-100 border-2 border-emerald-400 text-emerald-950 space-y-2">
                <div class="flex items-center gap-2 text-emerald-800 font-extrabold text-lg">
                    <span>✓</span>
                    <span>{{ $result['message'] }}</span>
                </div>
                <div class="text-sm">
                    <strong>Đại biểu:</strong> {{ $result['registration']->academic_title ?? '' }} {{ $result['registration']->full_name }} ({{ $result['registration']->delegate_id }})
                </div>
                <div class="text-xs text-emerald-800">
                    Cơ quan: {{ $result['registration']->organization }} • CME: {{ $result['registration']->request_cme ? 'Có' : 'Không' }}
                </div>
            </div>
            @elseif(isset($result['warning']) && $result['warning'])
            <div class="p-6 rounded-2xl bg-amber-100 border-2 border-amber-400 text-amber-950 space-y-2">
                <div class="flex items-center gap-2 text-amber-900 font-extrabold text-lg">
                    <span>⚠️</span>
                    <span>{{ $result['message'] }}</span>
                </div>
                <div class="text-sm">
                    <strong>Đại biểu:</strong> {{ $result['registration']->academic_title ?? '' }} {{ $result['registration']->full_name }} ({{ $result['registration']->delegate_id }})
                </div>
            </div>
            @elseif(isset($result['error']) && $result['error'])
            <div class="p-6 rounded-2xl bg-rose-100 border-2 border-rose-400 text-rose-950">
                <div class="flex items-center gap-2 font-extrabold text-base">
                    <span>❌</span>
                    <span>{{ $result['message'] }}</span>
                </div>
            </div>
            @endif
        @endif
    </div>

    <!-- Recent Check-ins List -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-slate-900 text-sm">Đại Biểu Vừa Check-in Gần Đây</h3>
            <span class="text-xs text-slate-400">10 lượt gần nhất</span>
        </div>

        <div class="divide-y divide-slate-100 text-xs">
            @forelse($recentCheckIns as $ck)
            <div class="p-4 flex items-center justify-between gap-4">
                <div>
                    <div class="font-bold text-slate-900 text-sm">{{ $ck->academic_title ?? '' }} {{ $ck->full_name }}</div>
                    <div class="text-slate-500 font-mono">{{ $ck->delegate_id }} • {{ $ck->organization }}</div>
                </div>
                <div class="text-right">
                    <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                        {{ $ck->checked_in_at->format('H:i:s d/m') }}
                    </span>
                </div>
            </div>
            @empty
            <div class="p-8 text-center text-slate-400">Chưa có lượt check-in nào.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
