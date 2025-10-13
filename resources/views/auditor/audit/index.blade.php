<x-layouts.app title="Daftar Audit Saya">
    <div class="min-h-screen bg-gray-50">
        <!-- Main Content -->
        <div class="flex-1">
            <div>
                <x-slot:header>
                    <!-- Header -->
                    <div>
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <div>
                                <h1 class="text-xl md:text-2xl lg:text-3xl font-bold text-gray-900">Daftar Audit Saya</h1>
                                <p class="text-gray-600 mt-1 md:mt-2 text-sm md:text-base">Semua jadwal audit yang akan dilakukan di tempat Anda</p>
                            </div>
                            <a href="{{ route('auditor.audit.recap') }}"
                                class="bg-primary text-white px-4 md:px-6 py-2 md:py-3 rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2 text-sm md:text-base w-full md:w-auto justify-center">
                                <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4">
                                    </path>
                                </svg>
                                Rekap Audit
                            </a>
                        </div>
                    </div>
                </x-slot:header>

                <!-- Success Message -->
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 mt-6">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Error Message -->
                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 mt-6">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Stats Cards -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3 md:gap-6 mb-6 md:mb-8 mt-6">
                    <div class="bg-white p-4 md:p-6 rounded-lg shadow-sm border">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs md:text-sm text-gray-600">Total Audit</p>
                                <p class="text-lg md:text-xl lg:text-2xl font-bold text-gray-900">{{ $visits->total() }}</p>
                            </div>
                            <div class="bg-blue-100 p-2 md:p-3 rounded-full">
                                <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-4 md:p-6 rounded-lg shadow-sm border">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs md:text-sm text-gray-600">Menunggu Saya</p>
                                <p class="text-lg md:text-xl lg:text-2xl font-bold text-yellow-600">
                                    {{ $visits->where('status', 'pending')->count() }}</p>
                            </div>
                            <div class="bg-yellow-100 p-2 md:p-3 rounded-full">
                                <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-yellow-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-4 md:p-6 rounded-lg shadow-sm border">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs md:text-sm text-gray-600">Menunggu Admin</p>
                                <p class="text-lg md:text-xl lg:text-2xl font-bold text-blue-600">
                                    {{ $visits->where('status', 'confirmed_by_author')->count() }}</p>
                            </div>
                            <div class="bg-blue-100 p-2 md:p-3 rounded-full">
                                <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-4 md:p-6 rounded-lg shadow-sm border">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs md:text-sm text-gray-600">Dalam Proses</p>
                                <p class="text-lg md:text-xl lg:text-2xl font-bold text-orange-600">
                                    {{ $visits->whereIn('status', ['confirmed_by_admin', 'in_progress'])->count() }}</p>
                            </div>
                            <div class="bg-orange-100 p-2 md:p-3 rounded-full">
                                <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-orange-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-4 md:p-6 rounded-lg shadow-sm border">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs md:text-sm text-gray-600">Selesai</p>
                                <p class="text-lg md:text-xl lg:text-2xl font-bold text-green-600">
                                    {{ $visits->where('status', 'completed')->count() }}</p>
                            </div>
                            <div class="bg-green-100 p-2 md:p-3 rounded-full">
                                <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter Tabs - Responsive -->
                <div class="bg-white rounded-lg shadow-sm border mb-6">
                    <!-- Desktop Tabs -->
                    <div class="hidden md:block border-b border-gray-200">
                        <nav class="-mb-px flex space-x-4 lg:space-x-8 px-4 lg:px-6" aria-label="Tabs">
                            <button onclick="filterVisits('all')"
                                class="filter-tab active border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                Semua
                            </button>
                            <button onclick="filterVisits('pending')"
                                class="filter-tab border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                Menunggu Konfirmasi Saya
                            </button>
                            <button onclick="filterVisits('confirmed_by_admin')"
                                class="filter-tab border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                Siap Dikunjungi
                            </button>
                            <button onclick="filterVisits('in_progress')"
                                class="filter-tab border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                Dalam Proses
                            </button>
                            <button onclick="filterVisits('completed')"
                                class="filter-tab border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                Selesai
                            </button>
                        </nav>
                    </div>
                    
                    <!-- Mobile Filter Dropdown -->
                    <div class="md:hidden p-4">
                        <label for="mobile-filter" class="sr-only">Filter Status</label>
                        <select id="mobile-filter" onchange="filterVisitsMobile(this.value)" 
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent text-sm">
                            <option value="all">Semua Audit</option>
                            <option value="pending">Menunggu Konfirmasi Saya</option>
                            <option value="confirmed_by_admin">Siap Dikunjungi</option>
                            <option value="in_progress">Dalam Proses</option>
                            <option value="completed">Selesai</option>
                        </select>
                    </div>
                </div>

                <!-- Table -->
                <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Auditor</th>
                                    <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal Audit</th>
                                    <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Alamat</th>
                                    <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="visits-table">
                                @forelse($visits as $visit)
                                    <tr class="hover:bg-gray-50 visit-row" data-status="{{ $visit->status }}">
                                        <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-8 w-8 md:h-10 md:w-10">
                                                    <div class="h-8 w-8 md:h-10 md:w-10 rounded-full bg-primary text-white flex items-center justify-center text-xs md:text-sm">
                                                        {{ substr($visit->auditor->name, 0, 1) }}
                                                    </div>
                                                </div>
                                                <div class="ml-3 md:ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $visit->auditor->name }}</div>
                                                    <div class="text-xs md:text-sm text-gray-500 hidden md:block">{{ $visit->auditor->email }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 md:px-6 py-4">
                                            <div class="flex flex-col space-y-1 md:space-y-2">
                                                <div class="text-sm text-gray-900">
                                                    {{ \Carbon\Carbon::parse($visit->tanggal)->format('d M Y') }}
                                                </div>
                                                <div>
                                                    @if (\Carbon\Carbon::parse($visit->tanggal)->isToday())
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                            Hari ini
                                                        </span>
                                                    @elseif(\Carbon\Carbon::parse($visit->tanggal)->isTomorrow())
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                            Besok
                                                        </span>
                                                    @elseif(\Carbon\Carbon::parse($visit->tanggal)->isPast())
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                            Lewat
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            Akan datang
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 md:px-6 py-4">
                                            <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $visit->alamat }}">
                                                {{ Str::limit($visit->alamat, 40) }}
                                            </div>
                                        </td>
                                        <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center space-x-2">
                                                @if ($visit->status === 'pending')
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        <span class="hidden sm:inline">Perlu Dikonfirmasi</span>
                                                        <span class="sm:hidden">Konfirmasi</span>
                                                    </span>
                                                @elseif($visit->status === 'confirmed_by_admin')
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        <span class="hidden sm:inline">Siap Dikunjungi</span>
                                                        <span class="sm:hidden">Siap</span>
                                                    </span>
                                                @elseif($visit->status === 'confirmed_by_author')
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                            </path>
                                                        </svg>
                                                        Dikonfirmasi
                                                    </span>
                                                @elseif($visit->status === 'in_progress')
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                            </path>
                                                        </svg>
                                                        <span class="hidden sm:inline">Dalam Proses</span>
                                                        <span class="sm:hidden">Proses</span>
                                                    </span>
                                                @elseif($visit->status === 'completed')
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                        </svg>
                                                        Selesai
                                                    </span>
                                                @endif

                                                @if ($visit->rejection_reason)
                                                    <span
                                                        class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800"
                                                        title="Laporan ditolak: {{ $visit->rejection_reason }}">
                                                        <svg class="w-3 h-3 mr-1" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                            </path>
                                                        </svg>
                                                        Ditolak
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-2">
                                                <!-- Detail Button -->
                                                <a href="{{ route('auditor.audit.show', $visit) }}"
                                                    class="text-blue-600 hover:text-blue-900 flex items-center gap-1 px-2 md:px-3 py-1 rounded-md hover:bg-blue-50 transition-colors text-xs md:text-sm">
                                                    <svg class="w-3 h-3 md:w-4 md:h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                        </path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                    Detail
                                                </a>

                                                @if ($visit->status === 'confirmed_by_admin')
                                                    <a href="{{ route('auditor.audit.report', $visit) }}"
                                                        class="bg-green-600 text-white px-3 md:px-4 py-1 md:py-2 rounded-lg hover:bg-green-700 transition-colors inline-flex items-center gap-2 text-xs md:text-sm">
                                                        <svg class="w-3 h-3 md:w-4 md:h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                            </path>
                                                        </svg>
                                                        Mulai Audit
                                                    </a>
                                                @elseif($visit->status === 'pending')
                                                    <span class="text-yellow-600 text-xs md:text-sm">Menunggu konfirmasi</span>
                                                @elseif($visit->status === 'confirmed_by_author')
                                                    <span class="text-blue-600 text-xs md:text-sm">Menunggu admin</span>
                                                @elseif($visit->status === 'in_progress')
                                                    <span class="text-orange-600 text-xs md:text-sm">Sedang berlangsung</span>
                                                @elseif($visit->status === 'completed')
                                                    <span class="text-green-600 text-xs md:text-sm">Selesai</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 md:px-6 py-8 md:py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-8 h-8 md:w-12 md:h-12 text-gray-400 mb-3 md:mb-4" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                                    </path>
                                                </svg>
                                                <h3 class="text-base md:text-lg font-medium text-gray-900 mb-1 md:mb-2">Belum ada jadwal audit</h3>
                                                <p class="text-gray-500 text-sm md:text-base">Saat ini belum ada jadwal audit yang ditugaskan untuk Anda.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($visits->hasPages())
                        <div class="bg-white px-4 md:px-6 py-3 border-t border-gray-200">
                            {{ $visits->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for filtering -->
    <script>
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
                if (status === 'all') {
                    row.style.display = '';
                } else {
                    row.style.display = row.dataset.status === status ? '' : 'none';
                }
            });
        }

        // Mobile filter function
        function filterVisitsMobile(status) {
            const rows = document.querySelectorAll('.visit-row');
            
            // Filter rows
            rows.forEach(row => {
                if (status === 'all') {
                    row.style.display = '';
                } else {
                    row.style.display = row.dataset.status === status ? '' : 'none';
                }
            });
        }
    </script>

    <style>
        .filter-tab.active {
            border-color: #3B82F6 !important;
            color: #3B82F6 !important;
        }
    </style>
</x-layouts.app>