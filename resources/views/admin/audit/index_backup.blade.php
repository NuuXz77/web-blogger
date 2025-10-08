<x-layouts.app title="Manajemen Audit">
    <div class="min-h-screen bg-gray-50">

        <!-- Main Content -->
        <div>
            <x-slot:header>
                <!-- Header -->
                <div>
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Manajemen Kunjungan Audit</h1>
                            <p class="text-gray-600 mt-2">Kelola semua kunjungan audit dan monitoring</p>
                        </div>
                        <div class="flex space-x-4">
                            <a href="{{ route('admin.audit.create') }}"
                                class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Buat Kunjungan Baru
                            </a>
                            <button onclick="openExportModal()"
                                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Export Excel
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                </div>
            </x-slot:header>

            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 mt-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-6 mt-6">
                <div class="bg-white p-6 rounded-lg shadow-sm border">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Total Kunjungan</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $visits->total() }}</p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Menunggu Konfirmasi Author</p>
                            <p class="text-2xl font-bold text-yellow-600">
                                {{ $visits->where('status', 'pending')->count() }}</p>
                        </div>
                        <div class="bg-yellow-100 p-3 rounded-full">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Menunggu Persetujuan Admin</p>
                            <p class="text-2xl font-bold text-blue-600">
                                {{ $visits->where('status', 'confirmed_by_author')->count() }}</p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Sedang Berlangsung</p>
                            <p class="text-2xl font-bold text-orange-600">
                                {{ $visits->whereIn('status', ['confirmed_by_admin', 'in_progress'])->count() }}</p>
                        </div>
                        <div class="bg-orange-100 p-3 rounded-full">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Selesai</p>
                            <p class="text-2xl font-bold text-green-600">
                                {{ $visits->where('status', 'completed')->count() }}</p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Tabs -->
            <div class="bg-white rounded-lg shadow-sm border mb-6">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8 px-6" aria-label="Tabs">
                        <button onclick="filterVisits('all')"
                            class="filter-tab active border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Semua
                        </button>
                        <button onclick="filterVisits('pending')"
                            class="filter-tab border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Menunggu Konfirmasi Author
                        </button>
                        <button onclick="filterVisits('confirmed_by_author')"
                            class="filter-tab border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Menunggu Persetujuan Admin
                        </button>
                        <button onclick="filterVisits('confirmed_by_admin,in_progress')"
                            class="filter-tab border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Sedang Berlangsung
                        </button>
                        <button onclick="filterVisits('completed')"
                            class="filter-tab border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Selesai
                        </button>
                    </nav>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Author</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Auditor</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Alamat</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status Author</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="visits-table">
                            @forelse($visits as $visit)
                                <tr class="hover:bg-gray-50 visit-row" data-status="{{ $visit->status }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div
                                                    class="h-10 w-10 rounded-full bg-primary text-white flex items-center justify-center">
                                                    {{ substr($visit->author->name, 0, 1) }}
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $visit->author->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $visit->author->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div
                                                    class="h-10 w-10 rounded-full bg-green-500 text-white flex items-center justify-center">
                                                    {{ substr($visit->auditor->name, 0, 1) }}
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $visit->auditor->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $visit->auditor->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($visit->tanggal)->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 max-w-xs">
                                        <div class="truncate" title="{{ $visit->alamat }}">
                                            {{ Str::limit($visit->alamat, 60) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($visit->reschedule_requested)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Minta Reschedule
                                            </span>
                                            @if ($visit->preferred_date)
                                                <div class="text-xs text-gray-500 mt-1">
                                                    Preferensi:
                                                    {{ \Carbon\Carbon::parse($visit->preferred_date)->format('d M Y') }}
                                                    @if ($visit->preferred_time)
                                                        {{ $visit->preferred_time }}
                                                    @endif
                                                </div>
                                            @endif
                                        @elseif($visit->author_confirmed)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Terkonfirmasi
                                            </span>
                                            <div class="text-xs text-gray-500 mt-1">
                                                {{ $visit->author_confirmed_at->format('d M Y, H:i') }}
                                            </div>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Menunggu Konfirmasi
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($visit->status === 'pending')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Pending (Author)
                                            </span>
                                        @elseif($visit->status === 'confirmed_by_admin')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                Konfirmasi
                                            </span>
                                        @elseif($visit->status === 'confirmed_by_author')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                Perlu Konfirmasi (Auditor)
                                            </span>
                                        @elseif($visit->status === 'in_progress')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-sky-100 text-sky-800">
                                                Perlu Konfirmasi (Admin)
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Kunjungan Selesai
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="relative inline-block text-left">
                                            <button type="button" onclick="toggleDropdown({{ $visit->id }})"
                                                class="inline-flex items-center p-2 text-gray-400 hover:text-gray-600 rounded-full hover:bg-gray-100">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z">
                                                    </path>
                                                </svg>
                                            </button>

                                            <div id="dropdown-{{ $visit->id }}"
                                                class="hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10">
                                                <div class="py-1" role="menu">
                                                    <!-- View Detail -->
                                                    <a href="{{ route('admin.audit.show', $visit) }}"
                                                        class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                        role="menuitem">
                                                        <svg class="w-4 h-4 mr-3 text-blue-500" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                            </path>
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                            </path>
                                                        </svg>
                                                        Lihat Detail
                                                    </a>

                                                    <!-- Edit -->
                                                    <a href="{{ route('admin.audit.edit', $visit) }}"
                                                        class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                        role="menuitem">
                                                        <svg class="w-4 h-4 mr-3 text-indigo-500" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                            </path>
                                                        </svg>
                                                        Edit Kunjungan
                                                    </a>

                                                    <!-- Status-specific actions -->
                                                    @if ($visit->status === 'confirmed_by_author')
                                                        <form action="{{ route('admin.audit.confirm', $visit) }}"
                                                            method="POST" class="block">
                                                            @csrf
                                                            <button type="submit"
                                                                class="w-full flex items-center px-4 py-2 text-sm text-green-700 hover:bg-green-50"
                                                                onclick="return confirm('Setujui konfirmasi author dan lanjutkan ke auditor?')"
                                                                role="menuitem">
                                                                <svg class="w-4 h-4 mr-3 text-green-500"
                                                                    fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                                    </path>
                                                                </svg>
                                                                Setujui Konfirmasi Author
                                                            </button>
                                                        </form>
                                                        <button type="button"
                                                            onclick="openRejectAuthorModal({{ $visit->id }})"
                                                            class="w-full flex items-center px-4 py-2 text-sm text-red-700 hover:bg-red-50"
                                                            role="menuitem">
                                                            <svg class="w-4 h-4 mr-3 text-red-500" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                            </svg>
                                                            Tolak Konfirmasi Author
                                                        </button>
                                                    @endif

                                                    @if ($visit->reschedule_requested)
                                                        <button type="button"
                                                            onclick="openApproveRescheduleModal({{ $visit->id }}, '{{ $visit->preferred_date }}', '{{ $visit->preferred_time }}')"
                                                            class="w-full flex items-center px-4 py-2 text-sm text-green-700 hover:bg-green-50"
                                                            role="menuitem">
                                                            <svg class="w-4 h-4 mr-3 text-green-500" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                                </path>
                                                            </svg>
                                                            Setujui Reschedule
                                                        </button>
                                                        <button type="button"
                                                            onclick="openRejectRescheduleModal({{ $visit->id }})"
                                                            class="w-full flex items-center px-4 py-2 text-sm text-red-700 hover:bg-red-50"
                                                            role="menuitem">
                                                            <svg class="w-4 h-4 mr-3 text-red-500" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                            </svg>
                                                            Tolak Reschedule
                                                        </button>
                                                    @endif

                                                    @if ($visit->status === 'in_progress')
                                                        <form
                                                            action="{{ route('admin.audit.confirm-report', $visit) }}"
                                                            method="POST" class="block">
                                                            @csrf
                                                            <button type="submit"
                                                                class="w-full flex items-center px-4 py-2 text-sm text-green-700 hover:bg-green-50"
                                                                onclick="return confirm('Setujui laporan kunjungan ini sebagai selesai?')"
                                                                role="menuitem">
                                                                <svg class="w-4 h-4 mr-3 text-green-500"
                                                                    fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                                    </path>
                                                                </svg>
                                                                Setujui Laporan
                                                            </button>
                                                        </form>
                                                        <button type="button"
                                                            class="w-full flex items-center px-4 py-2 text-sm text-red-700 hover:bg-red-50"
                                                            onclick="openRejectReportModal({{ $visit->id }})"
                                                            role="menuitem">
                                                            <svg class="w-4 h-4 mr-3 text-red-500" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                            </svg>
                                                            Tolak Laporan
                                                        </button>
                                                    @endif

                                                    <!-- Delete -->
                                                    <div class="border-t border-gray-100 my-1"></div>
                                                    <form action="{{ route('admin.audit.destroy', $visit) }}"
                                                        method="POST" class="block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="w-full flex items-center px-4 py-2 text-sm text-red-700 hover:bg-red-50"
                                                            onclick="return confirm('Yakin ingin menghapus kunjungan ini? Data tidak dapat dikembalikan.')"
                                                            role="menuitem">
                                                            <svg class="w-4 h-4 mr-3 text-red-500" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                                </path>
                                                            </svg>
                                                            Hapus Kunjungan
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                            </path>
                                        </svg>
                                        <p class="mt-2">Belum ada kunjungan audit</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($visits->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $visits->links() }}
                    </div>
                @endif
            </div>
        </div>
        <div class="flex-1">
        </div>
        {{-- <div class="flex">
            
        </div> --}}
    </div>

    <!-- Rejection Modal (untuk laporan auditor) -->
    <div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Tolak Laporan Kunjungan</h3>
                    <button type="button" onclick="closeRejectModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form id="rejectForm" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="rejection_reason" class="block text-sm font-medium text-gray-700 mb-2">
                            Alasan Penolakan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="rejection_reason" id="rejection_reason" rows="4" required
                            placeholder="Jelaskan alasan penolakan laporan ini..."
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent"></textarea>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeRejectModal()"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            Tolak Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Approve Reschedule Modal -->
    <div id="approveRescheduleModal"
        class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Setujui Perubahan Jadwal</h3>
                    <button type="button" onclick="closeApproveRescheduleModal()"
                        class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form id="approveRescheduleForm" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Baru</label>
                        <input type="date" name="tanggal" id="approve_tanggal" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Waktu (Opsional)</label>
                        <input type="text" name="waktu" id="approve_waktu" placeholder="Contoh: 09:00 - 12:00"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeApproveRescheduleModal()"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            Setujui & Update Jadwal
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

    <!-- Reject Author Confirmation Modal -->
    <div id="rejectAuthorModal"
        class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Tolak Konfirmasi Author</h3>
                    <button type="button" onclick="closeRejectAuthorModal()"
                        class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form id="rejectAuthorForm" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="reject_author_reason" class="block text-sm font-medium text-gray-700 mb-2">
                            Alasan Penolakan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="rejection_reason" id="reject_author_reason" rows="4" required
                            placeholder="Jelaskan mengapa konfirmasi author ditolak..."
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent"></textarea>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeRejectAuthorModal()"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            Tolak Konfirmasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Export Excel Modal -->
    <div id="exportModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Export Laporan Excel
                    </h3>
                    <button type="button" onclick="closeExportModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form id="exportForm" action="{{ route('admin.audit.export') }}" method="GET">
                    <div class="mb-4">
                        <label for="date_from" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Mulai (Opsional)
                        </label>
                        <input type="date" name="date_from" id="date_from"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>

                    <div class="mb-4">
                        <label for="date_to" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Selesai (Opsional)
                        </label>
                        <input type="date" name="date_to" id="date_to"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            Filter Status (Opsional)
                        </label>
                        <select name="status" id="export_status"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="">Semua Status</option>
                            <option value="pending">Menunggu Konfirmasi Author</option>
                            <option value="confirmed_by_author">Menunggu Persetujuan Admin</option>
                            <option value="confirmed_by_admin">Sedang Berlangsung</option>
                            <option value="in_progress">Dalam Proses</option>
                            <option value="completed">Selesai</option>
                        </select>
                    </div>

                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                        <div class="flex items-start space-x-3">
                            <svg class="flex-shrink-0 h-5 w-5 text-blue-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <div class="flex-1">
                                <p class="text-sm text-blue-700">
                                    <strong>Info:</strong> Jika tanggal tidak diisi, semua data akan diekspor. File akan berformat Excel (.xlsx).
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeExportModal()"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Download Excel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .filter-tab.active {
            border-color: #3B82F6 !important;
            color: #3B82F6 !important;
        }

        .border-primary {
            border-color: #3B82F6 !important;
        }

        .text-primary {
            color: #3B82F6 !important;
        }
    </style>

    <script>
        // Toggle dropdown
        function toggleDropdown(visitId) {
            const dropdown = document.getElementById(`dropdown-${visitId}`);
            const allDropdowns = document.querySelectorAll('[id^="dropdown-"]');

            // Close all other dropdowns
            allDropdowns.forEach(d => {
                if (d.id !== `dropdown-${visitId}`) {
                    d.classList.add('hidden');
                }
            });

            // Toggle current dropdown
            dropdown.classList.toggle('hidden');
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('[onclick^="toggleDropdown"]') && !e.target.closest('[id^="dropdown-"]')) {
                document.querySelectorAll('[id^="dropdown-"]').forEach(d => {
                    d.classList.add('hidden');
                });
            }
        });

        // Modal untuk reject laporan auditor
        function openRejectModal(visitId) {
            document.getElementById('rejectForm').action = `/admin/audit/${visitId}/reject-report`;
            document.getElementById('rejectModal').classList.remove('hidden');
        }

        function openRejectReportModal(visitId) {
            document.getElementById('rejectForm').action = `/admin/audit/${visitId}/reject-report`;
            document.getElementById('rejectModal').classList.remove('hidden');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
            document.getElementById('rejection_reason').value = '';
        }

        // Modal untuk reject author confirmation
        function openRejectAuthorModal(visitId) {
            document.getElementById('rejectAuthorForm').action = `/admin/audit/${visitId}/admin-reject`;
            document.getElementById('rejectAuthorModal').classList.remove('hidden');
        }

        function closeRejectAuthorModal() {
            document.getElementById('rejectAuthorModal').classList.add('hidden');
            document.getElementById('reject_author_reason').value = '';
        }

        // Modal untuk approve reschedule
        function openApproveRescheduleModal(visitId, preferredDate, preferredTime) {
            document.getElementById('approveRescheduleForm').action = `/admin/audit/${visitId}/approve-reschedule`;
            document.getElementById('approve_tanggal').value = preferredDate;
            document.getElementById('approve_waktu').value = preferredTime;
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
        document.getElementById('rejectModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRejectModal();
            }
        });

        document.getElementById('rejectAuthorModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRejectAuthorModal();
            }
        });

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

        // Export modal functions
        function openExportModal() {
            document.getElementById('exportModal').classList.remove('hidden');
        }

        function closeExportModal() {
            document.getElementById('exportModal').classList.add('hidden');
            // Reset form
            document.getElementById('date_from').value = '';
            document.getElementById('date_to').value = '';
            document.getElementById('export_status').value = '';
        }

        // Close export modal when clicking outside
        document.getElementById('exportModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeExportModal();
            }
        });

        // Validate date range
        document.getElementById('date_from').addEventListener('change', function() {
            const dateFrom = this.value;
            const dateTo = document.getElementById('date_to');
            if (dateFrom) {
                dateTo.setAttribute('min', dateFrom);
            }
        });

        document.getElementById('date_to').addEventListener('change', function() {
            const dateTo = this.value;
            const dateFrom = document.getElementById('date_from');
            if (dateTo) {
                dateFrom.setAttribute('max', dateTo);
            }
        });

        // Filter function for tabs
        function filterVisits(status) {
            const rows = document.querySelectorAll('.visit-row');
            const tabs = document.querySelectorAll('.filter-tab');

            // Remove active class from all tabs
            tabs.forEach(tab => {
                tab.classList.remove('active', 'border-primary', 'text-primary');
                tab.classList.add('border-transparent', 'text-gray-500');
            });

            // Add active class to clicked tab
            event.target.classList.add('active', 'border-primary', 'text-primary');
            event.target.classList.remove('border-transparent', 'text-gray-500');

            // Filter rows
            rows.forEach(row => {
                const rowStatus = row.dataset.status;
                if (status === 'all') {
                    row.style.display = '';
                } else if (status.includes(',')) {
                    // Handle multiple statuses (e.g., 'confirmed_by_admin,in_progress')
                    const statusArray = status.split(',');
                    if (statusArray.includes(rowStatus)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                } else if (rowStatus === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</x-layouts.app>
