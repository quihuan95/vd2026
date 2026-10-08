import Alpine from 'alpinejs';
import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';

window.Alpine = Alpine;
window.Swiper = Swiper;

// Clipboard helper function
window.copyToClipboard = function(text, element) {
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(text).then(() => {
            showCopiedTooltip(element);
        });
    } else {
        const textArea = document.createElement("textarea");
        textArea.value = text;
        textArea.style.position = "fixed";
        textArea.style.left = "-999999px";
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        try {
            document.execCommand('copy');
            showCopiedTooltip(element);
        } catch (err) {
            console.error('Copy failed', err);
        }
        document.body.removeChild(textArea);
    }
};

function showCopiedTooltip(element) {
    if (!element) return;
    const originalText = element.getAttribute('data-original-text') || element.innerText;
    element.setAttribute('data-original-text', originalText);
    element.innerText = '✓ ' + (document.documentElement.lang === 'vi' ? 'Đã sao chép' : 'Copied');
    element.classList.add('bg-emerald-600', 'text-white');
    
    setTimeout(() => {
        element.innerText = originalText;
        element.classList.remove('bg-emerald-600', 'text-white');
    }, 2200);
}

// Global Alpine data components if needed
Alpine.data('bankTransferCard', (accountNumber, content) => ({
    accountNumber: accountNumber,
    content: content,
    copiedAccount: false,
    copiedContent: false,
    copyAccount() {
        navigator.clipboard.writeText(this.accountNumber);
        this.copiedAccount = true;
        setTimeout(() => { this.copiedAccount = false; }, 2000);
    },
    copyContent() {
        navigator.clipboard.writeText(this.content);
        this.copiedContent = true;
        setTimeout(() => { this.copiedContent = false; }, 2000);
    }
}));

Alpine.start();
