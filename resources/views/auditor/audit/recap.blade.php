<x-layouts.app title="Rekap Kunjungan">
    <div class="min-h-screen bg-gray-50">
        <div class="flex">
            <!-- Main Content -->
            <div class="flex-1">
                <div class="max-w-7xl mx-auto">
                    <!-- Header -->
                    <div class="mb-8">
                        <div class="flex justify-between items-center">
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900">Rekap Kunjungan</h1>
                                <p class="text-gray-600 mt-2">Peta perjalanan dan riwayat kunjungan Anda</p>
                            </div>
                            <a href="{{ route('auditor.audit.index') }}" 
                               class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali ke Daftar
                            </a>
                        </div>
                    </div>

                    <!-- Stats Summary -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                        <div class="bg-white p-6 rounded-lg shadow-sm border">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Total Kunjungan Selesai</p>
                                    <p class="text-2xl font-bold text-green-600">{{ $visits->count() }}</p>
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
                                    <p class="text-sm text-gray-600">Bulan Ini</p>
                                    <p class="text-2xl font-bold text-blue-600">
                                        {{ $visits->filter(function($visit) { 
                                            return \Carbon\Carbon::parse($visit->tanggal)->isCurrentMonth(); 
                                        })->count() }}
                                    </p>
                                </div>
                                <div class="bg-blue-100 p-3 rounded-full">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm border">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Minggu Ini</p>
                                    <p class="text-2xl font-bold text-purple-600">
                                        {{ $visits->filter(function($visit) { 
                                            return \Carbon\Carbon::parse($visit->tanggal)->isCurrentWeek(); 
                                        })->count() }}
                                    </p>
                                </div>
                                <div class="bg-purple-100 p-3 rounded-full">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm border">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Lokasi Berbeda</p>
                                    <p class="text-2xl font-bold text-indigo-600">
                                        {{ $visits->unique('author_id')->count() }}
                                    </p>
                                </div>
                                <div class="bg-indigo-100 p-3 rounded-full">
                                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Map Section -->
                        <div class="lg:col-span-2">
                            <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                                <div class="px-6 py-4 border-b border-gray-200">
                                    <div class="flex justify-between items-center">
                                        <h3 class="text-lg font-semibold text-gray-900">Peta Rute Kunjungan</h3>
                                        <div class="flex items-center space-x-2">
                                            <button onclick="showAllVisits()" 
                                                    class="text-sm bg-blue-100 text-blue-700 px-3 py-1 rounded-full hover:bg-blue-200 transition-colors">
                                                Tampilkan Semua
                                            </button>
                                            <button onclick="showRoute()" 
                                                    class="text-sm bg-green-100 text-green-700 px-3 py-1 rounded-full hover:bg-green-200 transition-colors">
                                                Tampilkan Rute
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-6">
                                    @if($visits->isNotEmpty())
                                        <div id="map" class="w-full h-96 rounded-lg border"></div>
                                    @else
                                        <div class="text-center py-12">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <p class="mt-2 text-gray-500">Belum ada data kunjungan dengan koordinat</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Visit List -->
                        <div class="space-y-6">
                            <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                                <div class="px-6 py-4 border-b border-gray-200">
                                    <h3 class="text-lg font-semibold text-gray-900">Riwayat Kunjungan</h3>
                                </div>
                                <div class="p-6">
                                    @if($visits->isNotEmpty())
                                        <div class="space-y-4">
                                            @foreach($visits as $index => $visit)
                                                <div class="border rounded-lg p-4 hover:bg-gray-50 cursor-pointer visit-item" 
                                                     data-lat="{{ $visit->lat }}" 
                                                     data-lng="{{ $visit->long }}"
                                                     onclick="focusOnVisit({{ $visit->lat }}, {{ $visit->long }}, '{{ $visit->author->name }}', '{{ \Carbon\Carbon::parse($visit->tanggal)->format('d M Y') }}')">
                                                    <div class="flex items-start space-x-3">
                                                        <div class="flex-shrink-0">
                                                            <div class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center text-sm font-medium">
                                                                {{ $index + 1 }}
                                                            </div>
                                                        </div>
                                                        <div class="flex-1 min-w-0">
                                                            <p class="text-sm font-medium text-gray-900">{{ $visit->author->name }}</p>
                                                            <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($visit->tanggal)->format('d M Y') }}</p>
                                                            @if($visit->hasil)
                                                                <p class="text-xs text-gray-400 mt-1 line-clamp-2">{{ Str::limit($visit->hasil, 60) }}</p>
                                                            @endif
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center py-8">
                                            <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                            </svg>
                                            <p class="mt-2 text-sm text-gray-500">Belum ada kunjungan selesai</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Legend -->
                            <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                                <div class="px-6 py-4 border-b border-gray-200">
                                    <h3 class="text-lg font-semibold text-gray-900">Keterangan</h3>
                                </div>
                                <div class="p-6">
                                    <div class="space-y-2">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-4 h-4 bg-blue-500 rounded-full"></div>
                                            <span class="text-sm text-gray-600">Lokasi kunjungan</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <div class="w-4 h-1 bg-red-500"></div>
                                            <span class="text-sm text-gray-600">Rute perjalanan</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <div class="w-4 h-4 bg-green-500 rounded-full"></div>
                                            <span class="text-sm text-gray-600">Kunjungan terbaru</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($visits->isNotEmpty())
        <script>
            let map;
            let markers = [];
            let routeLine = null;
            
            const visits = {!! $visits->map(function($visit) {
                return [
                    'lat' => $visit->lat,
                    'lng' => $visit->long,
                    'author' => $visit->author->name,
                    'date' => \Carbon\Carbon::parse($visit->tanggal)->format('d M Y'),
                    'result' => $visit->hasil
                ];
            })->toJson() !!};

            // Initialize map
            function initMap() {
                if (visits.length === 0) return;

                // Get center point (average of all coordinates)
                const centerLat = visits.reduce((sum, visit) => sum + parseFloat(visit.lat), 0) / visits.length;
                const centerLng = visits.reduce((sum, visit) => sum + parseFloat(visit.lng), 0) / visits.length;

                map = L.map('map').setView([centerLat, centerLng], 10);

                // Add tile layer
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                // Add markers for all visits
                visits.forEach((visit, index) => {
                    const isLatest = index === visits.length - 1;
                    const marker = L.marker([visit.lat, visit.lng])
                        .addTo(map)
                        .bindPopup(`
                            <div class="p-2">
                                <h3 class="font-semibold text-gray-900">${visit.author}</h3>
                                <p class="text-sm text-gray-600">${visit.date}</p>
                                ${visit.result ? `<p class="text-xs text-gray-500 mt-1">${visit.result.substring(0, 100)}...</p>` : ''}
                            </div>
                        `);
                    
                    markers.push(marker);
                });

                // Fit map to show all markers
                if (markers.length > 1) {
                    const group = new L.featureGroup(markers);
                    map.fitBounds(group.getBounds().pad(0.1));
                }
            }

            // Show route between visits
            function showRoute() {
                if (routeLine) {
                    map.removeLayer(routeLine);
                }

                if (visits.length < 2) return;

                const coordinates = visits.map(visit => [visit.lat, visit.lng]);
                
                routeLine = L.polyline(coordinates, {
                    color: 'red',
                    weight: 3,
                    opacity: 0.7,
                    smoothFactor: 1
                }).addTo(map);
            }

            // Show all visits without route
            function showAllVisits() {
                if (routeLine) {
                    map.removeLayer(routeLine);
                    routeLine = null;
                }

                // Fit map to show all markers
                if (markers.length > 1) {
                    const group = new L.featureGroup(markers);
                    map.fitBounds(group.getBounds().pad(0.1));
                }
            }

            // Focus on specific visit
            function focusOnVisit(lat, lng, author, date) {
                map.setView([lat, lng], 15);
                
                // Find and open popup for the marker
                markers.forEach(marker => {
                    const markerLatLng = marker.getLatLng();
                    if (Math.abs(markerLatLng.lat - lat) < 0.0001 && Math.abs(markerLatLng.lng - lng) < 0.0001) {
                        marker.openPopup();
                    }
                });
            }

            // Initialize map when page loads
            document.addEventListener('DOMContentLoaded', function() {
                initMap();
            });
        </script>
    @endif
</x-layouts.app>