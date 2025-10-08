<x-layouts.app title="Dashboard Auditor">
    <div class="min-h-screen bg-gray-50">    
        <div class="flex">   
            <!-- Main Content -->
            <div class="flex-1">
                <div>
                    <x-slot:header>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Dashboard Auditor</h1>
                            <p class="text-gray-600 mt-2">Selamat datang, {{ Auth::user()->name }}!</p>
                        </div>
                    </x-slot:header>
                    <!-- Header -->

                    <!-- Quick Stats -->
                    @php
                        $totalVisits = \App\Models\Visits::where('auditor_id', Auth::id())->count();
                        $pendingVisits = \App\Models\Visits::where('auditor_id', Auth::id())->where('status', 'pending')->count();
                        $completedVisits = \App\Models\Visits::where('auditor_id', Auth::id())->where('status', 'selesai')->count();
                        $todayVisits = \App\Models\Visits::where('auditor_id', Auth::id())
                            ->whereDate('tanggal', today())->count();
                    @endphp

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6 mt-6">
                        <div class="bg-white p-6 rounded-lg shadow-sm border">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Total Kunjungan</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $totalVisits }}</p>
                                </div>
                                <div class="bg-blue-100 p-3 rounded-full">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm border">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Pending</p>
                                    <p class="text-2xl font-bold text-yellow-600">{{ $pendingVisits }}</p>
                                </div>
                                <div class="bg-yellow-100 p-3 rounded-full">
                                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm border">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Selesai</p>
                                    <p class="text-2xl font-bold text-green-600">{{ $completedVisits }}</p>
                                </div>
                                <div class="bg-green-100 p-3 rounded-full">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm border">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Hari Ini</p>
                                    <p class="text-2xl font-bold text-purple-600">{{ $todayVisits }}</p>
                                </div>
                                <div class="bg-purple-100 p-3 rounded-full">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Recent Visits -->
                        <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-lg font-semibold text-gray-900">Kunjungan Terbaru</h3>
                                    <a href="{{ route('auditor.audit.index') }}" class="text-primary hover:text-blue-700 text-sm font-medium">
                                        Lihat Semua
                                    </a>
                                </div>
                            </div>
                            <div class="p-6">
                                @php
                                    $recentVisits = \App\Models\Visits::with('author')
                                        ->where('auditor_id', Auth::id())
                                        ->orderBy('tanggal', 'desc')
                                        ->take(5)
                                        ->get();
                                @endphp

                                @if($recentVisits->isNotEmpty())
                                    <div class="space-y-4">
                                        @foreach($recentVisits as $visit)
                                            <div class="flex items-center justify-between p-3 border rounded-lg">
                                                <div class="flex items-center space-x-3">
                                                    <div class="flex-shrink-0 h-8 w-8">
                                                        <div class="h-8 w-8 rounded-full bg-primary text-white flex items-center justify-center text-sm">
                                                            {{ substr($visit->author->name, 0, 1) }}
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-900">{{ $visit->author->name }}</p>
                                                        <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($visit->tanggal)->format('d M Y') }}</p>
                                                    </div>
                                                </div>
                                                <div>
                                                    @if($visit->status === 'pending')
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                            Pending
                                                        </span>
                                                    @elseif($visit->status === 'konfirmasi')
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                            Konfirmasi
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            Selesai
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-8">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                        <p class="mt-2 text-sm text-gray-500">Belum ada kunjungan</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-900">Aksi Cepat</h3>
                            </div>
                            <div class="p-6">
                                <div class="space-y-4">
                                    <a href="{{ route('auditor.audit.index') }}" 
                                       class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                        <div class="flex-shrink-0">
                                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-900">Daftar Kunjungan</p>
                                            <p class="text-xs text-gray-500">Lihat semua tugas kunjungan</p>
                                        </div>
                                    </a>

                                    <a href="{{ route('auditor.audit.recap') }}" 
                                       class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                        <div class="flex-shrink-0">
                                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-900">Rekap Kunjungan</p>
                                            <p class="text-xs text-gray-500">Lihat peta dan riwayat</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
