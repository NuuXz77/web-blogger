<x-layouts.app title="Detail Komentar">
    <x-slot:header>
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="p-2 bg-blue-50 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                        </path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Detail Komentar</h1>
                    <p class="text-gray-600 mt-1">Lihat detail dan kelola komentar</p>
                </div>
            </div>
            <a href="{{ route('admin.comments.index') }}"
                class="inline-flex items-center text-primary hover:text-blue-700 font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Beranda
            </a>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="mt-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-md flex items-center">
            <svg class="w-5 h-5 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="py-6">
        <!-- Comment Details Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <!-- Header with User Info -->
            <div class="bg-gradient-to-r from-blue-50 to-blue-50 px-6 py-4 border-b border-gray-200">
                <div class="flex items-start space-x-4">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center flex-shrink-0 shadow-lg">
                        <span class="text-xl font-bold text-white">
                            {{ substr($comment->user->name ?? ($comment->user_name ?? 'G'), 0, 1) }}
                        </span>
                    </div>

                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-xl font-semibold text-gray-900">
                                {{ $comment->user->name ?? ($comment->user_name ?? 'Guest') }}</h3>
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                {{ $comment->status === 'approved'
                                    ? 'bg-green-100 text-green-800'
                                    : ($comment->status === 'pending'
                                        ? 'bg-yellow-100 text-yellow-800'
                                        : 'bg-red-100 text-red-800') }}">
                                @if ($comment->status === 'approved')
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Disetujui
                                @elseif($comment->status === 'pending')
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Menunggu
                                @else
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728">
                                        </path>
                                    </svg>
                                    Spam
                                @endif
                            </span>
                        </div>
                        <div class="flex items-center space-x-4 text-sm text-gray-600">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0h8m-8 0V17a2 2 0 002 2h4a2 2 0 002-2V7">
                                    </path>
                                </svg>
                                {{ $comment->created_at->format('d M Y, H:i') }}
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $comment->created_at->diffForHumans() }}
                            </div>
                            @if ($comment->parent_id)
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                    </svg>
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Balasan
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Comment Content -->
            <div class="p-6">
                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <div class="flex items-start space-x-2">
                        <svg class="w-5 h-5 text-gray-400 mt-1 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                            </path>
                        </svg>
                        <div class="prose max-w-none text-gray-700 leading-relaxed">
                            {{ $comment->content }}
                        </div>
                    </div>
                </div>

                <!-- Information Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Post Information -->
                    <div class="bg-blue-50 rounded-lg p-4">
                        <div class="flex items-center mb-3">
                            <div class="p-2 bg-blue-100 rounded-lg">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                    </path>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-gray-900 ml-2">Informasi Postingan</h4>
                        </div>
                        @if ($comment->post)
                            <a href="{{ route('posts.show', $comment->post->slug) }}"
                                class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium"
                                target="_blank">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                    </path>
                                </svg>
                                {{ $comment->post->title }}
                            </a>
                            <p class="text-sm text-gray-600 mt-2">
                                Dipublikasikan: {{ $comment->post->created_at->format('d M Y') }}
                            </p>
                        @else
                            <div class="flex items-center text-gray-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z">
                                    </path>
                                </svg>
                                Post tidak ditemukan
                            </div>
                        @endif
                    </div>

                    <!-- Parent Comment Information -->
                    @if ($comment->parent)
                        <div class="bg-blue-50 rounded-lg p-4">
                            <div class="flex items-center mb-3">
                                <div class="p-2 bg-blue-100 rounded-lg">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-gray-900 ml-2">Membalas Komentar</h4>
                            </div>
                            <div class="bg-white rounded p-3 border-l-4 border-blue-300">
                                <p class="text-sm text-gray-600 italic">
                                    {{ Str::limit($comment->parent->content, 100) }}</p>
                                <p class="text-xs text-gray-500 mt-1">
                                    Oleh: {{ $comment->parent->user->name ?? 'Guest' }}
                                </p>
                            </div>
                        </div>
                    @else
                        <!-- Comment Statistics -->
                        <div class="bg-green-50 rounded-lg p-4">
                            <div class="flex items-center mb-3">
                                <div class="p-2 bg-green-100 rounded-lg">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                        </path>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-gray-900 ml-2">Statistik Komentar</h4>
                            </div>
                            <div class="space-y-2">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Total Balasan:</span>
                                    <span
                                        class="font-medium text-gray-900">{{ $comment->replies ? $comment->replies->count() : 0 }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Likes:</span>
                                    <span
                                        class="font-medium text-gray-900">{{ $comment->likes ? $comment->likes->count() : 0 }}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="border-t border-gray-200 pt-6">
                    <div class="flex items-center gap-4 flex-wrap">
                        @if ($comment->status === 'pending')
                            <form method="POST" action="{{ route('admin.comments.update', $comment) }}"
                                class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="approved">
                                <button type="submit"
                                    class="inline-flex items-center bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-200 shadow-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Setujui Komentar
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.comments.update', $comment) }}"
                                class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="spam">
                                <button type="submit"
                                    class="inline-flex items-center bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-200 shadow-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728">
                                        </path>
                                    </svg>
                                    Tandai Spam
                                </button>
                            </form>
                        @elseif($comment->status === 'approved')
                            <form method="POST" action="{{ route('admin.comments.update', $comment) }}"
                                class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="pending">
                                <button type="submit"
                                    class="inline-flex items-center bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition duration-200 shadow-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Ubah ke Pending
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.comments.update', $comment) }}"
                                class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="spam">
                                <button type="submit"
                                    class="inline-flex items-center bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-200 shadow-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728">
                                        </path>
                                    </svg>
                                    Tandai Spam
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.comments.update', $comment) }}"
                                class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="approved">
                                <button type="submit"
                                    class="inline-flex items-center bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-200 shadow-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Setujui Komentar
                                </button>
                            </form>
                        @endif

                        <form method="POST" action="{{ route('admin.comments.destroy', $comment) }}" class="inline"
                            onsubmit="return confirm('Yakin ingin menghapus komentar ini? Tindakan ini tidak dapat dibatalkan.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition duration-200 shadow-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                                Hapus Komentar
                            </button>
                        </form>

                        <a href="{{ route('posts.show', $comment->post->slug) }}" target="_blank"
                            class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200 shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                            Lihat di Post
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Replies Section -->
        @if ($comment->replies && $comment->replies->count() > 0)
            <div class="mt-6">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900">Balasan ({{ $comment->replies->count() }})
                            </h3>
                        </div>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @foreach ($comment->replies as $reply)
                            <div class="p-6">
                                <div class="flex items-start space-x-4">
                                    <div
                                        class="w-10 h-10 bg-gradient-to-br from-green-500 to-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                                        <span class="text-sm font-medium text-white">
                                            {{ substr($reply->user->name ?? 'G', 0, 1) }}
                                        </span>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-2">
                                            <div class="flex items-center space-x-2">
                                                <h4 class="font-medium text-gray-900">
                                                    {{ $reply->user->name ?? 'Guest' }}</h4>
                                                <span class="text-sm text-gray-500">•</span>
                                                <span
                                                    class="text-sm text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                                            </div>
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                                {{ $reply->status === 'approved'
                                                    ? 'bg-green-100 text-green-800'
                                                    : ($reply->status === 'pending'
                                                        ? 'bg-yellow-100 text-yellow-800'
                                                        : 'bg-red-100 text-red-800') }}">
                                                {{ ucfirst($reply->status === 'approved' ? 'Disetujui' : ($reply->status === 'pending' ? 'Menunggu' : 'Spam')) }}
                                            </span>
                                        </div>
                                        <p class="text-gray-700 mb-3">{{ $reply->content }}</p>
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('admin.comments.show', $reply) }}"
                                                class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                                Lihat Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-layouts.app>
