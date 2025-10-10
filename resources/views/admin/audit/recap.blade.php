<x-layouts.app title="Rekap Kunjungan">
    <div class="min-h-screen bg-gray-50">
        <div class="flex">
            <!-- Main Content -->
            <div class="flex-1">
                <div>
                    <x-slot:header>
                        <!-- Header -->
                        <div>
                            <div class="flex justify-between items-center">
                                <div>
                                    <h1 class="text-3xl font-bold text-gray-900">Rekap Kunjungan</h1>
                                    <p class="text-gray-600 mt-2">Peta perjalanan dan riwayat kunjungan Anda</p>
                                </div>
                                <a href="{{ route('admin.audit.index') }}"
                                    class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                    Kembali ke Daftar
                                </a>
                            </div>
                        </div>
                    </x-slot:header>


                    <!-- Stats Summary -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6 mt-6">
                        <div class="bg-white p-6 rounded-lg shadow-sm border">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Total Kunjungan</p>
                                    <p class="text-2xl font-bold text-green-600">{{ $visits->count() }}</p>
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

                        <div class="bg-white p-6 rounded-lg shadow-sm border">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Bulan Ini</p>
                                    <p class="text-2xl font-bold text-blue-600">
                                        {{ $visits->filter(function ($visit) {
                                                return \Carbon\Carbon::parse($visit->tanggal)->isCurrentMonth();
                                            })->count() }}
                                    </p>
                                </div>
                                <div class="bg-blue-100 p-3 rounded-full">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm border">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Minggu Ini</p>
                                    <p class="text-2xl font-bold text-purple-600">
                                        {{ $visits->filter(function ($visit) {
                                                return \Carbon\Carbon::parse($visit->tanggal)->isCurrentWeek();
                                            })->count() }}
                                    </p>
                                </div>
                                <div class="bg-purple-100 p-3 rounded-full">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
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
                                    <p class="text-sm text-gray-600">Lokasi Berbeda</p>
                                    <p class="text-2xl font-bold text-indigo-600">
                                        {{ $visits->unique('author_id')->count() }}
                                    </p>
                                </div>
                                <div class="bg-indigo-100 p-3 rounded-full">
                                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filter Section -->
                    <div class="bg-white p-6 rounded-lg shadow-sm border mb-6 mt-6">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <h3 class="text-lg font-semibold text-gray-900">Filter Kunjungan</h3>
                            <div class="flex flex-wrap gap-3">
                                <select id="statusFilter"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                                    <option value="all">Semua Status</option>
                                    <option value="pending">Pending</option>
                                    <option value="confirmed_by_author">Dikonfirmasi Author</option>
                                    <option value="confirmed_by_admin">Dikonfirmasi Admin</option>
                                    <option value="in_progress">Sedang Berlangsung</option>
                                    <option value="completed" selected>Selesai</option>
                                </select>

                                <select id="monthFilter"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                                    <option value="all">Semua Bulan</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}">
                                            {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}</option>
                                    @endfor
                                </select>

                                <button id="resetFilter"
                                    class="bg-gray-200 text-gray-700 px-4 py-2.5 rounded-lg hover:bg-gray-300 transition-colors text-sm">
                                    Reset Filter
                                </button>
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
                                    @if ($visits->isNotEmpty())
                                        <div id="map" class="w-full h-96 rounded-lg border"></div>
                                        <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4" id="mapControls">
                                            <!-- Map controls will be populated by JavaScript -->
                                        </div>
                                    @else
                                        <div class="text-center py-12">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
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
                                    @if ($visits->isNotEmpty())
                                        <div class="space-y-4 max-h-[500px] overflow-y-auto" id="visitList">
                                            @foreach ($visits as $index => $visit)
                                                <div class="border rounded-lg p-4 hover:bg-gray-50 cursor-pointer visit-item transition-all duration-200"
                                                    data-id="{{ $visit->id }}" data-lat="{{ $visit->lat }}"
                                                    data-lng="{{ $visit->long }}" data-status="{{ $visit->status }}"
                                                    data-month="{{ \Carbon\Carbon::parse($visit->tanggal)->format('n') }}"
                                                    onclick="focusOnVisit({{ $visit->lat }}, {{ $visit->long }}, {{ $index }})">
                                                    <div class="flex items-start space-x-3">
                                                        <div class="flex-shrink-0">
                                                            <div
                                                                class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium status-{{ $visit->status }}">
                                                                {{ $index + 1 }}
                                                            </div>
                                                        </div>
                                                        <div class="flex-1 min-w-0">
                                                            <div class="flex items-center gap-2">
                                                                <p class="text-sm font-medium text-gray-900">
                                                                    {{ $visit->author->name }}</p>
                                                                <span
                                                                    class="px-2 py-1 text-xs rounded-full status-badge status-{{ $visit->status }}">
                                                                    {{ ucfirst(str_replace('_', ' ', $visit->status)) }}
                                                                </span>
                                                            </div>
                                                            <p class="text-sm text-gray-500">
                                                                {{ \Carbon\Carbon::parse($visit->tanggal)->translatedFormat('d F Y') }}
                                                            </p>
                                                            @if ($visit->hasil)
                                                                <p class="text-xs text-gray-400 mt-1 line-clamp-2">
                                                                    {{ Str::limit($visit->hasil, 60) }}</p>
                                                            @endif
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <svg class="w-5 h-5 text-green-500" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
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
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center py-8">
                                            <svg class="mx-auto h-10 w-10 text-gray-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                                </path>
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
                                    <div class="space-y-3">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-4 h-4 bg-blue-500 rounded-full"></div>
                                            <span class="text-sm text-gray-600">Kunjungan Selesai</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <div class="w-4 h-4 bg-green-500 rounded-full"></div>
                                            <span class="text-sm text-gray-600">Sedang Berlangsung</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <div class="w-4 h-4 bg-yellow-500 rounded-full"></div>
                                            <span class="text-sm text-gray-600">Dikonfirmasi Admin</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <div class="w-4 h-4 bg-orange-500 rounded-full"></div>
                                            <span class="text-sm text-gray-600">Dikonfirmasi Author</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <div class="w-4 h-4 bg-red-500 rounded-full"></div>
                                            <span class="text-sm text-gray-600">Pending</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <div class="w-4 h-1 bg-red-500"></div>
                                            <span class="text-sm text-gray-600">Rute perjalanan</span>
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

    @if ($visits->isNotEmpty())
        <script>
            let map;
            let markers = [];
            let routeLine = null;
            let currentPopup = null;

            const visits = {!! $visits->map(function ($visit) {
                    return [
                        'id' => $visit->id,
                        'lat' => $visit->lat,
                        'lng' => $visit->long,
                        'author' => $visit->author->name,
                        'date' => \Carbon\Carbon::parse($visit->tanggal)->translatedFormat('d F Y'),
                        'status' => $visit->status,
                        'result' => $visit->hasil,
                        'month' => \Carbon\Carbon::parse($visit->tanggal)->format('n'),
                    ];
                })->toJson() !!};

            // Status configuration
            const statusConfig = {
                'pending': {
                    color: 'red',
                    icon: '⏳'
                },
                'confirmed_by_author': {
                    color: 'orange',
                    icon: '✅'
                },
                'confirmed_by_admin': {
                    color: 'yellow',
                    icon: '👨‍💼'
                },
                'in_progress': {
                    color: 'green',
                    icon: '🚶'
                },
                'completed': {
                    color: 'blue',
                    icon: '🏁'
                }
            };

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
                    const statusInfo = statusConfig[visit.status];
                    const isLatest = index === visits.length - 1;

                    // Create custom icon based on status
                    const customIcon = L.divIcon({
                        className: 'custom-marker',
                        html: `<div class="marker-content status-${visit.status}" style="background-color: ${statusInfo.color};">
                                <span class="marker-icon">${statusInfo.icon}</span>
                                <span class="marker-number">${index + 1}</span>
                              </div>`,
                        iconSize: [30, 30],
                        iconAnchor: [15, 30],
                        popupAnchor: [0, -30]
                    });

                    const marker = L.marker([visit.lat, visit.lng], {
                            icon: customIcon
                        })
                        .addTo(map)
                        .bindPopup(`
                            <div class="p-2 min-w-[200px]">
                                <div class="flex items-center gap-2 mb-2">
                                    <h3 class="font-semibold text-gray-900">${visit.author}</h3>
                                    <span class="px-2 py-1 text-xs rounded-full status-${visit.status}">
                                        ${statusInfo.icon} ${ucfirst(visit.status.replace('_', ' '))}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600">${visit.date}</p>
                                ${visit.result ? `<p class="text-xs text-gray-500 mt-2">${visit.result.substring(0, 100)}...</p>` : ''}
                                <div class="mt-2 text-xs text-gray-400">
                                    Kunjungan ke-${index + 1}
                                </div>
                            </div>
                        `);

                    markers.push({
                        marker: marker,
                        id: visit.id,
                        status: visit.status,
                        month: visit.month
                    });
                });

                // Fit map to show all markers
                if (markers.length > 1) {
                    const group = new L.featureGroup(markers.map(m => m.marker));
                    map.fitBounds(group.getBounds().pad(0.1));
                }

                // Initialize map controls
                initMapControls();
            }

            // Initialize map controls
            function initMapControls() {
                const controlsContainer = document.getElementById('mapControls');
                if (!controlsContainer) return;

                // Add zoom to markers controls
                markers.forEach((markerObj, index) => {
                    const control = document.createElement('button');
                    control.className =
                        'text-sm bg-gray-100 text-gray-700 px-3 py-2 rounded-lg hover:bg-gray-200 transition-colors flex items-center gap-1';
                    control.innerHTML = `
                        <span class="w-3 h-3 rounded-full" style="background-color: ${statusConfig[markerObj.status].color}"></span>
                        Kunjungan ${index + 1}
                    `;
                    control.onclick = () => focusOnVisit(
                        markerObj.marker.getLatLng().lat,
                        markerObj.marker.getLatLng().lng,
                        index
                    );
                    controlsContainer.appendChild(control);
                });
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
                    weight: 4,
                    opacity: 0.7,
                    smoothFactor: 1,
                    dashArray: '10, 10'
                }).addTo(map);

                // Fit map to show the route
                map.fitBounds(routeLine.getBounds().pad(0.1));
            }

            // Show all visits without route
            function showAllVisits() {
                if (routeLine) {
                    map.removeLayer(routeLine);
                    routeLine = null;
                }

                // Fit map to show all markers
                if (markers.length > 1) {
                    const group = new L.featureGroup(markers.map(m => m.marker));
                    map.fitBounds(group.getBounds().pad(0.1));
                }
            }

            // Focus on specific visit
            function focusOnVisit(lat, lng, index) {
                map.setView([lat, lng], 15);

                // Close any existing popup
                if (currentPopup) {
                    currentPopup.closePopup();
                }

                // Find and open popup for the marker
                const markerObj = markers[index];
                if (markerObj) {
                    markerObj.marker.openPopup();
                    currentPopup = markerObj.marker;
                }

                // Highlight the corresponding list item
                document.querySelectorAll('.visit-item').forEach(item => {
                    item.classList.remove('bg-blue-50', 'border-blue-300');
                });

                const listItem = document.querySelector(`.visit-item[data-lat="${lat}"][data-lng="${lng}"]`);
                if (listItem) {
                    listItem.classList.add('bg-blue-50', 'border-blue-300');
                    listItem.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            }

            // Filter visits based on status and month
            function filterVisits() {
                const statusFilter = document.getElementById('statusFilter').value;
                const monthFilter = document.getElementById('monthFilter').value;

                // Filter list items
                document.querySelectorAll('.visit-item').forEach(item => {
                    const status = item.getAttribute('data-status');
                    const month = item.getAttribute('data-month');

                    const statusMatch = statusFilter === 'all' || status === statusFilter;
                    const monthMatch = monthFilter === 'all' || month === monthFilter;

                    if (statusMatch && monthMatch) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });

                // Filter markers on map
                markers.forEach(markerObj => {
                    const statusMatch = statusFilter === 'all' || markerObj.status === statusFilter;
                    const monthMatch = monthFilter === 'all' || markerObj.month.toString() === monthFilter;

                    if (statusMatch && monthMatch) {
                        map.addLayer(markerObj.marker);
                    } else {
                        map.removeLayer(markerObj.marker);
                    }
                });

                // Update map view to show filtered markers
                const visibleMarkers = markers.filter(markerObj => {
                    const statusMatch = statusFilter === 'all' || markerObj.status === statusFilter;
                    const monthMatch = monthFilter === 'all' || markerObj.month.toString() === monthFilter;
                    return statusMatch && monthMatch;
                });

                if (visibleMarkers.length > 0) {
                    const group = new L.featureGroup(visibleMarkers.map(m => m.marker));
                    map.fitBounds(group.getBounds().pad(0.1));
                }
            }

            // Utility function to capitalize first letter
            function ucfirst(str) {
                return str.charAt(0).toUpperCase() + str.slice(1);
            }

            // Initialize when page loads
            document.addEventListener('DOMContentLoaded', function() {
                initMap();

                // Add event listeners for filters
                document.getElementById('statusFilter').addEventListener('change', filterVisits);
                document.getElementById('monthFilter').addEventListener('change', filterVisits);
                document.getElementById('resetFilter').addEventListener('click', function() {
                    document.getElementById('statusFilter').value = 'all';
                    document.getElementById('monthFilter').value = 'all';
                    filterVisits();
                });
            });
        </script>

        <style>
            .custom-marker {
                background: transparent;
                border: none;
            }

            .marker-content {
                width: 30px;
                height: 30px;
                border-radius: 50% 50% 50% 0;
                transform: rotate(-45deg);
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            }

            .marker-icon {
                transform: rotate(45deg);
                font-size: 12px;
                color: white;
            }

            .marker-number {
                position: absolute;
                bottom: -15px;
                left: 50%;
                transform: translateX(-50%);
                font-size: 10px;
                font-weight: bold;
                color: #333;
                background: white;
                border-radius: 10px;
                padding: 0 4px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
            }

            /* Status badge styles */
            .status-pending {
                background-color: #fee2e2;
                color: #dc2626;
            }

            .status-confirmed_by_author {
                background-color: #fed7aa;
                color: #ea580c;
            }

            .status-confirmed_by_admin {
                background-color: #fef3c7;
                color: #d97706;
            }

            .status-in_progress {
                background-color: #dcfce7;
                color: #16a34a;
            }

            .status-completed {
                background-color: #dbeafe;
                color: #2563eb;
            }

            /* Status marker styles */
            .status-pending .marker-content {
                background-color: #ef4444 !important;
            }

            .status-confirmed_by_author .marker-content {
                background-color: #f97316 !important;
            }

            .status-confirmed_by_admin .marker-content {
                background-color: #eab308 !important;
            }

            .status-in_progress .marker-content {
                background-color: #22c55e !important;
            }

            .status-completed .marker-content {
                background-color: #3b82f6 !important;
            }

            /* List item hover effects */
            .visit-item:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            }
        </style>
    @endif
</x-layouts.app>
