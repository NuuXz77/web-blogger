<x-layouts.app title="Edit Kunjungan Audit">
    <div class="min-h-screen bg-gray-50">
        <!-- Main Content -->
        <div class="flex-1">
            <div class="max-w-5xl mt-6">
                <!-- Header -->
                <x-slot:header>
                    <div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div>
                                    <h1 class="text-2xl sm:text-2xl font-bold text-gray-900">Edit Kunjungan Audit</h1>
                                    <p class="text-gray-600 mt-1 text-sm">Perbarui informasi kunjungan audit</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3">
                                <a href="{{ route('admin.audit.show', $audit) }}"
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

                <div class="grid grid-cols-1 gap-6">
                    <!-- Main Form Content -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Basic Information Form -->
                        <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                    Edit Informasi Kunjungan
                                </h3>
                            </div>
                            
                            <form action="{{ route('admin.audit.update', $audit) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="p-6 space-y-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- Author Selection -->
                                        <div class="flex items-start space-x-3">
                                            <div class="flex-shrink-0 mt-1">
                                                <div class="h-10 w-10 rounded-full bg-primary text-white flex items-center justify-center">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                <label for="author_id" class="block text-sm font-medium text-gray-500 mb-2">
                                                    Author yang akan dikunjungi <span class="text-red-500">*</span>
                                                </label>
                                                <select name="author_id" id="author_id" required
                                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                                                    <option value="">Pilih Author</option>
                                                    @foreach ($authors as $author)
                                                        <option value="{{ $author->id }}"
                                                            {{ old('author_id', $audit->author_id) == $author->id ? 'selected' : '' }}>
                                                            {{ $author->name }} ({{ $author->email }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('author_id')
                                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Auditor Selection -->
                                        <div class="flex items-start space-x-3">
                                            <div class="flex-shrink-0 mt-1">
                                                <div class="h-10 w-10 rounded-full bg-green-500 text-white flex items-center justify-center">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                <label for="auditor_id" class="block text-sm font-medium text-gray-500 mb-2">
                                                    Auditor yang ditugaskan <span class="text-red-500">*</span>
                                                </label>
                                                <select name="auditor_id" id="auditor_id" required
                                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                                                    <option value="">Pilih Auditor</option>
                                                    @foreach ($auditors as $auditor)
                                                        <option value="{{ $auditor->id }}"
                                                            {{ old('auditor_id', $audit->auditor_id) == $auditor->id ? 'selected' : '' }}>
                                                            {{ $auditor->name }} ({{ $auditor->email }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('auditor_id')
                                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Tanggal Kunjungan -->
                                        <div class="flex items-start space-x-3">
                                            <div class="flex-shrink-0 mt-1">
                                                <div class="h-10 w-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                <label for="tanggal" class="block text-sm font-medium text-gray-500 mb-2">
                                                    Tanggal Kunjungan <span class="text-red-500">*</span>
                                                </label>
                                                <input type="date" name="tanggal" id="tanggal" required
                                                    value="{{ old('tanggal', $audit->tanggal) }}"
                                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                                                @error('tanggal')
                                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Status -->
                                        <div class="flex items-start space-x-3">
                                            <div class="flex-shrink-0 mt-1">
                                                <div class="h-10 w-10 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                <label for="status" class="block text-sm font-medium text-gray-500 mb-2">
                                                    Status
                                                </label>
                                                <select name="status" id="status"
                                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                                                    <option value="pending"
                                                        {{ old('status', $audit->status) == 'pending' ? 'selected' : '' }}>
                                                        Pending
                                                    </option>
                                                    <option value="confirmed_by_author"
                                                        {{ old('status', $audit->status) == 'confirmed_by_author' ? 'selected' : '' }}>
                                                        Dikonfirmasi (Author)
                                                    </option>
                                                    <option value="confirmed_by_admin"
                                                        {{ old('status', $audit->status) == 'confirmed_by_admin' ? 'selected' : '' }}>
                                                        Dikonfirmasi (Admin)
                                                    </option>
                                                    <option value="completed"
                                                        {{ old('status', $audit->status) == 'completed' ? 'selected' : '' }}>
                                                        Selesai
                                                    </option>
                                                </select>
                                                @error('status')
                                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Alamat Lengkap -->
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0 mt-1">
                                            <div class="h-10 w-10 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                    </path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <label for="alamat" class="block text-sm font-medium text-gray-500 mb-2">
                                                Alamat Tujuan Kunjungan <span class="text-red-500">*</span>
                                            </label>
                                            <div class="mt-1 p-3 bg-blue-50 rounded-lg border border-blue-200">
                                                <textarea name="alamat" id="alamat" rows="4" required
                                                    placeholder="Masukkan alamat lengkap yang akan dikunjungi auditor"
                                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary focus:border-transparent transition-colors bg-white">{{ old('alamat', $audit->alamat) }}</textarea>
                                            </div>
                                            @error('alamat')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    @if ($audit->keterangan || old('keterangan'))
                                        <!-- Keterangan -->
                                        <div class="flex items-start space-x-3">
                                            <div class="flex-shrink-0 mt-1">
                                                <div class="h-10 w-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                <label for="keterangan" class="block text-sm font-medium text-gray-500 mb-2">
                                                    Keterangan Tambahan
                                                </label>
                                                <textarea name="keterangan" id="keterangan" rows="4"
                                                    placeholder="Catatan dari admin (misal: kunjungan audit, sosialisasi, dll)"
                                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">{{ old('keterangan', $audit->keterangan) }}</textarea>
                                                @error('keterangan')
                                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Current Report Information (if available) -->
                                @if ($audit->hasil || $audit->selfie)
                                    <div class="mt-8 p-6 bg-gray-50 rounded-lg border">
                                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                            Laporan yang Sudah Ada
                                        </h3>

                                        <div class="space-y-4">
                                            @if ($audit->hasil)
                                                <div class="flex items-start space-x-3">
                                                    <div class="flex-shrink-0 mt-1">
                                                        <div
                                                            class="h-8 w-8 rounded-full bg-green-100 text-green-600 flex items-center justify-center">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <div class="flex-1">
                                                        <label class="block text-sm font-medium text-gray-700">Hasil
                                                            Kunjungan</label>
                                                        <p
                                                            class="mt-1 text-sm text-gray-900 bg-white p-3 rounded border">
                                                            {{ $audit->hasil }}</p>
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($audit->lat && $audit->long)
                                                <div class="flex items-start space-x-3">
                                                    <div class="flex-shrink-0 mt-1">
                                                        <div
                                                            class="h-8 w-8 rounded-full bg-red-100 text-red-600 flex items-center justify-center">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                                </path>
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <div class="flex-1">
                                                        <label
                                                            class="block text-sm font-medium text-gray-700">Koordinat
                                                            Lokasi</label>
                                                        <p
                                                            class="mt-1 text-sm text-gray-900 bg-white p-3 rounded border">
                                                            {{ $audit->lat }}, {{ $audit->long }}</p>
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($audit->selfie)
                                                <div class="flex items-start space-x-3">
                                                    <div class="flex-shrink-0 mt-1">
                                                        <div
                                                            class="h-8 w-8 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <div class="flex-1">
                                                        <label class="block text-sm font-medium text-gray-700">Foto
                                                            Bukti</label>
                                                        <div class="mt-2">
                                                            <img src="{{ asset('storage/' . $audit->selfie) }}"
                                                                alt="Foto bukti kunjungan"
                                                                class="max-w-sm rounded-lg border shadow-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="mt-4 bg-blue-50 border border-blue-200 rounded-lg p-4">
                                            <div class="flex items-start space-x-3">
                                                <svg class="flex-shrink-0 h-5 w-5 text-blue-400 mt-0.5"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                <div class="flex-1">
                                                    <p class="text-sm text-blue-700">
                                                        <strong>Note:</strong> Laporan ini telah disubmit oleh auditor.
                                                        Mengedit data di atas tidak akan mengubah laporan yang sudah
                                                        ada.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Submit Buttons -->
                            <div
                                class="px-6 py-4 bg-gray-50 border-t flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4">
                                <a href="{{ route('admin.audit.show', $audit) }}"
                                    class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors text-center flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Batal
                                </a>
                                <button type="submit"
                                    class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Perbarui Kunjungan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Side Info -->
                <div class="space-y-6">
                    <!-- Current Report Information (if available) -->
                    @if ($audit->hasil || $audit->selfie)
                        <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    Laporan yang Sudah Ada
                                </h3>
                            </div>
                            
                            <div class="p-6 space-y-6">
                                @if ($audit->hasil)
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0 mt-1">
                                            <div class="h-8 w-8 rounded-full bg-green-100 text-green-600 flex items-center justify-center">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <label class="block text-sm font-medium text-gray-500">Hasil Kunjungan</label>
                                            <p class="mt-1 text-sm text-gray-900 bg-gray-50 p-3 rounded border">
                                                {{ $audit->hasil }}
                                            </p>
                                        </div>
                                    </div>
                                @endif

                                @if ($audit->lat && $audit->long)
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0 mt-1">
                                            <div class="h-8 w-8 rounded-full bg-red-100 text-red-600 flex items-center justify-center">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                    </path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <label class="block text-sm font-medium text-gray-500">Koordinat Lokasi</label>
                                            <p class="mt-1 text-sm text-gray-900 bg-gray-50 p-3 rounded border">
                                                {{ $audit->lat }}, {{ $audit->long }}
                                            </p>
                                        </div>
                                    </div>
                                @endif

                                @if ($audit->selfie)
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0 mt-1">
                                            <div class="h-8 w-8 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                                    </path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <label class="block text-sm font-medium text-gray-500">Foto Bukti</label>
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $audit->selfie) }}" alt="Foto bukti kunjungan"
                                                    class="w-full h-48 object-cover rounded-lg border border-gray-200">
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                    <div class="flex items-start space-x-3">
                                        <svg class="flex-shrink-0 h-5 w-5 text-blue-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <div class="flex-1">
                                            <p class="text-sm text-blue-700">
                                                <strong>Note:</strong> Laporan ini telah disubmit oleh auditor. Mengedit data di atas tidak akan mengubah laporan yang sudah ada.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Status Timeline -->
                    <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Status Kunjungan
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-center">
                                @if($audit->status === 'pending')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Menunggu Konfirmasi Author
                                    </span>
                                @elseif($audit->status === 'confirmed_by_author')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Menunggu Persetujuan Admin
                                    </span>
                                @elseif($audit->status === 'confirmed_by_admin')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Sedang Berlangsung
                                    </span>
                                @elseif($audit->status === 'in_progress')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-sky-100 text-sky-800">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Dalam Proses
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Selesai
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
