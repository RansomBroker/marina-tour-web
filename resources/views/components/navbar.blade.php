<nav id="navbar" class="group/nav fixed top-0 left-0 right-0 z-50 transition-all duration-500 py-6 px-6 lg:px-20">
    <div class="max-w-[1400px] mx-auto flex items-center justify-between">

        {{-- Logo --}}
        <a href="/" class="flex items-center gap-3 group">
            <div class="w-10 h-10 rounded-lg bg-white/20 group-[.scrolled]/nav:bg-gray-100 backdrop-blur-sm flex items-center justify-center transition-colors duration-300">
                <span class="text-white group-[.scrolled]/nav:text-gray-800 font-bold text-lg transition-colors duration-300" style="font-family: var(--font-display)">S</span>
            </div>
            <span class="text-white group-[.scrolled]/nav:text-gray-800 text-xl font-medium tracking-wide transition-colors duration-300">
                Smith Bali Travel
            </span>
        </a>

        {{-- Right Section: Nav Links + CTA --}}
        <div class="flex items-center gap-4 lg:gap-8">
            {{-- Nav Links --}}
            <div class="hidden md:flex items-center gap-2">
                <a href="/" class="text-white group-[.scrolled]/nav:text-gray-800 bg-white/20 group-[.scrolled]/nav:bg-gray-100 px-6 py-2.5 rounded-xl text-sm font-medium backdrop-blur-md transition-colors duration-300">Home</a>
                <a href="/tour-packages" class="text-white/90 group-[.scrolled]/nav:text-gray-600 hover:text-white group-[.scrolled]/nav:hover:text-orange-500 hover:bg-white/10 group-[.scrolled]/nav:hover:bg-gray-100 px-6 py-2.5 rounded-full text-sm font-medium transition-colors duration-300">Tour Packages</a>
                <a href="/blog" class="text-white/90 group-[.scrolled]/nav:text-gray-600 hover:text-white group-[.scrolled]/nav:hover:text-orange-500 hover:bg-white/10 group-[.scrolled]/nav:hover:bg-gray-100 px-6 py-2.5 rounded-full text-sm font-medium transition-colors duration-300">Blog</a>
                <a href="/contact" class="text-white/90 group-[.scrolled]/nav:text-gray-600 hover:text-white group-[.scrolled]/nav:hover:text-orange-500 hover:bg-white/10 group-[.scrolled]/nav:hover:bg-gray-100 px-6 py-2.5 rounded-full text-sm font-medium transition-colors duration-300">Contact Us</a>
            </div>

            {{-- CTA --}}
            <a href="/tour-packages"
               class="hidden md:inline-flex items-center gap-2 bg-[#f47b25] hover:bg-orange-600 text-white text-sm font-medium px-6 py-2.5 rounded-xl transition-all duration-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                Book Now
            </a>

            {{-- Mobile Menu Button --}}
            <button id="mobile-menu-btn" class="md:hidden text-white group-[.scrolled]/nav:text-gray-800 bg-white/20 group-[.scrolled]/nav:bg-gray-100 p-2 rounded-full backdrop-blur-sm transition-colors duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden md:hidden mt-4 glass group-[.scrolled]/nav:bg-white group-[.scrolled]/nav:border group-[.scrolled]/nav:border-gray-100 rounded-2xl p-5 transition-colors duration-300">
        <div class="flex flex-col gap-4">
            <a href="/" class="text-white group-[.scrolled]/nav:text-gray-800 text-sm font-medium transition-colors">Home</a>
            <a href="/tour-packages" class="text-white group-[.scrolled]/nav:text-gray-800 text-sm font-medium transition-colors">Tour Packages</a>
            <a href="/blog" class="text-white group-[.scrolled]/nav:text-gray-800 text-sm font-medium transition-colors">Blog</a>
            <a href="/contact" class="text-white group-[.scrolled]/nav:text-gray-800 text-sm font-medium transition-colors">Contact Us</a>
            <a href="/tour-packages" class="bg-orange-500 text-white text-sm font-medium px-5 py-2.5 rounded-full text-center">Book Now</a>
        </div>
    </div>
</nav>
