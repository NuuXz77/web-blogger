<x-layouts.app title="Detail Audit">
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
                                    <h1 class="text-2xl sm:text-2xl font-bold text-gray-900">Detail Audit</h1>
                                    <p class="text-gray-600 mt-1 text-sm">Informasi lengkap jadwal audit Anda</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3">
                                <a href="{{ route('user.audit.index') }}"
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

                <!-- Error Message -->
                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        {{ session('error') }}
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
                                    Informasi Audit
                                </h3>
                            </div>
                            <div class="p-6 space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                                            <label class="block text-sm font-medium text-gray-500">Auditor yang Ditugaskan</label>
                                            <p class="text-sm font-medium text-gray-900 mt-1">
                                                {{ $audit->auditor->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $audit->auditor->email }}</p>
                                        </div>
                                    </div>

                                    <!-- Tanggal Audit -->
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
                                                Audit</label>
                                            <p class="text-sm text-gray-900 mt-1">
                                                {{ \Carbon\Carbon::parse($audit->tanggal)->format('d F Y') }}
                                                @if(\Carbon\Carbon::parse($audit->tanggal)->isToday())
                                                    <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        Hari ini
                                                    </span>
                                                @elseif(\Carbon\Carbon::parse($audit->tanggal)->isTomorrow())
                                                    <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                        Besok
                                                    </span>
                                                @elseif(\Carbon\Carbon::parse($audit->tanggal)->isPast())
                                                    <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                        Lewat
                                                    </span>
                                                @endif
                                            </p>
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
                                                        Menunggu Konfirmasi Anda
                                                    </span>
                                                @elseif($audit->status === 'konfirmasi')
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        Dalam Proses
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

                                    <!-- Created Date -->
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0 mt-1">
                                            <div
                                                class="h-10 w-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500">Dibuat Tanggal</label>
                                            <p class="text-sm text-gray-900 mt-1">
                                                {{ $audit->created_at->format('d F Y, H:i') }}
                                            </p>
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
                                        <label class="block text-sm font-medium text-gray-500">Alamat Audit</label>
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
                                            <label class="block text-sm font-medium text-gray-500">Keterangan dari Admin</label>
                                            <div class="mt-1 p-3 bg-yellow-50 rounded-lg border border-yellow-200">
                                                <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $audit->keterangan }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if($audit->hasil)
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0 mt-1">
                                            <div
                                                class="h-10 w-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <label class="block text-sm font-medium text-gray-500">Hasil Audit</label>
                                            <div class="mt-1 p-3 bg-green-50 rounded-lg border border-green-200">
                                                <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $audit->hasil }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Actions Sidebar -->
                    <div class="lg:col-span-1 space-y-6">
                        <!-- Quick Actions -->
                        <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                            <div class="px-4 py-3 border-b border-gray-200 bg-gray-50">
                                <h3 class="text-sm font-semibold text-gray-900">Aksi</h3>
                            </div>
                            <div class="p-4 space-y-3">
                                @if($audit->status === 'pending')
                                    <div class="space-y-3">
                                        <!-- Confirm Button -->
                                        <form action="{{ route('user.audit.confirm', $audit) }}" method="POST" class="w-full">
                                            @csrf
                                            <button type="submit" 
                                                    onclick="return confirm('Apakah Anda yakin dapat hadir pada tanggal dan waktu yang dijadwalkan?')"
                                                    class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Konfirmasi Jadwal
                                            </button>
                                        </form>

                                        <!-- Request Reschedule Button -->
                                        <button onclick="openRescheduleModal()" 
                                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-700 active:bg-orange-900 focus:outline-none focus:border-orange-900 focus:ring ring-orange-300 disabled:opacity-25 transition ease-in-out duration-150">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            Minta Ubah Jadwal
                                        </button>
                                    </div>
                                @elseif($audit->status === 'konfirmasi')
                                    <div class="text-center py-3">
                                        <div class="inline-flex items-center px-3 py-2 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Audit Sedang Berjalan
                                        </div>
                                        <p class="text-xs text-gray-500 mt-2">Auditor sedang dalam proses kunjungan</p>
                                    </div>
                                @else
                                    <div class="text-center py-3">
                                        <div class="inline-flex items-center px-3 py-2 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Audit Selesai
                                        </div>
                                        <p class="text-xs text-gray-500 mt-2">Audit telah diselesaikan</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Info -->
                        <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-blue-900">Informasi Penting</h4>
                                    <div class="mt-2 text-sm text-blue-700">
                                        <ul class="list-disc list-inside space-y-1">
                                            <li>Pastikan Anda berada di lokasi saat audit berlangsung</li>
                                            <li>Siapkan dokumen yang diperlukan</li>
                                            <li>Hubungi admin jika ada kendala</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reschedule Modal -->
    <div id="rescheduleModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Permintaan Perubahan Jadwal</h3>
                    <button onclick="closeRescheduleModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <form action="{{ route('user.audit.request-reschedule', $audit) }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="reschedule_reason" class="block text-sm font-medium text-gray-700">Alasan Perubahan Jadwal *</label>
                            <textarea name="reschedule_reason" id="reschedule_reason" rows="3" required
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                      placeholder="Jelaskan mengapa Anda memerlukan perubahan jadwal..."></textarea>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="preferred_date" class="block text-sm font-medium text-gray-700">Tanggal Preferensi</label>
                                <input type="date" name="preferred_date" id="preferred_date"
                                       min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                            
                            <div>
                                <label for="preferred_time" class="block text-sm font-medium text-gray-700">Waktu Preferensi</label>
                                <input type="text" name="preferred_time" id="preferred_time"
                                       placeholder="Contoh: 09:00 - 12:00"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeRescheduleModal()"
                                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Batal
                        </button>
                        <button type="submit"
                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                            Kirim Permintaan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openRescheduleModal() {
            document.getElementById('rescheduleModal').classList.remove('hidden');
        }
        
        function closeRescheduleModal() {
            document.getElementById('rescheduleModal').classList.add('hidden');
        }
        
        // Close modal when clicking outside
        document.getElementById('rescheduleModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRescheduleModal();
            }
        });
    </script>
</x-layouts.app>