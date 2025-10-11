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
                                    <p class="text-sm text-gray-600">Total Auditor</p>
                                    <p class="text-2xl font-bold text-indigo-600">
                                        {{ $visits->unique('auditor_id')->count() }}
                                    </p>
                                </div>
                                <div class="bg-indigo-100 p-3 rounded-full">
                                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filter Section -->
                    <div class="bg-white p-6 rounded-lg shadow-sm border mb-6 mt-6">
                        <div class="flex flex-col gap-4">
                            <h3 class="text-lg font-semibold text-gray-900">Filter Kunjungan</h3>

                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3">
                                <!-- Auditor Filter -->
                                <select id="auditorFilter"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                                    <option value="all">Semua Auditor</option>
                                    @foreach ($auditors as $auditor)
                                        <option value="{{ $auditor->id }}">{{ $auditor->name }}</option>
                                    @endforeach
                                </select>

                                <!-- Status Filter -->
                                <select id="statusFilter"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                                    <option value="all">Semua Status</option>
                                    <option value="pending">Pending</option>
                                    <option value="confirmed_by_author">Dikonfirmasi Author</option>
                                    <option value="confirmed_by_admin">Dikonfirmasi Admin</option>
                                    <option value="in_progress">Sedang Berlangsung</option>
                                    <option value="completed">Selesai</option>
                                </select>

                                <!-- Month Filter -->
                                <select id="monthFilter"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                                    <option value="all">Semua Bulan</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}">
                                            {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                                        </option>
                                    @endfor
                                </select>

                                <!-- Year Filter -->
                                <select id="yearFilter"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                                    <option value="all">Semua Tahun</option>
                                    @for ($year = date('Y'); $year >= 2020; $year--)
                                        <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>

                                <!-- Reset Button -->
                                <button id="resetFilter"
                                    class="bg-gray-200 text-gray-700 px-4 py-2.5 rounded-lg hover:bg-gray-300 transition-colors text-sm font-medium">
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
                                                    data-lng="{{ $visit->long }}"
                                                    data-status="{{ $visit->status }}"
                                                    data-auditor="{{ $visit->auditor_id }}"
                                                    data-month="{{ \Carbon\Carbon::parse($visit->tanggal)->format('n') }}"
                                                    data-year="{{ \Carbon\Carbon::parse($visit->tanggal)->format('Y') }}"
                                                    onclick="focusOnVisit({{ $visit->lat }}, {{ $visit->long }}, {{ $index }})">
                                                    <div class="flex items-start space-x-3">
                                                        <div class="flex-shrink-0">
                                                            <div
                                                                class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold text-white auditor-badge-{{ $visit->auditor_id }}">
                                                                {{ $index + 1 }}
                                                            </div>
                                                        </div>
                                                        <div class="flex-1 min-w-0">
                                                            <div class="flex items-center gap-2 flex-wrap">
                                                                <p class="text-sm font-medium text-gray-900">
                                                                    {{ $visit->author->name }}
                                                                </p>
                                                                <span
                                                                    class="px-2 py-1 text-xs rounded-full status-badge status-{{ $visit->status }}">
                                                                    {{ ucfirst(str_replace('_', ' ', $visit->status)) }}
                                                                </span>
                                                            </div>
                                                            <p class="text-xs text-gray-500 mt-1">
                                                                <span class="font-medium">Auditor:</span>
                                                                {{ $visit->auditor->name }}
                                                            </p>
                                                            <p class="text-sm text-gray-500">
                                                                {{ \Carbon\Carbon::parse($visit->tanggal)->translatedFormat('d F Y') }}
                                                            </p>
                                                            @if ($visit->hasil)
                                                                <p class="text-xs text-gray-400 mt-1 line-clamp-2">
                                                                    {{ Str::limit($visit->hasil, 60) }}
                                                                </p>
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
                                            <p class="mt-2 text-sm text-gray-500">Belum ada kunjungan</p>
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
                                    <!-- Status Legend -->
                                    <div class="mb-4">
                                        <p class="text-xs font-semibold text-gray-500 uppercase mb-3">Status Kunjungan
                                        </p>
                                        <div class="space-y-2">
                                            <div class="flex items-center space-x-2">
                                                <div class="w-4 h-4 rounded-full" style="background-color: #3b82f6;">
                                                </div>
                                                <span class="text-sm text-gray-600">Selesai</span>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <div class="w-4 h-4 rounded-full" style="background-color: #22c55e;">
                                                </div>
                                                <span class="text-sm text-gray-600">Sedang Berlangsung</span>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <div class="w-4 h-4 rounded-full" style="background-color: #eab308;">
                                                </div>
                                                <span class="text-sm text-gray-600">Dikonfirmasi Admin</span>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <div class="w-4 h-4 rounded-full" style="background-color: #f97316;">
                                                </div>
                                                <span class="text-sm text-gray-600">Dikonfirmasi Author</span>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <div class="w-4 h-4 rounded-full" style="background-color: #ef4444;">
                                                </div>
                                                <span class="text-sm text-gray-600">Pending</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Auditor Legend -->
                                    <div class="border-t pt-4">
                                        <p class="text-xs font-semibold text-gray-500 uppercase mb-3">Warna Auditor</p>
                                        <div class="space-y-2" id="auditorLegend">
                                            @foreach ($auditors as $auditor)
                                                <div class="flex items-center space-x-2">
                                                    <div
                                                        class="w-4 h-4 rounded-full auditor-color-{{ $auditor->id }}">
                                                    </div>
                                                    <span class="text-sm text-gray-600">{{ $auditor->name }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="border-t pt-4 mt-4">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-8 h-1 bg-red-500"></div>
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

            // Auditor colors - Generate dynamic colors for each auditor
            const auditorColors = {!! json_encode(
                $auditors->pluck('id')->mapWithKeys(function ($id, $index) {
                    $colors = ['#e11d48', '#2563eb', '#16a34a', '#9333ea', '#ea580c', '#0891b2', '#ca8a04', '#dc2626'];
                    return [$id => $colors[$index % count($colors)]];
                }),
            ) !!};

            const visits = {!! $visits->map(function ($visit) {
                    return [
                        'id' => $visit->id,
                        'lat' => $visit->lat,
                        'lng' => $visit->long,
                        'author' => $visit->author->name,
                        'auditor' => $visit->auditor->name,
                        'auditor_id' => $visit->auditor_id,
                        'date' => \Carbon\Carbon::parse($visit->tanggal)->translatedFormat('d F Y'),
                        'status' => $visit->status,
                        'result' => $visit->hasil,
                        'month' => \Carbon\Carbon::parse($visit->tanggal)->format('n'),
                        'year' => \Carbon\Carbon::parse($visit->tanggal)->format('Y'),
                    ];
                })->toJson() !!};

            // Status configuration
            const statusConfig = {
                'pending': {
                    color: '#ef4444',
                    icon: '⏳',
                    name: 'Pending'
                },
                'confirmed_by_author': {
                    color: '#f97316',
                    icon: '✅',
                    name: 'Dikonfirmasi Author'
                },
                'confirmed_by_admin': {
                    color: '#eab308',
                    icon: '👨‍💼',
                    name: 'Dikonfirmasi Admin'
                },
                'in_progress': {
                    color: '#22c55e',
                    icon: '🚶',
                    name: 'Sedang Berlangsung'
                },
                'completed': {
                    color: '#3b82f6',
                    icon: '🏁',
                    name: 'Selesai'
                }
            };

            // Apply auditor colors to badges and legend
            document.addEventListener('DOMContentLoaded', function() {
                Object.keys(auditorColors).forEach(auditorId => {
                    const color = auditorColors[auditorId];
                    // Apply to list badges
                    document.querySelectorAll(`.auditor-badge-${auditorId}`).forEach(badge => {
                        badge.style.backgroundColor = color;
                    });
                    // Apply to legend
                    document.querySelectorAll(`.auditor-color-${auditorId}`).forEach(dot => {
                        dot.style.backgroundColor = color;
                    });
                });
            });

            // Initialize map
            function initMap() {
                if (visits.length === 0) return;

                const centerLat = visits.reduce((sum, visit) => sum + parseFloat(visit.lat), 0) / visits.length;
                const centerLng = visits.reduce((sum, visit) => sum + parseFloat(visit.lng), 0) / visits.length;

                map = L.map('map').setView([centerLat, centerLng], 10);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                visits.forEach((visit, index) => {
                    const statusInfo = statusConfig[visit.status];
                    const auditorColor = auditorColors[visit.auditor_id];

                    const customIcon = L.divIcon({
                        className: 'custom-marker',
                        html: `<div class="marker-wrapper">
                                <div class="marker-content" style="background-color: ${statusInfo.color};">
                                    <span class="marker-icon">${statusInfo.icon}</span>
                                </div>
                                <div class="marker-auditor-ring" style="border-color: ${auditorColor};"></div>
                                <div class="marker-number" style="background-color: ${auditorColor};">${index + 1}</div>
                              </div>`,
                        iconSize: [40, 40],
                        iconAnchor: [20, 40],
                        popupAnchor: [0, -40]
                    });

                    const marker = L.marker([visit.lat, visit.lng], {
                            icon: customIcon
                        })
                        .addTo(map)
                        .bindPopup(`
                            <div class="p-3 min-w-[220px]">
                                <div class="flex items-center gap-2 mb-2">
                                    <h3 class="font-bold text-gray-900">${visit.author}</h3>
                                    <span class="px-2 py-1 text-xs rounded-full" style="background-color: ${statusInfo.color}20; color: ${statusInfo.color};">
                                        ${statusInfo.icon} ${statusInfo.name}
                                    </span>
                                </div>
                                <div class="flex items-center gap-2 mb-2">
                                    <div class="w-3 h-3 rounded-full" style="background-color: ${auditorColor};"></div>
                                    <p class="text-xs font-medium text-gray-600">Auditor: ${visit.auditor}</p>
                                </div>
                                <p class="text-sm text-gray-600 mb-2">${visit.date}</p>
                                ${visit.result ? `<p class="text-xs text-gray-500 mt-2 border-t pt-2">${visit.result.substring(0, 100)}...</p>` : ''}
                                <div class="mt-2 text-xs text-gray-400 bg-gray-50 px-2 py-1 rounded">
                                    Kunjungan ke-${index + 1}
                                </div>
                            </div>
                        `);

                    markers.push({
                        marker: marker,
                        id: visit.id,
                        status: visit.status,
                        month: visit.month,
                        year: visit.year,
                        auditor_id: visit.auditor_id
                    });
                });

                if (markers.length > 1) {
                    const group = new L.featureGroup(markers.map(m => m.marker));
                    map.fitBounds(group.getBounds().pad(0.1));
                }
            }

            // Show route
            function showRoute() {
                if (routeLine) map.removeLayer(routeLine);
                if (visits.length < 2) return;

                const coordinates = visits.map(visit => [visit.lat, visit.lng]);
                routeLine = L.polyline(coordinates, {
                    color: 'red',
                    weight: 4,
                    opacity: 0.7,
                    dashArray: '10, 10'
                }).addTo(map);

                map.fitBounds(routeLine.getBounds().pad(0.1));
            }

            // Show all visits
            function showAllVisits() {
                if (routeLine) {
                    map.removeLayer(routeLine);
                    routeLine = null;
                }
                if (markers.length > 1) {
                    const group = new L.featureGroup(markers.map(m => m.marker));
                    map.fitBounds(group.getBounds().pad(0.1));
                }
            }

            // Focus on visit
            function focusOnVisit(lat, lng, index) {
                map.setView([lat, lng], 15);
                if (currentPopup) currentPopup.closePopup();

                const markerObj = markers[index];
                if (markerObj) {
                    markerObj.marker.openPopup();
                    currentPopup = markerObj.marker;
                }

                document.querySelectorAll('.visit-item').forEach(item => {
                    item.classList.remove('bg-blue-50', 'border-blue-300', 'ring-2', 'ring-blue-500');
                });

                const listItem = document.querySelector(`.visit-item[data-lat="${lat}"][data-lng="${lng}"]`);
                if (listItem) {
                    listItem.classList.add('bg-blue-50', 'border-blue-300', 'ring-2', 'ring-blue-500');
                    listItem.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            }

            // Filter visits
            function filterVisits() {
                const auditorFilter = document.getElementById('auditorFilter').value;
                const statusFilter = document.getElementById('statusFilter').value;
                const monthFilter = document.getElementById('monthFilter').value;
                const yearFilter = document.getElementById('yearFilter').value;

                document.querySelectorAll('.visit-item').forEach(item => {
                    const auditor = item.getAttribute('data-auditor');
                    const status = item.getAttribute('data-status');
                    const month = item.getAttribute('data-month');
                    const year = item.getAttribute('data-year');

                    const auditorMatch = auditorFilter === 'all' || auditor === auditorFilter;
                    const statusMatch = statusFilter === 'all' || status === statusFilter;
                    const monthMatch = monthFilter === 'all' || month === monthFilter;
                    const yearMatch = yearFilter === 'all' || year === yearFilter;

                    if (auditorMatch && statusMatch && monthMatch && yearMatch) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });

                // Filter markers
                markers.forEach(markerObj => {
                    const auditorMatch = auditorFilter === 'all' || markerObj.auditor_id.toString() === auditorFilter;
                    const statusMatch = statusFilter === 'all' || markerObj.status === statusFilter;
                    const monthMatch = monthFilter === 'all' || markerObj.month.toString() === monthFilter;
                    const yearMatch = yearFilter === 'all' || markerObj.year.toString() === yearFilter;

                    if (auditorMatch && statusMatch && monthMatch && yearMatch) {
                        map.addLayer(markerObj.marker);
                    } else {
                        map.removeLayer(markerObj.marker);
                    }
                });

                // Update map view
                const visibleMarkers = markers.filter(markerObj => {
                    const auditorMatch = auditorFilter === 'all' || markerObj.auditor_id.toString() === auditorFilter;
                    const statusMatch = statusFilter === 'all' || markerObj.status === statusFilter;
                    const monthMatch = monthFilter === 'all' || markerObj.month.toString() === monthFilter;
                    const yearMatch = yearFilter === 'all' || markerObj.year.toString() === yearFilter;
                    return auditorMatch && statusMatch && monthMatch && yearMatch;
                });

                if (visibleMarkers.length > 0) {
                    const group = new L.featureGroup(visibleMarkers.map(m => m.marker));
                    map.fitBounds(group.getBounds().pad(0.1));
                }
            }

            // Initialize
            document.addEventListener('DOMContentLoaded', function() {
                initMap();

                // Event listeners
                document.getElementById('auditorFilter').addEventListener('change', filterVisits);
                document.getElementById('statusFilter').addEventListener('change', filterVisits);
                document.getElementById('monthFilter').addEventListener('change', filterVisits);
                document.getElementById('yearFilter').addEventListener('change', filterVisits);

                document.getElementById('resetFilter').addEventListener('click', function() {
                    document.getElementById('auditorFilter').value = 'all';
                    document.getElementById('statusFilter').value = 'all';
                    document.getElementById('monthFilter').value = 'all';
                    document.getElementById('yearFilter').value = 'all';
                    filterVisits();
                });
            });
        </script>

        <style>
            /* Custom Marker Styles */
            .custom-marker {
                background: transparent;
                border: none;
            }

            .marker-wrapper {
                position: relative;
                width: 40px;
                height: 40px;
            }

            .marker-content {
                width: 30px;
                height: 30px;
                border-radius: 50% 50% 50% 0;
                transform: rotate(-45deg);
                display: flex;
                align-items: center;
                justify-content: center;
                position: absolute;
                top: 0;
                left: 5px;
                box-shadow: 0 3px 8px rgba(0, 0, 0, 0.4);
                z-index: 2;
            }

            .marker-auditor-ring {
                width: 38px;
                height: 38px;
                border-radius: 50% 50% 50% 0;
                transform: rotate(-45deg);
                position: absolute;
                top: -4px;
                left: 1px;
                border: 3px solid;
                z-index: 1;
                animation: pulseRing 2s ease-in-out infinite;
            }

            @keyframes pulseRing {

                0%,
                100% {
                    opacity: 0.6;
                    transform: rotate(-45deg) scale(1);
                }

                50% {
                    opacity: 1;
                    transform: rotate(-45deg) scale(1.05);
                }
            }

            .marker-icon {
                transform: rotate(45deg);
                font-size: 14px;
                color: white;
                filter: drop-shadow(0 1px 2px rgba(0, 0, 0, 0.3));
            }

            .marker-number {
                position: absolute;
                bottom: -8px;
                left: 50%;
                transform: translateX(-50%);
                font-size: 11px;
                font-weight: bold;
                color: white;
                border-radius: 10px;
                padding: 2px 6px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
                z-index: 3;
                white-space: nowrap;
            }

            /* Status Badge Styles */
            .status-badge {
                font-weight: 600;
            }

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

            /* Visit Item Hover */
            .visit-item {
                transition: all 0.3s ease;
            }

            .visit-item:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            }

            /* Leaflet Popup Customization */
            .leaflet-popup-content-wrapper {
                border-radius: 12px;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            }

            .leaflet-popup-content {
                margin: 0;
            }

            .leaflet-popup-tip {
                box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            }

            /* Scrollbar Styling */
            #visitList::-webkit-scrollbar {
                width: 6px;
            }

            #visitList::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 10px;
            }

            #visitList::-webkit-scrollbar-thumb {
                background: #cbd5e1;
                border-radius: 10px;
            }

            #visitList::-webkit-scrollbar-thumb:hover {
                background: #94a3b8;
            }
        </style>
    @endif
</x-layouts.app>
