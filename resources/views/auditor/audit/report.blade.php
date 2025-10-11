<x-layouts.app title="Laporan Kunjungan">
    <div class="bg-gray-50">
        <!-- Main Content -->
        <div class="mt-6">
            <!-- Header -->
            <x-slot:header>
                <div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div>
                                <h1 class="text-2xl sm:text-2xl font-bold text-gray-900">Laporan Kunjungan</h1>
                                <p class="text-gray-600 mt-1 text-sm">Lengkapi laporan kunjungan Anda</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('auditor.audit.index') }}"
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

            <!-- Visit Info Card -->
            <div class="bg-white rounded-lg shadow-sm border overflow-hidden mb-6">
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
                <div class="p-6">
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
                                <label class="block text-sm font-medium text-gray-500">Author yang dikunjungi</label>
                                <p class="text-sm font-medium text-gray-900 mt-1">{{ $audit->author->name }}
                                </p>
                                <p class="text-sm text-gray-500">{{ $audit->author->email }}</p>
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
                                <label class="block text-sm font-medium text-gray-500">Tanggal Kunjungan</label>
                                <p class="text-sm text-gray-900 mt-1">
                                    {{ \Carbon\Carbon::parse($audit->tanggal)->format('d F Y') }}</p>
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="md:col-span-2 flex items-start space-x-3">
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
                                <label class="block text-sm font-medium text-gray-500">Alamat Tujuan Kunjungan</label>
                                <div class="mt-1 p-3 bg-blue-50 rounded-lg border border-blue-200">
                                    <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $audit->alamat }}</p>
                                </div>
                            </div>
                        </div>

                        @if ($audit->keterangan)
                            <div class="md:col-span-2 flex items-start space-x-3">
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
                                    <p class="mt-1 text-sm text-gray-900">{{ $audit->keterangan }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Report Form -->
            <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Form Laporan Kunjungan
                    </h3>
                </div>

                <form action="{{ route('auditor.audit.store-report', $audit) }}" method="POST">
                    @csrf
                    <div class="p-6 space-y-8">
                        <!-- Hasil Kunjungan -->
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-6 border border-green-200">
                            <div class="flex items-start space-x-4 mb-4">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="h-10 w-10 rounded-lg bg-green-100 text-green-600 flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <label for="hasil" class="block text-sm font-semibold text-gray-800">
                                        Hasil Kunjungan <span class="text-red-500">*</span>
                                    </label>
                                    <p class="text-xs text-gray-600 mt-1">Jelaskan hasil kunjungan Anda secara detail dan lengkap.</p>
                                </div>
                            </div>
                            <textarea name="hasil" id="hasil" rows="6" required
                                placeholder="Contoh: Kunjungan berhasil dilakukan. Auditor telah bertemu dengan pemilik usaha dan melakukan verifikasi dokumen..."
                                class="w-full p-4 border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 transition">{{ old('hasil') }}</textarea>
                            @error('hasil')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- [REVISED] Foto Selfie (Responsive) -->
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4 sm:p-6 border border-blue-200">
                            <div class="flex items-start space-x-4 mb-4">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="h-10 w-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-gray-800">
                                        Foto Bukti Kunjungan (Selfie) <span class="text-red-500">*</span>
                                    </label>
                                    <p class="text-xs text-gray-600 mt-1">Lokasi GPS akan diambil otomatis saat membuka kamera.</p>
                                </div>
                            </div>

                            <div id="media-wrapper" class="w-full aspect-video bg-gray-900 rounded-lg overflow-hidden my-4 shadow-inner hidden">
                                <video id="camera-video" class="w-full h-full object-cover" autoplay playsinline style="transform: scaleX(-1);"></video>
                                <img id="photo-preview" src="" alt="Pratinjau Foto" class="w-full h-full object-cover hidden">
                            </div>
                            
                            <div id="status-message" class="hidden mb-4"></div>

                            <div class="mt-4 flex flex-wrap justify-center sm:justify-start gap-3">
                                <button type="button" id="start-camera-btn" class="flex-grow sm:flex-grow-0 bg-blue-600 text-white px-5 py-2.5 rounded-lg hover:bg-blue-700 transition flex items-center justify-center gap-2 font-medium shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span>Buka Kamera & Ambil Lokasi</span>
                                </button>
                                <button type="button" id="take-photo-btn" class="hidden flex-grow sm:flex-grow-0 bg-green-600 text-white px-5 py-2.5 rounded-lg hover:bg-green-700 transition flex items-center justify-center gap-2 font-medium shadow-sm">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 001.553.832l3-2a1 1 0 000-1.664l-3-2z"></path></svg>
                                    <span>Ambil Foto</span>
                                </button>
                                <button type="button" id="retake-photo-btn" class="hidden flex-grow sm:flex-grow-0 bg-yellow-500 text-white px-5 py-2.5 rounded-lg hover:bg-yellow-600 transition flex items-center justify-center gap-2 font-medium shadow-sm">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"></path></svg>
                                    <span>Foto Ulang</span>
                                </button>
                            </div>

                            <canvas id="canvas" class="hidden"></canvas>
                            <input type="hidden" name="selfie" id="selfie-data" required>
                            @error('selfie')
                                <p class="text-red-500 text-sm mt-3">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Location Section -->
<div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-6 border border-purple-200">
    <!-- Header -->
    <div class="flex items-start gap-4 mb-4">
        <div class="flex-shrink-0 mt-1">
            <div class="h-10 w-10 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
        </div>
        <div class="flex-1">
            <label class="block text-sm font-semibold text-gray-800">
                Lokasi Kunjungan <span class="text-red-500">*</span>
            </label>
            <p class="text-xs sm:text-sm text-gray-600 mt-1 leading-relaxed">
                Lokasi di peta akan ter-update otomatis atau bisa diambil manual.
            </p>
        </div>
    </div>

    <!-- Content -->
    <div class="space-y-6">
        <!-- Button + Status -->
        <div class="flex flex-col sm:flex-row sm:items-center gap-3">
            <button 
                type="button" 
                id="get-location-btn" 
                class="w-full sm:w-auto bg-purple-600 text-white px-5 py-2.5 rounded-lg 
                       hover:bg-purple-700 transition flex items-center justify-center gap-2 
                       font-medium shadow-sm"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span>Ambil Lokasi Manual</span>
            </button>
            
            <div id="location-status" 
                class="text-sm text-gray-700 px-3 py-2 bg-white rounded-lg border border-purple-200 
                       flex-1 text-center sm:text-left"
            >
                <span class="italic">Belum ada lokasi yang diambil</span>
            </div>
        </div>

        <!-- Map -->
        <div class="bg-white rounded-xl p-3 border-2 border-dashed border-purple-300">
            <div id="map" class="w-full h-64 rounded-lg border-2 border-purple-200 shadow-inner"></div>
        </div>

        <!-- Hidden Inputs -->
        <input type="hidden" name="lat" id="lat" required>
        <input type="hidden" name="long" id="long" required>
        @error('lat') 
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p> 
        @enderror
        @error('long') 
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p> 
        @enderror
    </div>
</div>

                    </div>

                    <div class="px-6 py-6 bg-gradient-to-r from-gray-50 to-gray-100 border-t border-gray-200 flex justify-end space-x-4">
                        <a href="{{ route('auditor.audit.index') }}" class="px-6 py-3 border-2 border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 flex items-center gap-2 font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            Batal
                        </a>
                        <button type="submit" class="px-8 py-3 bg-gradient-to-r from-primary to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 flex items-center gap-2 shadow-lg hover:shadow-xl transform hover:scale-105 font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                            Kirim Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // --- Elements ---
            const videoEl = document.getElementById('camera-video');
            const canvasEl = document.getElementById('canvas');
            const photoPreviewEl = document.getElementById('photo-preview');
            const mediaWrapperEl = document.getElementById('media-wrapper');
            const statusMessageEl = document.getElementById('status-message');
            const selfieDataInput = document.getElementById('selfie-data');
            const startBtn = document.getElementById('start-camera-btn');
            const takePhotoBtn = document.getElementById('take-photo-btn');
            const retakeBtn = document.getElementById('retake-photo-btn');
            
            const mapContainer = document.getElementById('map');
            const getLocationBtn = document.getElementById('get-location-btn');
            const locationStatusEl = document.getElementById('location-status');
            const latInput = document.getElementById('lat');
            const longInput = document.getElementById('long');

            // --- State ---
            let cameraStream = null;
            let map;
            let currentMarker;

            // --- Helper Functions ---
            function updateStatus(message, type = 'info') {
                let styles = {
                    info: 'bg-gray-100 text-gray-800 border-gray-300',
                    success: 'bg-green-50 text-green-800 border-green-300',
                    error: 'bg-red-50 text-red-800 border-red-300',
                    loading: 'bg-blue-50 text-blue-800 border-blue-300'
                };
                let icons = {
                    success: `<svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>`,
                    error: `<svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>`,
                    loading: `<div class="animate-spin w-5 h-5 border-2 border-current border-t-transparent rounded-full"></div>`
                }
                
                statusMessageEl.innerHTML = `<div class="flex items-center gap-3 p-3 ${styles[type]} text-sm rounded-lg border">${icons[type] || ''}<span>${message}</span></div>`;
                statusMessageEl.classList.remove('hidden');
            }

            // --- Main Logic ---
            const startCameraAndLocationSequence = () => {
                updateStatus('Mengambil lokasi & membuka kamera...', 'loading');
                if (!navigator.geolocation) {
                    updateStatus('Geolocation tidak didukung. Kamera tetap dibuka.', 'error');
                    openCameraStream();
                    return;
                }

                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const { latitude, longitude } = position.coords;
                        setLocation(latitude, longitude);
                        locationStatusEl.innerHTML = `<div class="flex items-center gap-2 text-sm text-green-700"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg><span>Lokasi otomatis berhasil!</span></div>`;
                        openCameraStream();
                    },
                    (error) => {
                        console.error("Error getting location:", error);
                        locationStatusEl.innerHTML = `<span class="text-sm text-red-600">Gagal dapat lokasi: ${error.message}</span>`;
                        updateStatus('Gagal dapat lokasi, tapi kamera tetap dibuka.', 'error');
                        openCameraStream();
                    },
                    { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
                );
            };
            
            async function openCameraStream() {
                try {
                    if (cameraStream) cameraStream.getTracks().forEach(track => track.stop());
                    
                    cameraStream = await navigator.mediaDevices.getUserMedia({
                        video: { facingMode: 'user', width: { ideal: 1280 }, height: { ideal: 720 } }
                    });
                    
                    videoEl.srcObject = cameraStream;
                    
                    mediaWrapperEl.classList.remove('hidden');
                    videoEl.classList.remove('hidden');
                    photoPreviewEl.classList.add('hidden');
                    if(!statusMessageEl.innerHTML.includes('Gagal dapat lokasi')) statusMessageEl.classList.add('hidden');
                    
                    startBtn.classList.add('hidden');
                    takePhotoBtn.classList.remove('hidden');
                    retakeBtn.classList.add('hidden');
                } catch (err) {
                    console.error("Error accessing camera: ", err);
                    updateStatus('Gagal mengakses kamera. Mohon berikan izin pada browser Anda.', 'error');
                }
            }

            function takePhoto() {
                canvasEl.width = videoEl.videoWidth;
                canvasEl.height = videoEl.videoHeight;
                const context = canvasEl.getContext('2d');

                context.translate(canvasEl.width, 0);
                context.scale(-1, 1);
                context.drawImage(videoEl, 0, 0, canvasEl.width, canvasEl.height);

                const dataUrl = canvasEl.toDataURL('image/jpeg', 0.9);
                photoPreviewEl.src = dataUrl;
                selfieDataInput.value = dataUrl;

                videoEl.classList.add('hidden');
                photoPreviewEl.classList.remove('hidden');
                updateStatus('Foto berhasil diambil! Anda bisa melanjutkan atau "Foto Ulang".', 'success');

                if (cameraStream) cameraStream.getTracks().forEach(track => track.stop());

                takePhotoBtn.classList.add('hidden');
                retakeBtn.classList.remove('hidden');
            }
            
            const getCurrentLocationManual = () => {
                locationStatusEl.innerHTML = `<div class="flex items-center gap-2"><div class="animate-spin w-4 h-4 border-2 border-purple-500 border-t-transparent rounded-full"></div><span>Mengambil lokasi...</span></div>`;
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const { latitude, longitude } = position.coords;
                        setLocation(latitude, longitude);
                        locationStatusEl.innerHTML = `<div class="flex items-center gap-2 text-sm text-green-700"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg><span>Lokasi manual berhasil!</span></div>`;
                    },
                    (error) => {
                        console.error("Error getting location:", error);
                        locationStatusEl.innerHTML = `<span class="text-sm text-red-600">Gagal: ${error.message}</span>`;
                    },
                    { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
                );
            }

            function initMap() {
                map = L.map(mapContainer).setView([-6.2088, 106.8456], 10);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);
            }
            
            function setLocation(lat, lng) {
                if (currentMarker) map.removeLayer(currentMarker);
                currentMarker = L.marker([lat, lng]).addTo(map);
                map.setView([lat, lng], 16);
                latInput.value = lat;
                longInput.value = lng;
            }

            // --- Event Listeners ---
            startBtn.addEventListener('click', startCameraAndLocationSequence);
            takePhotoBtn.addEventListener('click', takePhoto);
            retakeBtn.addEventListener('click', startCameraAndLocationSequence); // Retake restarts the whole sequence
            getLocationBtn.addEventListener('click', getCurrentLocationManual);

            // --- Initializer ---
            initMap();
        });
    </script>
</x-layouts.app>

