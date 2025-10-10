<x-layouts.app title="Laporan Kunjungan">
    <div class="bg-gray-50">
        <!-- Main Content -->
        <div class="mt-6">
            <!-- Header -->
            <x-slot:header>
                <div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div>
                                <h1 class="text-2xl sm:text-2xl font-bold text-gray-900">Laporan Kunjungan</h1>
                                <p class="text-gray-600 mt-1 text-sm">Lengkapi laporan kunjungan Anda</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <a href="{{ route('auditor.audit.index') }}"
                                class="inline-flex items-center justify-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </x-slot:header>

            <!-- Visit Info Card -->
            <div class="bg-white rounded-lg shadow-sm border overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Informasi Kunjungan
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Author -->
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 mt-1">
                                <div
                                    class="h-10 w-10 rounded-full bg-primary text-white flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Author yang dikunjungi</label>
                                <p class="text-sm font-medium text-gray-900 mt-1">{{ $audit->author->name }}
                                </p>
                                <p class="text-sm text-gray-500">{{ $audit->author->email }}</p>
                            </div>
                        </div>

                        <!-- Tanggal Kunjungan -->
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 mt-1">
                                <div
                                    class="h-10 w-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Tanggal Kunjungan</label>
                                <p class="text-sm text-gray-900 mt-1">
                                    {{ \Carbon\Carbon::parse($audit->tanggal)->format('d F Y') }}</p>
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="md:col-span-2 flex items-start space-x-3">
                            <div class="flex-shrink-0 mt-1">
                                <div
                                    class="h-10 w-10 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-500">Alamat Tujuan Kunjungan</label>
                                <div class="mt-1 p-3 bg-blue-50 rounded-lg border border-blue-200">
                                    <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $audit->alamat }}</p>
                                    <p class="text-xs text-blue-600 mt-1 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Pastikan Anda sudah sampai di alamat ini sebelum mengambil foto selfie
                                    </p>
                                </div>
                            </div>
                        </div>

                        @if ($audit->keterangan)
                            <div class="md:col-span-2 flex items-start space-x-3">
                                <div class="flex-shrink-0 mt-1">
                                    <div
                                        class="h-10 w-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-medium text-gray-500">Keterangan dari Admin</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $audit->keterangan }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Report Form -->
            <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Form Laporan Kunjungan
                    </h3>
                </div>

                <form action="{{ route('auditor.audit.store-report', $audit) }}" method="POST"
                    enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="p-6 space-y-8">
                        <!-- Hasil Kunjungan -->
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-6 border border-green-200">
                            <div class="flex items-start space-x-3 mb-4">
                                <div class="flex-shrink-0 mt-1">
                                    <div
                                        class="h-10 w-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <label for="hasil" class="block text-sm font-medium text-gray-700 mb-2">
                                        Hasil Kunjungan <span class="text-red-500">*</span>
                                    </label>
                                    <p class="text-xs text-gray-600 mb-3">Jelaskan hasil kunjungan Anda secara detail dan lengkap</p>
                                </div>
                            </div>
                            <textarea name="hasil" id="hasil" rows="6" required
                                placeholder="Contoh: Kunjungan berhasil dilakukan. Auditor telah bertemu dengan pemilik usaha dan melakukan verifikasi dokumen..."
                                class="w-full border border-green-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all resize-none">{{ old('hasil') }}</textarea>
                            @error('hasil')
                                <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Foto Selfie dengan Kamera -->
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-200">
                            <div class="flex items-start space-x-3 mb-4">
                                <div class="flex-shrink-0 mt-1">
                                    <div
                                        class="h-10 w-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <label for="selfie" class="block text-sm font-medium text-gray-700 mb-2">
                                        Foto Bukti Kunjungan (Selfie) <span class="text-red-500">*</span>
                                    </label>
                                    <p class="text-xs text-gray-600 mb-4 flex items-center gap-1">
                                        <svg class="w-3 h-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Gunakan kamera untuk mengambil foto selfie sebagai bukti kunjungan di lokasi
                                    </p>
                                </div>
                            </div>

                            <!-- Camera Controls -->
                            <div class="space-y-6">
                                <div class="flex flex-wrap items-center gap-3">
                                    <button type="button" onclick="startCamera()"
                                        class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-3 rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 flex items-center gap-2 shadow-lg hover:shadow-xl transform hover:scale-105">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span class="font-medium">Buka Kamera</span>
                                    </button>

                                    <button type="button" onclick="takePhoto()" id="take-photo"
                                        class="bg-gradient-to-r from-green-600 to-green-700 text-white px-6 py-3 rounded-xl hover:from-green-700 hover:to-green-800 transition-all duration-200 items-center gap-2 shadow-lg hover:shadow-xl transform hover:scale-105 hidden">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4"></path>
                                        </svg>
                                        <span class="font-medium">Ambil Foto</span>
                                    </button>

                                    <button type="button" onclick="retakePhoto()" id="retake-photo"
                                        class="bg-gradient-to-r from-yellow-600 to-orange-600 text-white px-6 py-3 rounded-xl hover:from-yellow-700 hover:to-orange-700 transition-all duration-200 items-center gap-2 shadow-lg hover:shadow-xl transform hover:scale-105 hidden">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                            </path>
                                        </svg>
                                        <span class="font-medium">Foto Ulang</span>
                                    </button>
                                </div>

                                <!-- Camera Video -->
                                <div id="camera-container" class="hidden">
                                    <div class="bg-white rounded-xl p-4 border-2 border-dashed border-blue-300">
                                        <video id="camera" autoplay playsinline
                                            class="w-full max-w-md mx-auto rounded-lg border-2 border-blue-200 shadow-lg"
                                            style="transform: scaleX(-1);"></video>
                                        <div class="text-center mt-3">
                                            <p class="text-sm text-gray-600 flex items-center justify-center gap-1">
                                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                    </path>
                                                </svg>
                                                Posisikan wajah Anda di tengah frame, lalu klik "Ambil Foto"
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Canvas for capturing photo (hidden) -->
                                <canvas id="canvas" class="hidden"></canvas>

                                <!-- Photo Preview -->
                                <div id="photo-preview" class="hidden">
                                    <div class="bg-white rounded-xl p-4 border-2 border-green-300">
                                        <img id="captured-photo" src="" alt="Captured Photo"
                                            class="max-w-md mx-auto rounded-lg border-2 border-green-200 shadow-lg">
                                        <div class="text-center mt-3">
                                            <p class="text-sm text-green-700 flex items-center justify-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Foto berhasil diambil! Klik "Foto Ulang" jika ingin mengambil lagi
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Hidden input for photo data -->
                            <input type="hidden" name="selfie" id="selfie-data" required>

                            @error('selfie')
                                <p class="text-red-500 text-sm mt-3 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Location Section -->
                        <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-6 border border-purple-200">
                            <div class="flex items-start space-x-3 mb-4">
                                <div class="flex-shrink-0 mt-1">
                                    <div
                                        class="h-10 w-10 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Lokasi Kunjungan <span class="text-red-500">*</span>
                                    </label>
                                    <p class="text-xs text-gray-600 mb-4 flex items-center gap-1">
                                        <svg class="w-3 h-3 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Klik tombol "Ambil Lokasi Saat Ini" untuk mendapatkan koordinat GPS lokasi Anda
                                    </p>
                                </div>
                            </div>

                            <div class="space-y-6">
                                <div class="flex flex-wrap items-center gap-3">
                                    <button type="button" onclick="getCurrentLocation()"
                                        class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-3 rounded-xl hover:from-purple-700 hover:to-pink-700 transition-all duration-200 flex items-center gap-2 shadow-lg hover:shadow-xl transform hover:scale-105">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span class="font-medium">Ambil Lokasi Saat Ini</span>
                                    </button>

                                    <div id="location-status" 
                                        class="text-sm text-gray-600 px-3 py-2 bg-white rounded-lg border border-purple-200 min-w-0 flex-1">
                                        <span class="italic">Belum ada lokasi yang diambil</span>
                                    </div>
                                </div>

                                <!-- Map Container -->
                                <div class="bg-white rounded-xl p-3 border-2 border-dashed border-purple-300">
                                    <div id="map" class="w-full h-64 rounded-lg border-2 border-purple-200 shadow-inner"></div>
                                </div>

                                <!-- Current Location Info -->
                                <div id="location-info" class="p-4 bg-green-50 rounded-xl border border-green-200 hidden">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <div>
                                            <p class="text-sm font-medium text-green-800">Lokasi berhasil diperoleh!</p>
                                            <p class="text-xs text-green-700">
                                                <strong>Koordinat:</strong> 
                                                <span id="current-coords" class="font-mono"></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden inputs for coordinates -->
                                <input type="hidden" name="lat" id="lat" required>
                                <input type="hidden" name="long" id="long" required>

                                @error('lat')
                                    <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                                @error('long')
                                    <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="px-6 py-6 bg-gradient-to-r from-gray-50 to-gray-100 border-t border-gray-200 flex justify-end space-x-4">
                        <a href="{{ route('auditor.audit.index') }}"
                            class="px-6 py-3 border-2 border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 flex items-center gap-2 font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Batal
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-gradient-to-r from-primary to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 flex items-center gap-2 shadow-lg hover:shadow-xl transform hover:scale-105 font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            Kirim Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let map;
        let currentMarker;
        let camera, canvas, context;
        let currentStream = null;
        let locationWatcher = null;

        // Initialize map
        function initMap() {
            // Default location (Jakarta)
            map = L.map('map').setView([-6.2088, 106.8456], 10);

            // Add tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);
        }

        // Get current location (manual trigger)
        function getCurrentLocation() {
            const statusEl = document.getElementById('location-status');
            statusEl.innerHTML = '<div class="flex items-center gap-2"><div class="animate-spin w-4 h-4 border-2 border-blue-500 border-t-transparent rounded-full"></div><span>Mengambil lokasi...</span></div>';
            statusEl.className = 'text-sm text-blue-600 px-3 py-2 bg-blue-50 rounded-lg border border-blue-200 min-w-0 flex-1';

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        
                        setLocation(lat, lng);
                        
                        statusEl.innerHTML = '<div class="flex items-center gap-2"><svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg><span>Lokasi berhasil diambil!</span></div>';
                        statusEl.className = 'text-sm text-green-700 px-3 py-2 bg-green-50 rounded-lg border border-green-200 min-w-0 flex-1';
                    },
                    function(error) {
                        statusEl.innerHTML = '<div class="flex items-center gap-2"><svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg><span>Gagal mengambil lokasi: ' + error.message + '</span></div>';
                        statusEl.className = 'text-sm text-red-700 px-3 py-2 bg-red-50 rounded-lg border border-red-200 min-w-0 flex-1';
                    },
                    {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0 // Always get fresh location
                    }
                );
            } else {
                statusEl.innerHTML = '<div class="flex items-center gap-2"><svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg><span>Geolocation tidak didukung browser ini</span></div>';
                statusEl.className = 'text-sm text-red-700 px-3 py-2 bg-red-50 rounded-lg border border-red-200 min-w-0 flex-1';
            }
        }

        // Set location on map
        function setLocation(lat, lng) {
            // Remove previous marker
            if (currentMarker) {
                map.removeLayer(currentMarker);
            }

            // Add new marker
            currentMarker = L.marker([lat, lng]).addTo(map);
            
            // Center map on location
            map.setView([lat, lng], 15);

            // Update form fields
            document.getElementById('lat').value = lat;
            document.getElementById('long').value = lng;

            // Show location info
            document.getElementById('current-coords').textContent = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
            document.getElementById('location-info').classList.remove('hidden');
        }

        // Camera Functions
        function startCamera() {
            camera = document.getElementById('camera');
            canvas = document.getElementById('canvas');
            context = canvas.getContext('2d');
            
            // Update location status
            const statusEl = document.getElementById('location-status');
            statusEl.textContent = 'Mengambil lokasi dan membuka kamera...';
            statusEl.className = 'text-sm text-blue-600';
            
            // Get location first, then camera
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        
                        // Set location on map
                        setLocation(lat, lng);
                        
                        statusEl.textContent = 'Lokasi berhasil diambil! Membuka kamera...';
                        statusEl.className = 'text-sm text-green-600';
                        
                        // Now open camera
                        openCameraStream();
                    },
                    function(error) {
                        statusEl.textContent = 'Gagal mengambil lokasi: ' + error.message + '. Mencoba membuka kamera...';
                        statusEl.className = 'text-sm text-orange-600';
                        
                        // Still try to open camera even if location fails
                        openCameraStream();
                    },
                    {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0 // Always get fresh location
                    }
                );
            } else {
                statusEl.textContent = 'Geolocation tidak didukung. Membuka kamera...';
                statusEl.className = 'text-sm text-orange-600';
                openCameraStream();
            }
        }

        // Separate function to open camera stream
        function openCameraStream() {
            navigator.mediaDevices.getUserMedia({ 
                video: { 
                    facingMode: 'user' // front camera for selfie
                } 
            })
            .then(function(stream) {
                currentStream = stream;
                camera.srcObject = stream;
                
                // Show camera and take photo button
                document.getElementById('camera-container').classList.remove('hidden');
                document.getElementById('take-photo').classList.remove('hidden');
                document.getElementById('take-photo').classList.add('flex');
                
                // Start live location tracking while camera is active
                startLiveLocationTracking();
                
                // Update status to show camera is ready
                const statusEl = document.getElementById('location-status');
                if (statusEl.className.includes('green')) {
                    statusEl.innerHTML = '<div class="flex items-center gap-2"><svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg><span>Lokasi dan kamera siap! (Live tracking aktif)</span></div>';
                } else {
                    statusEl.innerHTML = '<div class="flex items-center gap-2"><svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg><span>Kamera siap! (Lokasi mungkin tidak tersedia)</span></div>';
                    statusEl.className = 'text-sm text-blue-700 px-3 py-2 bg-blue-50 rounded-lg border border-blue-200 min-w-0 flex-1';
                }
            })
            .catch(function(error) {
                console.error('Error accessing camera:', error);
                alert('Tidak dapat mengakses kamera. Pastikan izin kamera sudah diberikan.');
                
                const statusEl = document.getElementById('location-status');
                statusEl.innerHTML = '<div class="flex items-center gap-2"><svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg><span>Gagal membuka kamera</span></div>';
                statusEl.className = 'text-sm text-red-700 px-3 py-2 bg-red-50 rounded-lg border border-red-200 min-w-0 flex-1';
            });
        }

        // Start live location tracking
        function startLiveLocationTracking() {
            if (navigator.geolocation) {
                locationWatcher = navigator.geolocation.watchPosition(
                    function(position) {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        const accuracy = position.coords.accuracy;
                        
                        // Update location on map
                        setLocation(lat, lng);
                        
                        // Update status with accuracy info
                        const statusEl = document.getElementById('location-status');
                        statusEl.innerHTML = `<div class="flex items-center gap-2"><div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div><span>Live tracking aktif (Akurasi: ${Math.round(accuracy)}m)</span></div>`;
                        statusEl.className = 'text-sm text-green-700 px-3 py-2 bg-green-50 rounded-lg border border-green-200 min-w-0 flex-1';
                    },
                    function(error) {
                        console.log('Live tracking error:', error);
                        // Don't show error for live tracking, just stop it
                        stopLiveLocationTracking();
                    },
                    {
                        enableHighAccuracy: true,
                        timeout: 5000,
                        maximumAge: 1000 // Update every 1 second
                    }
                );
            }
        }

        // Stop live location tracking
        function stopLiveLocationTracking() {
            if (locationWatcher) {
                navigator.geolocation.clearWatch(locationWatcher);
                locationWatcher = null;
            }
        }

        function takePhoto() {
            // Set canvas size to match video
            canvas.width = camera.videoWidth;
            canvas.height = camera.videoHeight;
            
            // Save the current context state
            context.save();
            
            // Flip the canvas horizontally to correct the mirrored preview
            context.scale(-1, 1);
            context.translate(-canvas.width, 0);
            
            // Draw the video frame to the canvas (this will correct the mirror effect)
            context.drawImage(camera, 0, 0, canvas.width, canvas.height);
            
            // Restore the context state
            context.restore();
            
            // Convert to blob and then to base64
            canvas.toBlob(function(blob) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const base64Data = e.target.result;
                    
                    // Store the base64 data
                    document.getElementById('selfie-data').value = base64Data;
                    
                    // Show preview
                    document.getElementById('captured-photo').src = base64Data;
                    document.getElementById('photo-preview').classList.remove('hidden');
                    
                    // Hide camera, show retake button
                    document.getElementById('camera-container').classList.add('hidden');
                    document.getElementById('take-photo').classList.add('hidden');
                    document.getElementById('take-photo').classList.remove('flex');
                    document.getElementById('retake-photo').classList.remove('hidden');
                    document.getElementById('retake-photo').classList.add('flex');
                    
                    // Stop camera stream and live tracking
                    if (currentStream) {
                        currentStream.getTracks().forEach(track => track.stop());
                    }
                    stopLiveLocationTracking();
                    
                    // Update status
                    const statusEl = document.getElementById('location-status');
                    statusEl.innerHTML = '<div class="flex items-center gap-2"><svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg><span>Foto berhasil diambil! Lokasi tersimpan.</span></div>';
                    statusEl.className = 'text-sm text-green-700 px-3 py-2 bg-green-50 rounded-lg border border-green-200 min-w-0 flex-1';
                };
                reader.readAsDataURL(blob);
            }, 'image/jpeg', 0.8);
        }

        function retakePhoto() {
            // Clear photo data
            document.getElementById('selfie-data').value = '';
            
            // Hide preview and retake button
            document.getElementById('photo-preview').classList.add('hidden');
            document.getElementById('retake-photo').classList.add('hidden');
            document.getElementById('retake-photo').classList.remove('flex');
            
            // Restart camera and location tracking
            startCamera();
        }

        // Initialize map when page loads
        document.addEventListener('DOMContentLoaded', function() {
            initMap();
        });
    </script>
</x-layouts.app>