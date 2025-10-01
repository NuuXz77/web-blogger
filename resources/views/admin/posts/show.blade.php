<x-layouts.app title="Lihat Postingan">
    <x-slot:header>
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">
                {{ $post->title }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.posts.edit', $post) }}" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Postingan
                </a>
                <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:bg-gray-600 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Postingan
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6">
                    @if($post->featured_image)
                        <div class="mb-6">
                            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-64 object-cover rounded-lg">
                        </div>
                    @endif

                    <div class="prose max-w-none">
                        <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>

                        @if($post->excerpt)
                            <div class="text-lg text-gray-600 mb-6 p-4 bg-gray-50 rounded-lg border-l-4 border-primary">
                                {{ $post->excerpt }}
                            </div>
                        @endif

                        <div class="text-gray-800 leading-relaxed">
                            {!! nl2br(e($post->content)) !!}
                        </div>
                    </div>
                </div>

                @if($post->comments->count() > 0)
                    <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Komentar ({{ $post->comments->count() }})</h3>

                        <div class="space-y-4">
                            @foreach($post->comments as $comment)
                                <div class="border-l-4 border-gray-200 pl-4">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <span class="font-medium text-gray-900">{{ $comment->user->name }}</span>
                                            <span class="text-sm text-gray-500">{{ $comment->created_at->format('M d, Y \p\u\k\u\l H:i') }}</span>
                                        </div>
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                            {{ $comment->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ ucfirst($comment->status === 'approved' ? 'Disetujui' : 'Tertunda') }}
                                        </span>
                                    </div>
                                    <p class="text-gray-700">{{ $comment->content }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="space-y-6">
                <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Postingan</h3>

                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd class="mt-1">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                    {{ $post->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($post->status === 'published' ? 'Diterbitkan' : 'Draf') }}
                                </span>
                            </dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500">Penulis</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $post->user->name }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500">Kategori</dt>
                            <dd class="mt-1">
                                @if($post->category)
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $post->category->name }}
                                    </span>
                                @else
                                    <span class="text-sm text-gray-400">Tanpa Kategori</span>
                                @endif
                            </dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500">Dibuat</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $post->created_at->format('M d, Y \p\u\k\u\l H:i') }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500">Terakhir Diubah</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $post->updated_at->format('M d, Y \p\u\k\u\l H:i') }}</dd>
                        </div>

                        @if($post->published_at)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Diterbitkan</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $post->published_at->format('M d, Y \p\u\k\u\l H:i') }}</dd>
                            </div>
                        @endif

                        <div>
                            <dt class="text-sm font-medium text-gray-500">Slug</dt>
                            <dd class="mt-1 text-sm text-gray-900 font-mono bg-gray-100 px-2 py-1 rounded">{{ $post->slug }}</dd>
                        </div>
                    </dl>
                </div>

                <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Aksi Cepat</h3>
                    
                    <div class="space-y-2">
                        <form action="{{ route('admin.posts.toggle-status', $post) }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                {{ $post->status === 'published' ? 'Batalkan Publikasi' : 'Publikasikan' }}
                            </button>
                        </form>

                        <form action="{{ route('admin.posts.duplicate', $post) }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                Duplikat Postingan
                            </button>
                        </form>

                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="w-full"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus postingan ini? Tindakan ini tidak dapat dibatalkan.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 border border-red-300 shadow-sm text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Hapus Postingan
                            </button>
                        </form>
                    </div>
                </div>

                @if($post->meta_title || $post->meta_description)
                    <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi SEO</h3>
                        
                        <dl class="space-y-3">
                            @if($post->meta_title)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Judul Meta</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $post->meta_title }}</dd>
                                </div>
                            @endif

                            @if($post->meta_description)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Deskripsi Meta</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $post->meta_description }}</dd>
                                </div>
                            @endif
                        </dl>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>