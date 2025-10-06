<x-layouts.app title="Detail Kunjungan Audit">
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
                                    <h1 class="text-2xl sm:text-2xl font-bold text-gray-900">Detail Kunjungan Audit</h1>
                                    <p class="text-gray-600 mt-1 text-sm">Informasi lengkap kunjungan audit</p>
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

                <!-- Success Message -->
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Main Info -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Basic Information -->
                        <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
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
                            <div class="p-6 space-y-6">
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
                                            <label class="block text-sm font-medium text-gray-500">Author</label>
                                            <p class="text-sm font-medium text-gray-900 mt-1">{{ $audit->author->name }}
                                            </p>
                                            <p class="text-sm text-gray-500">{{ $audit->author->email }}</p>
                                        </div>
                                    </div>

                                    <!-- Auditor -->
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0 mt-1">
                                            <div
                                                class="h-10 w-10 rounded-full bg-green-500 text-white flex items-center justify-center">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500">Auditor</label>
                                            <p class="text-sm font-medium text-gray-900 mt-1">
                                                {{ $audit->auditor->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $audit->auditor->email }}</p>
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
                                            <label class="block text-sm font-medium text-gray-500">Tanggal
                                                Kunjungan</label>
                                            <p class="text-sm text-gray-900 mt-1">
                                                {{ \Carbon\Carbon::parse($audit->tanggal)->format('d F Y') }}</p>
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0 mt-1">
                                            <div
                                                class="h-10 w-10 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500">Status</label>
                                            <div class="mt-1">
                                                @if ($audit->status === 'pending')
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        Pending
                                                    </span>
                                                @elseif($audit->status === 'konfirmasi')
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        Konfirmasi
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        Selesai
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Alamat -->
                                <div class="flex items-start space-x-3">
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
                                        <label class="block text-sm font-medium text-gray-500">Alamat Tujuan
                                            Kunjungan</label>
                                        <div class="mt-1 p-3 bg-blue-50 rounded-lg border border-blue-200">
                                            <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $audit->alamat }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @if ($audit->keterangan)
                                    <div class="flex items-start space-x-3">
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
                                            <label class="block text-sm font-medium text-gray-500">Keterangan</label>
                                            <p class="mt-1 text-sm text-gray-900">{{ $audit->keterangan }}</p>
                                        </div>
                                    </div>
                                @endif

                                @if ($audit->status === 'pending' && $audit->rejection_reason)
                                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <h4 class="text-sm font-medium text-red-800">Laporan Ditolak</h4>
                                                <p class="mt-1 text-sm text-red-700">{{ $audit->rejection_reason }}</p>
                                                <p class="mt-2 text-xs text-red-600">Silakan perbaiki laporan Anda dan kirim
                                                    ulang.</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Report Information (if available) -->
                        @if ($audit->hasil || $audit->selfie)
                            <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                                    <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                        Laporan Kunjungan
                                    </h3>
                                </div>
                                <div class="p-6 space-y-6">
                                    @if ($audit->hasil)
                                        <div class="flex items-start space-x-3">
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
                                                <label class="block text-sm font-medium text-gray-500">Hasil
                                                    Kunjungan</label>
                                                <p class="mt-1 text-sm text-gray-900">{{ $audit->hasil }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($audit->lat && $audit->long)
                                        <div class="flex items-start space-x-3">
                                            <div class="flex-shrink-0 mt-1">
                                                <div
                                                    class="h-10 w-10 rounded-full bg-red-100 text-red-600 flex items-center justify-center">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
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
                                            <div class="flex-1">
                                                <label class="block text-sm font-medium text-gray-500">Koordinat
                                                    Lokasi</label>
                                                <p class="mt-1 text-sm text-gray-900">{{ $audit->lat }},
                                                    {{ $audit->long }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($audit->selfie)
                                        <div class="flex items-start space-x-3">
                                            <div class="flex-shrink-0 mt-1">
                                                <div
                                                    class="h-10 w-10 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                                        </path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                <label class="block text-sm font-medium text-gray-500">Foto
                                                    Bukti</label>
                                                <div class="mt-2">
                                                    <img src="{{ asset('storage/' . $audit->selfie) }}"
                                                        alt="Foto bukti kunjungan"
                                                        class="max-w-md rounded-lg border">
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Side Info -->
                    <div class="space-y-6">
                        <!-- Timeline -->
                        <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Timeline
                                </h3>
                            </div>
                            <div class="p-6">
                                <div class="flow-root">
                                    <ul class="mb-8 h-full">
                                        <li>
                                            <div class="relative pb-8">
                                                <div class="relative flex space-x-3">
                                                    <div>
                                                        <span
                                                            class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                                            <svg class="w-4 h-4 text-white" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                    <div class="min-w-0 flex-1 pt-1.5">
                                                        <div>
                                                            <p class="text-sm text-gray-500">Dibuat oleh admin</p>
                                                            <p class="text-xs text-gray-400">
                                                                {{ $audit->created_at->format('d M Y H:i') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                        @if ($audit->hasil)
                                            <li>
                                                <div class="relative pb-8">
                                                    <div class="relative flex space-x-3">
                                                        <div>
                                                            <span
                                                                class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                                                <svg class="w-4 h-4 text-white" fill="currentColor"
                                                                    viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd"
                                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                                        clip-rule="evenodd"></path>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                        <div class="min-w-0 flex-1 pt-1.5">
                                                            <div>
                                                                <p class="text-sm text-gray-500">Laporan disubmit
                                                                    auditor</p>
                                                                <p class="text-xs text-gray-400">
                                                                    {{ $audit->updated_at->format('d M Y H:i') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif

                                        @if ($audit->status === 'selesai')
                                            <li>
                                                <div>
                                                    <div class="relative flex space-x-3">
                                                        <div>
                                                            <span
                                                                class="h-8 w-8 rounded-full bg-primary flex items-center justify-center ring-8 ring-white">
                                                                <svg class="w-4 h-4 text-white" fill="currentColor"
                                                                    viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd"
                                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                                        clip-rule="evenodd"></path>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                        <div class="min-w-0 flex-1 pt-1.5">
                                                            <div>
                                                                <p class="text-sm text-gray-500">Di-ACC oleh admin</p>
                                                                <p class="text-xs text-gray-400">
                                                                    {{ $audit->updated_at->format('d M Y H:i') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Map (if coordinates available) -->
                        @if ($audit->lat && $audit->long)
                            <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                                    <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7">
                                            </path>
                                        </svg>
                                        Lokasi Kunjungan
                                    </h3>
                                </div>
                                <div class="p-6">
                                    <div id="map" class="w-full h-64 rounded-lg border"></div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($audit->lat && $audit->long)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize map
                const map = L.map('map').setView([{{ $audit->lat }}, {{ $audit->long }}], 15);

                // Add tile layer
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                // Add marker for the visit location
                L.marker([{{ $audit->lat }}, {{ $audit->long }}])
                    .addTo(map)
                    .bindPopup('<b>Lokasi Kunjungan</b><br>{{ $audit->author->name }}')
                    .openPopup();
            });
        </script>
    @endif
</x-layouts.app>