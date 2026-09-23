@props([
    'message' => null,
    'type' => 'success',
])

@php
    $actualMessage = $message ?? session('message') ?? session('success') ?? session('error');
    
    if (session()->has('error')) {
        $type = 'error';
    } elseif (session()->has('warning')) {
        $type = 'warning';
    } elseif (session()->has('info')) {
        $type = 'info';
    }
@endphp

<div 
    x-data="{ 
        show: false, 
        message: '', 
        type: 'success',
        bgColorsLight: {
            success: '#ecfdf5',
            error: '#fef2f2',
            warning: '#fffbeb',
            info: '#eff6ff'
        },
        bgColorsDark: {
            success: '#022c22',
            error: '#450a0a',
            warning: '#451a03',
            info: '#172554'
        },
        borderColorsLight: {
            success: '#a7f3d0',
            error: '#fecaca',
            warning: '#fde68a',
            info: '#bfdbfe'
        },
        borderColorsDark: {
            success: '#064e3b',
            error: '#7f1d1d',
            warning: '#78350f',
            info: '#1e3a8a'
        },
        textColorsLight: {
            success: '#065f46',
            error: '#991b1b',
            warning: '#92400e',
            info: '#1e40af'
        },
        textColorsDark: {
            success: '#a7f3d0',
            error: '#fecaca',
            warning: '#fde68a',
            info: '#bfdbfe'
        },
        icons: {
            success: `<svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round' class='shrink-0'><circle cx='12' cy='12' r='10'/><path d='m9 12 2 2 4-4'/></svg>`,
            error: `<svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round' class='shrink-0'><circle cx='12' cy='12' r='10'/><line x1='15' x2='9' y1='9' y2='15'/><line x1='9' x2='15' y1='9' y2='15'/></svg>`,
            warning: `<svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round' class='shrink-0'><path d='m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z'/><line x1='12' x2='12' y1='9' y2='13'/><line x1='12' x2='12' y1='17' y2='17'/></svg>`,
            info: `<svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round' class='shrink-0'><circle cx='12' cy='12' r='10'/><path d='M12 16v-4'/><path d='M12 8h.01'/></svg>`
        },
        timeout: null,
        isDarkMode() {
            return document.documentElement.classList.contains('dark');
        },
        getBgColor() {
            return this.isDarkMode() ? (this.bgColorsDark[this.type] || '#022c22') : (this.bgColorsLight[this.type] || '#ecfdf5');
        },
        getBorderColor() {
            return this.isDarkMode() ? (this.borderColorsDark[this.type] || '#064e3b') : (this.borderColorsLight[this.type] || '#a7f3d0');
        },
        getTextColor() {
            return this.isDarkMode() ? (this.textColorsDark[this.type] || '#a7f3d0') : (this.textColorsLight[this.type] || '#065f46');
        },
        trigger(msg, t) {
            if (!msg) return;
            this.message = msg;
            this.type = t || 'success';
            this.show = true;
            if (this.timeout) clearTimeout(this.timeout);
            this.timeout = setTimeout(() => this.show = false, 4000);
        }
    }"
    x-show="show"
    x-on:toast.window="trigger($event.detail.message, $event.detail.type)"
    x-init="
        @if($actualMessage)
            trigger('{{ addslashes($actualMessage) }}', '{{ $type }}');
        @endif
    "
    x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="translate-x-full opacity-0"
    x-transition:enter-end="translate-x-0 opacity-100"
    x-transition:leave="transition ease-in duration-200 transform"
    x-transition:leave-start="translate-x-0 opacity-100"
    x-transition:leave-end="translate-x-full opacity-0"
    class="fixed top-6 right-6 max-w-sm w-full border shadow-2xl rounded-2xl p-4 flex items-start gap-3"
    :style="'z-index: 999999 !important; background-color: ' + getBgColor() + ' !important; border-color: ' + getBorderColor() + ' !important; color: ' + getTextColor() + ' !important;'"
    x-cloak
>
    <div x-html="icons[type]" class="shrink-0"></div>
    <div class="flex-1 text-sm font-semibold font-body leading-normal" x-text="message"></div>
    <button @click="show = false" class="text-current opacity-60 hover:opacity-100 transition-opacity mt-0.5">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
    </button>
</div>
