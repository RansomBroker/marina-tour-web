<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Admin Login - Smith Travel Bali</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        [x-cloak] { display: none !important; }
        .login-bg-pattern {
            background-color: hsl(var(--background));
            background-image: radial-gradient(hsl(var(--primary) / 0.05) 1px, transparent 1px);
            background-size: 24px 24px;
        }
    </style>
</head>
<body class="antialiased min-h-screen flex items-center justify-center login-bg-pattern p-4 sm:p-6 lg:p-8">

    <!-- Main Container (Card) -->
    <div class="relative w-full max-w-5xl bg-card rounded-3xl overflow-hidden shadow-2xl border border-border/60 flex flex-col md:flex-row min-h-[600px] anim-fade-up">
        
        <!-- Decorative Glow Effects -->
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-accent/10 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Left Side: Brand Showcase & Imagery -->
        <div class="relative w-full md:w-1/2 min-h-[300px] md:min-h-auto overflow-hidden flex flex-col justify-between p-8 lg:p-12 text-white">
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=1000&q=80" alt="Scenic Uluwatu Temple, Bali" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-primary/95 via-primary/60 to-primary/40"></div>
                <div class="absolute inset-0 bg-black/10"></div>
            </div>

            <!-- Top Brand Info -->
            <div class="relative z-10 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-accent flex items-center justify-center shadow-lg shadow-accent/30">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="m8 3 4 8 5-5 5 15H2L8 3z"/></svg>
                </div>
                <div>
                    <span class="font-heading font-bold text-lg tracking-wide">Smith Travel</span>
                    <span class="block text-xs font-body text-accent font-semibold tracking-widest uppercase -mt-1">Bali</span>
                </div>
            </div>

            <!-- Bottom Brand Message -->
            <div class="relative z-10 mt-auto pt-16">
                <span class="inline-block px-3 py-1 rounded-full bg-white/10 backdrop-blur-md text-xs font-body font-medium mb-4 border border-white/10">
                    ✦ Control Center
                </span>
                <h2 class="text-3xl lg:text-4xl font-bold font-heading leading-tight mb-4">
                    Elevating Travel Experiences in Paradise.
                </h2>
                <p class="text-sm text-white/70 font-body leading-relaxed max-w-sm">
                    Manage bookings, customize premium itineraries, and share beautiful destinations across the Island of the Gods.
                </p>
            </div>
        </div>

        <!-- Right Side: Clean Modern Form -->
        <div class="w-full md:w-1/2 p-8 lg:p-12 flex flex-col justify-center bg-card z-10">
            <div class="max-w-md w-full mx-auto">
                <!-- Heading -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold font-heading text-foreground mb-2">Welcome Back</h1>
                    <p class="text-muted-foreground font-body text-sm">Please enter your admin credentials to access the console.</p>
                </div>

                <!-- Form -->
                @if (session('error'))
                    <div class="mb-4 p-4 rounded-xl bg-destructive/10 border border-destructive/20 text-destructive text-sm font-body flex items-center gap-2.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <form id="adminLoginForm" action="{{ route('admin.login') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Email Field -->
                    <x-shared.input.text 
                        id="adminEmail" 
                        name="email" 
                        type="email" 
                        label="Email Address" 
                        placeholder="name@smithtravelbali.com" 
                        required
                    >
                        <x-slot:icon>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        </x-slot:icon>
                    </x-shared.input.text>

                    <!-- Password Field -->
                    <x-shared.input.password 
                        id="adminPassword" 
                        name="password" 
                        label="Password" 
                        placeholder="••••••••" 
                        required
                        forgotUrl="#"
                    >
                        <x-slot:icon>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        </x-slot:icon>
                    </x-shared.input.password>

                    <!-- Remember Me Option -->
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            id="rememberMe" 
                            name="remember" 
                            class="h-4 w-4 rounded border-border text-primary focus:ring-primary/20"
                        >
                        <label for="rememberMe" class="ml-2.5 block text-sm font-body text-muted-foreground select-none cursor-pointer">
                            Remember me
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full py-3.5 bg-primary hover:bg-primary/95 text-white font-semibold font-body text-sm rounded-xl shadow-lg shadow-primary/20 hover:shadow-xl transition-all duration-200 flex items-center justify-center gap-2"
                    >
                        Sign In to Console
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </button>
                </form>

                <!-- Back to Main Site -->
                <div class="mt-8 text-center">
                    <a href="/" class="inline-flex items-center gap-1.5 text-xs font-semibold font-body text-muted-foreground hover:text-primary transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
                        Back to main website
                    </a>
                </div>
            </div>
        </div>

    </div>

</body>
</html>
