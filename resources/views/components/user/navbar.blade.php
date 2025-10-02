<div>
    <!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->
</div>

<!-- filepath: d:\PKL\web-blogger\resources\views\components\user\navbar.blade.php -->
<!-- Navbar -->
<nav class="bg-white shadow-sm border-b border-gray-200 fixed w-full z-30 top-0">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start">
                <!-- Mobile menu button -->
                <button 
                    id="toggleSidebarMobile" 
                    aria-expanded="true" 
                    aria-controls="sidebar" 
                    class="lg:hidden mr-2 text-gray-600 hover:text-gray-900 cursor-pointer p-2 hover:bg-gray-100 focus:bg-gray-100 focus:ring-2 focus:ring-gray-100 rounded"
                >
                    <svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <svg id="toggleSidebarMobileClose" class="w-6 h-6 hidden" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
                
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="text-xl font-bold flex items-center lg:ml-2.5">
                    <div class="h-8 w-8 bg-primary rounded-lg flex items-center justify-center mr-2">
                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                    </div>
                    <span class="self-center text-gray-900">
                        Web Blogger <span class="text-primary">Writer</span>
                    </span>
                </a>
            </div>
            
            <div class="flex items-center">
                <!-- User dropdown -->
                <div class="flex items-center ml-3">
                    <div class="relative">
                        <button 
                            type="button" 
                            class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300" 
                            id="user-menu-button" 
                            aria-expanded="false" 
                            data-dropdown-toggle="dropdown-user"
                        >
                            <span class="sr-only">Open user menu</span>
                            <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                                <span class="text-white text-sm font-medium">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </span>
                            </div>
                        </button>
                        
                        <!-- Dropdown menu -->
                        <div 
                            class="z-50 hidden absolute right-0 mt-2 w-56 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-lg border border-gray-200" 
                            id="dropdown-user"
                        >
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900" role="none">
                                    {{ auth()->user()->name }}
                                </p>
                                <p class="text-sm font-medium text-gray-900 truncate" role="none">
                                    {{ auth()->user()->email }}
                                </p>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 mt-1">
                                    Penulis
                                </span>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="{{ route('profile.update') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition duration-150" role="menuitem">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        Profil
                                    </a>
                                </li>
                                @if(auth()->user()->role === 'admin')
                                <li>
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition duration-150" role="menuitem">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                        </svg>
                                        Panel Admin
                                    </a>
                                </li>
                                @endif
                                <li>
                                    <hr class="border-gray-200">
                                </li>
                                <li>
                                    <button 
                                        type="button" 
                                        onclick="showLogoutModal()" 
                                        class="flex items-center w-full px-4 py-2 text-sm text-red-700 hover:bg-red-50 transition duration-150" 
                                        role="menuitem"
                                    >
                                        <svg class="w-4 h-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Logout
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Logout Confirmation Modal -->
<div id="logoutModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <!-- Icon -->
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.268 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
            </div>
            
            <!-- Title -->
            <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4" id="modal-title">
                Konfirmasi Logout
            </h3>
            
            <!-- Message -->
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    Apakah Anda yakin ingin keluar dari sistem? Anda harus login kembali untuk mengakses dashboard.
                </p>
            </div>
            
            <!-- Buttons -->
            <div class="flex items-center justify-center gap-4 px-4 py-3">
                <button 
                    type="button" 
                    onclick="hideLogoutModal()"
                    class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition duration-200"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Batal
                </button>
                <button 
                    type="button" 
                    onclick="confirmLogout()"
                    class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-200"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Ya, Logout
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Hidden Logout Form -->
<form id="logoutForm" method="POST" action="{{ route('logout') }}" class="hidden">
    @csrf
</form>

<script>
    function showLogoutModal() {
        const modal = document.getElementById('logoutModal');
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        modal.focus();
    }

    function hideLogoutModal() {
        const modal = document.getElementById('logoutModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function confirmLogout() {
        document.getElementById('logoutForm').submit();
    }

    // Close modal when clicking outside
    document.getElementById('logoutModal').addEventListener('click', function(event) {
        if (event.target === this) {
            hideLogoutModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const modal = document.getElementById('logoutModal');
            if (!modal.classList.contains('hidden')) {
                hideLogoutModal();
            }
        }
    });

    // Close user dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const userMenuButton = document.getElementById('user-menu-button');
        const dropdownUser = document.getElementById('dropdown-user');
        
        if (!userMenuButton.contains(event.target) && !dropdownUser.contains(event.target)) {
            dropdownUser.classList.add('hidden');
        }
    });

    // Toggle user dropdown with animation
    document.getElementById('user-menu-button').addEventListener('click', function() {
        const dropdownUser = document.getElementById('dropdown-user');
        
        if (dropdownUser.classList.contains('hidden')) {
            dropdownUser.classList.remove('hidden');
            dropdownUser.classList.add('animate-fadeIn');
            
            setTimeout(() => {
                dropdownUser.classList.remove('animate-fadeIn');
            }, 200);
        } else {
            dropdownUser.classList.add('animate-fadeOut');
            
            setTimeout(() => {
                dropdownUser.classList.add('hidden');
                dropdownUser.classList.remove('animate-fadeOut');
            }, 150);
        }
    });

    // Mobile sidebar toggle
    document.getElementById('toggleSidebarMobile').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebarBackdrop');
        const hamburger = document.getElementById('toggleSidebarMobileHamburger');
        const close = document.getElementById('toggleSidebarMobileClose');
        
        sidebar.classList.toggle('hidden');
        backdrop.classList.toggle('hidden');
        hamburger.classList.toggle('hidden');
        close.classList.toggle('hidden');
    });

    // Close mobile sidebar when clicking backdrop
    document.getElementById('sidebarBackdrop').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebarBackdrop');
        const hamburger = document.getElementById('toggleSidebarMobileHamburger');
        const close = document.getElementById('toggleSidebarMobileClose');
        
        sidebar.classList.add('hidden');
        backdrop.classList.add('hidden');
        hamburger.classList.remove('hidden');
        close.classList.add('hidden');
    });
</script>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
        to {
            opacity: 0;
            transform: translateY(-10px) scale(0.95);
        }
    }

    .animate-fadeIn {
        animation: fadeIn 0.2s ease-out forwards;
    }

    .animate-fadeOut {
        animation: fadeOut 0.15s ease-in forwards;
    }

    #dropdown-user a:hover,
    #dropdown-user button:hover {
        transform: translateX(2px);
    }
</style>