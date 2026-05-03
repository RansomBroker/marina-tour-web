import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    // 1. Element Selections
    const navbar = document.getElementById('navbar');
    const scrollToTopBtn = document.getElementById('scrollToTopBtn');
    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');

    // 2. Scroll Event Listener
    window.addEventListener('scroll', () => {
        // Navbar scroll effect
        if (navbar) {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled', 'bg-white/95', 'shadow-md', 'backdrop-blur-md');
                navbar.classList.remove('py-6');
                navbar.classList.add('py-4');
            } else {
                navbar.classList.remove('scrolled', 'bg-white/95', 'shadow-md', 'backdrop-blur-md');
                navbar.classList.add('py-6');
                navbar.classList.remove('py-4');
            }
        }

        // Scroll to top button visibility
        if (scrollToTopBtn) {
            if (window.scrollY > 300) {
                scrollToTopBtn.classList.remove('opacity-0', 'translate-y-10', 'pointer-events-none');
            } else {
                scrollToTopBtn.classList.add('opacity-0', 'translate-y-10', 'pointer-events-none');
            }
        }
    });

    // 3. Scroll to Top Action with Animation
    if (scrollToTopBtn) {
        scrollToTopBtn.addEventListener('click', () => {
            const startPosition = window.scrollY;
            const duration = 1000; // Durasi animasi dalam milidetik (1000ms = 1 detik)
            let startTime = null;

            function animation(currentTime) {
                if (startTime === null) startTime = currentTime;
                const timeElapsed = currentTime - startTime;
                
                // Easing function (Ease In Out Cubic) agar pergerakan natural
                const progress = timeElapsed / duration;
                const ease = progress < 0.5 
                    ? 4 * progress * progress * progress 
                    : 1 - Math.pow(-2 * progress + 2, 3) / 2;

                window.scrollTo(0, startPosition * (1 - ease));

                if (timeElapsed < duration) {
                    requestAnimationFrame(animation);
                } else {
                    window.scrollTo(0, 0); // Pastikan berhenti persis di atas
                }
            }

            requestAnimationFrame(animation);
        });
    }
    
    // 4. Mobile Menu Toggler
    if (btn && menu) {
        btn.addEventListener('click', () => menu.classList.toggle('hidden'));
    }
});
