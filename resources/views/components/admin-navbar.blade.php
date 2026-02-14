<nav class="bg-white shadow-sm border-b border-secondary-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-gradient-to-r from-primary-500 to-primary-600 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h1 class="text-xl font-bold text-gray-900">
                        Admin Panel
                    </h1>
                </div>
            </div>
            
            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-4">
                <a href="/admin/dashboard" class="{{ request()->is('admin/dashboard') ? 'text-blue-600 bg-blue-50' : 'text-secondary-600 hover:text-secondary-700' }} px-3 py-2 rounded-lg text-sm font-medium hover:bg-secondary-50 transition-colors duration-200">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Dashboard
                </a>
                <a href="/admin/settings" class="{{ request()->is('admin/settings') ? 'text-blue-600 bg-blue-50' : 'text-secondary-600 hover:text-secondary-700' }} px-3 py-2 rounded-lg text-sm font-medium hover:bg-secondary-50 transition-colors duration-200">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Pengaturan
                </a>
                @auth('admin')
                    <div class="flex items-center space-x-3 pl-3 border-l border-secondary-200">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center">
                                <span class="text-xs font-semibold text-primary-600">
                                    {{ strtoupper(substr(Auth::guard('admin')->user()->name, 0, 1)) }}
                                </span>
                            </div>
                            <span class="text-sm font-medium text-gray-700 hidden lg-block">{{ Auth::guard('admin')->user()->name }}</span>
                        </div>
                        <form method="POST" action="/admin/logout" class="inline" id="logoutForm">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-700 px-3 py-2 rounded-lg text-sm font-medium hover:bg-red-50 transition-colors duration-200">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                <span class="hidden lg:inline">Logout</span>
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
            
            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button id="mobileMenuButton" class="text-gray-600 hover:text-gray-900 p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Mobile Navigation -->
        <div id="mobileMenu" class="hidden md:hidden pb-4 transition-all duration-300 ease-in-out transform origin-top">
            <div class="space-y-2">
                <a href="/admin/dashboard" class="{{ request()->is('admin/dashboard') ? 'text-blue-600 bg-blue-50' : 'text-secondary-600 hover:text-secondary-700' }} block px-3 py-2 rounded-lg text-sm font-medium hover:bg-secondary-50 transition-all duration-200 transform">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Dashboard
                </a>
                <a href="/admin/settings" class="{{ request()->is('admin/settings') ? 'text-blue-600 bg-blue-50' : 'text-secondary-600 hover:text-secondary-700' }} block px-3 py-2 rounded-lg text-sm font-medium hover:bg-secondary-50 transition-all duration-200 transform">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Pengaturan
                </a>
                @auth('admin')
                    <div class="border-t border-secondary-200 pt-2 mt-2">
                        <div class="flex items-center space-x-3 px-3 py-2">
                            <div class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center">
                                <span class="text-xs font-semibold text-primary-600">
                                    {{ strtoupper(substr(Auth::guard('admin')->user()->name, 0, 1)) }}
                                </span>
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-gray-700">{{ Auth::guard('admin')->user()->name }}</div>
                            </div>
                        </div>
                        <form method="POST" action="/admin/logout" class="inline" id="mobileLogoutForm">
                            @csrf
                            <button type="submit" class="w-full text-left text-red-600 hover:text-red-700 px-3 py-2 rounded-lg text-sm font-medium hover:bg-red-50 transition-all duration-200 transform">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
// Mobile menu toggle with smooth animations
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const mobileMenu = document.getElementById('mobileMenu');
    let isMenuOpen = false;
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            isMenuOpen = !isMenuOpen;
            
            if (isMenuOpen) {
                // Show menu with animation
                mobileMenu.classList.remove('hidden');
                mobileMenu.classList.add('scale-95', 'opacity-0');
                
                // Trigger reflow
                void mobileMenu.offsetWidth;
                
                // Animate in
                setTimeout(() => {
                    mobileMenu.classList.remove('scale-95', 'opacity-0');
                    mobileMenu.classList.add('scale-100', 'opacity-100');
                }, 10);
                
                // Animate hamburger to X
                mobileMenuButton.querySelector('svg').innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                `;
            } else {
                // Animate out
                mobileMenu.classList.remove('scale-100', 'opacity-100');
                mobileMenu.classList.add('scale-95', 'opacity-0');
                
                // Hide after animation
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                    mobileMenu.classList.remove('scale-95', 'opacity-0');
                }, 300);
                
                // Animate X back to hamburger
                mobileMenuButton.querySelector('svg').innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                `;
            }
        });
        
        // Add menu item hover animations
        const menuItems = mobileMenu.querySelectorAll('a, button');
        menuItems.forEach((item, index) => {
            item.style.animationDelay = `${index * 50}ms`;
            item.classList.add('menu-item-animate');
        });
    }
});

// Add CSS animations for menu items
const style = document.createElement('style');
style.textContent = `
    .menu-item-animate {
        animation: slideInLeft 0.3s ease-out forwards;
        opacity: 0;
        transform: translateX(-20px);
    }
    
    @keyframes slideInLeft {
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
`;
document.head.appendChild(style);
</script>
