@props([
    'title' => 'Nội dung đang cập nhật',
    'subtitle' => 'Ban Tổ chức Hội nghị Khoa học Quốc tế Bệnh viện Hữu nghị Việt Đức 2026 đang hoàn thiện nội dung này và sẽ sớm công bố chính thức.',
    'backUrl' => null,
    'backText' => null,
])

@php
    $locale = $locale ?? app()->getLocale();
@endphp

<div class="py-16 md:py-24 bg-slate-50/70">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="bg-white rounded-3xl p-8 sm:p-12 border border-slate-200 shadow-sm text-center relative overflow-hidden">
            <!-- Background accent glow -->
            <div class="absolute -top-16 -right-16 w-48 h-48 bg-amber-400/10 rounded-full blur-2xl pointer-events-none"></div>
            <div class="absolute -bottom-16 -left-16 w-48 h-48 bg-emerald-500/10 rounded-full blur-2xl pointer-events-none"></div>

            <div class="relative z-10 space-y-6">
                <!-- Icon badge -->
                <div class="w-16 h-16 sm:w-20 sm:h-20 bg-amber-50 border border-amber-200 text-amber-600 rounded-2xl flex items-center justify-center text-3xl sm:text-4xl mx-auto shadow-inner">
                    ⏳
                </div>

                <div class="space-y-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-amber-100 text-amber-800">
                        <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                        {{ $locale === 'en' ? 'Updating / Coming Soon' : 'Đang cập nhật thông tin' }}
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        {{ $title }}
                    </h2>
                    <p class="text-slate-600 text-xs sm:text-sm max-w-xl mx-auto leading-relaxed">
                        {{ $subtitle }}
                    </p>
                </div>

                <!-- Contact note box -->
                <div class="p-4 rounded-2xl bg-emerald-50/60 border border-emerald-200/80 text-xs text-slate-700 max-w-lg mx-auto flex items-center justify-center gap-2">
                    <span class="text-emerald-700 font-bold">✉️</span>
                    <span>
                        {{ $locale === 'en' ? 'For urgent inquiries, please contact:' : 'Mọi thắc mắc xin liên hệ Ban Tổ Chức qua email:' }}
                        <a href="mailto:{{ __('conference.secretariat_email') }}" class="font-bold text-emerald-800 hover:underline">
                            {{ __('conference.secretariat_email') }}
                        </a>
                    </span>
                </div>

                <!-- Action buttons -->
                <div class="pt-2 flex flex-wrap items-center justify-center gap-3">
                    <a href="{{ route('conference.home', ['locale' => $locale]) }}" class="btn-secondary text-xs">
                        {{ $locale === 'en' ? '← Back to Home' : '← Về Trang Chủ' }}
                    </a>
                    <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'register']) }}" class="btn-primary text-xs">
                        {{ __('conference.cta.register_now') }} →
                    </a>
                    <a href="{{ route('conference.page', ['locale' => $locale, 'page' => 'about']) }}" class="btn-secondary text-xs">
                        {{ $locale === 'en' ? 'Welcome Message' : 'Thư chào mừng' }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
