<x-layouts.app title="Buat Kunjungan Audit">
    <div class="min-h-screen">
        <div class="flex">

            <!-- Main Content -->
            <div class="flex-1">
                <div class="max-w-5xl mx-auto">
                    <x-slot:header>
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div>
                                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                                    Formulir Kunjungan Audit
                                </h2>
                                <p class="text-sm text-gray-500 mt-1">
                                    Lengkapi informasi kunjungan audit dengan detail yang
                                akurat
                                </p>
                            </div>
                            <div class="flex items-center mt-4 md:mt-0">
                                <a href="{{ route('admin.audit.index') }}"
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
                    </x-slot:header>

                    <!-- Form -->
                    <div class="mt-6 bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                        {{-- <div class="px-6 py-4">
                            <h2 class="text-xl font-semibold flex items-center gap-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Formulir Kunjungan Audit
                            </h2>
                            <p class="text-blue-800 text-sm mt-1">Lengkapi informasi kunjungan audit dengan detail yang
                                akurat</p>
                        </div> --}}

                        <form action="{{ route('admin.audit.store') }}" method="POST">
                            @csrf

                            <div class="p-8">
                                <!-- Section 1: Informasi Peserta -->
                                <div class="mb-8">
                                    <div class="flex items-center gap-3 mb-6">
                                        <div
                                            class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900">Informasi Peserta</h3>
                                            <p class="text-sm text-gray-500">Pilih author dan auditor untuk kunjungan
                                            </p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                        <!-- Author Selection -->
                                        <div class="space-y-2 input-group">
                                            <label for="author_id"
                                                class="input-label flex items-center gap-2 text-sm font-medium text-gray-700">
                                                <svg class="input-icon w-4 h-4 text-blue-500 transition-all duration-200"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                    </path>
                                                </svg>
                                                Author yang akan dikunjungi
                                                <span class="text-red-500">*</span>
                                            </label>
                                            <div class="relative">
                                                <select name="author_id" id="author_id" required
                                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 pl-12 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white">
                                                    <option value="">Pilih Author</option>
                                                    @foreach ($authors as $author)
                                                        <option value="{{ $author->id }}"
                                                            {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                                            {{ $author->name }} ({{ $author->email }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div
                                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </div>
                                            @error('author_id')
                                                <p class="text-red-500 text-sm flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>

                                        <!-- Auditor Selection -->
                                        <div class="space-y-2 input-group">
                                            <label for="auditor_id"
                                                class="input-label flex items-center gap-2 text-sm font-medium text-gray-700">
                                                <svg class="input-icon w-4 h-4 text-green-500 transition-all duration-200"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Auditor yang ditugaskan
                                                <span class="text-red-500">*</span>
                                            </label>
                                            <div class="relative">
                                                <select name="auditor_id" id="auditor_id" required
                                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 pl-12 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors bg-white">
                                                    <option value="">Pilih Auditor</option>
                                                    @foreach ($auditors as $auditor)
                                                        <option value="{{ $auditor->id }}"
                                                            {{ old('auditor_id') == $auditor->id ? 'selected' : '' }}>
                                                            {{ $auditor->name }} ({{ $auditor->email }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div
                                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            @error('auditor_id')
                                                <p class="text-red-500 text-sm flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Section 2: Informasi Kunjungan -->
                                <div class="mb-8">
                                    <div class="flex items-center gap-3 mb-6">
                                        <div
                                            class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4v1a3 3 0 006 0v-1m6 0a2 2 0 100-4H6a2 2 0 100 4h12zM13 17h8m0 0V9m0 8l-8-8-4 4-6-6">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900">Detail Kunjungan</h3>
                                            <p class="text-sm text-gray-500">Tentukan waktu dan lokasi kunjungan</p>
                                        </div>
                                    </div>

                                    <div class="space-y-6">
                                        <!-- Tanggal Kunjungan -->
                                        <div class="space-y-2 input-group">
                                            <label for="tanggal"
                                                class="input-label flex items-center gap-2 text-sm font-medium text-gray-700">
                                                <svg class="input-icon w-4 h-4 text-orange-500 transition-all duration-200"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4v1a3 3 0 006 0v-1m6 0a2 2 0 100-4H6a2 2 0 100 4h12zM13 17h8m0 0V9m0 8l-8-8-4 4-6-6">
                                                    </path>
                                                </svg>
                                                Tanggal Kunjungan
                                                <span class="text-red-500">*</span>
                                            </label>
                                            <div class="relative">
                                                <input type="date" name="tanggal" id="tanggal" required
                                                    value="{{ old('tanggal') }}" min="{{ date('Y-m-d') }}"
                                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 pl-12 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors">
                                                <div
                                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4v1a3 3 0 006 0v-1m6 0a2 2 0 100-4H6a2 2 0 100 4h12zM13 17h8m0 0V9m0 8l-8-8-4 4-6-6">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </div>
                                            @error('tanggal')
                                                <p class="text-red-500 text-sm flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Section 3: Lokasi & Catatan -->
                                <div class="mb-8">
                                    <div class="flex items-center gap-3 mb-6">
                                        <div
                                            class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900">Lokasi & Catatan</h3>
                                            <p class="text-sm text-gray-500">Alamat tujuan dan informasi tambahan</p>
                                        </div>
                                    </div>

                                    <div class="space-y-6">
                                        <!-- Alamat Lengkap -->
                                        <div class="space-y-2">
                                            <label for="alamat"
                                                class="flex items-center gap-2 text-sm font-medium text-gray-700">
                                                <svg class="w-4 h-4 text-red-500" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                    </path>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                Alamat Lengkap yang Akan Dikunjungi
                                                <span class="text-red-500">*</span>
                                            </label>
                                            <div class="relative">
                                                <textarea name="alamat" id="alamat" rows="4" required
                                                    placeholder="Contoh: Jl. Merdeka No. 123, RT/RW 01/02, Kelurahan Merdeka, Kecamatan Pusat, Kota Jakarta, 12345"
                                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 pl-12 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors resize-none">{{ old('alamat') }}</textarea>
                                                <div
                                                    class="absolute top-3 left-0 pl-3 flex items-center pointer-events-none">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                        </path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                                                <div class="flex items-start gap-2">
                                                    <svg class="w-4 h-4 text-blue-500 mt-0.5 flex-shrink-0"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                        </path>
                                                    </svg>
                                                    <p class="text-sm text-blue-700">
                                                        <strong>Tips:</strong> Alamat ini akan menjadi panduan auditor
                                                        untuk menuju lokasi kunjungan. Pastikan alamat lengkap, akurat,
                                                        dan mudah ditemukan.
                                                    </p>
                                                </div>
                                            </div>
                                            @error('alamat')
                                                <p class="text-red-500 text-sm flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>

                                        <!-- Keterangan -->
                                        <div class="space-y-2">
                                            <label for="keterangan"
                                                class="flex items-center gap-2 text-sm font-medium text-gray-700">
                                                <svg class="w-4 h-4 text-gray-500" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                                Keterangan Tambahan
                                                <span class="text-gray-400 text-xs">(Opsional)</span>
                                            </label>
                                            <div class="relative">
                                                <textarea name="keterangan" id="keterangan" rows="3"
                                                    placeholder="Contoh: Kunjungan audit rutin, sosialisasi program baru, atau catatan khusus lainnya"
                                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 pl-12 focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-colors resize-none">{{ old('keterangan') }}</textarea>
                                                <div
                                                    class="absolute top-3 left-0 pl-3 flex items-center pointer-events-none">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </div>
                                            @error('keterangan')
                                                <p class="text-red-500 text-sm flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Buttons -->
                            <div
                                class="px-8 py-6 bg-gradient-to-r from-gray-50 to-gray-100 border-t border-gray-200 flex justify-end space-x-4">
                                <a href="{{ route('admin.audit.index') }}"
                                    class="inline-flex items-center gap-2 px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-white hover:shadow-md transition-all duration-200 font-medium">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Batal
                                </a>
                                <button type="submit"
                                    class="inline-flex items-center gap-2 px-8 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-200 font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Buat Kunjungan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom animations */
        .form-section {
            opacity: 0;
            transform: translateY(20px);
            animation: slideInUp 0.6s ease-out forwards;
        }

        .form-section:nth-child(1) {
            animation-delay: 0.1s;
        }

        .form-section:nth-child(2) {
            animation-delay: 0.2s;
        }

        .form-section:nth-child(3) {
            animation-delay: 0.3s;
        }

        @keyframes slideInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Focus states */
        .input-group:focus-within .input-icon {
            color: #3B82F6;
            transform: scale(1.1);
        }

        .input-group:focus-within .input-label {
            color: #3B82F6;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add form sections class for animation
            document.querySelectorAll('.mb-8').forEach((section, index) => {
                section.classList.add('form-section');
            });

            // Auto-resize textareas
            document.querySelectorAll('textarea').forEach(textarea => {
                textarea.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = (this.scrollHeight) + 'px';
                });
            });

            // Form validation feedback
            const form = document.querySelector('form');
            const submitButton = form.querySelector('button[type="submit"]');

            form.addEventListener('input', function() {
                const requiredFields = form.querySelectorAll('[required]');
                let allValid = true;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        allValid = false;
                    }
                });

                if (allValid) {
                    submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
                    submitButton.disabled = false;
                } else {
                    submitButton.classList.add('opacity-50', 'cursor-not-allowed');
                    submitButton.disabled = true;
                }
            });

            // Initial check
            form.dispatchEvent(new Event('input'));

            // Add loading state on form submit
            form.addEventListener('submit', function() {
                submitButton.innerHTML = `
                    <svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Memproses...
                `;
                submitButton.disabled = true;
            });
        });
    </script>
</x-layouts.app>
