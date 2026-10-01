@props([
    'delegateId' => null,
    'amount' => null,
])

@php
    $locale = app()->getLocale();
    $content = $delegateId 
        ? __('conference.bank.content_prefix') . $delegateId 
        : __('conference.bank.content_prefix') . 'VDUH26-DEL-XXXX';
@endphp

<div class="rounded-xl border border-amber-300/80 bg-gradient-to-br from-amber-50/80 via-white to-emerald-50/60 p-6 shadow-sm relative overflow-hidden" 
     x-data="{
        accountNumber: '{{ __('conference.bank.account_number') }}',
        transferContent: '{{ $content }}',
        copiedAcc: false,
        copiedMsg: false,
        txtCopied: '{{ $locale === 'en' ? '✓ Copied' : '✓ Đã sao chép' }}',
        txtCopy: '{{ $locale === 'en' ? 'Copy' : 'Sao chép' }}',
        copyAcc() {
            navigator.clipboard.writeText(this.accountNumber);
            this.copiedAcc = true;
            setTimeout(() => this.copiedAcc = false, 2000);
        },
        copyMsg() {
            navigator.clipboard.writeText(this.transferContent);
            this.copiedMsg = true;
            setTimeout(() => this.copiedMsg = false, 2000);
        }
     }">
    
    <!-- Decorative badge -->
    <div class="flex items-center justify-between mb-4 pb-3 border-b border-amber-200">
        <div class="flex items-center gap-2">
            <span class="p-2 bg-emerald-800 text-amber-300 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
            </span>
            <div>
                <h4 class="font-bold text-slate-900 text-sm sm:text-base">{{ __('conference.bank.title') }}</h4>
                <p class="text-xs text-slate-500">{{ $locale === 'en' ? 'Joint Stock Commercial Bank for Investment and Development of Vietnam (BIDV)' : 'Ngân hàng TMCP Đầu tư và Phát triển Việt Nam (BIDV)' }}</p>
            </div>
        </div>
        <span class="text-xs font-bold text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-full border border-emerald-300">
            {{ $locale === 'en' ? 'Direct Bank Transfer' : 'Chuyển khoản trực tiếp' }}
        </span>
    </div>

    <!-- Alert warning -->
    <div class="mb-5 p-3 rounded-lg bg-amber-100/70 border-l-4 border-amber-500 text-xs text-amber-900 font-medium">
        ⚠️ {{ __('conference.bank.warning') }}
    </div>

    <!-- Details grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs sm:text-sm">
        <div class="p-3 bg-white rounded-lg border border-slate-200 shadow-2xs">
            <span class="text-slate-500 block mb-0.5 text-xs">{{ $locale === 'en' ? 'Beneficiary Name (Account Name)' : 'Đơn vị thụ hưởng (Account Name)' }}</span>
            <span class="font-bold text-slate-900 tracking-wide">{{ __('conference.bank.account_name') }}</span>
        </div>

        <div class="p-3 bg-white rounded-lg border border-slate-200 shadow-2xs flex items-center justify-between">
            <div>
                <span class="text-slate-500 block mb-0.5 text-xs">{{ $locale === 'en' ? 'Account Number' : 'Số tài khoản (Account Number)' }}</span>
                <span class="font-bold text-emerald-800 text-base font-mono">{{ __('conference.bank.account_number') }}</span>
            </div>
            <button type="button" @click="copyAcc()" class="px-2.5 py-1.5 text-xs font-semibold rounded bg-slate-100 hover:bg-emerald-600 hover:text-white transition border border-slate-300" :class="copiedAcc ? 'bg-emerald-700 text-white' : ''">
                <span x-text="copiedAcc ? txtCopied : txtCopy"></span>
            </button>
        </div>

        <div class="p-3 bg-white rounded-lg border border-slate-200 shadow-2xs">
            <span class="text-slate-500 block mb-0.5 text-xs">{{ $locale === 'en' ? 'Bank & Branch' : 'Ngân hàng & Chi nhánh (Bank & Branch)' }}</span>
            <span class="font-semibold text-slate-800">{{ __('conference.bank.bank_name') }}</span>
            <div class="text-xs text-slate-600">{{ __('conference.bank.branch') }}</div>
        </div>

        <div class="p-3 bg-white rounded-lg border border-slate-200 shadow-2xs flex items-center justify-between">
            <div>
                <span class="text-slate-500 block mb-0.5 text-xs">{{ $locale === 'en' ? 'Transfer Description / Reference Note' : 'Cú pháp chuyển khoản (Transfer note)' }}</span>
                <span class="font-bold text-amber-900 font-mono text-xs sm:text-sm" x-text="transferContent"></span>
            </div>
            <button type="button" @click="copyMsg()" class="px-2.5 py-1.5 text-xs font-semibold rounded bg-slate-100 hover:bg-emerald-600 hover:text-white transition border border-slate-300" :class="copiedMsg ? 'bg-emerald-700 text-white' : ''">
                <span x-text="copiedMsg ? txtCopied : txtCopy"></span>
            </button>
        </div>
    </div>

    @if($amount)
    <div class="mt-4 pt-3 border-t border-amber-200 flex items-center justify-between">
        <span class="text-xs font-semibold text-slate-600">{{ $locale === 'en' ? 'Total Amount Due:' : 'Số tiền cần thanh toán:' }}</span>
        <span class="text-base sm:text-lg font-bold text-emerald-800">{{ number_format($amount, 0, ',', '.') }} VND</span>
    </div>
    @endif
</div>
