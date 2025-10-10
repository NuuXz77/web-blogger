<x-layouts.app title="Detail Audit">
    <div class="min-h-screen bg-gray-50">
        <!-- Main Content -->
        <div class="flex-1">
            <div class="mt-6">
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
                                                @if ($audit->rejection_reason)
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        Permintaan Jadwal Ditolak
                                                    </span>
                                                @elseif ($audit->status === 'pending')
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        Menunggu Konfirmasi Anda
                                                    </span>
                                                @elseif($audit->status === 'confirmed_by_author')
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        Telah Dikonfirmasi
                                                    </span>
                                                @elseif($audit->status === 'confirmed_by_admin')
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        Dikonfirmasi Admin
                                                    </span>
                                                @elseif($audit->status === 'in_progress')
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        Audit Telah Ditugaskan
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        Audit Selesai
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
                                @if($audit->rejection_reason)
                                    <div class="text-center py-3">
                                        <div class="inline-flex items-center px-3 py-2 rounded-full text-sm font-medium bg-red-100 text-red-800 mb-3">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Permintaan Jadwal Ditolak
                                        </div>
                                        <div class="bg-red-50 border border-red-200 rounded-lg p-3 mb-3">
                                            <p class="text-sm text-red-800 font-medium mb-1">Alasan Penolakan:</p>
                                            <p class="text-sm text-red-700">{{ $audit->rejection_reason }}</p>
                                        </div>
                                        <p class="text-xs text-red-600">Anda dapat mengajukan permintaan jadwal baru</p>
                                        
                                        <!-- Button untuk request jadwal baru -->
                                        <button onclick="openRescheduleModal()" 
                                                class="mt-3 w-full inline-flex items-center justify-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-700 active:bg-orange-900 focus:outline-none focus:border-orange-900 focus:ring ring-orange-300 disabled:opacity-25 transition ease-in-out duration-150">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            Ajukan Jadwal Baru
                                        </button>
                                        <button onclick="openConfirmModal()" 
                                                class="mt-4 w-full inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Konfirmasi Jadwal
                                        </button>
                                    </div>
                                @elseif($audit->status === 'pending')
                                    <div class="space-y-3">
                                        <!-- Confirm Button with Modal -->
                                        <button onclick="openConfirmModal()" 
                                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Konfirmasi Jadwal
                                        </button>

                                        <!-- Request Reschedule Button -->
                                        <button onclick="openRescheduleModal()" 
                                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-700 active:bg-orange-900 focus:outline-none focus:border-orange-900 focus:ring ring-orange-300 disabled:opacity-25 transition ease-in-out duration-150">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            Minta Ubah Jadwal
                                        </button>
                                    </div>
                                @elseif($audit->status === 'confirmed_by_author')
                                    <div class="text-center py-3">
                                        <div class="inline-flex items-center px-3 py-2 rounded-full text-sm font-medium bg-blue-100 text-blue-800 mb-3">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Menunggu Persetujuan Admin
                                        </div>
                                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-3">
                                            <p class="text-sm text-blue-800 font-medium mb-1">⏳ Status Audit</p>
                                            <p class="text-sm text-blue-700">Konfirmasi Anda telah diterima. Admin sedang meninjau dan akan segera memberikan persetujuan.</p>
                                        </div>
                                        <p class="text-xs text-blue-600 mb-3">Anda dapat membatalkan konfirmasi jika diperlukan</p>
                                        
                                        <!-- Cancel confirmation button -->
                                        {{-- <form action="{{ route('audit.cancel', $audit) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" 
                                                    onclick="return confirm('Yakin ingin membatalkan konfirmasi? Status akan kembali ke pending.')"
                                                    class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition-colors">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                Batalkan Konfirmasi
                                            </button>
                                        </form> --}}
                                    </div>
                                @elseif($audit->status === 'confirmed_by_admin')
                                    <div class="text-center py-3">
                                        <div class="inline-flex items-center px-3 py-2 rounded-full text-sm font-medium bg-green-100 text-green-800 mb-3">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Audit Disetujui Admin
                                        </div>
                                        <div class="bg-green-50 border border-green-200 rounded-lg p-3 mb-3">
                                            <p class="text-sm text-green-800 font-medium mb-1">✅ Status Audit</p>
                                            <p class="text-sm text-green-700">Jadwal audit Anda telah disetujui oleh admin. Auditor akan segera melakukan kunjungan sesuai jadwal yang telah ditentukan.</p>
                                        </div>
                                        <p class="text-xs text-green-600">Tidak ada action yang diperlukan</p>
                                    </div>
                                @elseif($audit->status === 'in_progress')
                                    <div class="text-center py-3">
                                        <div class="inline-flex items-center px-3 py-2 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Audit Sedang Berlangsung
                                        </div>
                                        <p class="text-xs text-yellow-500 mt-2">Auditor sedang melakukan kunjungan</p>
                                    </div>
                                @elseif($audit->status === 'cancelled_by_author')
                                    <div class="text-center py-3">
                                        <div class="inline-flex items-center px-3 py-2 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Audit Dibatalkan
                                        </div>
                                        <p class="text-xs text-red-500 mt-2">Anda telah membatalkan audit ini</p>
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
                                            {{-- <li>Siapkan dokumen yang diperlukan</li>
                                            <li>Hubungi admin jika ada kendala</li> --}}
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

    <!-- Confirm Modal -->
    <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-60 hidden overflow-y-auto h-full w-full z-50 transition-all duration-300 ease-out">
        <div class="flex items-center justify-center min-h-screen px-4 py-8">
            <div id="confirmModalContent" class="relative w-full max-w-lg mx-auto transform scale-95 opacity-0 transition-all duration-300 ease-out">
                <div class="bg-white rounded-xl shadow-2xl border border-gray-200 overflow-hidden">
                    <!-- Modal Header -->
                    <div class="bg-gradient-to-r from-green-600 to-emerald-600 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="bg-white bg-opacity-20 rounded-full p-2">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-white">Konfirmasi Kehadiran</h3>
                            </div>
                            <button onclick="closeConfirmModal()" class="text-white hover:text-green-200 transition-colors duration-200 p-1 rounded-full hover:bg-white hover:bg-opacity-20">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Modal Body -->
                    <div class="p-6">
                        <!-- Information Box -->
                        <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="bg-green-100 rounded-full p-2">
                                        <svg class="w-5 h-5 text-green-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-sm font-semibold text-green-900 mb-1">Konfirmasi Jadwal Audit</h4>
                                    <p class="text-sm text-green-700">Dengan mengkonfirmasi, Anda menyetujui bahwa dapat hadir pada:</p>
                                    <div class="mt-3 space-y-2">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <span class="text-sm font-medium text-green-900">{{ \Carbon\Carbon::parse($audit->tanggal)->format('d F Y') }}</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span class="text-sm text-green-800">{{ Str::limit($audit->alamat, 50) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form id="confirmForm" action="{{ route('user.audit.confirm', $audit) }}" method="POST">
                            @csrf
                            <!-- Warning Message -->
                            <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-6">
                                <div class="flex items-start space-x-3">
                                    <svg class="w-5 h-5 text-amber-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-amber-900">Perhatian!</p>
                                        <p class="text-sm text-amber-700 mt-1">Pastikan Anda benar-benar dapat hadir. Setelah dikonfirmasi, status akan berubah menjadi "Menunggu Konfirmasi Admin".</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Modal Footer -->
                            <div class="flex justify-end space-x-3 mt-6 pt-6 border-t border-gray-200">
                                <button type="button" onclick="closeConfirmModal()"
                                        class="inline-flex items-center px-6 py-3 border-2 border-gray-300 rounded-xl text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200 shadow-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Batal
                                </button>
                                <button type="submit"
                                        class="inline-flex items-center px-8 py-3 border border-transparent rounded-xl shadow-lg text-sm font-semibold text-white bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 transform hover:scale-105 hover:shadow-xl">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Ya, Saya Konfirmasi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reschedule Modal -->
    <div id="rescheduleModal" class="fixed inset-0 bg-black bg-opacity-60 hidden overflow-y-auto h-full w-full z-50 transition-all duration-300 ease-out">
        <div class="flex items-center justify-center min-h-screen px-4 py-8">
            <div id="rescheduleModalContent" class="relative w-full max-w-2xl mx-auto transform scale-95 opacity-0 transition-all duration-300 ease-out">
                <div class="bg-white rounded-xl shadow-2xl border border-gray-200 overflow-hidden">
                    <!-- Modal Header -->
                    <div class="bg-gradient-to-r from-orange-600 to-amber-600 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="bg-white bg-opacity-20 rounded-full p-2">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-white">Permintaan Perubahan Jadwal</h3>
                            </div>
                            <button onclick="closeRescheduleModal()" class="text-white hover:text-orange-200 transition-colors duration-200 p-1 rounded-full hover:bg-white hover:bg-opacity-20">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Modal Body -->
                    <div class="p-6">
                        <!-- Information Box -->
                        <div class="bg-orange-50 border border-orange-200 rounded-xl p-4 mb-6">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="bg-orange-100 rounded-full p-2">
                                        <svg class="w-5 h-5 text-orange-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-sm font-semibold text-orange-900 mb-1">Catatan Penting</h4>
                                    <p class="text-sm text-orange-700">Permintaan perubahan jadwal akan ditinjau oleh admin. Mohon berikan alasan yang jelas dan tanggal alternatif yang sesuai.</p>
                                </div>
                            </div>
                        </div>
                        
                        <form action="{{ route('user.audit.request-reschedule', $audit) }}" method="POST">
                            @csrf
                            <div class="space-y-6">
                                <!-- Reason Section -->
                                <div>
                                    <div class="flex items-center space-x-2 mb-3">
                                        <div class="bg-red-100 rounded-full p-1.5">
                                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"></path>
                                            </svg>
                                        </div>
                                        <label for="reschedule_reason" class="block text-sm font-semibold text-gray-900">
                                            Alasan Perubahan Jadwal <span class="text-red-500">*</span>
                                        </label>
                                    </div>
                                    <div class="relative">
                                        <textarea name="reschedule_reason" id="reschedule_reason" rows="4" required
                                                  class="block w-full px-4 py-3 text-gray-900 border-2 border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 resize-none hover:border-gray-400"
                                                  placeholder="Jelaskan mengapa Anda memerlukan perubahan jadwal. Contoh: Ada keperluan mendadak, bentrok dengan jadwal lain, dll."></textarea>
                                        <div class="absolute inset-y-0 right-0 flex items-start pr-3 pt-3 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Date and Time Section -->
                                <div class="bg-gray-50 rounded-xl p-5 border border-gray-200">
                                    <div class="flex items-center space-x-2 mb-4">
                                        <div class="bg-orange-100 rounded-full p-1.5">
                                            <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <h4 class="text-sm font-semibold text-gray-900">Jadwal Alternatif (Opsional)</h4>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="preferred_date" class="block text-sm font-medium text-gray-700 mb-2">
                                                <span class="flex items-center space-x-2">
                                                    <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                    <span>Tanggal Preferensi</span>
                                                </span>
                                            </label>
                                            <div class="relative">
                                                <input type="date" name="preferred_date" id="preferred_date"
                                                       min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}"
                                                       class="block w-full px-4 py-3 text-gray-900 border-2 border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 hover:border-gray-400 bg-white">
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <label for="preferred_time" class="block text-sm font-medium text-gray-700 mb-2">
                                                <span class="flex items-center space-x-2">
                                                    <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <span>Waktu Preferensi</span>
                                                </span>
                                            </label>
                                            <div class="relative">
                                                <input type="text" name="preferred_time" id="preferred_time"
                                                       placeholder="Contoh: 09:00 - 12:00 WIB"
                                                       class="block w-full px-4 py-3 text-gray-900 border-2 border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 hover:border-gray-400 bg-white">
                                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Modal Footer -->
                            <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                                <button type="button" onclick="closeRescheduleModal()"
                                        class="inline-flex items-center px-6 py-3 border-2 border-gray-300 rounded-xl text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200 shadow-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Batal
                                </button>
                                <button type="submit"
                                        class="inline-flex items-center px-8 py-3 border border-transparent rounded-xl shadow-lg text-sm font-semibold text-white bg-gradient-to-r from-orange-600 to-amber-600 hover:from-orange-700 hover:to-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200 transform hover:scale-105 hover:shadow-xl">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                    Kirim Permintaan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirm Modal -->
    <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-60 hidden overflow-y-auto h-full w-full z-50 transition-all duration-300 ease-out">
        <div class="flex items-center justify-center min-h-screen px-4 py-8">
            <div id="confirmModalContent" class="relative w-full max-w-lg mx-auto transform scale-95 opacity-0 transition-all duration-300 ease-out">
                <div class="bg-white rounded-xl shadow-2xl border border-gray-200 overflow-hidden">
                    <!-- Modal Header -->
                    <div class="bg-gradient-to-r from-green-600 to-emerald-600 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="bg-white bg-opacity-20 rounded-full p-2">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-white">Konfirmasi Kehadiran</h3>
                            </div>
                            <button onclick="closeConfirmModal()" class="text-white hover:text-green-200 transition-colors duration-200 p-1 rounded-full hover:bg-white hover:bg-opacity-20">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Modal Body -->
                    <div class="p-6">
                        <!-- Schedule Info -->
                        <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="bg-green-100 rounded-full p-2">
                                        <svg class="w-5 h-5 text-green-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-sm font-semibold text-green-900 mb-1">Konfirmasi Jadwal Audit</h4>
                                    <p class="text-sm text-green-700">Dengan mengkonfirmasi, Anda menyetujui bahwa dapat hadir pada:</p>
                                    <div class="mt-3 space-y-2">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <span class="text-sm font-medium text-green-900">{{ \Carbon\Carbon::parse($audit->tanggal)->format('d F Y') }}</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span class="text-sm text-green-800">{{ Str::limit($audit->alamat, 50) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Warning Message -->
                        <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-6">
                            <div class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-amber-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-amber-900">Perhatian!</p>
                                    <p class="text-sm text-amber-700 mt-1">Pastikan Anda benar-benar dapat hadir. Setelah dikonfirmasi, status akan berubah menjadi "Menunggu Konfirmasi Admin".</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Modal Footer -->
                        <div class="flex justify-end space-x-3 mt-6">
                            <button type="button" onclick="closeConfirmModal()"
                                    class="inline-flex items-center px-6 py-3 border-2 border-gray-300 rounded-xl text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200 shadow-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Batal
                            </button>
                            <form id="confirmForm" action="{{ route('user.audit.confirm', $audit) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit"
                                        class="inline-flex items-center px-8 py-3 border border-transparent rounded-xl shadow-lg text-sm font-semibold text-white bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 transform hover:scale-105 hover:shadow-xl">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Ya, Saya Konfirmasi
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom smooth animations for modal */
        #confirmModal, #rescheduleModal {
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }
        
        #confirmModal.show, #rescheduleModal.show {
            background-color: rgba(0, 0, 0, 0.6);
        }
        
        /* Smooth gradient animation for green (confirm) */
        .bg-gradient-to-r.from-green-600 {
            background-size: 200% 200%;
            animation: gradientShiftGreen 4s ease infinite;
        }
        
        @keyframes gradientShiftGreen {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
        
        /* Smooth gradient animation for orange (reschedule) */
        .bg-gradient-to-r.from-orange-600 {
            background-size: 200% 200%;
            animation: gradientShiftOrange 4s ease infinite;
        }
        
        @keyframes gradientShiftOrange {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
        
        /* Enhanced input field styling */
        .form-input {
            @apply block w-full px-4 py-3 text-gray-900 border-2 border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 transition-all duration-200 hover:border-gray-400 bg-white;
        }
        
        .form-input:focus {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.15), 0 0 0 2px rgba(99, 102, 241, 0.5);
        }
        
        .form-input:hover:not(:focus) {
            border-color: #9CA3AF;
        }
        
        /* Button hover effects */
        .btn-primary {
            @apply inline-flex items-center px-8 py-3 border border-transparent rounded-xl shadow-lg text-sm font-semibold text-white transition-all duration-200;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px) scale(1.02);
        }
        
        .btn-secondary {
            @apply inline-flex items-center px-6 py-3 border-2 border-gray-300 rounded-xl text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200 shadow-sm;
        }
        
        .btn-secondary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        /* Icon animations */
        .icon-float {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-5px);
            }
        }
        
        /* Smooth transitions for all interactive elements */
        button, input, textarea, select {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Enhanced modal animation */
        #confirmModalContent, #rescheduleModalContent {
            animation-fill-mode: both;
        }
        
        .modal-enter {
            animation: modalEnter 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        
        .modal-exit {
            animation: modalExit 0.2s cubic-bezier(0.4, 0, 1, 1);
        }
        
        @keyframes modalEnter {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(-20px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }
        
        @keyframes modalExit {
            from {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
            to {
                opacity: 0;
                transform: scale(0.95) translateY(-10px);
            }
        }
    </style>

    <script>
        // Confirm Modal Functions
        function openConfirmModal() {
            const modal = document.getElementById('confirmModal');
            const modalContent = document.getElementById('confirmModalContent');
            
            modal.classList.remove('hidden');
            modal.offsetHeight;
            modal.classList.add('show');
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }
        
        function closeConfirmModal() {
            const modal = document.getElementById('confirmModal');
            const modalContent = document.getElementById('confirmModalContent');
            
            modal.classList.remove('show');
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
        
        // Reschedule Modal Functions
        function openRescheduleModal() {
            const modal = document.getElementById('rescheduleModal');
            const modalContent = document.getElementById('rescheduleModalContent');
            
            modal.classList.remove('hidden');
            modal.offsetHeight;
            modal.classList.add('show');
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }
        
        function closeRescheduleModal() {
            const modal = document.getElementById('rescheduleModal');
            const modalContent = document.getElementById('rescheduleModalContent');
            
            modal.classList.remove('show');
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            
            setTimeout(() => {
                modal.classList.add('hidden');
                // Reset form
                document.getElementById('reschedule_reason').value = '';
                document.getElementById('preferred_date').value = '';
                document.getElementById('preferred_time').value = '';
            }, 300);
        }
        
        // Close modals when clicking outside
        document.getElementById('confirmModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeConfirmModal();
            }
        });
        
        document.getElementById('rescheduleModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRescheduleModal();
            }
        });
        
        // Close modals with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const confirmModal = document.getElementById('confirmModal');
                const rescheduleModal = document.getElementById('rescheduleModal');
                
                if (!confirmModal.classList.contains('hidden')) {
                    closeConfirmModal();
                }
                if (!rescheduleModal.classList.contains('hidden')) {
                    closeRescheduleModal();
                }
            }
        });
        
        // Add smooth focus animation for inputs
        document.addEventListener('DOMContentLoaded', function() {
            const rescheduleInputs = document.querySelectorAll('#rescheduleModal input, #rescheduleModal textarea');
            rescheduleInputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.classList.add('ring-2', 'ring-orange-500', 'border-orange-500');
                });
                
                input.addEventListener('blur', function() {
                    this.classList.remove('ring-2', 'ring-orange-500', 'border-orange-500');
                });
            });
        });
    </script>
</x-layouts.app>