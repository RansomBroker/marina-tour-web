<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Console - Smith Travel Bali')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        [x-cloak] { display: none !important; }
        .dashboard-pattern {
            background-color: hsl(var(--background));
            background-image: radial-gradient(hsl(var(--primary) / 0.03) 1px, transparent 1px);
            background-size: 24px 24px;
        }
    </style>
    @stack('styles')
    @livewireStyles
</head>
<body class="antialiased dashboard-pattern text-foreground min-h-screen" 
	  x-data="{ mobileSidebarOpen: false, sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true', settingsDropdownOpen: {{ request()->routeIs('admin.settings*') ? 'true' : 'false' }} }" 
	  x-init="$watch('sidebarCollapsed', val => localStorage.setItem('sidebarCollapsed', val))">

	<div class="flex h-screen overflow-hidden">

		<!-- Sidebar (Desktop & Tablet) -->
		<aside class="hidden lg:flex flex-col bg-card border-r border-border/60 shrink-0 relative z-20 transition-all duration-300"
			   :class="sidebarCollapsed ? 'w-20' : 'w-72'">
			<!-- Sidebar Header -->
			@php
				$adminLogo = \App\Models\Setting::get('company_logo');
				$adminCompanyName = \App\Models\Setting::get('company_name', 'Smith Travel');
			@endphp
			<div class="h-20 flex items-center border-b border-border/60 transition-all duration-300"
				 :class="sidebarCollapsed ? 'justify-center px-4' : 'px-8 gap-3'">
				@if ($adminLogo)
					<img src="{{ asset('storage/' . $adminLogo) }}" alt="{{ $adminCompanyName }}" class="h-9 w-9 rounded-xl object-contain shrink-0 bg-white p-0.5">
				@else
					<div class="w-9 h-9 rounded-xl bg-accent flex items-center justify-center shadow-lg shadow-accent/20 shrink-0">
						<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="m8 3 4 8 5-5 5 15H2L8 3z"/></svg>
					</div>
				@endif
				<div x-show="!sidebarCollapsed" x-transition:enter="transition ease-out duration-200" class="min-w-0">
					<span class="font-heading font-bold text-base tracking-wide block leading-none truncate">{{ $adminCompanyName }}</span>
					<span class="text-[10px] font-body text-accent font-bold tracking-widest uppercase mt-0.5 block">Console</span>
				</div>
			</div>

			<!-- Sidebar Navigation -->
			<nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
				<a href="{{ route('admin.dashboard') }}" class="flex items-center rounded-xl font-body text-sm transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white font-semibold shadow-md shadow-primary/15' : 'text-muted-foreground hover:bg-muted/40 hover:text-foreground font-medium' }}"
				   :class="sidebarCollapsed ? 'p-3 justify-center' : 'px-4 py-3 gap-3'">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
					<span x-show="!sidebarCollapsed" x-transition:enter="transition ease-out duration-200" class="truncate">Dashboard</span>
				</a>
				<a href="{{ route('admin.bookings') }}" class="flex items-center rounded-xl font-body text-sm transition-all {{ request()->routeIs('admin.bookings') ? 'bg-primary text-white font-semibold shadow-md shadow-primary/15' : 'text-muted-foreground hover:bg-muted/40 hover:text-foreground font-medium' }}"
				   :class="sidebarCollapsed ? 'p-3 justify-center' : 'px-4 py-3 gap-3'">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/><path d="m9 16 2 2 4-4"/></svg>
					<span x-show="!sidebarCollapsed" x-transition:enter="transition ease-out duration-200" class="truncate">Bookings</span>
				</a>
				<a href="{{ route('admin.inquiries') }}" class="flex items-center rounded-xl font-body text-sm transition-all {{ request()->routeIs('admin.inquiries') ? 'bg-primary text-white font-semibold shadow-md shadow-primary/15' : 'text-muted-foreground hover:bg-muted/40 hover:text-foreground font-medium' }}"
				   :class="sidebarCollapsed ? 'p-3 justify-center' : 'px-4 py-3 gap-3'">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
					<span x-show="!sidebarCollapsed" x-transition:enter="transition ease-out duration-200" class="truncate">Inquiries</span>
				</a>
				<a href="{{ route('admin.packages') }}" class="flex items-center rounded-xl font-body text-sm transition-all {{ request()->routeIs('admin.packages') ? 'bg-primary text-white font-semibold shadow-md shadow-primary/15' : 'text-muted-foreground hover:bg-muted/40 hover:text-foreground font-medium' }}"
				   :class="sidebarCollapsed ? 'p-3 justify-center' : 'px-4 py-3 gap-3'">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
					<span x-show="!sidebarCollapsed" x-transition:enter="transition ease-out duration-200" class="truncate">Tour Packages</span>
				</a>
				<a href="{{ route('admin.categories') }}" class="flex items-center rounded-xl font-body text-sm transition-all {{ request()->routeIs('admin.categories') ? 'bg-primary text-white font-semibold shadow-md shadow-primary/15' : 'text-muted-foreground hover:bg-muted/40 hover:text-foreground font-medium' }}"
				   :class="sidebarCollapsed ? 'p-3 justify-center' : 'px-4 py-3 gap-3'">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><path d="M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"/></svg>
					<span x-show="!sidebarCollapsed" x-transition:enter="transition ease-out duration-200" class="truncate">Categories</span>
				</a>
				<a href="{{ route('admin.blogs') }}" class="flex items-center rounded-xl font-body text-sm transition-all {{ request()->routeIs('admin.blogs') || request()->routeIs('admin.blogs.*') ? 'bg-primary text-white font-semibold shadow-md shadow-primary/15' : 'text-muted-foreground hover:bg-muted/40 hover:text-foreground font-medium' }}"
				   :class="sidebarCollapsed ? 'p-3 justify-center' : 'px-4 py-3 gap-3'">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6 6h10M6 10h10"/></svg>
					<span x-show="!sidebarCollapsed" x-transition:enter="transition ease-out duration-200" class="truncate">Blogs</span>
				</a>
				<!-- Settings Accordion / Dropdown -->
				<div class="space-y-1">
					<button 
						type="button"
						x-on:click="if (sidebarCollapsed) { sidebarCollapsed = false; } settingsDropdownOpen = !settingsDropdownOpen"
						class="w-full flex items-center justify-between rounded-xl font-body text-sm transition-all {{ request()->routeIs('admin.settings*') ? 'bg-primary/10 text-primary font-semibold' : 'text-muted-foreground hover:bg-muted/40 hover:text-foreground font-medium' }}"
						:class="sidebarCollapsed ? 'p-3 justify-center' : 'px-4 py-3 gap-3'"
						title="Settings"
					>
						<div class="flex items-center gap-3 min-w-0">
							<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.1a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
							<span x-show="!sidebarCollapsed" x-transition:enter="transition ease-out duration-200" class="truncate">Settings</span>
						</div>
						<svg x-show="!sidebarCollapsed" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 transition-transform duration-200" :class="settingsDropdownOpen ? 'rotate-180 text-primary' : 'text-muted-foreground'"><polyline points="6 9 12 15 18 9"/></svg>
					</button>

					<!-- Submenu Items -->
					<div 
						x-show="settingsDropdownOpen && !sidebarCollapsed" 
						x-transition:enter="transition ease-out duration-200"
						x-transition:enter-start="opacity-0 -translate-y-2"
						x-transition:enter-end="opacity-100 translate-y-0"
						x-transition:leave="transition ease-in duration-150"
						x-transition:leave-start="opacity-100 translate-y-0"
						x-transition:leave-end="opacity-0 -translate-y-2"
						class="pl-7 pr-2 py-1 space-y-1"
					>
						<a href="{{ route('admin.settings.whatsapp') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg font-body text-xs transition-all {{ request()->routeIs('admin.settings.whatsapp') ? 'bg-primary text-white font-semibold shadow-sm' : 'text-muted-foreground hover:bg-muted/40 hover:text-foreground font-medium' }}">
							<span class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('admin.settings.whatsapp') ? 'bg-white' : 'bg-muted-foreground/60' }}"></span>
							<span>WhatsApp Setting</span>
						</a>
						<a href="{{ route('admin.settings.company') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg font-body text-xs transition-all {{ request()->routeIs('admin.settings.company') ? 'bg-primary text-white font-semibold shadow-sm' : 'text-muted-foreground hover:bg-muted/40 hover:text-foreground font-medium' }}">
							<span class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('admin.settings.company') ? 'bg-white' : 'bg-muted-foreground/60' }}"></span>
							<span>Company Profile & Logo</span>
						</a>
						<a href="{{ route('admin.settings.smtp') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg font-body text-xs transition-all {{ request()->routeIs('admin.settings.smtp') ? 'bg-primary text-white font-semibold shadow-sm' : 'text-muted-foreground hover:bg-muted/40 hover:text-foreground font-medium' }}">
							<span class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('admin.settings.smtp') ? 'bg-white' : 'bg-muted-foreground/60' }}"></span>
							<span>SMTP (Email) Setting</span>
						</a>
						<a href="{{ route('admin.settings.users') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg font-body text-xs transition-all {{ request()->routeIs('admin.settings.users') ? 'bg-primary text-white font-semibold shadow-sm' : 'text-muted-foreground hover:bg-muted/40 hover:text-foreground font-medium' }}">
							<span class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('admin.settings.users') ? 'bg-white' : 'bg-muted-foreground/60' }}"></span>
							<span>User Management</span>
						</a>
					</div>
				</div>
			</nav>

			<!-- Sidebar Footer -->
			<div class="p-4 border-t border-border/60 space-y-3">
				<!-- Collapse / Expand Toggle Button -->
				<button x-on:click="sidebarCollapsed = !sidebarCollapsed" 
						class="hidden lg:flex items-center w-full text-muted-foreground hover:text-foreground hover:bg-muted/40 rounded-xl transition-all"
						:class="sidebarCollapsed ? 'p-3 justify-center' : 'px-4 py-3 gap-3'">
					<span class="shrink-0">
						<!-- Chevron Left (when expanded) -->
						<svg x-show="!sidebarCollapsed" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
						<!-- Chevron Right (when collapsed) -->
						<svg x-show="sidebarCollapsed" x-cloak xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
					</span>
					<span x-show="!sidebarCollapsed" x-transition:enter="transition ease-out duration-200" class="text-sm font-medium font-body truncate">
						Collapse Sidebar
					</span>
				</button>

				<!-- Profile Info -->
				<div class="flex items-center bg-muted/30 rounded-2xl transition-all"
					 :class="sidebarCollapsed ? 'p-2 justify-center' : 'p-3 gap-3'">
					<div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center font-heading font-bold text-primary shrink-0">
						{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
					</div>
					<div x-show="!sidebarCollapsed" x-transition:enter="transition ease-out duration-200" class="flex-1 min-w-0">
						<p class="text-sm font-semibold font-body truncate leading-tight">{{ Auth::user()->name }}</p>
						<span class="text-[10px] font-body font-semibold text-accent tracking-wider uppercase">Administrator</span>
					</div>
				</div>
			</div>
		</aside>

		<!-- Mobile Sidebar Overlay & Navigation -->
		<div x-show="mobileSidebarOpen" 
			 x-transition:enter="transition ease-out duration-300"
			 x-transition:enter-start="opacity-0"
			 x-transition:enter-end="opacity-100"
			 x-transition:leave="transition ease-in duration-200"
			 x-transition:leave-start="opacity-100"
			 x-transition:leave-end="opacity-0"
			 class="fixed inset-0 bg-black/50 z-30 lg:hidden"
			 x-on:click="mobileSidebarOpen = false"
			 x-cloak>
		</div>

		<aside x-show="mobileSidebarOpen"
			   x-transition:enter="transition ease-out duration-300 transform"
			   x-transition:enter-start="-translate-x-full"
			   x-transition:enter-end="translate-x-0"
			   x-transition:leave="transition ease-in duration-200 transform"
			   x-transition:leave-start="translate-x-0"
			   x-transition:leave-end="-translate-x-full"
			   class="fixed inset-y-0 left-0 w-72 bg-card border-r border-border/60 flex flex-col z-40 lg:hidden"
			   x-cloak>
			<!-- Mobile Sidebar Header -->
			<div class="h-20 flex items-center justify-between px-6 border-b border-border/60">
				<div class="flex items-center gap-3">
					@if ($adminLogo)
						<img src="{{ asset('storage/' . $adminLogo) }}" alt="{{ $adminCompanyName }}" class="h-9 w-9 rounded-xl object-contain bg-white p-0.5">
					@else
						<div class="w-9 h-9 rounded-xl bg-accent flex items-center justify-center text-white font-bold">
							{{ strtoupper(substr($adminCompanyName, 0, 1)) ?: 'S' }}
						</div>
					@endif
					<div>
						<span class="font-heading font-bold text-base leading-none block">{{ $adminCompanyName }}</span>
						<span class="text-[10px] font-body text-accent font-semibold tracking-wider uppercase block">Console</span>
					</div>
				</div>
				<button x-on:click="mobileSidebarOpen = false" class="p-1 rounded-lg text-muted-foreground hover:bg-muted">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
				</button>
			</div>

			<!-- Mobile Navigation -->
			<nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
				<a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-body text-sm {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white font-semibold shadow-md' : 'text-muted-foreground font-medium' }}">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
					Dashboard
				</a>
				<a href="{{ route('admin.bookings') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-body text-sm {{ request()->routeIs('admin.bookings') ? 'bg-primary text-white font-semibold shadow-md' : 'text-muted-foreground font-medium' }}">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/><path d="m9 16 2 2 4-4"/></svg>
					Bookings
				</a>
				<a href="{{ route('admin.inquiries') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-body text-sm {{ request()->routeIs('admin.inquiries') ? 'bg-primary text-white font-semibold shadow-md' : 'text-muted-foreground font-medium' }}">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
					Inquiries
				</a>
				<a href="{{ route('admin.packages') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-body text-sm {{ request()->routeIs('admin.packages') ? 'bg-primary text-white font-semibold shadow-md' : 'text-muted-foreground font-medium' }}">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
					Tour Packages
				</a>
				<a href="{{ route('admin.categories') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-body text-sm {{ request()->routeIs('admin.categories') ? 'bg-primary text-white font-semibold shadow-md' : 'text-muted-foreground font-medium' }}">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"/></svg>
					Categories
				</a>
				<a href="{{ route('admin.blogs') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-body text-sm {{ request()->routeIs('admin.blogs') || request()->routeIs('admin.blogs.*') ? 'bg-primary text-white font-semibold shadow-md' : 'text-muted-foreground font-medium' }}">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6 6h10M6 10h10"/></svg>
					Blogs
				</a>
				<!-- Mobile Settings Accordion -->
				<div class="space-y-1">
					<button 
						type="button"
						x-on:click="settingsDropdownOpen = !settingsDropdownOpen"
						class="w-full flex items-center justify-between px-4 py-3 rounded-xl font-body text-sm {{ request()->routeIs('admin.settings*') ? 'bg-primary/10 text-primary font-semibold' : 'text-muted-foreground font-medium hover:bg-muted/40' }}"
					>
						<div class="flex items-center gap-3">
							<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.1a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
							<span>Settings</span>
						</div>
						<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="transition-transform duration-200" :class="settingsDropdownOpen ? 'rotate-180 text-primary' : 'text-muted-foreground'"><polyline points="6 9 12 15 18 9"/></svg>
					</button>

					<div x-show="settingsDropdownOpen" class="pl-7 pr-2 py-1 space-y-1">
						<a href="{{ route('admin.settings.whatsapp') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg font-body text-xs {{ request()->routeIs('admin.settings.whatsapp') ? 'bg-primary text-white font-semibold' : 'text-muted-foreground hover:bg-muted/40 font-medium' }}">
							<span class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('admin.settings.whatsapp') ? 'bg-white' : 'bg-muted-foreground/60' }}"></span>
							<span>WhatsApp Setting</span>
						</a>
						<a href="{{ route('admin.settings.company') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg font-body text-xs {{ request()->routeIs('admin.settings.company') ? 'bg-primary text-white font-semibold' : 'text-muted-foreground hover:bg-muted/40 font-medium' }}">
							<span class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('admin.settings.company') ? 'bg-white' : 'bg-muted-foreground/60' }}"></span>
							<span>Company Profile & Logo</span>
						</a>
						<a href="{{ route('admin.settings.smtp') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg font-body text-xs {{ request()->routeIs('admin.settings.smtp') ? 'bg-primary text-white font-semibold' : 'text-muted-foreground hover:bg-muted/40 font-medium' }}">
							<span class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('admin.settings.smtp') ? 'bg-white' : 'bg-muted-foreground/60' }}"></span>
							<span>SMTP (Email) Setting</span>
						</a>
						<a href="{{ route('admin.settings.users') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg font-body text-xs {{ request()->routeIs('admin.settings.users') ? 'bg-primary text-white font-semibold' : 'text-muted-foreground hover:bg-muted/40 font-medium' }}">
							<span class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('admin.settings.users') ? 'bg-white' : 'bg-muted-foreground/60' }}"></span>
							<span>User Management</span>
						</a>
					</div>
				</div>

			<!-- Mobile Sidebar Footer -->
			<div class="p-4 border-t border-border/60">
				<div class="flex items-center gap-3 p-3 bg-muted/30 rounded-2xl">
					<div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center font-heading font-bold text-primary">
						{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
					</div>
					<div class="flex-1 min-w-0">
						<p class="text-sm font-semibold font-body truncate leading-tight">{{ Auth::user()->name }}</p>
						<span class="text-[10px] font-body text-accent tracking-wider uppercase font-semibold">Administrator</span>
					</div>
				</div>
			</div>
		</aside>

		<!-- Main Page Area -->
		<div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
			
			<!-- Top Header -->
			<header class="h-20 bg-card/60 backdrop-blur-md border-b border-border/60 flex items-center justify-between px-6 sm:px-8 shrink-0 sticky top-0 z-10">
				<div class="flex items-center gap-4">
					<!-- Mobile Burger Menu -->
					<button x-on:click="mobileSidebarOpen = true" class="lg:hidden p-2 hover:bg-muted/60 rounded-xl text-muted-foreground hover:text-foreground transition-all">
						<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
					</button>

					<!-- Breadcrumb -->
					<div class="hidden sm:flex items-center gap-2 text-xs font-body text-muted-foreground font-semibold uppercase tracking-wider">
						<span>Admin</span>
						<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
						<span class="text-foreground">@yield('title_breadcrumb', 'Dashboard')</span>
					</div>
				</div>

				<!-- Right Actions -->
				<div class="flex items-center gap-4">
					<!-- Sign Out Trigger -->
					<form action="{{ route('admin.logout') }}" method="POST" class="inline">
						@csrf
						<button type="submit" class="flex items-center gap-2 px-4 py-2 rounded-xl bg-muted/60 hover:bg-destructive/10 text-muted-foreground hover:text-destructive text-sm font-semibold font-body transition-all duration-200">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
							Sign Out
						</button>
					</form>
				</div>
			</header>

			<!-- Main Panel Content -->
			<main class="p-6 sm:p-8 space-y-8 max-w-7xl w-full mx-auto">
				@yield('content')
			</main>
		</div>

	</div>

    <x-shared.toast />

    @stack('scripts')
    @livewireScripts
</body>
</html>
