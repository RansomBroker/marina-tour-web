@props(['text', 'name', 'location'])

@php
    $initial = strtoupper(substr($name, 0, 1));
@endphp

<div class="bg-card rounded-2xl p-6 shadow-sm border border-border/50 hover:shadow-md transition-shadow" style="opacity: 1; transform: none;">
    <div class="flex gap-1 mb-4">
        @for($i = 0; $i < 5; $i++)
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star w-4 h-4 fill-accent text-accent"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path></svg>
        @endfor
    </div>
    <p class="text-sm text-muted-foreground font-body leading-relaxed mb-5 italic">"{{ $text }}"</p>
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center font-heading font-bold text-primary text-sm">{{ $initial }}</div>
        <div>
            <p class="text-sm font-semibold font-body text-foreground">{{ $name }}</p>
            <p class="text-xs text-muted-foreground font-body">{{ $location }}</p>
        </div>
    </div>
</div>
