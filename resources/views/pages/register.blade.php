@extends('layouts.conference')

@section('title', __('conference.register_form.title'))

@section('content')

{{-- Success state --}}
@if(request('success') && request('id'))
<section class="py-16 md:py-24 bg-gradient-to-br from-emerald-50 via-white to-amber-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center">
        <div class="bg-white rounded-3xl shadow-xl border border-emerald-100 p-10 sm:p-14 space-y-6">
            <div class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center mx-auto">
                <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-emerald-900 tracking-tight">
                    Đăng ký thành công!
                </h1>
                <p class="mt-2 text-slate-600 text-sm">
                    Cảm ơn Quý đại biểu đã đăng ký. Email xác nhận kèm mã tham dự sẽ được gửi tới email của bạn.
                </p>
            </div>
            <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-6 space-y-3">
                <div class="text-xs font-bold uppercase tracking-widest text-emerald-700">
                    Mã đại biểu của bạn
                </div>
                <div class="text-3xl font-extrabold text-emerald-900 tracking-wider font-mono">
                    {{ request('id') }}
                </div>
                <p class="text-xs text-slate-500">
                    Vui lòng lưu mã này. Quý đại biểu sẽ dùng mã để check-in tại Hội nghị.
                </p>
            </div>
            <div class="flex flex-wrap gap-3 justify-center pt-2">
                <a href="{{ route('conference.home', ['locale' => $locale]) }}" class="btn-primary text-sm">
                    Về trang chủ
                </a>
                <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'register']) }}" class="btn-secondary text-sm">
                    Đăng ký thêm đại biểu khác
                </a>
            </div>
        </div>
    </div>
</section>

@else

<section class="bg-gradient-to-br from-emerald-900 via-emerald-800 to-emerald-950 text-white py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center space-y-3">
        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold bg-amber-400/20 text-amber-300 border border-amber-400/30 uppercase tracking-widest">
            <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
            Mở đăng ký
        </span>
        <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight">
            {{ __('conference.register_form.title') }}
        </h1>
        <p class="text-emerald-200 text-sm max-w-3xl mx-auto">
            Hội nghị Khoa học Quốc tế Bệnh viện Hữu nghị Việt Đức 2026 · 19/11/2026 · Hà Nội
        </p>
    </div>
</section>

<section class="py-12 md:py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">

        <div class="mb-8 bg-amber-50 border border-amber-200 rounded-2xl p-4 flex items-start gap-3">
            <svg class="w-5 h-5 text-amber-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-xs text-amber-800">
                <strong>Miễn phí tham dự:</strong>
                Đăng ký và tham dự Hội nghị hoàn toàn miễn phí. Sau khi gửi form, Quý đại biểu sẽ nhận email xác nhận kèm mã tham dự để check-in tại sự kiện.
            </p>
        </div>

        @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 rounded-2xl p-4 space-y-1">
            <div class="flex items-center gap-2 text-red-700 font-bold text-sm mb-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                Vui lòng kiểm tra lại các lỗi sau:
            </div>
            @foreach ($errors->all() as $error)
                <p class="text-xs text-red-600 pl-6">- {{ $error }}</p>
            @endforeach
        </div>
        @endif

        <form id="register-form" action="{{ route('conference.register.submit', ['locale' => $locale]) }}" method="POST" class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
            @csrf

            <div class="px-6 sm:px-8 pt-8 pb-6 border-b border-slate-100">
                <h2 class="text-base font-bold text-emerald-800 uppercase tracking-wider mb-6 flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-700 text-xs font-extrabold flex items-center justify-center">1</span>
                    Thông tin cá nhân
                </h2>
                <div class="space-y-5">
                    <div>
                        <label for="full_name" class="block text-xs font-bold text-slate-700 mb-1.5">
                            {{ __('conference.register_form.full_name') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}"
                            placeholder="VD: Nguyễn Văn An" required
                            class="w-full px-4 py-3 rounded-xl border @error('full_name') border-red-400 bg-red-50 @else border-slate-200 @enderror text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                        @error('full_name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="gender" class="block text-xs font-bold text-slate-700 mb-1.5">
                                {{ __('conference.register_form.gender') }} <span class="text-red-500">*</span>
                            </label>
                            <select id="gender" name="gender" required
                                class="w-full px-4 py-3 rounded-xl border @error('gender') border-red-400 bg-red-50 @else border-slate-200 @enderror text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition bg-white">
                                <option value="" disabled {{ old('gender') ? '' : 'selected' }}>-- Chọn --</option>
                                <option value="male"   {{ old('gender') === 'male'   ? 'selected' : '' }}>{{ __('conference.register_form.gender_male') }}</option>
                                <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>{{ __('conference.register_form.gender_female') }}</option>
                                <option value="other"  {{ old('gender') === 'other'  ? 'selected' : '' }}>{{ __('conference.register_form.gender_other') }}</option>
                            </select>
                            @error('gender')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="dob" class="block text-xs font-bold text-slate-700 mb-1.5">
                                {{ __('conference.register_form.dob') }}
                            </label>
                            <input type="date" id="dob" name="dob" value="{{ old('dob') }}" max="{{ date('Y-m-d') }}"
                                class="w-full px-4 py-3 rounded-xl border @error('dob') border-red-400 bg-red-50 @else border-slate-200 @enderror text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                            @error('dob')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-6 sm:px-8 py-6 border-b border-slate-100">
                <h2 class="text-base font-bold text-emerald-800 uppercase tracking-wider mb-6 flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-700 text-xs font-extrabold flex items-center justify-center">2</span>
                    Thông tin công tác
                </h2>
                <div class="space-y-5">
                    <div>
                        <label for="organization" class="block text-xs font-bold text-slate-700 mb-1.5">{{ __('conference.register_form.organization') }}</label>
                        <input type="text" id="organization" name="organization" value="{{ old('organization') }}"
                            placeholder="VD: Bệnh viện Hữu nghị Việt Đức"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="department" class="block text-xs font-bold text-slate-700 mb-1.5">{{ __('conference.register_form.department') }}</label>
                            <input type="text" id="department" name="department" value="{{ old('department') }}"
                                placeholder="VD: Khoa Chấn thương chỉnh hình"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                        </div>
                        <div>
                            <label for="job_title" class="block text-xs font-bold text-slate-700 mb-1.5">{{ __('conference.register_form.job_title') }}</label>
                            <input type="text" id="job_title" name="job_title" value="{{ old('job_title') }}"
                                placeholder="VD: Bác sĩ điều trị"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-6 sm:px-8 py-6 border-b border-slate-100">
                <h2 class="text-base font-bold text-emerald-800 uppercase tracking-wider mb-6 flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-700 text-xs font-extrabold flex items-center justify-center">3</span>
                    Thông tin liên hệ
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="email" class="block text-xs font-bold text-slate-700 mb-1.5">
                            {{ __('conference.register_form.email') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="example@email.com" required
                            class="w-full px-4 py-3 rounded-xl border @error('email') border-red-400 bg-red-50 @else border-slate-200 @enderror text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                        @error('email')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        <p class="mt-1 text-[11px] text-slate-400">
                            Mã tham dự sẽ được gửi đến email này.
                        </p>
                    </div>
                    <div>
                        <label for="phone" class="block text-xs font-bold text-slate-700 mb-1.5">
                            {{ __('conference.register_form.phone') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                            placeholder="0xxx xxx xxx" required
                            class="w-full px-4 py-3 rounded-xl border @error('phone') border-red-400 bg-red-50 @else border-slate-200 @enderror text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                        @error('phone')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            <div class="px-6 sm:px-8 py-6 border-b border-slate-100">
                <h2 class="text-base font-bold text-emerald-800 uppercase tracking-wider mb-5 flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-700 text-xs font-extrabold flex items-center justify-center">4</span>
                    Tiệc tối Hội nghị
                </h2>
                <p class="text-sm font-semibold text-slate-800 mb-4">{{ __('conference.register_form.attend_dinner') }}</p>
                <div class="flex items-center gap-6">
                    <label class="flex items-center gap-2.5 cursor-pointer group">
                        <input type="radio" name="attend_dinner" value="1"
                            {{ old('attend_dinner', '1') === '1' ? 'checked' : '' }}
                            class="w-4 h-4 text-emerald-600 border-slate-300 focus:ring-emerald-500">
                        <span class="text-sm text-slate-700 font-medium group-hover:text-emerald-700 transition">{{ __('conference.register_form.dinner_yes') }}</span>
                    </label>
                    <label class="flex items-center gap-2.5 cursor-pointer group">
                        <input type="radio" name="attend_dinner" value="0"
                            {{ old('attend_dinner') === '0' ? 'checked' : '' }}
                            class="w-4 h-4 text-emerald-600 border-slate-300 focus:ring-emerald-500">
                        <span class="text-sm text-slate-700 font-medium group-hover:text-emerald-700 transition">{{ __('conference.register_form.dinner_no') }}</span>
                    </label>
                </div>
            </div>

            <div class="px-6 sm:px-8 py-8 bg-slate-50/60">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-5">
                    <p class="text-[11px] text-slate-500 leading-relaxed">
                        Bằng cách gửi form này, Quý đại biểu đồng ý để Ban Tổ chức sử dụng thông tin cho mục đích quản lý Hội nghị.
                    </p>
                    <button id="submit-btn" type="submit"
                        class="btn-primary whitespace-nowrap flex items-center gap-2 min-w-[200px] justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span id="btn-label">{{ __('conference.register_form.submit_btn') }}</span>
                    </button>
                </div>
            </div>
        </form>

        <p class="mt-6 text-center text-xs text-slate-500">
            Thắc mắc? Liên hệ Ban Tổ chức:
            <a href="mailto:{{ __('conference.secretariat_email') }}?cc={{ rawurlencode(__('conference.cc_email')) }}" class="text-emerald-700 font-semibold hover:underline">{{ __('conference.secretariat_email') }}</a>
        </p>
    </div>
</section>

@endif
@endsection

@push('scripts')
<script>
document.getElementById('register-form')?.addEventListener('submit', function() {
    const btn = document.getElementById('submit-btn');
    const label = document.getElementById('btn-label');
    if (btn && label) {
        btn.disabled = true;
        btn.classList.add('opacity-70', 'cursor-not-allowed');
        label.textContent = 'Đang gửi...';
    }
});
</script>
@endpush
