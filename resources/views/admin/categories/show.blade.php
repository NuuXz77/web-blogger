<x-layouts.app title="Detail Kategori">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Detail Kategori</h1>
            <p class="text-gray-600 mt-1">Lihat informasi kategori dan artikel terkait</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.categories.edit', $category) }}" 
               class="inline-flex items-center px-4 py-2 bg-[#0046FF] hover:bg-[#0036D8] text-white rounded-md transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Kategori
            </a>
            <a href="{{ route('admin.categories.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Kategori
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Category Information -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Informasi Kategori</h2>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Category Name & Color -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <div class="flex items-center">
                            <div class="w-6 h-6 rounded-full mr-3" style="background-color: {{ $category->color }}"></div>
                            <div>
                                <div class="font-medium text-gray-900">{{ $category->name }}</div>
                                <div class="text-sm text-gray-500">{{ $category->slug }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        @if($category->description)
                            <p class="text-gray-600">{{ $category->description }}</p>
                        @else
                            <p class="text-gray-400 italic">Tidak ada deskripsi</p>
                        @endif
                    </div>

                    <!-- Color -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Warna</label>
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-md border border-gray-200" style="background-color: {{ $category->color }}"></div>
                            <div>
                                <div class="font-mono text-sm text-gray-900">{{ $category->color }}</div>
                                <div class="text-xs text-gray-500">Kode warna hex</div>
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        @if($category->is_active)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                                Tidak Aktif
                            </span>
                        @endif
                    </div>

                    <!-- Statistics -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Statistik</label>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Total Artikel</span>
                                <span class="text-lg font-semibold text-gray-900">{{ $category->posts_count }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Dates -->
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Dibuat</label>
                            <p class="text-sm text-gray-600">{{ $category->created_at->format('j F Y \p\u\k\u\l g:i A') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Terakhir Diperbarui</label>
                            <p class="text-sm text-gray-600">{{ $category->updated_at->format('j F Y \p\u\k\u\l g:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Associated Posts -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-900">
                            Artikel Terkait ({{ $posts->total() }})
                        </h2>
                        @if($category->is_active)
                            <a href="{{ route('admin.posts.create') }}?category={{ $category->id }}" 
                               class="inline-flex items-center px-3 py-1.5 bg-[#0046FF] hover:bg-[#0036D8] text-white text-sm rounded-md transition-colors duration-200">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Tambah Artikel
                            </a>
                        @endif
                    </div>
                </div>

                @if($posts->count() > 0)
                    <div class="divide-y divide-gray-200">
                        @foreach($posts as $post)
                            <div class="p-6 hover:bg-gray-50 transition-colors duration-150">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">
                                            <a href="{{ route('admin.posts.show', $post) }}" class="hover:text-[#0046FF] transition-colors duration-200">
                                                {{ $post->title }}
                                            </a>
                                        </h3>
                                        @if($post->content)
                                            <p class="text-gray-600 mb-3">{{ Str::limit(strip_tags($post->content), 150) }}</p>
                                        @endif
                                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                                {{ $post->user->name }}
                                            </span>
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                {{ $post->created_at->format('M j, Y') }}
                                            </span>
                                            @if($post->comments_count > 0)
                                                <span class="flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                                    </svg>
                                                    {{ $post->comments_count }} komentar
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="ml-4 flex items-center space-x-2">
                                        <a href="{{ route('admin.posts.edit', $post) }}" 
                                           class="p-2 text-gray-400 hover:text-[#0046FF] transition-colors duration-200">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.posts.show', $post) }}" 
                                           class="p-2 text-gray-400 hover:text-[#0046FF] transition-colors duration-200">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($posts->hasPages())
                        <div class="px-6 py-4 border-t border-gray-200">
                            {{ $posts->links() }}
                        </div>
                    @endif
                @else
                    <!-- Empty State -->
                    <div class="p-12 text-center">
                        <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada artikel dalam kategori ini</h3>
                        <p class="text-gray-500 mb-6">Kategori ini belum memiliki artikel apapun.</p>
                        @if($category->is_active)
                            <a href="{{ route('admin.posts.create') }}?category={{ $category->id }}" 
                               class="inline-flex items-center px-4 py-2 bg-[#0046FF] hover:bg-[#0036D8] text-white rounded-md transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Buat Artikel Pertama
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
