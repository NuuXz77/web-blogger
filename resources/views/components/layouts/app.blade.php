@props(['title' => 'Web Blogger'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon-16x16.png')}}">
    <link rel="icon" type="image/png" href="{{asset('images/favicon-16x16.png')}}">
    <link rel="manifest" href="/site.webmanifest">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <!-- Loading Progress Bar Styles -->
    <style>
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            z-index: 9999;
            display: none;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .loading-overlay.show {
            display: flex;
        }

        .progress-bar {
            width: 300px;
            height: 4px;
            background: #e5e7eb;
            border-radius: 2px;
            overflow: hidden;
            margin-top: 20px;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #3b82f6, #1d4ed8);
            border-radius: 2px;
            width: 0%;
            animation: progress 2s ease-in-out forwards;
        }

        @keyframes progress {
            0% {
                width: 0%;
            }

            50% {
                width: 70%;
            }

            100% {
                width: 100%;
            }
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid #e5e7eb;
            border-top: 3px solid #3b82f6;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .loading-text {
            margin-top: 15px;
            color: #6b7280;
            font-size: 14px;
            animation: pulse 1.5s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .blob {
            animation: blobMove 20s ease-in-out infinite;
        }

        /* Button Glow Hover */
        .btn-glow {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .btn-glow::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-glow:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-glow:hover {
            box-shadow: 0 0 20px rgba(102, 126, 234, 0.6),
                0 0 40px rgba(102, 126, 234, 0.4),
                0 0 60px rgba(102, 126, 234, 0.2);
            transform: translateY(-2px);
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50">
    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="loading-overlay">
        <div class="loading-spinner"></div>
        <div class="progress-bar">
            <div class="progress-fill"></div>
        </div>
        <div class="loading-text">Memuat halaman...</div>
    </div>

    @if (auth()->check() && auth()->user()->role === 'admin')
        <!-- Admin Layout -->
        <div class="min-h-screen">
            <!-- Admin Sidebar -->
            <x-admin.sidebar />
            <!-- Admin Navbar -->
            <x-admin.navbar />

            <!-- Main Content Area -->
            <div class="lg:ml-64">
                <main class="p-4 pt-20">
                    <!-- Page Header -->
                    @if (isset($header))
                        <div>
                            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                                {{ $header }}
                            </div>
                        </div>
                    @endif

                    <!-- Page Content -->
                    <div class="min-h-screen">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    @elseif(auth()->check() && auth()->user()->role === 'auditor')
        <!-- Auditor Layout -->
        <div class="min-h-screen">
            <!-- Auditor Sidebar -->
            <x-auditor.sidebar />
            <!-- Auditor Navbar -->
            <x-auditor.navbar />

            <!-- Main Content Area -->
            <div class="lg:ml-64">
                <main class="p-4 pt-20">
                    <!-- Page Header -->
                    @if (isset($header))
                        <div>
                            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                                {{ $header }}
                            </div>
                        </div>
                    @endif

                    <!-- Page Content -->
                    <div class="min-h-screen">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    @else
        <!-- Regular User Layout with Sidebar -->
        <div class="min-h-screen">
            <!-- User Sidebar -->
            <x-user.sidebar />
            <!-- User Navbar -->
            <x-user.navbar />

            <!-- Main Content Area -->
            <div class="lg:ml-64">
                <main class="p-4 pt-20">
                    <!-- Page Header -->
                    @if (isset($header))
                        <div class="mb-6">
                            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                                {{ $header }}
                            </div>
                        </div>
                    @endif

                    <!-- Page Content -->
                    <div class="min-h-screen">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    @endif

    <!-- Loading Progress JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loadingOverlay = document.getElementById('loadingOverlay');
            let isNavigating = false;

            // Function to show loading
            function showLoading() {
                if (!isNavigating) {
                    isNavigating = true;
                    loadingOverlay.classList.add('show');
                }
            }

            // Function to hide loading
            function hideLoading() {
                setTimeout(() => {
                    loadingOverlay.classList.remove('show');
                    isNavigating = false;
                }, 2000); // 2 second delay
            }

            // Handle navigation links clicks
            document.addEventListener('click', function(e) {
                const target = e.target.closest('a');

                if (target && target.href) {
                    const currentPath = window.location.pathname;
                    const targetPath = new URL(target.href).pathname;

                    // Check if it's a dashboard route navigation
                    const isDashboardRoute = targetPath.includes('/dashboard') || targetPath.includes(
                        '/posts') || targetPath.includes('/admin');
                    const isDifferentRoute = currentPath !== targetPath;
                    const isNotExternal = target.href.startsWith(window.location.origin);
                    const isNotDownload = !target.hasAttribute('download');
                    const isNotBlank = target.getAttribute('target') !== '_blank';

                    if (isDashboardRoute && isDifferentRoute && isNotExternal && isNotDownload &&
                        isNotBlank) {
                        showLoading();

                        setTimeout(() => {
                            hideLoading();
                        }, 100);
                    }
                }
            });

            // Handle form submissions that navigate
            document.addEventListener('submit', function(e) {
                const form = e.target;
                const action = form.getAttribute('action');
                const method = form.getAttribute('method') || 'GET';

                if (action && method.toLowerCase() === 'get') {
                    showLoading();
                    setTimeout(() => {
                        hideLoading();
                    }, 100);
                }
            });

            // Handle browser back/forward buttons
            window.addEventListener('popstate', function() {
                showLoading();
                hideLoading();
            });

            // Handle page load
            window.addEventListener('beforeunload', function() {
                showLoading();
            });

            // Ensure loading is hidden when page fully loads
            window.addEventListener('load', function() {
                setTimeout(() => {
                    loadingOverlay.classList.remove('show');
                    isNavigating = false;
                }, 500);
            });
        });
    </script>
</body>

</html>
