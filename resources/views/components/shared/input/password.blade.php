@props([
    'label' => 'Password',
    'id',
    'name',
    'placeholder' => '••••••••',
    'required' => false,
    'forgotUrl' => null
])

<div class="space-y-2" x-data="{ show: false }">
    <div class="flex justify-between items-center">
        @if($label)
            <label for="{{ $id }}" class="block text-sm font-semibold font-body text-muted-foreground">
                {{ $label }}
            </label>
        @endif
        @if($forgotUrl)
            <a href="{{ $forgotUrl }}" class="text-xs font-semibold font-body text-primary hover:text-accent transition-colors">
                Forgot Password?
            </a>
        @endif
    </div>
    
    <div class="relative">
        @if(isset($icon))
            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-muted-foreground/60">
                {{ $icon }}
            </span>
        @endif
        
        <input 
            :type="show ? 'text' : 'password'" 
            type="password"
            id="{{ $id }}" 
            name="{{ $name }}" 
            placeholder="{{ $placeholder }}" 
            {{ $required ? 'required' : '' }}
            {{ $attributes->merge([
                'class' => 'w-full pr-12 py-3 bg-muted/40 border rounded-xl font-body text-sm text-foreground placeholder-muted-foreground/50 focus:outline-none focus:ring-2 transition-all duration-200 ' . 
                (isset($icon) ? 'pl-11 ' : 'pl-4 ') . 
                ($errors->has($name) 
                    ? 'border-destructive focus:ring-destructive/20 focus:border-destructive' 
                    : 'border-border/80 focus:ring-primary/20 focus:border-primary')
            ]) }}
        >

        <!-- Toggle Visibility Button -->
        <button 
            type="button" 
            x-on:click="show = !show"
            class="absolute inset-y-0 right-0 pr-3 flex items-center text-muted-foreground/60 hover:text-foreground focus:outline-none"
        >
            <!-- Eye icon when hidden -->
            <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
            <!-- Eye Off icon when shown -->
            <svg x-show="show" x-cloak xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-off"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.52 13.52 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" x2="22" y1="2" y2="22"/></svg>
        </button>
    </div>

    @error($name)
        <p class="text-xs font-semibold text-destructive mt-1 font-body block">{{ $message }}</p>
    @enderror
</div>
