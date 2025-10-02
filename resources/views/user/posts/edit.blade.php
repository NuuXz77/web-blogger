<x-layouts.app title="Edit Postingan">
    <x-slot:header>
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ __('Edit Postingan') }}:
                    {{ Str::limit($post->title, 50) }}</h1>
                <p class="text-gray-600 mt-1">Perbarui informasi postingan</p>
            </div>
            <h2 class="text-xl font-semibold text-gray-800">


            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('user.posts.show', $post) }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:bg-gray-600 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                    Lihat Postingan
                </a>
                <a href="{{ route('user.posts.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Postingan
                </a>
            </div>
        </div>
    </x-slot>

    <div>
        <form action="{{ route('user.posts.update', $post) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6">
                        <div class="space-y-4">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                        Judul *
                                    </span>
                                </label>
                                <div class="relative">
                                    <input type="text" name="title" id="title"
                                        value="{{ old('title', $post->title) }}"
                                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm @error('title') border-red-300 focus:ring-red-500 focus:border-red-300 @enderror transition duration-200"
                                        placeholder="Masukkan judul yang menarik untuk postingan Anda" required>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                @error('title')
                                    <p class="mt-2 flex items-center text-sm text-red-600">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                                            </path>
                                        </svg>
                                        Slug *
                                    </span>
                                </label>
                                <div class="relative">
                                    <input type="text" name="slug" id="slug"
                                        value="{{ old('slug', $post->slug) }}"
                                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm @error('slug') border-red-300 focus:ring-red-500 focus:border-red-300 @enderror transition duration-200"
                                        placeholder="post-slug" required>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <p class="mt-1 text-xs text-gray-500 flex items-center">
                                    <svg class="w-3 h-3 mr-1 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Versi judul yang ramah-URL. Gunakan hanya huruf kecil, angka, dan tanda hubung
                                </p>
                                @error('slug')
                                    <p class="mt-2 flex items-center text-sm text-red-600">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                            </path>
                                        </svg>
                                        Kategori
                                    </span>
                                </label>
                                <div class="relative">
                                    <select name="category_id" id="category_id"
                                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm @error('category_id') border-red-300 focus:ring-red-500 focus:border-red-300 @enderror transition duration-200">
                                        <option value="">Pilih kategori (opsional)</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}
                                                data-color="{{ $category->color }}">
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                                <p class="mt-1 text-xs text-gray-500 flex items-center">
                                    <svg class="w-3 h-3 mr-1 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Atur postingan Anda dengan memilih kategori
                                </p>
                                @error('category_id')
                                    <p class="mt-2 flex items-center text-sm text-red-600">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6">
                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    Konten *
                                </span>
                            </label>
                            <div class="relative">
                                <textarea name="content" id="content" rows="15"
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm resize-vertical @error('content') border-red-300 focus:ring-red-500 focus:border-red-300 @enderror transition duration-200"
                                    placeholder="Perbarui konten Anda di sini... 

Anda dapat mengubah paragraf, menambahkan bagian baru, memperbarui daftar, kutipan, dan memformat konten sesuai kebutuhan. Ini akan menjadi badan utama dari postingan blog Anda yang akan dilihat pembaca."
                                    required>{{ old('content', $post->content) }}</textarea>
                                <div class="absolute top-3 right-3">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            @error('content')
                                <p class="mt-2 flex items-center text-sm text-red-600">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6">
                        <div>
                            <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 12h8m-8 6h16"></path>
                                    </svg>
                                    Kutipan
                                </span>
                            </label>
                            <div class="relative">
                                <textarea name="excerpt" id="excerpt" rows="3"
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm resize-vertical @error('excerpt') border-red-300 focus:ring-red-500 focus:border-red-300 @enderror transition duration-200"
                                    placeholder="Ringkasan singkat dari postingan... Ini akan muncul di pratinjau postingan dan hasil pencarian.">{{ old('excerpt', $post->excerpt) }}</textarea>
                                <div class="absolute top-3 right-3">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 12h8m-8 6h16"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="mt-1 text-xs text-gray-500 flex items-center">
                                <svg class="w-3 h-3 mr-1 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Biarkan kosong untuk dibuat secara otomatis dari konten. Digunakan dalam pratinjau
                                postingan dan deskripsi meta
                            </p>
                            @error('excerpt')
                                <p class="mt-2 flex items-center text-sm text-red-600">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Pengaturan Publikasi</h3>

                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                        </path>
                                    </svg>
                                    Status Publikasi
                                </span>
                            </label>
                            <div class="relative">
                                <select name="status" id="status"
                                    class="block w-full pl-10 pr-10 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm @error('status') border-red-300 focus:ring-red-500 focus:border-red-300 @enderror transition duration-200 appearance-none bg-white">
                                    <option value="draft"
                                        {{ old('status', $post->status) === 'draft' ? 'selected' : '' }}>
                                        📝 Draf - Simpan untuk nanti
                                    </option>
                                    <option value="published"
                                        {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>
                                        🚀 Diterbitkan - Tayang sekarang
                                    </option>
                                </select>
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                        </path>
                                    </svg>
                                </div>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                            @error('status')
                                <p class="mt-2 flex items-center text-sm text-red-600">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4 p-3 bg-gray-50 rounded-md">
                            <p class="text-sm text-gray-600">
                                <span class="font-medium">Status Saat Ini:</span>
                                <span
                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                    {{ $post->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($post->status) }}
                                </span>
                            </p>
                            @if ($post->published_at)
                                <p class="text-sm text-gray-600 mt-1">
                                    <span class="font-medium">Diterbitkan:</span>
                                    {{ $post->published_at->format('M d, Y \p\u\k\u\l H:i') }}
                                </p>
                            @endif
                        </div>

                        <div class="space-y-3">
                            <button type="submit" name="action" value="save"
                                class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent shadow-lg text-sm font-medium rounded-lg text-white bg-gradient-to-r from-primary to-blue-600 hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transform hover:scale-105 transition duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                                    </path>
                                </svg>
                                Perbarui Postingan
                            </button>
                            <button type="submit" name="action" value="save_and_continue"
                                class="w-full inline-flex justify-center items-center px-6 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Perbarui & Lanjutkan Mengedit
                            </button>
                        </div>
                    </div>

                    <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Gambar Unggulan</h3>

                        @if ($post->featured_image)
                            <div class="mb-4">
                                <p class="text-sm text-gray-600 mb-2">Gambar Saat Ini:</p>
                                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
                                    class="w-full h-32 object-cover rounded-lg">
                            </div>
                        @endif

                        <div>
                            <label for="featured_image" class="block text-sm font-medium text-gray-700">
                                {{ $post->featured_image ? 'Ganti Gambar' : 'Unggah Gambar' }}
                            </label>
                            <input type="file" name="featured_image" id="featured_image" accept="image/*"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-primary file:text-white hover:file:bg-blue-700 @error('featured_image') border-red-300 @enderror">
                            <p class="mt-1 text-sm text-gray-500">Ukuran maks: 2MB. Format: JPG, PNG, GIF</p>
                            @error('featured_image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Pengaturan SEO</h3>

                        <div class="space-y-4">
                            <div>
                                <label for="meta_title" class="block text-sm font-medium text-gray-700">Judul
                                    Meta</label>
                                <input type="text" name="meta_title" id="meta_title"
                                    value="{{ old('meta_title', $post->meta_title) }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm @error('meta_title') border-red-300 @enderror"
                                    placeholder="Biarkan kosong untuk menggunakan judul postingan">
                                @error('meta_title')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="meta_description"
                                    class="block text-sm font-medium text-gray-700">Deskripsi Meta</label>
                                <textarea name="meta_description" id="meta_description" rows="3"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm @error('meta_description') border-red-300 @enderror"
                                    placeholder="Biarkan kosong untuk menggunakan kutipan">{{ old('meta_description', $post->meta_description) }}</textarea>
                                @error('meta_description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Postingan</h3>

                        <dl class="space-y-2 text-sm">
                            <div>
                                <dt class="font-medium text-gray-500">Penulis:</dt>
                                <dd class="text-gray-900">{{ $post->user->name }}</dd>
                            </div>
                            <div>
                                <dt class="font-medium text-gray-500">Dibuat:</dt>
                                <dd class="text-gray-900">{{ $post->created_at->format('M d, Y \p\u\k\u\l H:i') }}
                                </dd>
                            </div>
                            <div>
                                <dt class="font-medium text-gray-500">Terakhir Diubah:</dt>
                                <dd class="text-gray-900">{{ $post->updated_at->format('M d, Y \p\u\k\u\l H:i') }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Auto-generate slug from title (only if slug field is empty or matches old title)
        const titleField = document.getElementById('title');
        const slugField = document.getElementById('slug');
        const originalTitle = "{{ $post->title }}";
        const originalSlug = "{{ $post->slug }}";

        titleField.addEventListener('input', function() {
            const title = this.value;
            const currentSlug = slugField.value;

            // Only auto-generate if slug is empty or still matches the original pattern
            if (title && (!currentSlug || currentSlug === originalSlug)) {
                fetch(`{{ route('user.posts.generate-slug') }}?title=${encodeURIComponent(title)}`)
                    .then(response => response.json())
                    .then(data => {
                        slugField.value = data.slug;
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    </script>
</x-layouts.app>
