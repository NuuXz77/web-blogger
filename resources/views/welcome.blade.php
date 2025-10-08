<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Web Blogger - Temukan Cerita-Cerita Luar Biasa</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon-16x16.png') }}">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Parallax Background */
        .parallax-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            overflow: hidden;
        }

        .parallax-layer {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        /* Floating Icons Animation */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        @keyframes floatReverse {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(20px) rotate(-5deg);
            }
        }

        .float-icon {
            position: absolute;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        .float-icon:nth-child(2) {
            animation: floatReverse 8s ease-in-out infinite;
            animation-delay: 1s;
        }

        .float-icon:nth-child(3) {
            animation: float 10s ease-in-out infinite;
            animation-delay: 2s;
        }

        /* Glowing Effect */
        @keyframes glow {

            0%,
            100% {
                box-shadow: 0 0 20px rgba(102, 126, 234, 0.5),
                    0 0 40px rgba(102, 126, 234, 0.3),
                    0 0 60px rgba(102, 126, 234, 0.2);
            }

            50% {
                box-shadow: 0 0 30px rgba(102, 126, 234, 0.8),
                    0 0 60px rgba(102, 126, 234, 0.5),
                    0 0 90px rgba(102, 126, 234, 0.3);
            }
        }

        .glow-effect {
            animation: glow 3s ease-in-out infinite;
        }

        /* Gradient Animation */
        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .gradient-animate {
            background-size: 200% 200%;
            animation: gradientShift 5s ease infinite;
        }

        /* Card Hover Effect */
        .card-hover {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .card-hover:hover {
            transform: translateY(-10px) scale(1.02);
        }

        /* Shimmer Effect */
        @keyframes shimmer {
            0% {
                background-position: -1000px 0;
            }

            100% {
                background-position: 1000px 0;
            }
        }

        .shimmer {
            background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.3) 50%, transparent 100%);
            background-size: 1000px 100%;
            animation: shimmer 3s infinite;
        }

        /* Reveal Animation */
        .reveal {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s ease;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Glass Morphism */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Neon Text Effect */
        @keyframes neon {

            0%,
            100% {
                text-shadow: 0 0 10px rgba(102, 126, 234, 0.8),
                    0 0 20px rgba(102, 126, 234, 0.6),
                    0 0 30px rgba(102, 126, 234, 0.4);
            }

            50% {
                text-shadow: 0 0 20px rgba(102, 126, 234, 1),
                    0 0 40px rgba(102, 126, 234, 0.8),
                    0 0 60px rgba(102, 126, 234, 0.6);
            }
        }

        .neon-text {
            animation: neon 2s ease-in-out infinite;
        }

        /* Pulse Effect */
        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.8;
                transform: scale(1.05);
            }
        }

        .pulse-effect {
            animation: pulse 2s ease-in-out infinite;
        }

        /* Particle Background */
        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: white;
            border-radius: 50%;
            opacity: 0.3;
            animation: particleFloat 15s linear infinite;
        }

        @keyframes particleFloat {
            0% {
                transform: translateY(100vh) rotate(0deg);
            }

            100% {
                transform: translateY(-100vh) rotate(360deg);
            }
        }

        /* Blob Animation */
        @keyframes blobMove {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            25% {
                transform: translate(20px, -20px) scale(1.1);
            }

            50% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            75% {
                transform: translate(20px, 20px) scale(1.05);
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

        /* Navbar Scroll Effect */
        .navbar-scrolled {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        /* Text Gradient */
        .text-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>

<body class="antialiased overflow-x-hidden">
    <!-- Parallax Background -->
    <div class="parallax-bg" id="parallaxBg">
        <div class="parallax-layer particles" id="particles"></div>

        <!-- Floating Icons -->
        <div class="float-icon" style="top: 10%; left: 10%; font-size: 4rem;">📝</div>
        <div class="float-icon" style="top: 20%; right: 15%; font-size: 3rem;">✍️</div>
        <div class="float-icon" style="bottom: 15%; left: 20%; font-size: 3.5rem;">📚</div>
        <div class="float-icon" style="top: 60%; right: 10%; font-size: 4rem;">💡</div>
        <div class="float-icon" style="bottom: 25%; right: 30%; font-size: 3rem;">🎨</div>
        <div class="float-icon" style="top: 40%; left: 5%; font-size: 3.5rem;">📖</div>

        <!-- Animated Blobs -->
        <div class="blob absolute w-96 h-96 bg-purple-500 rounded-full opacity-20 blur-3xl"
            style="top: -10%; left: -10%;"></div>
        <div class="blob absolute w-96 h-96 bg-blue-500 rounded-full opacity-20 blur-3xl"
            style="bottom: -10%; right: -10%; animation-delay: 5s;"></div>
    </div>

    <!-- Navbar with Glass Effect -->
    <nav id="navbar"
        class="bg-white/90 backdrop-blur-md shadow-lg border-b border-white/20 sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center group">
                    <div
                        class="h-10 w-10 bg-gradient-to-br from-primary to-purple-600 rounded-xl flex items-center justify-center mr-3 glow-effect transform group-hover:rotate-12 transition-transform duration-300">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                            </path>
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-gray-900">
                        Web <span class="text-gradient">Blogger</span>
                    </span>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-gray-700 hover:text-primary transition duration-300 relative group">
                        Beranda
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="#posts" class="text-gray-700 hover:text-primary transition duration-300 relative group">
                        Postingan Terbaru
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="#about" class="text-gray-700 hover:text-primary transition duration-300 relative group">
                        Tentang
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary group-hover:w-full transition-all duration-300"></span>
                    </a>
                </div>

                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="text-gray-700 hover:text-primary transition duration-300 font-medium">Dasbor</a>
                        @if (auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}"
                                class="btn-glow relative inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-primary to-purple-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest overflow-hidden">
                                Panel Admin
                            </a>
                        @elseif (auth()->user()->role === 'auditor')
                            <a href="{{ route('auditor.dashboard') }}"
                                class="btn-glow relative inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-primary to-purple-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest overflow-hidden">
                                Panel Auditor
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                            class="text-gray-700 hover:text-primary transition duration-300 font-medium">Masuk</a>
                        <a href="{{ route('register') }}"
                            class="btn-glow relative inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-primary to-purple-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest overflow-hidden">
                            Mulai Sekarang
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Parallax -->
    <section id="home" class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
            <div class="text-center reveal">
                <div class="mb-8 inline-block">
                    <span
                        class="px-4 py-2 bg-white/20 backdrop-blur-md rounded-full text-white text-sm font-medium border border-white/30 pulse-effect">
                        ✨ Platform Blog Terbaik di Indonesia
                    </span>
                </div>

                <h1 class="text-5xl md:text-7xl lg:text-8xl text-white font-bold mb-6 leading-tight">
                    Temukan
                    <span
                        class="block text-transparent bg-clip-text bg-gradient-to-r from-yellow-200 via-pink-200 to-purple-200 neon-text">
                        Cerita Luar Biasa
                    </span>
                </h1>

                <p class="text-xl md:text-2xl text-white/90 mb-12 max-w-3xl mx-auto leading-relaxed">
                    Jelajahi dunia artikel, wawasan, dan cerita menarik dari para penulis berbakat di seluruh dunia.
                    Bergabunglah dengan komunitas pembaca dan penulis kami hari ini.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="#posts"
                        class="btn-glow group relative inline-flex items-center px-8 py-4 border-2 border-white text-white font-bold rounded-xl text-lg overflow-hidden transition-all duration-300 hover:border-transparent">
                        <span class="relative z-10 flex items-center">
                            <svg class="w-6 h-6 mr-2 group-hover:rotate-12 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                </path>
                            </svg>
                            Jelajahi Cerita
                        </span>
                    </a>
                    @guest
                        <a href="{{ route('register') }}"
                            class="btn-glow group relative inline-flex items-center px-8 py-4 bg-white text-primary font-bold rounded-xl text-lg overflow-hidden transition-all duration-300">
                            <span class="relative z-10 flex items-center">
                                <svg class="w-6 h-6 mr-2 group-hover:scale-110 transition-transform duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Gabung Komunitas
                            </span>
                        </a>
                    @endguest
                </div>

                <!-- Stats Section -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-20 max-w-4xl mx-auto">
                    <div class="glass rounded-2xl p-6 card-hover reveal" style="transition-delay: 0.2s;">
                        <div class="text-4xl font-bold text-white mb-2">1000+</div>
                        <div class="text-white/80">Artikel Berkualitas</div>
                    </div>
                    <div class="glass rounded-2xl p-6 card-hover reveal" style="transition-delay: 0.4s;">
                        <div class="text-4xl font-bold text-white mb-2">500+</div>
                        <div class="text-white/80">Penulis Aktif</div>
                    </div>
                    <div class="glass rounded-2xl p-6 card-hover reveal" style="transition-delay: 0.6s;">
                        <div class="text-4xl font-bold text-white mb-2">10K+</div>
                        <div class="text-white/80">Pembaca Setia</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2">
            <a href="#posts" class="flex flex-col items-center text-white animate-bounce">
                <span class="text-sm mb-2">Scroll Kebawah</span>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </a>
        </div>
    </section>

    <!-- Posts Section with Premium Cards -->
    <section id="posts" class="py-20 bg-gradient-to-b from-gray-50 to-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 reveal">
                <span
                    class="inline-block px-4 py-2 bg-primary/10 rounded-full text-primary text-sm font-semibold mb-4">
                    📚 KONTEN TERBARU
                </span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Postingan <span class="text-gradient">Terbaru</span>
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Temukan artikel dan wawasan terbaru dari komunitas penulis kami yang berbakat
                </p>
            </div>

            @if ($posts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach ($posts as $index => $post)
                        <article
                            class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden card-hover group reveal"
                            style="transition-delay: {{ $index * 0.1 }}s;">
                            <div class="relative h-56 bg-gradient-to-br from-primary to-purple-600 overflow-hidden">
                                @if ($post->featured_image)
                                    <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div
                                        class="w-full h-full bg-gradient-to-br from-primary to-purple-600 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-white opacity-50 group-hover:scale-110 group-hover:rotate-12 transition-all duration-500"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif

                                <!-- Overlay Gradient -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>

                                <div class="absolute top-4 left-4">
                                    @if ($post->category)
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold text-white shadow-lg backdrop-blur-sm"
                                            style="background-color: {{ $post->category->color }}88;">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                                </path>
                                            </svg>
                                            {{ $post->category->name }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="p-6">
                                <h3
                                    class="text-xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors duration-300 line-clamp-2">
                                    <a href="{{ route('posts.show', $post->slug) }}">
                                        {{ $post->title }}
                                    </a>
                                </h3>

                                <p class="text-gray-600 mb-4 line-clamp-3 text-sm leading-relaxed">
                                    {{ $post->excerpt ?: Str::limit(strip_tags($post->content), 120) }}
                                </p>

                                <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-100">
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="w-10 h-10 bg-gradient-to-br from-primary to-purple-600 rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                            <span class="text-sm font-bold text-white">
                                                {{ substr($post->user->name, 0, 1) }}
                                            </span>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900">{{ $post->user->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $post->created_at->format('M d, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div
                                        class="flex items-center text-xs text-gray-500 bg-gray-50 px-3 py-1.5 rounded-full">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $post->created_at->diffForHumans() }}
                                    </div>
                                </div>

                                <a href="{{ route('posts.show', $post->slug) }}"
                                    class="inline-flex items-center text-primary hover:text-purple-600 font-semibold text-sm group-hover:translate-x-2 transition-all duration-300">
                                    Baca Selengkapnya
                                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-300"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                @if ($posts->hasPages())
                    <div class="text-center reveal">
                        {{ $posts->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-20 reveal">
                    <div class="inline-block p-8 bg-gradient-to-br from-primary/10 to-purple-600/10 rounded-3xl mb-6">
                        <svg class="mx-auto h-20 w-20 text-primary" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Belum ada postingan</h3>
                    <p class="text-gray-500 mb-8 text-lg">Jadilah yang pertama berbagi cerita Anda dengan komunitas
                        kami.</p>
                    @auth
                        @if (auth()->user()->role === 'admin')
                            <a href="{{ route('admin.posts.create') }}"
                                class="btn-glow inline-flex items-center px-8 py-3 border border-transparent shadow-lg text-base font-semibold rounded-xl text-white bg-gradient-to-r from-primary to-purple-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Buat Postingan Pertama
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </section>

    <!-- About Section with Features -->
    <section id="about" class="py-20 bg-white relative overflow-hidden">
        <!-- Decorative Elements -->
        <div
            class="absolute top-0 left-0 w-72 h-72 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob">
        </div>
        <div
            class="absolute top-0 right-0 w-72 h-72 bg-yellow-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000">
        </div>
        <div
            class="absolute bottom-0 left-1/2 w-72 h-72 bg-pink-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="reveal">
                    <span
                        class="inline-block px-4 py-2 bg-primary/10 rounded-full text-primary text-sm font-semibold mb-6">
                        ✨ TENTANG KAMI
                    </span>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                        Bagikan <span class="text-gradient">Cerita Anda</span>
                    </h2>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        Bergabunglah dengan komunitas penulis dan pembaca kami yang dinamis. Bagikan pemikiran,
                        pengalaman, dan wawasan Anda dengan orang-orang dari seluruh dunia.
                    </p>

                    <div class="space-y-6">
                        <div class="flex items-start space-x-4 group">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-primary to-purple-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Platform Menulis Modern</h3>
                                <p class="text-gray-600">Editor yang mudah digunakan dengan fitur lengkap untuk membuat
                                    konten berkualitas</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 group">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Komunitas Aktif</h3>
                                <p class="text-gray-600">Terhubung dengan ribuan pembaca dan penulis yang memiliki
                                    minat yang sama</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 group">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Jangkauan Luas</h3>
                                <p class="text-gray-600">Bagikan karya Anda ke ribuan pembaca dan bangun personal
                                    branding Anda</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10">
                        @guest
                            <a href="{{ route('register') }}"
                                class="btn-glow inline-flex items-center px-8 py-4 bg-gradient-to-r from-primary to-purple-600 text-white font-bold rounded-xl text-lg shadow-xl">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                                Mulai Menulis Sekarang
                            </a>
                        @endguest
                    </div>
                </div>

                <div class="relative reveal" style="transition-delay: 0.3s;">
                    <div class="relative">
                        <!-- Main Card -->
                        <div
                            class="glass rounded-3xl p-8 shadow-2xl backdrop-blur-xl border border-white/20 transform hover:scale-105 transition-all duration-500">
                            <div class="space-y-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <div
                                            class="w-16 h-16 bg-gradient-to-br from-primary to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-xl font-bold text-gray-900">Editor Premium</h4>
                                            <p class="text-gray-600 text-sm">Alat penulisan profesional</p>
                                        </div>
                                    </div>
                                    <div
                                        class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center pulse-effect">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                </div>

                                <div class="h-1 bg-gradient-to-r from-primary to-purple-600 rounded-full"></div>

                                <div class="space-y-4">
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl">
                                        <span class="text-gray-700 font-medium">📊 Statistik Real-time</span>
                                        <span
                                            class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm font-semibold">Aktif</span>
                                    </div>
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl">
                                        <span class="text-gray-700 font-medium">🎨 Kustomisasi Penuh</span>
                                        <span
                                            class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-sm font-semibold">Tersedia</span>
                                    </div>
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl">
                                        <span class="text-gray-700 font-medium">🚀 SEO Optimized</span>
                                        <span
                                            class="px-3 py-1 bg-purple-100 text-purple-600 rounded-full text-sm font-semibold">Premium</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Floating Elements -->
                        <div
                            class="absolute -top-6 -right-6 w-24 h-24 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-3xl shadow-2xl transform rotate-12 hover:rotate-45 transition-transform duration-500 flex items-center justify-center">
                            <span class="text-4xl">✨</span>
                        </div>
                        <div
                            class="absolute -bottom-6 -left-6 w-24 h-24 bg-gradient-to-br from-pink-400 to-purple-500 rounded-3xl shadow-2xl transform -rotate-12 hover:-rotate-45 transition-transform duration-500 flex items-center justify-center">
                            <span class="text-4xl">🎯</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Feature Grid -->
            <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="reveal card-hover bg-gradient-to-br from-blue-50 to-indigo-50 rounded-3xl p-8 border border-blue-100"
                    style="transition-delay: 0.1s;">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Perpustakaan Lengkap</h3>
                    <p class="text-gray-600 leading-relaxed">Akses ribuan artikel dari berbagai kategori dan topik
                        menarik</p>
                </div>

                <div class="reveal card-hover bg-gradient-to-br from-green-50 to-emerald-50 rounded-3xl p-8 border border-green-100"
                    style="transition-delay: 0.2s;">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Ide Kreatif</h3>
                    <p class="text-gray-600 leading-relaxed">Dapatkan inspirasi dari penulis berbakat di seluruh
                        Indonesia</p>
                </div>

                <div class="reveal card-hover bg-gradient-to-br from-purple-50 to-pink-50 rounded-3xl p-8 border border-purple-100"
                    style="transition-delay: 0.3s;">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Update Cepat</h3>
                    <p class="text-gray-600 leading-relaxed">Konten baru setiap hari dari komunitas penulis aktif kami
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-br from-primary via-purple-600 to-pink-600 relative overflow-hidden">
        <div class="absolute inset-0">
            <div
                class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full mix-blend-overlay filter blur-3xl opacity-20 animate-blob">
            </div>
            <div
                class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full mix-blend-overlay filter blur-3xl opacity-20 animate-blob animation-delay-2000">
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 reveal">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Siap Memulai Perjalanan Menulis Anda?
            </h2>
            <p class="text-xl text-white/90 mb-10 leading-relaxed">
                Bergabunglah dengan ribuan penulis dan pembaca di platform blog terbaik Indonesia
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @guest
                    <a href="{{ route('register') }}"
                        class="btn-glow inline-flex items-center justify-center px-10 py-4 bg-white text-primary font-bold rounded-xl text-lg shadow-2xl hover:shadow-3xl">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                        Daftar Gratis Sekarang
                    </a>
                @else
                    <a href="{{ route('dashboard') }}"
                        class="btn-glow inline-flex items-center justify-center px-10 py-4 bg-white text-primary font-bold rounded-xl text-lg shadow-2xl hover:shadow-3xl">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        Mulai Menulis
                    </a>
                @endguest
                <a href="#posts"
                    class="inline-flex items-center justify-center px-10 py-4 border-2 border-white text-white font-bold rounded-xl text-lg hover:bg-white hover:text-primary transition-all duration-300">
                    Lihat Artikel
                </a>
            </div>
        </div>
    </section>

    <!-- Footer Premium -->
    <footer class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-primary rounded-full filter blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-purple-600 rounded-full filter blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center mb-6">
                        <div
                            class="h-12 w-12 bg-gradient-to-br from-primary to-purple-600 rounded-xl flex items-center justify-center mr-3 shadow-lg glow-effect">
                            <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                </path>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold">
                            Web <span class="text-gradient">Blogger</span>
                        </span>
                    </div>
                    <p class="text-gray-300 mb-6 max-w-md leading-relaxed">
                        Platform blog modern untuk berbagi cerita, pengetahuan, dan inspirasi dengan komunitas pembaca
                        dan penulis di seluruh Indonesia.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center hover:bg-white/20 transition-all duration-300 hover:scale-110">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center hover:bg-white/20 transition-all duration-300 hover:scale-110">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.894 8.221l-1.97 9.28c-.145.658-.537.818-1.084.508l-3-2.21-1.446 1.394c-.14.18-.357.295-.6.295-.002 0-.003 0-.005 0l.213-3.054 5.56-5.022c.24-.213-.054-.334-.373-.121l-6.869 4.326-2.96-.924c-.64-.203-.658-.64.135-.954l11.566-4.458c.538-.196 1.006.128.832.941z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center hover:bg-white/20 transition-all duration-300 hover:scale-110">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-6 flex items-center">
                        <span class="w-2 h-2 bg-primary rounded-full mr-2"></span>
                        Tautan Cepat
                    </h3>
                    <ul class="space-y-3">
                        <li><a href="#home"
                                class="text-gray-300 hover:text-white transition duration-300 flex items-center group">
                                <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                                Beranda
                            </a></li>
                        <li><a href="#posts"
                                class="text-gray-300 hover:text-white transition duration-300 flex items-center group">
                                <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                                Postingan Terbaru
                            </a></li>
                        <li><a href="#about"
                                class="text-gray-300 hover:text-white transition duration-300 flex items-center group">
                                <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                                Tentang Kami
                            </a></li>
                        @auth
                            <li><a href="{{ route('dashboard') }}"
                                    class="text-gray-300 hover:text-white transition duration-300 flex items-center group">
                                    <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    Dasbor Saya
                                </a></li>
                        @else
                            <li><a href="{{ route('login') }}"
                                    class="text-gray-300 hover:text-white transition duration-300 flex items-center group">
                                    <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    Masuk
                                </a></li>
                            <li><a href="{{ route('register') }}"
                                    class="text-gray-300 hover:text-white transition duration-300 flex items-center group">
                                    <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    Daftar
                                </a></li>
                        @endauth
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-6 flex items-center">
                        <span class="w-2 h-2 bg-purple-500 rounded-full mr-2"></span>
                        Kontak
                    </h3>
                    <ul class="space-y-4">
                        <li class="flex items-start space-x-3">
                            <div
                                class="w-8 h-8 bg-primary/20 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <span class="text-gray-300 text-sm">
                                Jakarta, Indonesia
                            </span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <div
                                class="w-8 h-8 bg-primary/20 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <span class="text-gray-300 text-sm">
                                hello@weblogger.com
                            </span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <div
                                class="w-8 h-8 bg-primary/20 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                            </div>
                            <span class="text-gray-300 text-sm">
                                +62 812 3456 7890
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="pt-8 mt-8 border-t border-gray-700/50">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <div class="text-gray-400 text-sm">
                        © 2024 Web Blogger. All rights reserved.
                    </div>
                    <div class="flex space-x-6 text-sm">
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            Privacy Policy
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            Terms of Service
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            Cookie Policy
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="backToTop"
        class="fixed bottom-8 right-8 w-14 h-14 bg-gradient-to-br from-primary to-purple-600 text-white rounded-2xl shadow-2xl flex items-center justify-center transition-all duration-300 opacity-0 invisible hover:scale-110 hover:shadow-3xl">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18">
            </path>
        </svg>
    </button>

    <script>
        // Scroll Reveal Animation
        function revealOnScroll() {
            const reveals = document.querySelectorAll('.reveal');
            reveals.forEach(element => {
                const windowHeight = window.innerHeight;
                const elementTop = element.getBoundingClientRect().top;
                const elementVisible = 150;

                if (elementTop < windowHeight - elementVisible) {
                    element.classList.add('active');
                }
            });
        }

        // Navbar Scroll Effect
        function handleNavbarScroll() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 100) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        }

        // Back to Top Button
        function handleBackToTop() {
            const backToTop = document.getElementById('backToTop');
            if (window.scrollY > 300) {
                backToTop.style.opacity = '1';
                backToTop.style.visibility = 'visible';
            } else {
                backToTop.style.opacity = '0';
                backToTop.style.visibility = 'hidden';
            }
        }

        // Smooth Scroll for Anchor Links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Back to Top Functionality
        document.getElementById('backToTop').addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Create Floating Particles
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 50;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 15 + 's';
                particle.style.width = Math.random() * 3 + 2 + 'px';
                particle.style.height = particle.style.width;
                particlesContainer.appendChild(particle);
            }
        }

        // Initialize all functions
        document.addEventListener('DOMContentLoaded', function() {
            createParticles();
            revealOnScroll();
            handleNavbarScroll();
            handleBackToTop();

            // Event Listeners
            window.addEventListener('scroll', () => {
                revealOnScroll();
                handleNavbarScroll();
                handleBackToTop();
            });

            // Parallax Effect
            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const parallaxBg = document.getElementById('parallaxBg');
                parallaxBg.style.transform = `translateY(${scrolled * 0.5}px)`;
            });

            // Add loading animation
            document.body.style.opacity = '0';
            document.body.style.transition = 'opacity 0.5s ease';
            setTimeout(() => {
                document.body.style.opacity = '1';
            }, 100);
        });

        // Add animation delay classes for blob animations
        document.head.insertAdjacentHTML('beforeend', `
            <style>
                .animate-blob {
                    animation: blob 7s infinite;
                }
                .animation-delay-2000 {
                    animation-delay: 2s;
                }
                .animation-delay-4000 {
                    animation-delay: 4s;
                }
                @keyframes blob {
                    0% {
                        transform: translate(0px, 0px) scale(1);
                    }
                    33% {
                        transform: translate(30px, -50px) scale(1.1);
                    }
                    66% {
                        transform: translate(-20px, 20px) scale(0.9);
                    }
                    100% {
                        transform: translate(0px, 0px) scale(1);
                    }
                }
            </style>
        `);
    </script>
</body>

</html>
