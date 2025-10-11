<x-layouts.app title="Detail Kunjungan Audit">
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
                                    <h1 class="text-2xl sm:text-2xl font-bold text-gray-900">Detail Kunjungan Audit</h1>
                                    <p class="text-gray-600 mt-1 text-sm">Informasi lengkap kunjungan audit</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3">
                                <!-- Dropdown for Export Options -->
                                <div class="relative inline-block text-left">
                                    <button type="button" onclick="toggleExportDropdown()"
                                        class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors flex items-center gap-2 text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                        Cetak Audit
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>

                                    <!-- Dropdown Menu -->
                                    <div id="exportDropdown"
                                        class="hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                                        <div class="py-1" role="menu" aria-orientation="vertical">
                                            <a href="{{ route('admin.audit.export-pdf', $audit) }}"
                                                class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-900"
                                                role="menuitem">
                                                <svg class="w-4 h-4 mr-3 text-red-500" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                                Download PDF
                                                <span class="ml-auto text-xs text-gray-500">*.pdf</span>
                                            </a>
                                            <a href="{{ route('admin.audit.export-excel', $audit) }}"
                                                class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-900"
                                                role="menuitem">
                                                <svg class="w-4 h-4 mr-3 text-green-500" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                                Download Excel
                                                <span class="ml-auto text-xs text-gray-500">*.xlsx</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                @if ($audit->status === 'in_progress')
                                    <div class="flex flex-wrap gap-2">
                                        <form action="{{ route('admin.audit.confirm-report', $audit) }}" method="POST"
                                            class="min-w-0">
                                            @csrf
                                            <button type="submit"
                                                class="w-full flex items-center justify-center sm:justify-start px-3 py-2 text-sm text-green-700 hover:bg-green-50 rounded-lg border border-green-200 transition-colors"
                                                onclick="return confirm('Setujui laporan kunjungan ini sebagai selesai?')"
                                                role="menuitem">
                                                <svg class="w-4 h-4 sm:mr-2 flex-shrink-0 text-green-500" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                    </path>
                                                </svg>
                                                <span class="hidden sm:inline">Setujui Laporan</span>
                                            </button>
                                        </form>

                                        <button type="button"
                                            class="flex items-center justify-center sm:justify-start px-3 py-2 text-sm text-red-700 hover:bg-red-50 rounded-lg border border-red-200 transition-colors"
                                            onclick="openRejectReportModal({{ $audit->id }})" role="menuitem">
                                            <svg class="w-4 h-4 sm:mr-2 flex-shrink-0 text-red-500" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            <span class="hidden sm:inline">Tolak Laporan</span>
                                        </button>
                                    </div>
                                @endif

                                @if ($audit->status === 'confirmed_by_author')
                                    <div class="flex flex-wrap gap-2">
                                        <!-- Button Setujui Jadwal Saat Ini -->
                                        @if (!$audit->reschedule_requested)
                                            <form action="{{ route('admin.audit.confirm', $audit) }}" method="POST"
                                                class="flex-1 min-w-0">
                                                @csrf
                                                <button type="submit"
                                                    class="w-full flex items-center justify-center sm:justify-start px-3 py-2 text-sm text-white bg-green-600 hover:bg-green-700 rounded-lg transition-colors"
                                                    onclick="return confirm('Apakah Anda yakin ingin menyetujui jadwal kunjungan saat ini?')">
                                                    <svg class="w-4 h-4 sm:mr-2 flex-shrink-0" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    <span class="hidden sm:inline">Setujui Jadwal</span>
                                                </button>
                                            </form>
                                        @endif

                                        <!-- Button Konfirmasi Reschedule - hanya muncul jika ada permintaan reschedule -->
                                        @if ($audit->reschedule_requested)
                                            <button type="button"
                                                onclick="openApproveRescheduleModal({{ $audit->id }}, '{{ $audit->preferred_date ?? '' }}', '{{ $audit->preferred_time ?? '' }}')"
                                                class="flex-1 min-w-0 flex items-center justify-center sm:justify-start px-3 py-2 text-sm text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors">
                                                <svg class="w-4 h-4 sm:mr-2 flex-shrink-0" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                                <span class="hidden sm:inline">Konfirmasi Reschedule</span>
                                            </button>

                                            <button type="button"
                                                onclick="openRejectRescheduleModal({{ $audit->id }})"
                                                class="flex-1 min-w-0 flex items-center justify-center sm:justify-start px-3 py-2 text-sm text-white bg-orange-600 hover:bg-orange-700 rounded-lg transition-colors">
                                                <svg class="w-4 h-4 sm:mr-2 flex-shrink-0" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                <span class="hidden sm:inline">Tolak Reschedule</span>
                                            </button>
                                        @endif
                                    </div>
                                @endif

                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('admin.audit.edit', $audit) }}"
                                        class="flex-1 min-w-0 flex items-center justify-center sm:justify-start px-3 py-2 text-sm text-white bg-primary hover:bg-blue-700 rounded-lg transition-colors">
                                        <svg class="w-4 h-4 sm:mr-2 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                        <span class="hidden sm:inline">Edit</span>
                                    </a>

                                    <a href="{{ route('admin.audit.index') }}"
                                        class="min-w-0 flex items-center justify-center sm:justify-start px-3 py-2 text-sm text-gray-800 bg-gray-200 hover:bg-gray-300 rounded-lg transition-colors">
                                        <svg class="w-4 h-4 sm:mr-2 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                        </svg>
                                        <span class="hidden sm:inline">Kembali</span>
                                    </a>
                                </div>
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

                <!-- Info Alert untuk Status Konfirmasi -->
                @if ($audit->status === 'confirmed_by_author')
                    <div class="bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 rounded mb-6">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-400 mt-0.5 mr-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h4 class="font-medium">Menunggu Konfirmasi Admin</h4>
                                <div class="mt-1 text-sm">
                                    @if (!$audit->reschedule_requested)
                                        <p>• <strong>Setujui Jadwal:</strong> Konfirmasi kunjungan pada jadwal yang
                                            telah ditentukan</p>
                                    @endif
                                    @if ($audit->reschedule_requested)
                                        <p>• <strong>Konfirmasi Reschedule:</strong> Setujui/tolak permintaan perubahan
                                            jadwal dari user</p>
                                    @endif
                                </div>
                            </div>
                        </div>
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
                                            <p class="text-sm font-medium text-gray-900 mt-1">
                                                {{ $audit->author->name }}
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
                                                @elseif($audit->status === 'confirmed_by_author')
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-cyan-100 text-cyan-800">
                                                        Dikonfirmasi (Author)
                                                    </span>
                                                @elseif($audit->status === 'confirmed_by_admin')
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        Dikonfirmasi (Admin)
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

                                <!-- Reschedule Request Information -->
                                @if ($audit->reschedule_requested)
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0 mt-1">
                                            <div
                                                class="h-10 w-10 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <label class="block text-sm font-medium text-gray-500">Permintaan
                                                Reschedule dari User</label>
                                            <div class="mt-1 p-3 bg-orange-50 rounded-lg border border-orange-200">
                                                <div class="space-y-2">
                                                    @if ($audit->preferred_date)
                                                        <div class="flex justify-between">
                                                            <span class="text-sm font-medium text-orange-800">Tanggal
                                                                Baru:</span>
                                                            <span
                                                                class="text-sm text-orange-700">{{ \Carbon\Carbon::parse($audit->preferred_date)->format('d F Y') }}</span>
                                                        </div>
                                                    @endif
                                                    @if ($audit->preferred_time)
                                                        <div class="flex justify-between">
                                                            <span
                                                                class="text-sm font-medium text-orange-800">Waktu:</span>
                                                            <span
                                                                class="text-sm text-orange-700">{{ $audit->preferred_time }}</span>
                                                        </div>
                                                    @endif
                                                    @if ($audit->reschedule_reason)
                                                        <div>
                                                            <span
                                                                class="text-sm font-medium text-orange-800">Alasan:</span>
                                                            <p class="text-sm text-orange-700 mt-1">
                                                                {{ $audit->reschedule_reason }}</p>
                                                        </div>
                                                    @endif
                                                    @if ($audit->reschedule_requested_at)
                                                        <div class="flex justify-between">
                                                            <span class="text-sm font-medium text-orange-800">Diminta
                                                                pada:</span>
                                                            <span
                                                                class="text-sm text-orange-700">{{ \Carbon\Carbon::parse($audit->reschedule_requested_at)->format('d M Y, H:i') }}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Author Status Information -->
                        <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                    Status Konfirmasi Author
                                </h3>
                            </div>
                            <div class="p-6 space-y-6">
                                @if ($audit->reschedule_requested)
                                    <div class="bg-orange-50 border border-orange-200 rounded-lg p-4">
                                        <div class="flex items-start space-x-3">
                                            <div class="flex-shrink-0">
                                                <svg class="w-6 h-6 text-orange-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                            <div class="flex-1">
                                                <h4 class="text-sm font-medium text-orange-900">Permintaan Perubahan
                                                    Jadwal</h4>
                                                <p class="text-sm text-orange-700 mt-1">Author meminta perubahan jadwal
                                                    pada
                                                    {{ $audit->reschedule_requested_at ? \Carbon\Carbon::parse($audit->reschedule_requested_at)->format('d M Y, H:i') : '-' }}
                                                </p>

                                                <div class="mt-3 space-y-2">
                                                    <div>
                                                        <span
                                                            class="text-xs font-medium text-orange-800">Alasan:</span>
                                                        <p class="text-sm text-orange-700">
                                                            {{ $audit->reschedule_reason }}</p>
                                                    </div>

                                                    @if ($audit->preferred_date)
                                                        <div>
                                                            <span class="text-xs font-medium text-orange-800">Tanggal
                                                                Preferensi:</span>
                                                            <p class="text-sm text-orange-700">
                                                                {{ \Carbon\Carbon::parse($audit->preferred_date)->format('d F Y') }}
                                                            </p>
                                                        </div>
                                                    @endif

                                                    @if ($audit->preferred_time)
                                                        <div>
                                                            <span class="text-xs font-medium text-orange-800">Waktu
                                                                Preferensi:</span>
                                                            <p class="text-sm text-orange-700">
                                                                {{ $audit->preferred_time }}</p>
                                                        </div>
                                                    @endif
                                                </div>

                                                @if ($audit->status === 'pending')
                                                    <div class="mt-4 flex space-x-3">
                                                        <button type="button"
                                                            onclick="openApproveRescheduleModal({{ $audit->id }}, '{{ $audit->preferred_date }}', '{{ $audit->preferred_time }}')"
                                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                            <svg class="w-4 h-4 mr-1" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                            </svg>
                                                            Setujui
                                                        </button>
                                                        <button type="button"
                                                            onclick="openRejectRescheduleModal({{ $audit->id }})"
                                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                            <svg class="w-4 h-4 mr-1" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                            </svg>
                                                            Tolak
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @elseif($audit->author_confirmed)
                                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                        <div class="flex items-start space-x-3">
                                            <div class="flex-shrink-0">
                                                <svg class="w-6 h-6 text-green-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="text-sm font-medium text-green-900">Jadwal Dikonfirmasi</h4>
                                                <p class="text-sm text-green-700 mt-1">Author telah mengkonfirmasi
                                                    jadwal pada {{ $audit->author_confirmed_at->format('d M Y, H:i') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                        <div class="flex items-start space-x-3">
                                            <div class="flex-shrink-0">
                                                <svg class="w-6 h-6 text-yellow-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="text-sm font-medium text-yellow-900">Menunggu Konfirmasi
                                                </h4>
                                                <p class="text-sm text-yellow-700 mt-1">Author belum mengkonfirmasi
                                                    jadwal audit</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($audit->rejection_reason)
                                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                                        <div class="flex items-start space-x-3">
                                            <div class="flex-shrink-0">
                                                <svg class="w-6 h-6 text-red-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="text-sm font-medium text-red-900">Permintaan Reschedule
                                                    Ditolak</h4>
                                                <p class="text-sm text-red-700 mt-1">{{ $audit->rejection_reason }}
                                                </p>
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
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
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
                                                        class="max-w-md rounded-lg border shadow-sm">
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
                                    <h3 class="text-lg font-semibold text-gray-900 flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7">
                                                </path>
                                            </svg>
                                            Lokasi Kunjungan
                                        </div>
                                        <a href="https://www.google.com/maps?q={{ $audit->lat }},{{ $audit->long }}"
                                            target="_blank"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                                </path>
                                            </svg>
                                            Buka di Maps
                                        </a>
                                    </h3>
                                </div>
                                <div class="p-6">
                                    <div id="map" class="w-full h-64 rounded-lg border"></div>
                                    <div class="mt-4 text-center">
                                        <p class="text-sm text-gray-600">
                                            Koordinat: {{ $audit->lat }}, {{ $audit->long }}
                                        </p>
                                        <a href="https://www.google.com/maps?q={{ $audit->lat }},{{ $audit->long }}"
                                            target="_blank"
                                            class="inline-flex items-center gap-1 mt-2 text-blue-600 hover:text-blue-800 text-sm font-medium">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z">
                                                </path>
                                            </svg>
                                            Lihat di Google Maps
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Approve Reschedule Modal -->
    <div id="approveRescheduleModal"
        class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Konfirmasi Reschedule</h3>
                    <button type="button" onclick="closeApproveRescheduleModal()"
                        class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Info permintaan reschedule -->
                <div class="mb-4 p-3 bg-blue-50 rounded-lg border border-blue-200">
                    <h4 class="text-sm font-medium text-blue-900 mb-2">Detail Permintaan Reschedule:</h4>
                    <div class="text-sm text-blue-700 space-y-1">
                        <div>📅 <strong>Tanggal yang diminta:</strong> <span id="requested-date-display"></span></div>
                        <div>⏰ <strong>Waktu yang diminta:</strong> <span id="requested-time-display"></span></div>
                    </div>
                </div>

                <form action="{{ route('admin.audit.confirm', $audit) }}" id="approveRescheduleForm" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Baru *</label>
                        <input type="date" name="tanggal" id="approve_tanggal" required
                            min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                        <p class="text-xs text-gray-500 mt-1">Anda dapat mengubah tanggal jika diperlukan</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Waktu (Opsional)</label>
                        <input type="text" name="waktu" id="approve_waktu" placeholder="Contoh: 09:00 - 12:00"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                        <p class="text-xs text-gray-500 mt-1">Anda dapat mengubah waktu jika diperlukan</p>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeApproveRescheduleModal()"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            Setujui Reschedule
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Reject Reschedule Modal -->
    <div id="rejectRescheduleModal"
        class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Tolak Perubahan Jadwal</h3>
                    <button type="button" onclick="closeRejectRescheduleModal()"
                        class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form id="rejectRescheduleForm" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="reject_reschedule_reason" class="block text-sm font-medium text-gray-700 mb-2">
                            Alasan Penolakan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="rejection_reason" id="reject_reschedule_reason" rows="4" required
                            placeholder="Jelaskan mengapa permintaan perubahan jadwal ditolak..."
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent"></textarea>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeRejectRescheduleModal()"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            Tolak Permintaan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Modal untuk approve reschedule
        function openApproveRescheduleModal(visitId, preferredDate, preferredTime) {
            console.log('=== DEBUG RESCHEDULE MODAL ===');
            console.log('Visit ID:', visitId);
            console.log('Preferred Date (raw):', preferredDate);
            console.log('Preferred Time (raw):', preferredTime);
            console.log('Preferred Date type:', typeof preferredDate);
            console.log('Preferred Time type:', typeof preferredTime);

            document.getElementById('approveRescheduleForm').action = `/admin/audit/${visitId}/approve-reschedule`;

            // Set input tanggal dengan format yang benar untuk input type="date"
            if (preferredDate && preferredDate.trim() !== '') {
                // Pastikan format tanggal adalah YYYY-MM-DD
                let formattedDate = '';

                // Jika sudah dalam format YYYY-MM-DD
                if (preferredDate.match(/^\d{4}-\d{2}-\d{2}$/)) {
                    formattedDate = preferredDate;
                } else if (preferredDate.match(/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/)) {
                    // Jika format YYYY-MM-DD HH:MM:SS, ambil bagian tanggal saja
                    formattedDate = preferredDate.split(' ')[0];
                } else {
                    // Konversi ke format YYYY-MM-DD TANPA timezone issue
                    const dateObj = new Date(preferredDate + 'T00:00:00Z'); // Paksa UTC
                    if (!isNaN(dateObj.getTime())) {
                        formattedDate = dateObj.toISOString().split('T')[0];
                    }
                }

                console.log('Formatted Date for input:', formattedDate);

                // Pastikan input terisi dengan tanggal yang benar
                if (formattedDate) {
                    document.getElementById('approve_tanggal').value = formattedDate;
                    console.log('Input date set to:', formattedDate);
                } else {
                    console.log('Failed to format date, using empty value');
                    document.getElementById('approve_tanggal').value = '';
                }
            } else {
                console.log('No preferred date provided or empty string');
                document.getElementById('approve_tanggal').value = '';
            }

            document.getElementById('approve_waktu').value = preferredTime || '';

            // Update display info - menampilkan data asli dari permintaan user
            const dateDisplay = document.getElementById('requested-date-display');
            const timeDisplay = document.getElementById('requested-time-display');

            if (preferredDate) {
                const date = new Date(preferredDate);
                console.log('Date object for display:', date);
                console.log('Is date valid?', !isNaN(date.getTime()));

                if (!isNaN(date.getTime())) {
                    const displayText = date.toLocaleDateString('id-ID', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                    console.log('Display text:', displayText);
                    dateDisplay.textContent = displayText;
                } else {
                    dateDisplay.textContent = `Invalid Date (${preferredDate})`;
                }
            } else {
                dateDisplay.textContent = 'Tidak disebutkan';
            }

            const timeText = preferredTime || 'Tidak disebutkan';
            console.log('Time display text:', timeText);
            timeDisplay.textContent = timeText;

            console.log('=== END DEBUG ===');

            document.getElementById('approveRescheduleModal').classList.remove('hidden');
        }

        function closeApproveRescheduleModal() {
            document.getElementById('approveRescheduleModal').classList.add('hidden');
            document.getElementById('approve_tanggal').value = '';
            document.getElementById('approve_waktu').value = '';
        }

        // Modal untuk reject reschedule
        function openRejectRescheduleModal(visitId) {
            document.getElementById('rejectRescheduleForm').action = `/admin/audit/${visitId}/reject-reschedule`;
            document.getElementById('rejectRescheduleModal').classList.remove('hidden');
        }

        function closeRejectRescheduleModal() {
            document.getElementById('rejectRescheduleModal').classList.add('hidden');
            document.getElementById('reject_reschedule_reason').value = '';
        }

        // Close modals when clicking outside
        document.getElementById('approveRescheduleModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeApproveRescheduleModal();
            }
        });

        document.getElementById('rejectRescheduleModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRejectRescheduleModal();
            }
        });

        // Export dropdown functionality
        function toggleExportDropdown() {
            const dropdown = document.getElementById('exportDropdown');
            dropdown.classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('exportDropdown');
            const button = e.target.closest('[onclick="toggleExportDropdown()"]');

            if (!button && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>

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
