<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Audit - #{{ $audit->id }}</title>
    <style>
        @page {
            margin: 2cm; /* Margin halaman A4 */
            size: A4 portrait;
        }

        /* Reset & Font Dasar */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-print-color-adjust: exact !important; /* Memaksa browser mencetak warna background */
            print-color-adjust: exact !important;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11px;
            line-height: 1.5;
            color: #333;
        }

        /* --- STRUKTUR UTAMA --- */
        .container {
            padding: 1cm; /* Padding internal untuk konten agar tidak terpotong */
            border: 1px solid #e0e0e0;
        }

        /* --- HEADER --- */
        .header {
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 2px solid #2563eb; /* Biru Primer */
            margin-bottom: 25px;
        }
        .header h1 {
            font-size: 20px;
            color: #2563eb;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }
        .header .document-title {
            margin-top: 10px;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            color: #555;
        }

        /* --- BAGIAN KONTEN --- */
        .section {
            margin-bottom: 20px;
            page-break-inside: avoid; /* Mencegah section terpotong antar halaman */
        }
        .section-title {
            font-size: 13px;
            font-weight: bold;
            color: #ffffff;
            background-color: #2563eb; /* Biru Primer */
            padding: 8px 12px;
            margin-bottom: 12px;
            text-transform: uppercase;
        }

        /* --- TABEL --- */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            border: 1px solid #e0e0e0;
            padding: 8px 10px;
            text-align: left;
            vertical-align: top;
        }
        table th {
            background-color: #f4f6f8;
            font-weight: bold;
        }
        .info-table td:first-child {
            width: 25%;
            font-weight: bold;
        }
        tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }

        /* --- ELEMEN KUSTOM --- */
        .box {
            border: 1px solid #e0e0e0;
            padding: 12px;
            background-color: #f9fafb;
            white-space: pre-wrap; /* Agar line break di textarea tetap tampil */
            word-wrap: break-word;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 99px;
            font-weight: bold;
            font-size: 10px;
            color: #fff;
            text-transform: uppercase;
        }
        .status-completed { background-color: #16a34a; } /* Hijau */
        .status-inprogress { background-color: #f97316; } /* Oranye */
        .status-confirmed { background-color: #2563eb; } /* Biru */
        .status-pending { background-color: #6b7280; } /* Abu-abu */
        .status-reschedule { background-color: #f59e0b; } /* Kuning */
        
        /* --- GAMBAR --- */
        .image-section {
            text-align: center;
            margin-top: 20px;
        }
        .image-section img {
            max-width: 90%;
            height: auto;
            border: 2px solid #e0e0e0;
            padding: 5px;
            background-color: #fff;
        }

        /* --- FOOTER --- */
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #ccc;
            text-align: center;
            font-size: 9px;
            color: #777;
        }
    </style>
</head>
<body>

    @php
        // Logika untuk menentukan teks dan kelas status
        $status = ['text' => 'TIDAK DIKETAHUI', 'class' => 'status-pending'];
        switch ($audit->status) {
            case 'pending':
                $status = ['text' => 'PENDING', 'class' => 'status-pending'];
                break;
            case 'confirmed_by_author':
                $status = ['text' => 'DISETUJUI AUTHOR', 'class' => 'status-confirmed'];
                break;
            case 'confirmed_by_admin':
                $status = ['text' => 'DISETUJUI ADMIN', 'class' => 'status-confirmed'];
                break;
            case 'in_progress':
                $status = ['text' => 'BERLANGSUNG', 'class' => 'status-inprogress'];
                break;
            case 'completed':
            case 'selesai':
                $status = ['text' => 'SELESAI', 'class' => 'status-completed'];
                break;
        }
        if ($audit->reschedule_requested) {
            $status = ['text' => 'PERMINTAAN RESCHEDULE', 'class' => 'status-reschedule'];
        }
    @endphp

    <div class="container">
        <!-- HEADER -->
        <div class="header">
            <h1>Web Blogger Audit System</h1>
            <div class="document-title">Laporan Detail Kunjungan Audit</div>
        </div>

        <!-- INFORMASI DASAR -->
        <div class="section">
            <div class="section-title">I. Informasi Dasar Kunjungan</div>
            <table class="info-table">
                <tr>
                    <td>ID Audit</td>
                    <td><strong>#{{ $audit->id }}</strong></td>
                </tr>
                <tr>
                    <td>Status Kunjungan</td>
                    <td><span class="status-badge {{ $status['class'] }}">{{ $status['text'] }}</span></td>
                </tr>
                <tr>
                    <td>Tanggal Kunjungan</td>
                    <td>{{ \Carbon\Carbon::parse($audit->tanggal)->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <td>Waktu Kunjungan</td>
                    <td>{{ $audit->waktu ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Tanggal Dibuat</td>
                    <td>{{ $audit->created_at->translatedFormat('d F Y, H:i') }} WIB</td>
                </tr>
            </table>
        </div>

        <!-- INFORMASI PERSONEL -->
        <div class="section">
            <div class="section-title">II. Informasi Personel</div>
            <table>
                <thead>
                    <tr>
                        <th width="25%">Role</th>
                        <th width="35%">Nama Lengkap</th>
                        <th width="40%">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Author</strong></td>
                        <td>{{ $audit->author->name }}</td>
                        <td>{{ $audit->author->email }}</td>
                    </tr>
                    <tr>
                        <td><strong>Auditor</strong></td>
                        <td>{{ $audit->auditor->name }}</td>
                        <td>{{ $audit->auditor->email }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- INFORMASI LOKASI -->
        <div class="section">
            <div class="section-title">III. Informasi Lokasi</div>
            <table class="info-table">
                <tr>
                    <td>Alamat Tujuan</td>
                    <td><div class="box">{{ $audit->alamat }}</div></td>
                </tr>
                @if($audit->lat && $audit->long)
                <tr>
                    <td>Koordinat GPS</td>
                    <td>Lat: {{ $audit->lat }}, Long: {{ $audit->long }}</td>
                </tr>
                @endif
            </table>
        </div>

        <!-- HASIL KUNJUNGAN -->
        @if($audit->hasil || $audit->selfie)
        <div class="section">
            <div class="section-title">IV. Laporan Hasil Kunjungan</div>
            @if($audit->hasil)
            <table class="info-table">
                <tr>
                    <td>Hasil Kunjungan</td>
                    <td><div class="box">{{ $audit->hasil }}</div></td>
                </tr>
                <tr>
                    <td>Waktu Lapor</td>
                    <td>{{ $audit->updated_at->translatedFormat('d F Y, H:i') }} WIB</td>
                </tr>
            </table>
            @endif

            @if($audit->selfie)
                @php
                    $imageData = null;
                    $imagePath = public_path('storage/' . $audit->selfie);
                    if (file_exists($imagePath)) {
                        $imageData = 'data:' . mime_content_type($imagePath) . ';base64,' . base64_encode(file_get_contents($imagePath));
                    }
                @endphp
                <div class="image-section">
                    <strong>Dokumentasi Kunjungan:</strong><br><br>
                    @if($imageData)
                        <img src="{{ $imageData }}" alt="Foto Bukti Kunjungan">
                    @else
                        <div class="box" style="text-align: center;">Foto tidak dapat dimuat.</div>
                    @endif
                </div>
            @endif
        </div>
        @endif

        <!-- FOOTER -->
        <div class="footer">
            <p>Dokumen ini dibuat secara otomatis oleh Web Blogger Audit System pada {{ now()->translatedFormat('d F Y, H:i:s') }} WIB.</p>
            <p>&copy; {{ date('Y') }} Web Blogger | Dibuat oleh: {{ Auth::user()->name }}</p>
        </div>
    </div>
</body>
</html>
