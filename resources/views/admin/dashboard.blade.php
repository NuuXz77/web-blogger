<x-layouts.app title="Admin Dashboard">
    <x-slot:header>
        <h2 class="text-xl font-semibold text-gray-800">
            {{ __('Dasbor Admin') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-6 mb-6">
            <!-- Stats Cards -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-primary text-white rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    Total Kategori
                                </dt>
                                <dd class="text-lg font-semibold text-gray-900">
                                    {{ $totalCategories ?? 0 }}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-green-500 text-white rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    Total Artikel
                                </dt>
                                <dd class="text-lg font-semibold text-gray-900">
                                    {{ $totalPosts ?? 0 }}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-yellow-500 text-white rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    Total Komentar
                                </dt>
                                <dd class="text-lg font-semibold text-gray-900">
                                    {{ $totalComments ?? 0 }}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Visits Chart -->
        <div class="bg-white shadow-sm rounded-lg border border-gray-200 mb-6 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Grafik Kunjungan</h3>
                <div class="flex items-center space-x-3">
                    <select id="chart-range" class="appearance-none bg-white border border-gray-300 text-gray-700 py-2 pl-3 pr-8 rounded-lg shadow-sm hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50 text-sm">
                        <option value="day">Per Hari (7 hari)</option>
                        <option value="week" selected>Per Minggu (4 minggu)</option>
                        <option value="month">Per Bulan (12 bulan)</option>
                        <option value="custom">Kustom</option>
                    </select>

                    <select id="chart-auditor" class="appearance-none bg-white border border-gray-300 text-gray-700 py-2 pl-3 pr-8 rounded-lg shadow-sm hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50 text-sm">
                        <option value="">Semua Auditor</option>
                        @foreach(App\Models\User::where('role','auditor')->get() as $aud)
                            <option value="{{ $aud->id }}">{{ $aud->name }}</option>
                        @endforeach
                    </select>

                    <div id="custom-dates" class="hidden items-center space-x-2">
                        <input type="date" id="start-date" class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                        <input type="date" id="end-date" class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    </div>

                    <button id="update-chart" class="bg-primary text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition duration-150">Terapkan</button>
                </div>
            </div>

            <!-- Chart Container with Loading -->
            <div class="relative" style="height: 400px;">
                <div id="chart-loading" class="absolute inset-0 flex items-center justify-center bg-white bg-opacity-75 rounded-lg z-10">
                    <div class="flex flex-col items-center">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div>
                        <p class="text-sm text-gray-600 mt-2">Memuat grafik...</p>
                    </div>
                </div>
                <canvas id="visitsChart" style="height: 100%; width: 100%;"></canvas>
            </div>
        </div>

        <!-- Chart.js Script -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('visitsChart').getContext('2d');
                const primaryColor = '#0046FF';
                const loadingEl = document.getElementById('chart-loading');

                let visitsChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [],
                        datasets: [{
                            label: 'Kunjungan',
                            data: [],
                            borderColor: primaryColor,
                            backgroundColor: primaryColor + '33',
                            fill: true,
                            tension: 0.3,
                            pointBackgroundColor: primaryColor,
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: { 
                                display: true,
                                grid: { display: false },
                                ticks: {
                                    maxRotation: 45,
                                    minRotation: 0,
                                    font: {
                                        size: 11
                                    }
                                }
                            },
                            y: { 
                                beginAtZero: true,
                                grid: { color: '#f3f4f6' }
                            }
                        },
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                titleColor: '#fff',
                                bodyColor: '#fff',
                                cornerRadius: 6,
                            }
                        }
                    }
                });

                function showLoading() {
                    loadingEl.classList.remove('hidden');
                }

                function hideLoading() {
                    loadingEl.classList.add('hidden');
                }

                function fetchAndUpdate() {
                    showLoading();
                    
                    const range = document.getElementById('chart-range').value;
                    const auditor = document.getElementById('chart-auditor').value;
                    const start = document.getElementById('start-date').value;
                    const end = document.getElementById('end-date').value;

                    const params = new URLSearchParams();
                    if(range) params.set('range', range);
                    if(auditor) params.set('auditor_id', auditor);
                    if(range === 'custom' && start && end) {
                        params.set('start', start);
                        params.set('end', end);
                    }

                    fetch('{{ url('admin/audit/visits-chart-data') }}' + '?' + params.toString(), {
                        headers: { 
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                        }
                        return response.json();
                    })
                    .then(payload => {
                        console.log('Chart data received:', payload);
                        
                        if (payload.error) {
                            throw new Error(payload.message || payload.error);
                        }
                        
                        visitsChart.data.labels = payload.labels || [];
                        visitsChart.data.datasets[0].data = payload.data || [];
                        visitsChart.update();
                        hideLoading();
                        
                        if (payload.debug) {
                            console.log('Debug info:', payload.debug);
                        }
                    })
                    .catch(err => {
                        console.error('Chart fetch error:', err);
                        hideLoading();
                        
                        const errorMsg = err.message || 'Unknown error';
                        visitsChart.data.labels = [`Error: ${errorMsg}`];
                        visitsChart.data.datasets[0].data = [0];
                        visitsChart.update();
                    });
                }

                // Handle range change
                document.getElementById('chart-range').addEventListener('change', (e)=>{
                    const custom = document.getElementById('custom-dates');
                    if(e.target.value === 'custom') {
                        custom.classList.remove('hidden');
                        custom.classList.add('flex');
                    } else {
                        custom.classList.add('hidden');
                        custom.classList.remove('flex');
                        fetchAndUpdate(); // Auto-update when changing from custom
                    }
                });

                // Handle auditor change
                document.getElementById('chart-auditor').addEventListener('change', function() {
                    if(document.getElementById('chart-range').value !== 'custom') {
                        fetchAndUpdate();
                    }
                });

                document.getElementById('update-chart').addEventListener('click', fetchAndUpdate);

                // Initial load
                setTimeout(fetchAndUpdate, 100);
            });
        </script>

        <!-- Recent Posts with Filter -->
        <div class="bg-white shadow-sm rounded-lg border border-gray-200 mb-6">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-900">Artikel Terbaru</h3>

                {{-- <!-- Filter Form -->
                <div class="flex flex-wrap items-center gap-3">
                    <div class="relative">
                        <select id="status-filter" class="appearance-none bg-white border border-gray-300 text-gray-700 py-2 pl-4 pr-8 rounded-lg shadow-sm hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50 focus:border-primary text-sm transition duration-150 ease-in-out">
                            <option value="">Semua Status</option>
                            <option value="published">Dipublikasikan</option>
                            <option value="draft">Draft</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <div class="relative">
                        <select id="category-filter" class="appearance-none bg-white border border-gray-300 text-gray-700 py-2 pl-4 pr-8 rounded-lg shadow-sm hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50 focus:border-primary text-sm transition duration-150 ease-in-out">
                            <option value="">Semua Kategori</option>
                            @foreach ($categories ?? [] as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <button id="apply-filter" class="bg-primary text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-sm">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                            </svg>
                            Filter
                        </div>
                    </button>
                </div> --}}
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Judul</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            {{-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tayangan</th> --}}
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="posts-table-body">
                        @forelse($recentPosts ?? [] as $post)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $post->title }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">
                                        {{ $post->category->name ?? 'Tidak ada kategori' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($post->status == 'published')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Dipublikasikan
                                        </span>
                                    @else
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Draft
                                        </span>
                                    @endif
                                </td>
                                {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $post->views_count ?? 0 }}
                                </td> --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $post->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('admin.posts.edit', $post->id) }}"
                                        class="text-primary hover:text-blue-800 mr-3">Edit</a>
                                    <a href="{{ route('posts.show', $post->slug) }}" target="_blank"
                                        class="text-gray-600 hover:text-gray-900">Lihat</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Belum ada artikel yang dibuat
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-3">
                <a href="{{ route('admin.posts.create') }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-blue-700">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Buat Artikel Baru
                </a>
            </div>
        </div>

        <!-- Recent Comments -->
        {{-- <div class="bg-white shadow-sm rounded-lg border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Komentar Terbaru</h3>
            </div>
            <div class="overflow-hidden">
                <ul class="divide-y divide-gray-200" id="comments-list">
                    @forelse($recentComments ?? [] as $comment)
                        <li class="p-6 {{ $comment->is_approved ? '' : 'bg-yellow-50' }}">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-500 font-semibold">{{ substr($comment->name, 0, 1) }}</span>
                                    </div>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="flex justify-between">
                                        <p class="text-sm font-medium text-gray-900">{{ $comment->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $comment->created_at->format('d M Y') }}</p>
                                    </div>
                                    <div class="mt-1">
                                        <p class="text-sm text-gray-700">{{ $comment->content }}</p>
                                    </div>
                                    <div class="mt-2 text-sm">
                                        <a href="{{ route('posts.show', $comment->post->slug) }}#comment-{{ $comment->id }}" class="text-primary hover:text-blue-800">
                                            Pada: {{ $comment->post->title }}
                                        </a>
                                    </div>
                                    @if (!$comment->is_approved)
                                        <div class="mt-2 flex space-x-2">
                                            <form action="{{ route('admin.comments.approve', $comment->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                    Setujui
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                    Tolak
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="p-6 text-center">
                            <p class="text-sm text-gray-500">Belum ada komentar</p>
                        </li>
                    @endforelse
                </ul>
                
                @if (isset($recentComments) && count($recentComments) > 0)
                    <div class="px-6 py-3 border-t border-gray-200">
                        <a href="{{ route('admin.comments.index') }}" class="text-sm font-medium text-primary hover:text-blue-700">
                            Lihat semua komentar →
                        </a>
                    </div>
                @endif
            </div>
        </div> --}}
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const statusFilter = document.getElementById('status-filter');
                const categoryFilter = document.getElementById('category-filter');
                const applyFilter = document.getElementById('apply-filter');

                applyFilter.addEventListener('click', function() {
                    const status = statusFilter.value;
                    const category = categoryFilter.value;

                    // AJAX request to get filtered posts
                    fetch(`{{ route('admin.posts.filter') }}?status=${status}&category=${category}`)
                        .then(response => response.json())
                        .then(data => {
                            const tableBody = document.getElementById('posts-table-body');
                            tableBody.innerHTML = '';

                            if (data.posts.length === 0) {
                                tableBody.innerHTML = `
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                        Tidak ada artikel yang sesuai dengan filter
                                    </td>
                                </tr>
                            `;
                                return;
                            }

                            data.posts.forEach(post => {
                                const statusBadge = post.status === 'published' ?
                                    `<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Dipublikasikan</span>` :
                                    `<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Draft</span>`;

                                tableBody.innerHTML += `
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">${post.title}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">${post.category ? post.category.name : 'Tidak ada kategori'}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        ${statusBadge}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        ${post.views_count || 0}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        ${new Date(post.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' })}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="/admin/posts/${post.id}/edit" class="text-primary hover:text-blue-800 mr-3">Edit</a>
                                        <a href="/posts/${post.slug}" target="_blank" class="text-gray-600 hover:text-gray-900">Lihat</a>
                                    </td>
                                </tr>
                            `;
                            });
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        </script>
    @endpush
</x-layouts.app>
