<x-layouts.app title="System Logs">
    <style>
        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
        
        /* Modal animations */
        .modal-enter {
            opacity: 0;
            transform: scale(0.9);
        }
        .modal-enter-active {
            opacity: 1;
            transform: scale(1);
            transition: opacity 0.3s, transform 0.3s;
        }
        
        /* Table hover effects */
        .hover-effect:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
        }
        
        /* Loading animation */
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        .loading-pulse {
            animation: pulse 2s infinite;
        }
    </style>
    <div class="min-h-screen bg-gray-50">
        <!-- Main Content -->
        <div>
            <x-slot:header>
                <!-- Header -->
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">System Logs</h1>
                        <p class="text-gray-600 mt-2">Monitor dan kelola log sistem Laravel</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors flex items-center gap-2" onclick="loadStats()">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Statistik
                        </button>
                        <a href="{{ route('admin.logs.download') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download
                        </a>
                        <button type="button" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors flex items-center gap-2" onclick="confirmClear()">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Clear Logs
                        </button>
                    </div>
                </div>
            </x-slot:header>

            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 mt-6">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <!-- Error Summary Card -->
            @if(isset($logs['data']) && !empty($logs['data']))
                @php
                    $errorLogs = collect($logs['data'])->filter(function($log) {
                        return in_array(strtolower($log['level']), ['emergency', 'alert', 'critical', 'error']);
                    });
                    $warningLogs = collect($logs['data'])->filter(function($log) {
                        return strtolower($log['level']) === 'warning';
                    });
                @endphp
                
                @if($errorLogs->count() > 0)
                <div class="bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-500 rounded-lg p-6 mb-6 shadow-sm mt-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-red-800">Ringkasan Error</h3>
                                <p class="text-red-700">
                                    Ditemukan <strong>{{ $errorLogs->count() }}</strong> error(s) dan <strong>{{ $warningLogs->count() }}</strong> warning(s)
                                </p>
                            </div>
                        </div>
                        <button onclick="showErrorSummary()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors">
                            Lihat Detail
                        </button>
                    </div>
                </div>
                @endif
            @endif

            <!-- Filters -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">
                <div class="p-6">
                    <form method="GET" action="{{ route('admin.logs.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Log Level</label>
                            <select name="level" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                <option value="all" {{ request('level') == 'all' ? 'selected' : '' }}>Semua Level</option>
                                <option value="emergency" {{ request('level') == 'emergency' ? 'selected' : '' }}>🚨 Emergency</option>
                                <option value="alert" {{ request('level') == 'alert' ? 'selected' : '' }}>⚠️ Alert</option>
                                <option value="critical" {{ request('level') == 'critical' ? 'selected' : '' }}>🔥 Critical</option>
                                <option value="error" {{ request('level') == 'error' ? 'selected' : '' }}>❌ Error</option>
                                <option value="warning" {{ request('level') == 'warning' ? 'selected' : '' }}>⚡ Warning</option>
                                <option value="notice" {{ request('level') == 'notice' ? 'selected' : '' }}>📝 Notice</option>
                                <option value="info" {{ request('level') == 'info' ? 'selected' : '' }}>ℹ️ Info</option>
                                <option value="debug" {{ request('level') == 'debug' ? 'selected' : '' }}>🐛 Debug</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Search Message</label>
                            <input type="text" name="search" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="Cari dalam pesan log..." value="{{ request('search') }}">
                        </div>
                        <div class="flex items-end space-x-2">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Filter
                            </button>
                            <a href="{{ route('admin.logs.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition-colors flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Logs Table -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Log Entries</h3>
                        @if(isset($logs['total']))
                            <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">
                                {{ $logs['total'] }} entries
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="overflow-hidden">
                    @if(isset($message))
                        <div class="p-6">
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-yellow-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-yellow-800 font-medium">{{ $message }}</span>
                                </div>
                            </div>
                        </div>
                    @elseif(empty($logs['data']))
                        <div class="p-6">
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-blue-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-blue-800 font-medium">Tidak ada log yang ditemukan.</span>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-800 text-white">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">DateTime</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Level</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Environment</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Message</th>
                                        <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($logs['data'] as $index => $log)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-600">
                                                <div class="font-medium">{{ \Carbon\Carbon::parse($log['datetime'])->format('d/m/Y') }}</div>
                                                <div class="text-gray-500">{{ \Carbon\Carbon::parse($log['datetime'])->format('H:i:s') }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $levelColors = [
                                                    'emergency' => 'bg-red-600',
                                                    'alert' => 'bg-red-500',
                                                    'critical' => 'bg-red-500',
                                                    'error' => 'bg-red-500',
                                                    'warning' => 'bg-yellow-500',
                                                    'notice' => 'bg-blue-500',
                                                    'info' => 'bg-blue-500',
                                                    'debug' => 'bg-gray-500'
                                                ];
                                                $levelColor = $levelColors[strtolower($log['level'])] ?? 'bg-gray-500';
                                            @endphp
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium text-white {{ $levelColor }}">
                                                {{ strtoupper($log['level']) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-800">
                                                {{ $log['environment'] }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="log-message">
                                                <div class="text-sm text-gray-900 font-mono bg-gray-50 p-3 rounded-lg border max-h-24 overflow-y-auto">
                                                    {{ Str::limit($log['message'], 150) }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <button onclick="showLogDetail({{ $index }})" class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded-md text-sm transition-colors">
                                                Detail
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($logs['total_pages'] > 1)
                        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-700">
                                    Showing {{ count($logs['data']) }} of {{ $logs['total'] }} entries
                                </div>
                                <nav class="flex items-center space-x-1">
                                    @if($logs['has_prev'])
                                        <a href="{{ request()->fullUrlWithQuery(['page' => $logs['prev_page']]) }}" 
                                           class="px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                            </svg>
                                        </a>
                                    @endif
                                    
                                    @for($i = max(1, $logs['current_page'] - 2); $i <= min($logs['total_pages'], $logs['current_page'] + 2); $i++)
                                        <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}" 
                                           class="px-3 py-2 text-sm font-medium {{ $i == $logs['current_page'] ? 'bg-blue-600 text-white' : 'text-gray-500 hover:text-gray-700 border border-gray-300 hover:bg-gray-50' }} rounded-md transition-colors">
                                            {{ $i }}
                                        </a>
                                    @endfor
                                    
                                    @if($logs['has_next'])
                                        <a href="{{ request()->fullUrlWithQuery(['page' => $logs['next_page']]) }}" 
                                           class="px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    @endif
                                </nav>
                            </div>
                        </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

<!-- Log Detail Modal -->
<div id="logDetailModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeLogDetail()"></div>
        
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="w-full">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Log Detail
                            </h3>
                            <button onclick="closeLogDetail()" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <div id="logDetailContent" class="space-y-4">
                            <!-- Content will be populated by JavaScript -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Error Summary Modal -->
<div id="errorSummaryModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeErrorSummary()"></div>
        
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-6xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="w-full">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Error Summary
                            </h3>
                            <button onclick="closeErrorSummary()" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <div id="errorSummaryContent" class="space-y-4">
                            @if(isset($logs['data']) && !empty($logs['data']))
                                @foreach($logs['data'] as $index => $log)
                                    @if(in_array(strtolower($log['level']), ['emergency', 'alert', 'critical', 'error', 'warning']))
                                    <div class="border-l-4 {{ in_array(strtolower($log['level']), ['emergency', 'alert', 'critical', 'error']) ? 'border-red-500 bg-red-50' : 'border-yellow-500 bg-yellow-50' }} p-4 rounded-r-lg">
                                        <div class="flex items-center justify-between mb-2">
                                            <div class="flex items-center space-x-2">
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium text-white {{ in_array(strtolower($log['level']), ['emergency', 'alert', 'critical', 'error']) ? 'bg-red-600' : 'bg-yellow-600' }}">
                                                    {{ strtoupper($log['level']) }}
                                                </span>
                                                <span class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($log['datetime'])->format('d/m/Y H:i:s') }}</span>
                                            </div>
                                            <button onclick="showLogDetail({{ $index }})" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                                View Detail
                                            </button>
                                        </div>
                                        <div class="text-sm text-gray-800 font-mono bg-white p-2 rounded border">
                                            {{ Str::limit($log['message'], 200) }}
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Clear Confirmation Modal -->
<div id="clearModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Konfirmasi Clear Logs
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Apakah Anda yakin ingin menghapus semua log? Tindakan ini tidak dapat dibatalkan.
                            </p>
                            <div class="mt-3 p-3 bg-red-50 rounded-lg border border-red-200">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-red-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-red-800 text-sm font-medium">Peringatan: Semua log yang ada akan dihapus permanen.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <form method="POST" action="{{ route('admin.logs.clear') }}" class="w-full sm:w-auto">
                    @csrf
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                        Ya, Hapus Semua Log
                    </button>
                </form>
                <button type="button" onclick="closeClearModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Stats Modal -->
<div id="statsModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeStatsModal()"></div>
        
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="w-full">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Statistik Log
                            </h3>
                            <button onclick="closeStatsModal()" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <div id="statsContent">
                            <div class="flex items-center justify-center h-32">
                                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                                <span class="ml-3 text-gray-600">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Store logs data for JavaScript access
const logsData = @json($logs['data'] ?? []);

function confirmClear() {
    document.getElementById('clearModal').classList.remove('hidden');
}

function closeClearModal() {
    document.getElementById('clearModal').classList.add('hidden');
}

function showLogDetail(index) {
    const log = logsData[index];
    if (!log) return;
    
    const levelColors = {
        'emergency': 'bg-red-600',
        'alert': 'bg-red-500',
        'critical': 'bg-red-500',
        'error': 'bg-red-500',
        'warning': 'bg-yellow-500',
        'notice': 'bg-blue-500',
        'info': 'bg-blue-500',
        'debug': 'bg-gray-500'
    };
    
    const levelColor = levelColors[log.level.toLowerCase()] || 'bg-gray-500';
    
    const content = `
        <div class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">DateTime</label>
                    <div class="text-sm text-gray-900 bg-gray-50 p-2 rounded border">
                        ${new Date(log.datetime).toLocaleString('id-ID')}
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Level</label>
                    <div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium text-white ${levelColor}">
                            ${log.level.toUpperCase()}
                        </span>
                    </div>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Environment</label>
                <div class="text-sm text-gray-900 bg-gray-50 p-2 rounded border">
                    ${log.environment}
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Full Message</label>
                <div class="text-sm text-gray-900 font-mono bg-gray-50 p-4 rounded border max-h-96 overflow-y-auto whitespace-pre-wrap">
${log.message}
                </div>
            </div>
        </div>
    `;
    
    document.getElementById('logDetailContent').innerHTML = content;
    document.getElementById('logDetailModal').classList.remove('hidden');
}

function closeLogDetail() {
    document.getElementById('logDetailModal').classList.add('hidden');
}

function showErrorSummary() {
    document.getElementById('errorSummaryModal').classList.remove('hidden');
}

function closeErrorSummary() {
    document.getElementById('errorSummaryModal').classList.add('hidden');
}

function loadStats() {
    document.getElementById('statsModal').classList.remove('hidden');
    
    fetch('{{ route("admin.logs.stats") }}')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                document.getElementById('statsContent').innerHTML = `
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-red-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-red-800">${data.error}</span>
                        </div>
                    </div>
                `;
                return;
            }
            
            let levelsHtml = '';
            if (data.levels) {
                Object.entries(data.levels).forEach(([level, count]) => {
                    if (count > 0) {
                        const badgeClass = getBadgeClass(level);
                        levelsHtml += `
                            <div class="bg-white rounded-lg border border-gray-200 p-4 text-center">
                                <div class="flex items-center justify-center mb-2">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium text-white ${badgeClass}">
                                        ${level.toUpperCase()}
                                    </span>
                                </div>
                                <div class="text-2xl font-bold text-gray-900">${count}</div>
                            </div>
                        `;
                    }
                });
            }
            
            document.getElementById('statsContent').innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-blue-50 rounded-lg border border-blue-200 p-4 text-center">
                        <div class="text-blue-600 font-semibold text-sm uppercase tracking-wide mb-1">File Size</div>
                        <div class="text-2xl font-bold text-blue-900">${data.file_size}</div>
                    </div>
                    <div class="bg-green-50 rounded-lg border border-green-200 p-4 text-center">
                        <div class="text-green-600 font-semibold text-sm uppercase tracking-wide mb-1">Total Lines</div>
                        <div class="text-2xl font-bold text-green-900">${data.total_lines}</div>
                    </div>
                    <div class="bg-purple-50 rounded-lg border border-purple-200 p-4 text-center">
                        <div class="text-purple-600 font-semibold text-sm uppercase tracking-wide mb-1">Last Modified</div>
                        <div class="text-lg font-semibold text-purple-900">${data.last_modified}</div>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Log Levels Distribution</h4>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        ${levelsHtml || '<div class="col-span-full text-center text-gray-500">No log entries found</div>'}
                    </div>
                </div>
            `;
        })
        .catch(error => {
            document.getElementById('statsContent').innerHTML = `
                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-red-800">Error loading stats: ${error.message}</span>
                    </div>
                </div>
            `;
        });
}

function closeStatsModal() {
    document.getElementById('statsModal').classList.add('hidden');
}

function getBadgeClass(level) {
    const classes = {
        'emergency': 'bg-red-600',
        'alert': 'bg-red-500',
        'critical': 'bg-red-500',
        'error': 'bg-red-500',
        'warning': 'bg-yellow-500',
        'notice': 'bg-blue-500',
        'info': 'bg-blue-500',
        'debug': 'bg-gray-500'
    };
    return classes[level.toLowerCase()] || 'bg-gray-500';
}
</script>

</x-layouts.app>