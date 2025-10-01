@php
$currentRoute = request()->route()->getName();
$menuItems = [
    [
        'name' => 'Dasbor',
        'route' => 'admin.dashboard',
        'icon' => 'M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z'
    ],
    [
        'name' => 'Artikel',
        'route' => 'admin.posts.index',
        'icon' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z'
    ],
    [
        'name' => 'Kategori',
        'route' => 'admin.categories.index',
        'icon' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z'
    ],
    [
        'name' => 'Komentar',
        'route' => 'admin.comments.index',
        'icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z'
    ]
];
@endphp

<!-- Sidebar -->
<aside 
    id="sidebar" 
    class="fixed top-0 left-0 z-20 flex-col flex-shrink-0 hidden w-64 h-full pt-16 font-normal duration-75 lg:flex transition-width" 
    aria-label="Sidebar"
>
    <div class="relative flex-1 flex flex-col min-h-0 border-r border-gray-200 bg-white pt-0">
        <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
            <div class="flex-1 px-3 space-y-1 bg-white divide-y divide-gray-200">
                <ul class="space-y-2 pb-2">
                    @foreach($menuItems as $item)
                        @php
                            $isActive = $currentRoute === $item['route'] || 
                                      (str_contains($item['route'], 'posts') && str_contains($currentRoute, 'posts')) ||
                                      (str_contains($item['route'], 'categories') && str_contains($currentRoute, 'categories')) ||
                                      (str_contains($item['route'], 'comments') && str_contains($currentRoute, 'comments'));
                        @endphp
                        <li>
                            <a 
                                href="{{ route($item['route']) }}" 
                                class="flex items-center w-full p-2 text-base transition duration-75 rounded-lg group 
                                       {{ $isActive 
                                           ? 'bg-primary text-white shadow-md' 
                                           : 'text-gray-900 hover:bg-gray-100 hover:text-primary' 
                                       }}"
                            >
                                <svg 
                                    class="flex-shrink-0 w-6 h-6 transition duration-75 
                                           {{ $isActive ? 'text-white' : 'text-gray-500 group-hover:text-primary' }}" 
                                    fill="none" 
                                    stroke="currentColor" 
                                    viewBox="0 0 24 24" 
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path 
                                        stroke-linecap="round" 
                                        stroke-linejoin="round" 
                                        stroke-width="2" 
                                        d="{{ $item['icon'] }}"
                                    ></path>
                                </svg>
                                <span class="ml-3 {{ $isActive ? 'font-medium' : '' }}">{{ $item['name'] }}</span>
                                
                                @if($isActive)
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
                                <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-800">Panel Admin</p>
                                <p class="text-xs text-gray-600">Kelola blog Anda</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="pt-2">
                        <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi Cepat</h3>
                        <div class="mt-2 space-y-1">
                            <a href="{{ route('admin.posts.create') }}" class="group flex items-center px-3 py-2 text-sm font-medium text-gray-600 rounded-md hover:text-primary hover:bg-gray-50">
                                <svg class="text-gray-400 mr-3 flex-shrink-0 h-5 w-5 group-hover:text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Artikel Baru
                            </a>
                            <a href="{{ route('dashboard') }}" class="group flex items-center px-3 py-2 text-sm font-medium text-gray-600 rounded-md hover:text-primary hover:bg-gray-50">
                                <svg class="text-gray-400 mr-3 flex-shrink-0 h-5 w-5 group-hover:text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
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
                            {{ ucfirst(auth()->user()->role) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>

<!-- Mobile sidebar backdrop -->
<div class="fixed inset-0 z-10 hidden bg-gray-900 bg-opacity-50 lg:hidden" id="sidebarBackdrop"></div>