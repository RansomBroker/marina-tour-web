@props([
    'type' => 'warning',
    'title' => 'Confirm Action',
    'message' => 'Are you sure you want to perform this action? This cannot be undone.',
    'confirmText' => 'Confirm',
    'cancelText' => 'Cancel',
    'confirmAction',
    'cancelAction' => 'closeConfirmModal',
    'openProp' => 'isConfirmModalOpen'
])

@php
    $colors = [
        'danger' => [
            'iconBg' => 'bg-destructive/10 text-destructive border-destructive/20',
            'btnConfirm' => 'bg-destructive hover:bg-destructive/90 text-white focus:ring-destructive/20 shadow-destructive/15',
        ],
        'warning' => [
            'iconBg' => 'bg-amber-500/10 text-amber-600 border-amber-500/20',
            'btnConfirm' => 'bg-amber-600 hover:bg-amber-700 text-white focus:ring-amber-600/20 shadow-amber-600/15',
        ],
        'info' => [
            'iconBg' => 'bg-blue-500/10 text-blue-600 border-blue-500/20',
            'btnConfirm' => 'bg-blue-600 hover:bg-blue-700 text-white focus:ring-blue-600/20 shadow-blue-600/15',
        ],
        'success' => [
            'iconBg' => 'bg-emerald-500/10 text-emerald-600 border-emerald-500/20',
            'btnConfirm' => 'bg-emerald-600 hover:bg-emerald-700 text-white focus:ring-emerald-600/20 shadow-emerald-600/15',
        ]
    ][$type] ?? [
        'iconBg' => 'bg-muted text-muted-foreground border-border/80',
        'btnConfirm' => 'bg-primary hover:bg-primary/90 text-white focus:ring-primary/20 shadow-primary/15',
    ];
@endphp

<div x-data="{ open: @entangle($openProp) }" x-show="open" x-cloak class="fixed inset-0 z-[60] overflow-y-auto flex items-center justify-center p-4">
    <!-- Backdrop -->
    <div x-show="open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity" 
         wire:click="{{ $cancelAction }}"></div>

    <!-- Modal Content -->
    <div x-show="open"
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         class="relative bg-card border border-border/60 rounded-3xl max-w-md w-full p-6 sm:p-8 shadow-2xl overflow-hidden transition-all z-10">
        <div class="flex flex-col items-center text-center">
            <!-- Icon -->
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center border {{ $colors['iconBg'] }} mb-5 shrink-0">
                @if($type === 'danger')
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                @elseif($type === 'warning')
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><line x1="12" x2="12" y1="9" y2="13"/><line x1="12" x2="12" y1="17" y2="17"/></svg>
                @elseif($type === 'info')
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                @elseif($type === 'success')
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                @endif
            </div>

            <!-- Title & Description -->
            <h3 class="text-lg font-bold font-heading text-foreground mb-2">{{ $title }}</h3>
            <p class="text-sm font-body text-muted-foreground leading-relaxed mb-6">{{ $message }}</p>

            <!-- Action Buttons -->
            <div class="flex items-center gap-3 w-full">
                <button type="button" wire:click="{{ $cancelAction }}" class="flex-1 py-3 px-4 rounded-xl border border-border/80 text-muted-foreground hover:bg-muted/40 font-body text-sm font-semibold transition-all">
                    {{ $cancelText }}
                </button>
                <button type="button" wire:click="{{ $confirmAction }}" class="flex-1 py-3 px-4 rounded-xl font-body text-sm font-semibold transition-all shadow-lg {{ $colors['btnConfirm'] }}">
                    {{ $confirmText }}
                </button>
            </div>
        </div>
    </div>
</div>
