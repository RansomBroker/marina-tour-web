@props([
    'label' => null,
    'id',
    'name',
    'type' => 'text',
    'placeholder' => '',
    'required' => false
])

<div class="space-y-2">
    @if($label)
        <label for="{{ $id }}" class="block text-sm font-semibold font-body text-muted-foreground">
            {{ $label }}
        </label>
    @endif
    
    <div class="relative">
        @if(isset($icon))
            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-muted-foreground/60">
                {{ $icon }}
            </span>
        @endif
        
        <input 
            type="{{ $type }}" 
            id="{{ $id }}" 
            name="{{ $name }}" 
            value="{{ old($name) }}"
            placeholder="{{ $placeholder }}" 
            {{ $required ? 'required' : '' }}
            {{ $attributes->merge([
                'class' => 'w-full pr-4 py-3 bg-muted/40 border rounded-xl font-body text-sm text-foreground placeholder-muted-foreground/50 focus:outline-none focus:ring-2 transition-all duration-200 ' . 
                (isset($icon) ? 'pl-11 ' : 'pl-4 ') . 
                ($errors->has($name) 
                    ? 'border-destructive focus:ring-destructive/20 focus:border-destructive' 
                    : 'border-border/80 focus:ring-primary/20 focus:border-primary')
            ]) }}
        >
    </div>

    @error($name)
        <p class="text-xs font-semibold text-destructive mt-1 font-body block">{{ $message }}</p>
    @enderror
</div>
