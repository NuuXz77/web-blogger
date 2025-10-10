<!-- filepath: d:\PKL\web-blogger\resources\views\components\user\sidebar.blade.php -->
@php
    $currentRoute = request()->route()->getName();
    $menuItems = [
        [
            'name' => 'Dasbor',
            'route' => 'dashboard',
            'icon' => 'M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z',
        ],
        [
            'name' => 'Artikel Saya',
            'route' => 'user.posts.index',
            'icon' =>
                'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z',
        ],
        [
            'name' => 'Audit Saya',
            'route' => 'user.audit.index',
            'icon' =>
                'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
        ],
    ];
@endphp

<!-- Sidebar -->
<aside id="sidebar"
    class="fixed top-0 left-0 z-20 flex-col flex-shrink-0 hidden w-64 h-full pt-16 font-normal duration-75 lg:flex transition-width"
    aria-label="Sidebar">
    <div class="relative h-full flex-1 flex flex-col min-h-0 border-r border-gray-200 bg-white pt-0">
        <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
            <div class="flex-1 px-3 space-y-1 bg-white divide-y divide-gray-200">
                <ul class="space-y-2 pb-2">
                    @foreach ($menuItems as $item)
                        @php
                            $isActive =
                                $currentRoute === $item['route'] ||
                                (str_contains($item['route'], 'posts') && str_contains($currentRoute, 'posts')) ||
                                (str_contains($item['route'], 'audit') && str_contains($currentRoute, 'audit'));
                        @endphp
                        <li>
                            <a href="{{ route($item['route']) }}"
                                class="flex items-center w-full p-2 text-base transition duration-75 rounded-lg group 
                                       {{ $isActive ? 'bg-primary text-white shadow-md' : 'text-gray-900 hover:bg-gray-100 hover:text-primary' }}">
                                <svg class="flex-shrink-0 w-6 h-6 transition duration-75 
                                           {{ $isActive ? 'text-white' : 'text-gray-500 group-hover:text-primary' }}"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="{{ $item['icon'] }}"></path>
                                </svg>
                                <span class="ml-3 {{ $isActive ? 'font-medium' : '' }}">{{ $item['name'] }}</span>

                                @if ($isActive)
                                    <div class="ml-auto">
                                        <div class="w-2 h-2 bg-white rounded-full"></div>
                                    </div>
                                @endif
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="space-y-2 pt-2">
                    <!-- Stats or additional info -->
                    <div class="p-4 bg-blue-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-800">Panel Penulis</p>
                                <p class="text-xs text-gray-600">Kelola artikel Anda</p>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="pt-2">
                        <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi Cepat</h3>
                        <div class="mt-2 space-y-1">
                            <a href="{{ route('user.posts.create') }}"
                                class="group flex items-center px-3 py-2 text-sm font-medium text-gray-600 rounded-md hover:text-primary hover:bg-gray-50">
                                <svg class="text-gray-400 mr-3 flex-shrink-0 h-5 w-5 group-hover:text-primary"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Artikel Baru
                            </a>
                            <a href="/" target="_blank"
                                class="group flex items-center px-3 py-2 text-sm font-medium text-gray-600 rounded-md hover:text-primary hover:bg-gray-50">
                                <svg class="text-gray-400 mr-3 flex-shrink-0 h-5 w-5 group-hover:text-primary"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                Lihat Website
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Footer -->
        <div class="flex-shrink-0 flex border-t border-gray-200 p-4">
            <div class="flex-shrink-0 w-full group block">
                <div class="flex items-center">
                    <div class="w-9 h-9 bg-primary rounded-lg flex items-center justify-center">
                        <span class="text-white text-sm font-medium">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </span>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-700 group-hover:text-gray-900">
                            {{ auth()->user()->name }}
                        </p>
                        <p class="text-xs font-medium text-gray-500 group-hover:text-gray-700">
                            Penulis
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>

<!-- Mobile sidebar backdrop -->
<div class="fixed h-full inset-0 z-10 hidden bg-gray-900 bg-opacity-50 lg:hidden" id="sidebarBackdrop"></div>
