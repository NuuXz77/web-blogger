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
</head>

<body class="antialiased bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('welcome') }}" class="flex items-center">
                        <div class="h-8 w-8 bg-primary rounded-lg flex items-center justify-center mr-3">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                </path>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-gray-900">
                            Web <span class="text-primary">Blogger</span>
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('welcome') }}"
                        class="text-gray-700 hover:text-primary transition duration-200">Beranda</a>
                    <a href="{{ route('welcome') }}#posts"
                        class="text-gray-700 hover:text-primary transition duration-200">Artikel Terbaru</a>
                    <a href="{{ route('welcome') }}#about"
                        class="text-gray-700 hover:text-primary transition duration-200">Tentang</a>
                </div>

                <!-- Auth Links -->
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="text-gray-700 hover:text-primary transition duration-200">Dashboard</a>
                        @if (auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}"
                                class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition ease-in-out duration-150">
                                Panel Admin
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                            class="text-gray-700 hover:text-primary transition duration-200">Masuk</a>
                        <a href="{{ route('register') }}"
                            class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition ease-in-out duration-150">
                            Mulai
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Breadcrumb -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="flex items-center space-x-2 text-sm">
                <a href="{{ route('welcome') }}"
                    class="text-gray-500 hover:text-primary transition duration-200">Beranda</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-gray-900 font-medium">{{ $post->title }}</span>
            </nav>
        </div>
    </div>

    <!-- Article -->
    <article class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Article Header -->
            <header class="mb-8">
                <div class="text-center mb-8">
                    <!-- Category Badge -->
                    <div class="mb-4">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary text-white">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                </path>
                            </svg>
                            {{ ucfirst($post->category->name) }}
                        </span>
                    </div>

                    <!-- Title -->
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                        {{ $post->title }}
                    </h1>

                    <!-- Excerpt -->
                    @if ($post->excerpt)
                        <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto leading-relaxed">
                            {{ $post->excerpt }}
                        </p>
                    @endif

                    <!-- Author Info -->
                    <div class="flex items-center justify-center space-x-4 mb-8">
                        <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center">
                            <span class="text-lg font-medium text-white">
                                {{ substr($post->user->name, 0, 1) }}
                            </span>
                        </div>
                        <div class="text-left">
                            <p class="font-medium text-gray-900">{{ $post->user->name }}</p>
                            <div class="flex items-center text-sm text-gray-500 space-x-4">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0h8m-8 0V17a2 2 0 002 2h4a2 2 0 002-2V7">
                                        </path>
                                    </svg>
                                    {{ $post->created_at->format('d M Y') }}
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $post->created_at->diffForHumans() }}
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                    {{ rand(50, 500) }} tayangan
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Featured Image -->
                @if ($post->featured_image)
                    <div class="mb-8">
                        <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}"
                            class="w-full h-64 md:h-96 object-cover rounded-lg shadow-lg">
                    </div>
                @endif
            </header>

            <!-- Article Content -->
            <div class="prose prose-lg prose-primary mx-auto max-w-none">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
                    {!! nl2br(e($post->content)) !!}
                </div>
            </div>

            <!-- Article Footer -->
            <footer class="mt-12 pt-8 border-t border-gray-200">
                <div
                    class="flex flex-col md:flex-row items-start md:items-center justify-between space-y-6 md:space-y-0">
                    <div class="w-full md:w-auto">
                        <p class="text-sm text-gray-500 mb-4">Bagikan artikel ini:</p>
                        <div class="flex flex-wrap gap-3">
                            <!-- Facebook Share -->
                            <a href="#" onclick="shareToFacebook()"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                                Facebook
                            </a>

                            <!-- Twitter Share -->
                            <a href="#" onclick="shareToTwitter()"
                                class="inline-flex items-center px-4 py-2 bg-blue-400 text-white rounded-lg hover:bg-blue-500 transition duration-200">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                </svg>
                                Twitter
                            </a>

                            <!-- LinkedIn Share -->
                            <a href="#" onclick="shareToLinkedIn()"
                                class="inline-flex items-center px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition duration-200">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                </svg>
                                LinkedIn
                            </a>

                            <!-- WhatsApp Share -->
                            <a href="#" onclick="shareToWhatsApp()"
                                class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-200">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488" />
                                </svg>
                                WhatsApp
                            </a>

                            <!-- Copy Link -->
                            <button onclick="copyLink()" id="copyButton"
                                class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span id="copyText">Salin Link</span>
                            </button>
                        </div>
                    </div>

                    <a href="{{ route('welcome') }}"
                        class="inline-flex items-center text-primary hover:text-blue-700 font-medium">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </footer>
        </div>
    </article>

    <!-- Comments Section -->
    <section class="py-12 bg-white border-t border-gray-200" id="comments">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Comments Header -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Komentar</h2>
                <p class="text-gray-600">Bagikan pendapat Anda tentang artikel ini</p>
            </div>

            @auth
                <!-- Comment Form -->
                <div class="bg-gray-50 rounded-xl p-6 mb-8">
                    <form action="{{ route('comments.store', $post) }}" method="POST" id="commentForm">
                        @csrf
                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                                Tulis komentar Anda
                            </label>
                            <textarea name="content" id="content" rows="4" 
                                placeholder="Berikan tanggapan atau pendapat Anda tentang artikel ini..."
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent resize-none transition duration-200"
                                required></textarea>
                            @error('content')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                                    <span class="text-sm font-medium text-white">
                                        {{ substr(auth()->user()->name, 0, 1) }}
                                    </span>
                                </div>
                                <span class="text-sm text-gray-600">{{ auth()->user()->name }}</span>
                            </div>
                            <button type="submit" 
                                class="inline-flex items-center px-6 py-2 bg-primary text-white rounded-lg hover:bg-blue-700 transition duration-200 font-medium">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Kirim Komentar
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <!-- Login Required Message -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-8">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h3 class="text-blue-900 font-medium">Ingin berkomentar?</h3>
                            <p class="text-blue-700 text-sm">
                                <a href="{{ route('login') }}" class="font-medium hover:underline">Masuk</a> 
                                atau 
                                <a href="{{ route('register') }}" class="font-medium hover:underline">daftar</a> 
                                untuk dapat memberikan komentar
                            </p>
                        </div>
                    </div>
                </div>
            @endauth

            <!-- Comments List -->
            <div class="space-y-6" id="commentsList">
                @if($post->comments && $post->comments->count() > 0)
                    @foreach($post->comments->where('parent_id', null)->where('status', 'approved') as $comment)
                        <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-sm transition duration-200">
                            <div class="flex items-start space-x-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span class="text-sm font-medium text-white">
                                        {{ substr($comment->user->name ?? 'G', 0, 1) }}
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center space-x-2 mb-2">
                                        <h4 class="font-medium text-gray-900">{{ $comment->user->name ?? 'Guest' }}</h4>
                                        <span class="text-sm text-gray-500">•</span>
                                        <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-gray-700 leading-relaxed mb-3">
                                        {{ $comment->content }}
                                    </p>
                                    <div class="flex items-center space-x-4">
                                        @auth
                                            <button onclick="likeComment({{ $comment->id }})" 
                                                class="inline-flex items-center text-sm text-gray-500 hover:text-primary transition duration-200">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V18m-7-8a2 2 0 01-2-2V6a2 2 0 012-2h2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17v4a2 2 0 01-2 2H3a2 2 0 01-2-2v-4a2 2 0 012-2h2a2 2 0 012 2z"></path>
                                                </svg>
                                                <span id="likes-{{ $comment->id }}">Suka ({{ $comment->likes()->count() }})</span>
                                            </button>
                                            <button onclick="toggleReplyForm({{ $comment->id }})" 
                                                class="inline-flex items-center text-sm text-gray-500 hover:text-primary transition duration-200">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                </svg>
                                                Balas
                                            </button>
                                            
                                            @if(auth()->user()->id === $comment->user_id || auth()->user()->role === 'admin')
                                                <button onclick="toggleEditForm({{ $comment->id }})" 
                                                    class="inline-flex items-center text-sm text-gray-500 hover:text-blue-600 transition duration-200">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                    Edit
                                                </button>
                                                
                                                <form method="POST" action="{{ route('comments.destroy', $comment) }}" class="inline"
                                                      onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center text-sm text-red-500 hover:text-red-700 transition duration-200">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        @else
                                            <span class="inline-flex items-center text-sm text-gray-500">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V18m-7-8a2 2 0 01-2-2V6a2 2 0 012-2h2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17v4a2 2 0 01-2 2H3a2 2 0 01-2-2v-4a2 2 0 012-2h2a2 2 0 012 2z"></path>
                                                </svg>
                                                Suka ({{ $comment->likes()->count() }})
                                            </span>
                                        @endauth
                                    </div>

                                    @auth
                                        <!-- Edit Form (hidden by default) -->
                                        <div id="edit-form-{{ $comment->id }}" class="mt-4 hidden">
                                            <form action="{{ route('comments.update', $comment) }}" method="POST" class="bg-yellow-50 rounded-lg p-4">
                                                @csrf
                                                @method('PATCH')
                                                <textarea name="content" rows="3" 
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent resize-none text-sm"
                                                    required>{{ $comment->content }}</textarea>
                                                <div class="flex items-center justify-end space-x-2 mt-3">
                                                    <button type="button" onclick="toggleEditForm({{ $comment->id }})" 
                                                        class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800">
                                                        Batal
                                                    </button>
                                                    <button type="submit" 
                                                        class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-700 transition duration-200 text-sm">
                                                        Simpan Perubahan
                                                    </button>
                                                </div>
                                            </form>
                                        </div>

                                        <!-- Reply Form (hidden by default) -->
                                        <div id="reply-form-{{ $comment->id }}" class="mt-4 hidden">
                                            <form action="{{ route('comments.reply', $comment) }}" method="POST" class="bg-gray-50 rounded-lg p-4">
                                                @csrf
                                                <textarea name="content" rows="3" 
                                                    placeholder="Tulis balasan Anda..."
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent resize-none text-sm"
                                                    required></textarea>
                                                <div class="flex items-center justify-end space-x-2 mt-3">
                                                    <button type="button" onclick="toggleReplyForm({{ $comment->id }})" 
                                                        class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800">
                                                        Batal
                                                    </button>
                                                    <button type="submit" 
                                                        class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-700 transition duration-200 text-sm">
                                                        Kirim Balasan
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    @endauth

                                    <!-- Replies -->
                                    @if($comment->replies && $comment->replies->count() > 0)
                                        <div class="mt-4 space-y-4 border-l-2 border-gray-100 pl-4">
                                            @foreach($comment->replies->where('status', 'approved') as $reply)
                                                <div class="bg-gray-50 rounded-lg p-4">
                                                    <div class="flex items-start space-x-3">
                                                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-full flex items-center justify-center flex-shrink-0">
                                                            <span class="text-xs font-medium text-white">
                                                                {{ substr($reply->user->name ?? 'G', 0, 1) }}
                                                            </span>
                                                        </div>
                                                        <div class="flex-1">
                                                            <div class="flex items-center justify-between mb-1">
                                                                <div class="flex items-center space-x-2">
                                                                    <h5 class="font-medium text-gray-900 text-sm">{{ $reply->user->name ?? 'Guest' }}</h5>
                                                                    <span class="text-xs text-gray-500">•</span>
                                                                    <span class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                                                                </div>
                                                                @auth
                                                                    @if(auth()->user()->id === $reply->user_id || auth()->user()->role === 'admin')
                                                                        <div class="flex items-center space-x-2">
                                                                            <button onclick="toggleEditReplyForm({{ $reply->id }})" 
                                                                                class="text-xs text-gray-500 hover:text-blue-600 transition duration-200">
                                                                                Edit
                                                                            </button>
                                                                            <form method="POST" action="{{ route('comments.destroy', $reply) }}" class="inline"
                                                                                  onsubmit="return confirm('Yakin ingin menghapus balasan ini?')">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" class="text-xs text-red-500 hover:text-red-700 transition duration-200">
                                                                                    Hapus
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    @endif
                                                                @endauth
                                                            </div>
                                                            
                                                            <div id="reply-content-{{ $reply->id }}">
                                                                <p class="text-gray-700 text-sm">{{ $reply->content }}</p>
                                                            </div>
                                                            
                                                            @auth
                                                                @if(auth()->user()->id === $reply->user_id || auth()->user()->role === 'admin')
                                                                    <!-- Edit Reply Form (hidden by default) -->
                                                                    <div id="edit-reply-form-{{ $reply->id }}" class="mt-2 hidden">
                                                                        <form action="{{ route('comments.update', $reply) }}" method="POST" class="bg-yellow-50 rounded p-3">
                                                                            @csrf
                                                                            @method('PATCH')
                                                                            <textarea name="content" rows="2" 
                                                                                class="w-full px-2 py-1 border border-gray-300 rounded text-xs focus:ring-1 focus:ring-primary focus:border-transparent resize-none"
                                                                                required>{{ $reply->content }}</textarea>
                                                                            <div class="flex items-center justify-end space-x-2 mt-2">
                                                                                <button type="button" onclick="toggleEditReplyForm({{ $reply->id }})" 
                                                                                    class="px-2 py-1 text-xs text-gray-600 hover:text-gray-800">
                                                                                    Batal
                                                                                </button>
                                                                                <button type="submit" 
                                                                                    class="px-2 py-1 bg-primary text-white rounded text-xs hover:bg-blue-700 transition duration-200">
                                                                                    Simpan
                                                                                </button>
                                                                            </div>
                                                                        </form>
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
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada komentar</h3>
                        <p class="text-gray-500">Jadilah yang pertama memberikan komentar untuk artikel ini!</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Related Posts -->
    @if ($relatedPosts->count() > 0)
        <section class="py-16 bg-gray-50 border-t border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">
                        Artikel <span class="text-primary">Terkait</span>
                    </h2>
                    <p class="text-lg text-gray-600">
                        Temukan artikel menarik lainnya yang mungkin Anda sukai
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach ($relatedPosts as $relatedPost)
                        <article
                            class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition duration-300 group">
                            <!-- Featured Image -->
                            <div class="relative h-48 bg-gray-200 overflow-hidden">
                                @if ($relatedPost->featured_image)
                                    <img src="{{ Storage::url($relatedPost->featured_image) }}"
                                        alt="{{ $relatedPost->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                @else
                                    <div
                                        class="w-full h-full bg-gradient-to-br from-primary to-blue-600 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-white opacity-50" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Post Content -->
                            <div class="p-6">
                                <!-- Title -->
                                <h3
                                    class="text-lg font-semibold text-gray-900 mb-3 group-hover:text-primary transition duration-200">
                                    <a href="{{ route('posts.show', $relatedPost->slug) }}">
                                        {{ $relatedPost->title }}
                                    </a>
                                </h3>

                                <!-- Excerpt -->
                                <p class="text-gray-600 mb-4 text-sm line-clamp-2">
                                    {{ $relatedPost->excerpt ?: Str::limit(strip_tags($relatedPost->content), 80) }}
                                </p>

                                <!-- Meta Information -->
                                <div class="flex items-center justify-between text-xs text-gray-500">
                                    <span>{{ $relatedPost->user->name }}</span>
                                    <span>{{ $relatedPost->created_at->format('d M Y') }}</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center mb-4">
                        <div class="h-8 w-8 bg-primary rounded-lg flex items-center justify-center mr-3">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                </path>
                            </svg>
                        </div>
                        <span class="text-xl font-bold">
                            Web <span class="text-primary">Blogger</span>
                        </span>
                    </div>
                    <p class="text-gray-300 mb-4 max-w-md">
                        Sebuah platform di mana cerita menjadi hidup. Bergabunglah dengan komunitas penulis kami yang
                        bersemangat dan pembaca yang aktif.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Tautan Cepat</h3>
                    <ul class="space-y-2">
                        <li><a href="#home" class="text-gray-300 hover:text-white transition duration-200">Beranda</a>
                        </li>
                        <li><a href="#posts" class="text-gray-300 hover:text-white transition duration-200">Postingan
                                Terbaru</a></li>
                        <li><a href="#about" class="text-gray-300 hover:text-white transition duration-200">Tentang</a>
                        </li>
                        @auth
                            <li><a href="{{ route('dashboard') }}"
                                    class="text-gray-300 hover:text-white transition duration-200">Dasbor</a></li>
                        @else
                            <li><a href="{{ route('login') }}"
                                    class="text-gray-300 hover:text-white transition duration-200">Masuk</a></li>
                            <li><a href="{{ route('register') }}"
                                    class="text-gray-300 hover:text-white transition duration-200">Daftar</a></li>
                        @endauth
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Terhubung</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-white transition duration-200">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition duration-200">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p class="text-gray-300">
                    &copy; {{ date('Y') }} Web Blogger. Hak cipta dilindungi.
                </p>
            </div>
        </div>
    </footer>

    <!-- JavaScript for Social Sharing and Comments -->
    <script>
        // Get current URL and post data
        const currentUrl = window.location.href;
        const postTitle = @json($post->title);
        const postExcerpt = @json($post->excerpt ?: Str::limit(strip_tags($post->content), 100));

        // Facebook Share
        function shareToFacebook() {
            const url = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(currentUrl)}`;
            openShareWindow(url);
        }

        // Twitter Share
        function shareToTwitter() {
            const text = `${postTitle} - ${postExcerpt}`;
            const url = `https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(currentUrl)}`;
            openShareWindow(url);
        }

        // LinkedIn Share
        function shareToLinkedIn() {
            const url = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(currentUrl)}`;
            openShareWindow(url);
        }

        // WhatsApp Share
        function shareToWhatsApp() {
            const text = `${postTitle} - ${postExcerpt} ${currentUrl}`;
            const url = `https://wa.me/?text=${encodeURIComponent(text)}`;
            openShareWindow(url);
        }

        // Copy Link Function
        function copyLink() {
            navigator.clipboard.writeText(currentUrl).then(function() {
                // Change button text temporarily
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
                // Fallback for older browsers
                const textArea = document.createElement('textarea');
                textArea.value = currentUrl;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);

                alert('Link berhasil disalin!');
            });
        }

        // Helper function to open share window
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

        // Comment Form Handler
        document.getElementById('commentForm')?.addEventListener('submit', function(e) {
            // Let the form submit normally to the backend
            const commentText = document.getElementById('content').value;
            if (commentText.trim() === '') {
                e.preventDefault();
                alert('Silakan tulis komentar Anda terlebih dahulu.');
                return;
            }
        });

        // Like Comment Function
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

        // Toggle Reply Form
        function toggleReplyForm(commentId) {
            const replyForm = document.getElementById(`reply-form-${commentId}`);
            if (replyForm) {
                replyForm.classList.toggle('hidden');
                if (!replyForm.classList.contains('hidden')) {
                    replyForm.querySelector('textarea').focus();
                }
            }
        }

        // Toggle Edit Form
        function toggleEditForm(commentId) {
            const editForm = document.getElementById(`edit-form-${commentId}`);
            if (editForm) {
                editForm.classList.toggle('hidden');
                if (!editForm.classList.contains('hidden')) {
                    editForm.querySelector('textarea').focus();
                }
            }
        }

        // Toggle Edit Reply Form
        function toggleEditReplyForm(replyId) {
            const editForm = document.getElementById(`edit-reply-form-${replyId}`);
            if (editForm) {
                editForm.classList.toggle('hidden');
                if (!editForm.classList.contains('hidden')) {
                    editForm.querySelector('textarea').focus();
                }
            }
        }
    </script>
</body>

</html>
