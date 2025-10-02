<x-layouts.app title="Kelola Postingan">
    <x-slot:header>
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Manajemen Postingan</h1>
                <p class="text-gray-600 mt-1">Kelola postingan dan artikel blog</p>
            </div>
            <a href="{{ route('user.posts.create') }}"
               class="inline-flex items-center px-4 py-2 bg-[#0046FF] hover:bg-[#0036D8] text-white rounded-md transition-colors duration-200 shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Postingan
            </a>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="mt-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="py-6">
        <div class="mb-6">
            <form action="{{ route('user.posts.search') }}" method="GET" class="flex gap-4">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input
                        type="text"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Cari postingan berdasarkan judul, konten, atau penulis..."
                        class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0046FF] focus:border-[#0046FF] sm:text-sm transition duration-200"
                    >
                </div>
                <button
                    type="submit"
                    class="inline-flex items-center px-6 py-3 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-[#0046FF] hover:bg-[#0036D8] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0046FF] transition duration-200"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Cari
                </button>
                @if(request('q'))
                    <a
                        href="{{ route('user.posts.index') }}"
                        class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0046FF] transition duration-200"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Bersihkan
                    </a>
                @endif
            </form>
        </div>

        <div class="bg-white shadow-sm rounded-lg border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">
                    Semua Postingan ({{ $posts->total() }})
                    @if(isset($query))
                        <span class="text-sm text-gray-500"> - Hasil pencarian untuk "{{ $query }}"</span>
                    @endif
                </h2>
            </div>

            @if($posts->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penulis</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diterbitkan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($posts as $post)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">
                                                    <a href="{{ route('user.posts.show', $post) }}" class="hover:text-primary">
                                                        {{ $post->title }}
                                                    </a>
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ Str::limit($post->excerpt, 50) }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $post->user->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @if($post->category)
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                {{ $post->category->name }}
                                            </span>
                                        @else
                                            <span class="text-gray-400">Tanpa Kategori</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                            {{ $post->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ ucfirst($post->status === 'published' ? 'Diterbitkan' : 'Draf') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $post->published_at ? $post->published_at->format('M d, Y') : '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="relative inline-block text-left">
                                            <div>
                                                <button
                                                    type="button"
                                                    class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
                                                    onclick="toggleDropdown({{ $post->id }})"
                                                >
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                                    </svg>
                                                </button>
                                            </div>

                                            <div
                                                id="dropdown-{{ $post->id }}"
                                                class="hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10"
                                            >
                                                <div class="py-1" role="menu">
                                                    <a
                                                        href="{{ route('user.posts.show', $post) }}"
                                                        class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                                        role="menuitem"
                                                    >
                                                        <svg class="w-4 h-4 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                        </svg>
                                                        Lihat Postingan
                                                    </a>

                                                    <a
                                                        href="{{ route('user.posts.edit', $post) }}"
                                                        class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                                        role="menuitem"
                                                    >
                                                        <svg class="w-4 h-4 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                        </svg>
                                                        Edit Postingan
                                                    </a>

                                                    <form action="{{ route('user.posts.toggle-status', $post) }}" method="POST" class="block">
                                                        @csrf
                                                        <button
                                                            type="submit"
                                                            class="flex items-center w-full px-4 py-2 text-sm text-left hover:bg-gray-100
                                                                {{ $post->status === 'published' ? 'text-orange-700 hover:text-orange-900' : 'text-green-700 hover:text-green-900' }}"
                                                            role="menuitem"
                                                        >
                                                            @if($post->status === 'published')
                                                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"></path>
                                                                </svg>
                                                                Batalkan Publikasi
                                                            @else
                                                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                                </svg>
                                                                Publikasikan
                                                            @endif
                                                        </button>
                                                    </form>

                                                    <form action="{{ route('user.posts.duplicate', $post) }}" method="POST" class="block">
                                                        @csrf
                                                        <button
                                                            type="submit"
                                                            class="flex items-center w-full px-4 py-2 text-sm text-blue-700 text-left hover:bg-gray-100 hover:text-blue-900"
                                                            role="menuitem"
                                                        >
                                                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                                            </svg>
                                                            Duplikat Postingan
                                                        </button>
                                                    </form>

                                                    <div class="border-t border-gray-100"></div>

                                                    <form action="{{ route('user.posts.destroy', $post) }}" method="POST" class="block"
                                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus postingan ini? Tindakan ini tidak dapat dibatalkan.')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            type="submit"
                                                            class="flex items-center w-full px-4 py-2 text-sm text-red-700 text-left hover:bg-red-50 hover:text-red-900"
                                                            role="menuitem"
                                                        >
                                                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                            </svg>
                                                            Hapus Postingan
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">
                        @if(isset($query))
                            Postingan tidak ditemukan untuk "{{ $query }}"
                        @else
                            Belum ada postingan
                        @endif
                    </h3>
                    <p class="text-gray-500 mb-6">
                        @if(isset($query))
                            Coba sesuaikan kata kunci pencarian Anda atau lihat semua postingan.
                        @else
                            Mulailah dengan membuat postingan blog pertama Anda.
                        @endif
                    </p>
                    @if(!isset($query))
                        <a href="{{ route('user.posts.create') }}"
                           class="inline-flex items-center px-4 py-2 bg-[#0046FF] hover:bg-[#0036D8] text-white rounded-md transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Buat Postingan Pertama
                        </a>
                    @else
                        <a href="{{ route('user.posts.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md transition-colors duration-200 mr-3">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Lihat Semua Postingan
                        </a>
                        <a href="{{ route('user.posts.create') }}"
                           class="inline-flex items-center px-4 py-2 bg-[#0046FF] hover:bg-[#0036D8] text-white rounded-md transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah Postingan
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <script>
        function toggleDropdown(postId) {
            const dropdown = document.getElementById('dropdown-' + postId);
            const allDropdowns = document.querySelectorAll('[id^="dropdown-"]');
            
            // Tutup semua dropdown lain
            allDropdowns.forEach(function(element) {
                if (element.id !== 'dropdown-' + postId) {
                    element.classList.add('hidden');
                }
            });
            
            // Toggle dropdown saat ini
            dropdown.classList.toggle('hidden');
        }

        // Tutup dropdown saat mengklik di luar
        document.addEventListener('click', function(event) {
            const allDropdowns = document.querySelectorAll('[id^="dropdown-"]');
            const isDropdownButton = event.target.closest('button[onclick^="toggleDropdown"]');
            
            if (!isDropdownButton && !event.target.closest('[id^="dropdown-"]')) {
                allDropdowns.forEach(function(dropdown) {
                    dropdown.classList.add('hidden');
                });
            }
        });

        // Tutup dropdown dengan tombol Escape
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const allDropdowns = document.querySelectorAll('[id^="dropdown-"]');
                allDropdowns.forEach(function(dropdown) {
                    dropdown.classList.add('hidden');
                });
            }
        });
    </script>
</x-layouts.app>