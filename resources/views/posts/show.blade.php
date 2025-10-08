<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $post->meta_title ?: $post->title }} - Web Blogger</title>
    <meta name="description"
        content="{{ $post->meta_description ?: $post->excerpt ?: Str::limit(strip_tags($post->content), 160) }}">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon-16x16.png')}}">
    <link rel="icon" type="image/png" href="{{asset('images/favicon-16x16.png')}}">
    <link rel="manifest" href="/site.webmanifest">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Vite CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Custom Styles for Post Detail */
        .article-content {
            font-size: 1.125rem;
            line-height: 1.8;
            color: #374151;
        }

        .article-content h2 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #111827;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .article-content h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #111827;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
        }

        .article-content p {
            margin-bottom: 1.5rem;
        }

        .article-content blockquote {
            border-left: 4px solid #3b82f6;
            padding-left: 1.5rem;
            margin: 2rem 0;
            font-style: italic;
            color: #6b7280;
        }

        .article-content img {
            border-radius: 0.75rem;
            margin: 2rem 0;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .article-content ul, .article-content ol {
            margin: 1.5rem 0;
            padding-left: 1.5rem;
        }

        .article-content li {
            margin-bottom: 0.5rem;
        }

        /* Reading Progress Bar */
        .reading-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            transform-origin: left;
            transform: scaleX(0);
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        /* Floating Action Buttons */
        .floating-actions {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 50;
        }

        .floating-btn {
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        .floating-btn:hover {
            transform: translateY(-2px) scale(1.1);
        }

        /* Smooth Scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Gradient Text */
        .text-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Card Hover Effects */
        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.1);
        }

        /* Glass Morphism */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Animation Classes */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .fade-in.active {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body class="antialiased bg-gray-50">
    <!-- Reading Progress Bar -->
    <div class="reading-progress" id="readingProgress"></div>

    <!-- Navigation -->
    <nav class="bg-white/90 backdrop-blur-md shadow-lg border-b border-white/20 sticky top-0 z-50 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center group">
                    <a href="{{ route('welcome') }}" class="flex items-center">
                        <div class="h-10 w-10 bg-gradient-to-br from-primary to-purple-600 rounded-xl flex items-center justify-center mr-3 shadow-lg glow-effect transform group-hover:rotate-12 transition-transform duration-300">
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
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('welcome') }}" class="text-gray-700 hover:text-primary transition duration-300 relative group">
                        Beranda
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="{{ route('welcome') }}#posts" class="text-gray-700 hover:text-primary transition duration-300 relative group">
                        Artikel Terbaru
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="{{ route('welcome') }}#about" class="text-gray-700 hover:text-primary transition duration-300 relative group">
                        Tentang
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary group-hover:w-full transition-all duration-300"></span>
                    </a>
                </div>

                <!-- Auth Links -->
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-primary transition duration-300 font-medium">Dasbor</a>
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
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary transition duration-300 font-medium">Masuk</a>
                        <a href="{{ route('register') }}"
                            class="btn-glow relative inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-primary to-purple-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest overflow-hidden">
                            Mulai Sekarang
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Breadcrumb -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <nav class="flex items-center space-x-3 text-sm">
                <a href="{{ route('welcome') }}" class="text-gray-500 hover:text-primary transition duration-300 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Beranda
                </a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-gray-900 font-medium truncate">{{ Str::limit($post->title, 50) }}</span>
            </nav>
        </div>
    </div>

    <!-- Article -->
    <article class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Article Header -->
            <header class="mb-12 fade-in">
                <div class="text-center mb-8">
                    <!-- Category Badge -->
                    <div class="mb-6">
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-gradient-to-r from-primary to-purple-600 text-white shadow-lg">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                </path>
                            </svg>
                            {{ ucfirst($post->category->name) }}
                        </span>
                    </div>

                    <!-- Title -->
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        {{ $post->title }}
                    </h1>

                    <!-- Excerpt -->
                    @if ($post->excerpt)
                        <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto leading-relaxed">
                            {{ $post->excerpt }}
                        </p>
                    @endif

                    <!-- Author Info -->
                    <div class="flex items-center justify-center space-x-6 mb-8">
                        <div class="flex items-center space-x-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-primary to-purple-600 rounded-full flex items-center justify-center shadow-lg">
                                <span class="text-lg font-bold text-white">
                                    {{ substr($post->user->name, 0, 1) }}
                                </span>
                            </div>
                            <div class="text-left">
                                <p class="font-bold text-gray-900 text-lg">{{ $post->user->name }}</p>
                                <div class="flex items-center text-sm text-gray-500 space-x-4 mt-1">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $post->created_at->format('d M Y') }}
                                    </span>
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $post->created_at->diffForHumans() }}
                                    </span>
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        {{ rand(500, 2000) }} tayangan
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Featured Image -->
                @if ($post->featured_image)
                    <div class="mb-8 rounded-2xl overflow-hidden shadow-2xl">
                        <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}"
                            class="w-full h-64 md:h-96 object-cover transform hover:scale-105 transition duration-700">
                    </div>
                @endif
            </header>

            <!-- Article Content -->
            <div class="article-content fade-in" style="transition-delay: 0.2s;">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 md:p-12">
                    {!! nl2br(e($post->content)) !!}
                </div>
            </div>

            <!-- Article Footer -->
            <footer class="mt-12 pt-8 border-t border-gray-200 fade-in" style="transition-delay: 0.4s;">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between space-y-6 md:space-y-0">
                    <div class="w-full md:w-auto">
                        <p class="text-sm font-semibold text-gray-700 mb-4">Bagikan artikel ini:</p>
                        <div class="flex flex-wrap gap-3">
                            <!-- Facebook Share -->
                            <a href="#" onclick="shareToFacebook()"
                                class="inline-flex items-center px-5 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition duration-300 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                                Facebook
                            </a>

                            <!-- Twitter Share -->
                            <a href="#" onclick="shareToTwitter()"
                                class="inline-flex items-center px-5 py-2.5 bg-blue-400 text-white rounded-xl hover:bg-blue-500 transition duration-300 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                </svg>
                                Twitter
                            </a>

                            <!-- WhatsApp Share -->
                            <a href="#" onclick="shareToWhatsApp()"
                                class="inline-flex items-center px-5 py-2.5 bg-green-500 text-white rounded-xl hover:bg-green-600 transition duration-300 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488" />
                                </svg>
                                WhatsApp
                            </a>

                            <!-- Copy Link -->
                            <button onclick="copyLink()" id="copyButton"
                                class="inline-flex items-center px-5 py-2.5 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition duration-300 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span id="copyText">Salin Link</span>
                            </button>
                        </div>
                    </div>

                    <a href="{{ route('welcome') }}"
                        class="inline-flex items-center text-primary hover:text-blue-700 font-semibold transition duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </footer>
        </div>
    </article>

    <!-- Floating Action Buttons -->
    <div class="floating-actions">
        <button onclick="scrollToTop()" class="floating-btn bg-gradient-to-br from-primary to-purple-600 text-white">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
            </svg>
        </button>
        <button onclick="scrollToComments()" class="floating-btn bg-white text-gray-700 border border-gray-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
        </button>
    </div>

    <!-- Comments Section -->
    <section class="py-16 bg-white border-t border-gray-200 fade-in" id="comments" style="transition-delay: 0.6s;">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Comments Header -->
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Diskusi <span class="text-gradient">Artikel</span>
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Bagikan pendapat, pengalaman, atau pertanyaan Anda tentang artikel ini
                </p>
            </div>

            @auth
                <!-- Comment Form -->
                <div class="bg-gradient-to-br from-gray-50 to-blue-50 rounded-2xl p-8 mb-12 shadow-lg border border-gray-100">
                    <form action="{{ route('comments.store', $post) }}" method="POST" id="commentForm">
                        @csrf
                        <div class="mb-6">
                            <label for="content" class="block text-lg font-semibold text-gray-900 mb-4">
                                💬 Tulis Komentar Anda
                            </label>
                            <textarea name="content" id="content" rows="5" 
                                placeholder="Bagikan pemikiran atau pertanyaan Anda tentang artikel ini..."
                                class="w-full px-6 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent resize-none transition duration-300 text-lg"
                                required></textarea>
                            @error('content')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-primary to-purple-600 rounded-full flex items-center justify-center shadow-lg">
                                    <span class="text-sm font-bold text-white">
                                        {{ substr(auth()->user()->name, 0, 1) }}
                                    </span>
                                </div>
                                <div>
                                    <span class="text-lg font-semibold text-gray-900">{{ auth()->user()->name }}</span>
                                    <p class="text-sm text-gray-500">Member sejak {{ auth()->user()->created_at->format('M Y') }}</p>
                                </div>
                            </div>
                            <button type="submit" 
                                class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-primary to-purple-600 text-white rounded-xl hover:shadow-xl transition duration-300 font-semibold shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Kirim Komentar
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <!-- Login Required Message -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-100 border border-blue-200 rounded-2xl p-8 mb-12 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-500 rounded-full mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-blue-900 mb-2">Ingin Berpartisipasi?</h3>
                    <p class="text-blue-700 text-lg mb-6">
                        Bergabunglah dengan komunitas kami untuk berdiskusi dan berbagi pendapat
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('login') }}" 
                            class="inline-flex items-center px-8 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition duration-300 font-semibold shadow-lg">
                            Masuk ke Akun
                        </a>
                        <a href="{{ route('register') }}" 
                            class="inline-flex items-center px-8 py-3 border-2 border-blue-600 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition duration-300 font-semibold">
                            Daftar Sekarang
                        </a>
                    </div>
                </div>
            @endauth

            <!-- Comments List -->
            <div class="space-y-8" id="commentsList">
                @if($post->comments && $post->comments->count() > 0)
                    @foreach($post->comments->where('parent_id', null)->where('status', 'approved') as $comment)
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 hover:shadow-xl transition duration-300 card-hover">
                            <div class="flex items-start space-x-6">
                                <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center flex-shrink-0 shadow-lg">
                                    <span class="text-lg font-bold text-white">
                                        {{ substr($comment->user->name ?? 'G', 0, 1) }}
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center space-x-4">
                                            <h4 class="text-xl font-bold text-gray-900">{{ $comment->user->name ?? 'Guest' }}</h4>
                                            <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm font-medium">
                                                {{ $comment->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        @auth
                                            @if(auth()->user()->id === $comment->user_id || auth()->user()->role === 'admin')
                                                <div class="flex items-center space-x-3">
                                                    <button onclick="toggleEditForm({{ $comment->id }})" 
                                                        class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 transition duration-200 font-medium">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                        </svg>
                                                        Edit
                                                    </button>
                                                    
                                                    <form method="POST" action="{{ route('comments.destroy', $comment) }}" class="inline"
                                                          onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="inline-flex items-center text-sm text-red-600 hover:text-red-800 transition duration-200 font-medium">
                                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                            </svg>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        @endauth
                                    </div>
                                    
                                    <div id="comment-content-{{ $comment->id }}">
                                        <p class="text-gray-700 text-lg leading-relaxed mb-4">
                                            {{ $comment->content }}
                                        </p>
                                    </div>

                                    <div class="flex items-center space-x-6 pt-4 border-t border-gray-100">
                                        @auth
                                            <button onclick="likeComment({{ $comment->id }})" 
                                                class="inline-flex items-center text-base text-gray-600 hover:text-primary transition duration-200 font-medium">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V18m-7-8a2 2 0 01-2-2V6a2 2 0 012-2h2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17v4a2 2 0 01-2 2H3a2 2 0 01-2-2v-4a2 2 0 012-2h2a2 2 0 012 2z"></path>
                                                </svg>
                                                <span id="likes-{{ $comment->id }}">Suka ({{ $comment->likes()->count() }})</span>
                                            </button>
                                            <button onclick="toggleReplyForm({{ $comment->id }})" 
                                                class="inline-flex items-center text-base text-gray-600 hover:text-primary transition duration-200 font-medium">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                                </svg>
                                                Balas
                                            </button>
                                        @else
                                            <span class="inline-flex items-center text-base text-gray-500">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V18m-7-8a2 2 0 01-2-2V6a2 2 0 012-2h2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17v4a2 2 0 01-2 2H3a2 2 0 01-2-2v-4a2 2 0 012-2h2a2 2 0 012 2z"></path>
                                                </svg>
                                                Suka ({{ $comment->likes()->count() }})
                                            </span>
                                        @endauth
                                    </div>

                                    @auth
                                        <!-- Edit Form (hidden by default) -->
                                        <div id="edit-form-{{ $comment->id }}" class="mt-6 hidden">
                                            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6">
                                                <form action="{{ route('comments.update', $comment) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <textarea name="content" rows="4" 
                                                        class="w-full px-4 py-3 border border-yellow-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent resize-none text-base"
                                                        required>{{ $comment->content }}</textarea>
                                                    <div class="flex items-center justify-end space-x-4 mt-4">
                                                        <button type="button" onclick="toggleEditForm({{ $comment->id }})" 
                                                            class="px-6 py-2 text-base text-gray-600 hover:text-gray-800 font-medium">
                                                            Batal
                                                        </button>
                                                        <button type="submit" 
                                                            class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-blue-700 transition duration-200 font-medium">
                                                            Simpan Perubahan
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Reply Form (hidden by default) -->
                                        <div id="reply-form-{{ $comment->id }}" class="mt-6 hidden">
                                            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                                                <form action="{{ route('comments.reply', $comment) }}" method="POST">
                                                    @csrf
                                                    <textarea name="content" rows="4" 
                                                        placeholder="Tulis balasan Anda..."
                                                        class="w-full px-4 py-3 border border-blue-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent resize-none text-base"
                                                        required></textarea>
                                                    <div class="flex items-center justify-end space-x-4 mt-4">
                                                        <button type="button" onclick="toggleReplyForm({{ $comment->id }})" 
                                                            class="px-6 py-2 text-base text-gray-600 hover:text-gray-800 font-medium">
                                                            Batal
                                                        </button>
                                                        <button type="submit" 
                                                            class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-blue-700 transition duration-200 font-medium">
                                                            Kirim Balasan
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endauth

                                    <!-- Replies -->
                                    @if($comment->replies && $comment->replies->count() > 0)
                                        <div class="mt-8 space-y-6 border-l-4 border-blue-100 pl-8">
                                            @foreach($comment->replies->where('status', 'approved') as $reply)
                                                <div class="bg-gray-50 rounded-xl p-6">
                                                    <div class="flex items-start space-x-4">
                                                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-full flex items-center justify-center flex-shrink-0 shadow-md">
                                                            <span class="text-sm font-bold text-white">
                                                                {{ substr($reply->user->name ?? 'G', 0, 1) }}
                                                            </span>
                                                        </div>
                                                        <div class="flex-1">
                                                            <div class="flex items-center justify-between mb-3">
                                                                <div class="flex items-center space-x-3">
                                                                    <h5 class="font-semibold text-gray-900">{{ $reply->user->name ?? 'Guest' }}</h5>
                                                                    <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-medium">
                                                                        {{ $reply->created_at->diffForHumans() }}
                                                                    </span>
                                                                </div>
                                                                @auth
                                                                    @if(auth()->user()->id === $reply->user_id || auth()->user()->role === 'admin')
                                                                        <div class="flex items-center space-x-3">
                                                                            <button onclick="toggleEditReplyForm({{ $reply->id }})" 
                                                                                class="text-sm text-blue-600 hover:text-blue-800 transition duration-200">
                                                                                Edit
                                                                            </button>
                                                                            <form method="POST" action="{{ route('comments.destroy', $reply) }}" class="inline"
                                                                                  onsubmit="return confirm('Yakin ingin menghapus balasan ini?')">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" class="text-sm text-red-600 hover:text-red-800 transition duration-200">
                                                                                    Hapus
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    @endif
                                                                @endauth
                                                            </div>
                                                            
                                                            <div id="reply-content-{{ $reply->id }}">
                                                                <p class="text-gray-700">{{ $reply->content }}</p>
                                                            </div>
                                                            
                                                            @auth
                                                                @if(auth()->user()->id === $reply->user_id || auth()->user()->role === 'admin')
                                                                    <!-- Edit Reply Form (hidden by default) -->
                                                                    <div id="edit-reply-form-{{ $reply->id }}" class="mt-4 hidden">
                                                                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                                                            <form action="{{ route('comments.update', $reply) }}" method="POST">
                                                                                @csrf
                                                                                @method('PATCH')
                                                                                <textarea name="content" rows="3" 
                                                                                    class="w-full px-3 py-2 border border-yellow-300 rounded text-sm focus:ring-1 focus:ring-primary focus:border-transparent resize-none"
                                                                                    required>{{ $reply->content }}</textarea>
                                                                                <div class="flex items-center justify-end space-x-3 mt-3">
                                                                                    <button type="button" onclick="toggleEditReplyForm({{ $reply->id }})" 
                                                                                        class="px-3 py-1 text-sm text-gray-600 hover:text-gray-800">
                                                                                        Batal
                                                                                    </button>
                                                                                    <button type="submit" 
                                                                                        class="px-3 py-1 bg-primary text-white rounded text-sm hover:bg-blue-700 transition duration-200">
                                                                                        Simpan
                                                                                    </button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endauth
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-16">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-6">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Belum ada komentar</h3>
                        <p class="text-gray-500 text-lg mb-8">Jadilah yang pertama memberikan komentar untuk artikel ini!</p>
                        @auth
                            <button onclick="document.getElementById('content').focus()" 
                                class="inline-flex items-center px-8 py-3 bg-primary text-white rounded-xl hover:bg-blue-700 transition duration-300 font-semibold shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tulis Komentar Pertama
                            </button>
                        @else
                            <a href="{{ route('login') }}" 
                                class="inline-flex items-center px-8 py-3 bg-primary text-white rounded-xl hover:bg-blue-700 transition duration-300 font-semibold shadow-lg">
                                Masuk untuk Berkomentar
                            </a>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Related Posts -->
    @if ($relatedPosts->count() > 0)
        <section class="py-20 bg-gradient-to-br from-gray-50 to-blue-50 border-t border-gray-200 fade-in" style="transition-delay: 0.8s;">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                        Artikel <span class="text-gradient">Terkait</span>
                    </h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Jelajahi artikel menarik lainnya yang mungkin Anda sukai
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($relatedPosts as $relatedPost)
                        <article class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden card-hover group">
                            <!-- Featured Image -->
                            <div class="relative h-48 bg-gradient-to-br from-primary to-purple-600 overflow-hidden">
                                @if ($relatedPost->featured_image)
                                    <img src="{{ Storage::url($relatedPost->featured_image) }}"
                                        alt="{{ $relatedPost->title }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-primary to-purple-600 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-white opacity-50 group-hover:scale-110 group-hover:rotate-12 transition-all duration-500" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                                
                                <!-- Category Badge -->
                                <div class="absolute top-4 left-4">
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold text-white shadow-lg backdrop-blur-sm bg-black/30">
                                        {{ $relatedPost->category->name }}
                                    </span>
                                </div>
                            </div>

                            <!-- Post Content -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors duration-300 line-clamp-2">
                                    <a href="{{ route('posts.show', $relatedPost->slug) }}">
                                        {{ $relatedPost->title }}
                                    </a>
                                </h3>

                                <p class="text-gray-600 mb-4 line-clamp-3 text-sm leading-relaxed">
                                    {{ $relatedPost->excerpt ?: Str::limit(strip_tags($relatedPost->content), 120) }}
                                </p>

                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <span class="font-medium">{{ $relatedPost->user->name }}</span>
                                    <span>{{ $relatedPost->created_at->format('d M Y') }}</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

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
                        <div class="h-12 w-12 bg-gradient-to-br from-primary to-purple-600 rounded-xl flex items-center justify-center mr-3 shadow-lg glow-effect">
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
                        Platform blog modern untuk berbagi cerita, pengetahuan, dan inspirasi dengan komunitas pembaca dan penulis di seluruh Indonesia.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center hover:bg-white/20 transition-all duration-300 hover:scale-110">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg>
                        </a>
                        <a href="#" class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center hover:bg-white/20 transition-all duration-300 hover:scale-110">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.894 8.221l-1.97 9.28c-.145.658-.537.818-1.084.508l-3-2.21-1.446 1.394c-.14.18-.357.295-.6.295-.002 0-.003 0-.005 0l.213-3.054 5.56-5.022c.24-.213-.054-.334-.373-.121l-6.869 4.326-2.96-.924c-.64-.203-.658-.64.135-.954l11.566-4.458c.538-.196 1.006.128.832.941z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center hover:bg-white/20 transition-all duration-300 hover:scale-110">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
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
                        <li><a href="{{ route('welcome') }}" class="text-gray-300 hover:text-white transition duration-300 flex items-center group">
                            <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            Beranda
                        </a></li>
                        <li><a href="{{ route('welcome') }}#posts" class="text-gray-300 hover:text-white transition duration-300 flex items-center group">
                            <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            Artikel Terbaru
                        </a></li>
                        <li><a href="{{ route('welcome') }}#about" class="text-gray-300 hover:text-white transition duration-300 flex items-center group">
                            <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            Tentang Kami
                        </a></li>
                        @auth
                            <li><a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white transition duration-300 flex items-center group">
                                <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                Dasbor Saya
                            </a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="text-gray-300 hover:text-white transition duration-300 flex items-center group">
                                <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                Masuk
                            </a></li>
                            <li><a href="{{ route('register') }}" class="text-gray-300 hover:text-white transition duration-300 flex items-center group">
                                <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
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
                            <div class="w-8 h-8 bg-primary/20 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <span class="text-gray-300 text-sm">
                                Jakarta, Indonesia
                            </span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-primary/20 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <span class="text-gray-300 text-sm">
                                hello@weblogger.com
                            </span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-primary/20 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
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

    <!-- JavaScript for Enhanced Features -->
    <script>
        // Reading Progress Bar
        function updateReadingProgress() {
            const progressBar = document.getElementById('readingProgress');
            const windowHeight = window.innerHeight;
            const documentHeight = document.documentElement.scrollHeight - windowHeight;
            const scrollTop = window.pageYOffset;
            const progress = scrollTop / documentHeight;
            
            progressBar.style.transform = `scaleX(${progress})`;
        }

        // Scroll to Top
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Scroll to Comments
        function scrollToComments() {
            document.getElementById('comments').scrollIntoView({
                behavior: 'smooth'
            });
        }

        // Fade in animation on scroll
        function fadeInOnScroll() {
            const elements = document.querySelectorAll('.fade-in');
            elements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const elementVisible = 150;
                
                if (elementTop < window.innerHeight - elementVisible) {
                    element.classList.add('active');
                }
            });
        }

        // Get current URL and post data
        const currentUrl = window.location.href;
        const postTitle = @json($post->title);
        const postExcerpt = @json($post->excerpt ?: Str::limit(strip_tags($post->content), 100));

        // Social Sharing Functions
        function shareToFacebook() {
            const url = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(currentUrl)}`;
            openShareWindow(url);
        }

        function shareToTwitter() {
            const text = `${postTitle} - ${postExcerpt}`;
            const url = `https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(currentUrl)}`;
            openShareWindow(url);
        }

        function shareToWhatsApp() {
            const text = `${postTitle} - ${postExcerpt} ${currentUrl}`;
            const url = `https://wa.me/?text=${encodeURIComponent(text)}`;
            openShareWindow(url);
        }

        function copyLink() {
            navigator.clipboard.writeText(currentUrl).then(function() {
                const copyButton = document.getElementById('copyText');
                const originalText = copyButton.textContent;
                copyButton.textContent = 'Tersalin!';
                copyButton.parentElement.classList.remove('bg-gray-600', 'hover:bg-gray-700');
                copyButton.parentElement.classList.add('bg-green-600', 'hover:bg-green-700');

                setTimeout(function() {
                    copyButton.textContent = originalText;
                    copyButton.parentElement.classList.remove('bg-green-600', 'hover:bg-green-700');
                    copyButton.parentElement.classList.add('bg-gray-600', 'hover:bg-gray-700');
                }, 2000);
            }).catch(function(err) {
                const textArea = document.createElement('textarea');
                textArea.value = currentUrl;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);
                alert('Link berhasil disalin!');
            });
        }

        function openShareWindow(url) {
            const width = 600;
            const height = 400;
            const left = (window.innerWidth - width) / 2;
            const top = (window.innerHeight - height) / 2;

            window.open(
                url,
                'shareWindow',
                `width=${width},height=${height},left=${left},top=${top},scrollbars=yes,resizable=yes`
            );
        }

        // Comment functionality
        function likeComment(commentId) {
            fetch(`/comments/${commentId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                const likesElement = document.getElementById(`likes-${commentId}`);
                if (likesElement) {
                    likesElement.textContent = `Suka (${data.likes_count})`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyukai komentar');
            });
        }

        function toggleReplyForm(commentId) {
            const replyForm = document.getElementById(`reply-form-${commentId}`);
            if (replyForm) {
                replyForm.classList.toggle('hidden');
                if (!replyForm.classList.contains('hidden')) {
                    replyForm.querySelector('textarea').focus();
                }
            }
        }

        function toggleEditForm(commentId) {
            const editForm = document.getElementById(`edit-form-${commentId}`);
            if (editForm) {
                editForm.classList.toggle('hidden');
                if (!editForm.classList.contains('hidden')) {
                    editForm.querySelector('textarea').focus();
                }
            }
        }

        function toggleEditReplyForm(replyId) {
            const editForm = document.getElementById(`edit-reply-form-${replyId}`);
            if (editForm) {
                editForm.classList.toggle('hidden');
                if (!editForm.classList.contains('hidden')) {
                    editForm.querySelector('textarea').focus();
                }
            }
        }

        // Initialize all functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Initial animations
            fadeInOnScroll();
            
            // Event listeners
            window.addEventListener('scroll', () => {
                updateReadingProgress();
                fadeInOnScroll();
            });

            // Navbar scroll effect
            window.addEventListener('scroll', () => {
                const navbar = document.getElementById('navbar');
                if (window.scrollY > 100) {
                    navbar.classList.add('bg-white', 'shadow-lg');
                    navbar.classList.remove('bg-white/90');
                } else {
                    navbar.classList.remove('bg-white', 'shadow-lg');
                    navbar.classList.add('bg-white/90');
                }
            });

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
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
        });
    </script>
</body>
</html>