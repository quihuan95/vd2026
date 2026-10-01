@extends('layouts.conference')

@section('title', __('conference.register_form.title'))

@section('content')
<x-conference-hero-title 
    :title="__('conference.register_form.title')" 
    :subtitle="$locale === 'en' ? 'Register to attend the International Scientific Conference & 120th Anniversary of Viet Duc University Hospital' : 'Đăng ký tham dự Hội nghị Khoa học Quốc tế Bệnh viện Hữu nghị Việt Đức 2026'" 
    :badge="$locale === 'en' ? 'REGISTRATION PORTAL' : 'CỔNG ĐĂNG KÝ'" 
/>

<section class="py-14 md:py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        
        @if(request()->has('success') && request('id'))
        <!-- Success Card -->
        <div class="bg-white rounded-3xl p-8 sm:p-12 border-2 border-emerald-500 shadow-xl text-center space-y-6">
            <div class="w-20 h-20 bg-emerald-100 text-emerald-800 rounded-full flex items-center justify-center text-4xl mx-auto border-2 border-emerald-300">
                ✓
            </div>
            
            <div class="space-y-2">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 bg-emerald-100 px-3 py-1 rounded-full">
                    {{ $locale === 'en' ? 'REGISTRATION SUCCESSFUL' : 'ĐĂNG KÝ THÀNH CÔNG' }}
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">
                    {{ $locale === 'en' ? 'Thank You for Registering!' : 'Cảm Ơn Quý Đại Biểu Đã Hoàn Tất Đăng Ký!' }}
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 max-w-lg mx-auto">
                    {{ $locale === 'en' 
                        ? 'Your registration has been recorded by the Organizing Committee. Please save your Delegate ID and QR Code pass for rapid check-in at the venue.' 
                        : 'Thông tin đăng ký của Quý Đại biểu đã được ghi nhận. Ban Tổ Chức đã cấp mã định danh đại biểu và mã QR để check-in tại Hội nghị.' }}
                </p>
            </div>

            <!-- Delegate ID Display -->
            <div class="p-4 bg-emerald-50 border border-emerald-300 rounded-2xl inline-block px-8">
                <div class="text-xs text-emerald-800 font-bold uppercase">{{ $locale === 'en' ? 'Delegate ID' : 'Mã Đại Biểu' }}</div>
                <div class="text-2xl sm:text-3xl font-mono font-extrabold text-emerald-950 mt-1">
                    {{ request('id') }}
                </div>
            </div>

            <!-- QR code ticket link -->
            @if(request('token'))
            <div class="p-6 bg-slate-50 rounded-2xl border border-slate-200 max-w-md mx-auto space-y-3">
                <div class="text-xs text-slate-500">{{ $locale === 'en' ? 'Personal QR Code Token for Check-in:' : 'Mã QR Check-in Tại Sự Kiện:' }}</div>
                <div class="font-mono text-xs font-bold bg-white p-2.5 rounded border border-slate-200 text-slate-800">
                    {{ request('token') }}
                </div>
                <a href="{{ route('conference.ticket', ['locale' => $locale, 'token' => request('token')]) }}" target="_blank" class="btn-primary text-xs w-full">
                    {{ $locale === 'en' ? 'View & Print Digital Pass (QR Code) 🪪' : 'Xem & Lưu Thẻ Đại Biểu (Mã QR) 🪪' }}
                </a>
            </div>
            @endif

            <div class="pt-4 flex justify-center gap-4">
                <a href="{{ route('conference.home', ['locale' => $locale]) }}" class="btn-secondary text-xs">
                    {{ $locale === 'en' ? '← Back to Home' : '← Trở về Trang Chủ' }}
                </a>
                <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'about']) }}" class="btn-secondary text-xs">
                    {{ __('conference.welcome_letter.title') }}
                </a>
            </div>
        </div>
        @else

        <!-- Registration Form (Matching Google Doc fields 100%) -->
        <div class="bg-white rounded-3xl p-6 sm:p-10 border border-slate-200 shadow-sm space-y-8">
            
            <div class="border-b border-slate-100 pb-5">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-3 py-1 rounded-full inline-block mb-2">
                    {{ __('conference.event_dates') }}
                </span>
                <h2 class="text-xl sm:text-2xl font-bold text-slate-900">
                    {{ __('conference.register_form.title') }}
                </h2>
                <p class="text-xs text-slate-500 mt-1">
                    {{ $locale === 'en' 
                        ? 'Please enter your information accurately to receive email confirmation and check-in QR code.' 
                        : 'Quý Đại biểu vui lòng điền chính xác thông tin để nhận email xác nhận và mã QR check-in tại sự kiện.' }}
                </p>
            </div>

            @if ($errors->any())
            <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-xs text-rose-800">
                <ul class="list-disc pl-4 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('conference.register.submit', ['locale' => $locale]) }}" method="POST" class="space-y-6">
                @csrf

                <!-- Họ và tên (Full name) -->
                <div>
                    <label for="full_name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        {{ __('conference.register_form.full_name') }} <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="full_name" id="full_name" required value="{{ old('full_name') }}"
                           placeholder="{{ $locale === 'en' ? 'e.g. Nguyen Van An' : 'Ví dụ: Nguyễn Văn An' }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 text-sm">
                </div>

                <!-- Giới tính (Gender) & Ngày sinh (DOB) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="gender" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            {{ __('conference.register_form.gender') }} <span class="text-rose-500">*</span>
                        </label>
                        <select name="gender" id="gender" required
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 text-sm bg-white">
                            <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>{{ __('conference.register_form.gender_male') }}</option>
                            <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>{{ __('conference.register_form.gender_female') }}</option>
                            <option value="other" {{ old('gender') === 'other' ? 'selected' : '' }}>{{ __('conference.register_form.gender_other') }}</option>
                        </select>
                    </div>

                    <div>
                        <label for="dob" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            {{ __('conference.register_form.dob') }}
                        </label>
                        <input type="date" name="dob" id="dob" value="{{ old('dob') }}"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 text-sm bg-white">
                    </div>
                </div>

                <!-- Cơ quan (Organization) -->
                <div>
                    <label for="organization" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        {{ __('conference.register_form.organization') }}
                    </label>
                    <input type="text" name="organization" id="organization" value="{{ old('organization') }}"
                           placeholder="{{ $locale === 'en' ? 'Hospital / University / Institute' : 'Bệnh viện / Viện nghiên cứu / Trường Đại học' }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 text-sm">
                </div>

                <!-- Khoa/Phòng (Department) & Chức vụ (Title) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="department" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            {{ __('conference.register_form.department') }}
                        </label>
                        <input type="text" name="department" id="department" value="{{ old('department') }}"
                               placeholder="{{ $locale === 'en' ? 'e.g. Department of Surgery' : 'Ví dụ: Khoa Phẫu thuật Tiêu hóa' }}"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 text-sm">
                    </div>

                    <div>
                        <label for="job_title" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            {{ __('conference.register_form.job_title') }}
                        </label>
                        <input type="text" name="job_title" id="job_title" value="{{ old('job_title') }}"
                               placeholder="{{ $locale === 'en' ? 'e.g. Head of Department, Doctor' : 'Ví dụ: Bác sĩ điều trị, Trưởng khoa' }}"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 text-sm">
                    </div>
                </div>

                <!-- Email & Số điện thoại -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            {{ __('conference.register_form.email') }} <span class="text-rose-500">*</span>
                        </label>
                        <input type="email" name="email" id="email" required value="{{ old('email') }}"
                               placeholder="email@example.com"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 text-sm">
                    </div>

                    <div>
                        <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            {{ __('conference.register_form.phone') }} <span class="text-rose-500">*</span>
                        </label>
                        <input type="tel" name="phone" id="phone" required value="{{ old('phone') }}"
                               placeholder="0912 345 678"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 text-sm">
                    </div>
                </div>

                <!-- Quý đại biểu có tham dự tiệc tối không? -->
                <div class="p-5 rounded-2xl bg-amber-50/70 border border-amber-200/80 space-y-3">
                    <span class="block text-xs font-bold uppercase tracking-wider text-amber-900">
                        {{ __('conference.register_form.attend_dinner') }}
                    </span>
                    <div class="flex items-center gap-6 text-sm text-slate-800">
                        <label class="inline-flex items-center gap-2 cursor-pointer font-medium">
                            <input type="radio" name="attend_dinner" value="1" {{ old('attend_dinner') === '1' ? 'checked' : '' }}
                                   class="text-emerald-700 focus:ring-emerald-600">
                            <span>{{ __('conference.register_form.dinner_yes') }}</span>
                        </label>
                        <label class="inline-flex items-center gap-2 cursor-pointer font-medium">
                            <input type="radio" name="attend_dinner" value="0" {{ old('attend_dinner', '0') === '0' ? 'checked' : '' }}
                                   class="text-emerald-700 focus:ring-emerald-600">
                            <span>{{ __('conference.register_form.dinner_no') }}</span>
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" class="btn-primary w-full text-center py-3 text-sm font-bold shadow-md hover:shadow-lg transition">
                        {{ __('conference.register_form.submit_btn') }} →
                    </button>
                </div>
            </form>
        </div>
        @endif

    </div>
</section>
@endsection
