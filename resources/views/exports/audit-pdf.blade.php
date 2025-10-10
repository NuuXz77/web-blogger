<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Detail Audit - {{ $audit->id }}</title>
    <style>
        @page {
            margin: 2cm 1.5cm;
            size: A4;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            background-color: #fff;
        }
        
        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }
        
        /* HEADER STYLES */
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px 0;
            border-bottom: 3px solid #1F2937;
        }
        
        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #1F2937;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .company-subtitle {
            font-size: 14px;
            color: #6B7280;
            margin-bottom: 8px;
        }
        
        .company-contact {
            font-size: 10px;
            color: #9CA3AF;
            margin-bottom: 15px;
        }
        
        .document-title {
            font-size: 18px;
            font-weight: bold;
            color: #3B82F6;
            margin-top: 20px;
            padding: 12px 20px;
            background: linear-gradient(90deg, #3B82F6, #1D4ED8);
            color: white;
            border-radius: 8px;
        }
        
        /* SECTION STYLES */
        .section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }
        
        .section-header {
            background: #F3F4F6;
            color: #374151;
            padding: 12px 15px;
            font-weight: bold;
            font-size: 14px;
            border-left: 4px solid #3B82F6;
            margin-bottom: 15px;
            border-radius: 4px;
        }
        
        .section-content {
            padding: 0 10px;
        }
        
        /* INFO GRID */
        .info-grid {
            display: table;
            width: 100%;
            margin-bottom: 15px;
        }
        
        .info-row {
            display: table-row;
            margin-bottom: 8px;
        }
        
        .info-label {
            display: table-cell;
            width: 35%;
            font-weight: bold;
            color: #4B5563;
            padding: 8px 10px 8px 0;
            vertical-align: top;
            border-bottom: 1px solid #E5E7EB;
        }
        
        .info-value {
            display: table-cell;
            width: 65%;
            padding: 8px 0;
            vertical-align: top;
            border-bottom: 1px solid #E5E7EB;
            word-wrap: break-word;
        }
        
        /* STATUS BADGES */
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .status-pending {
            background: #FEF3C7;
            color: #92400E;
        }
        
        .status-confirmed-author {
            background: #DBEAFE;
            color: #1E40AF;
        }
        
        .status-confirmed-admin {
            background: #D1FAE5;
            color: #065F46;
        }
        
        .status-completed {
            background: #D1FAE5;
            color: #065F46;
        }
        
        /* SPECIAL CONTENT */
        .address-box {
            background: #F9FAFB;
            border: 1px solid #E5E7EB;
            padding: 12px;
            border-radius: 6px;
            margin-top: 5px;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        
        .alert-box {
            background: #FEF2F2;
            border: 1px solid #FECACA;
            color: #B91C1C;
            padding: 12px;
            border-radius: 6px;
            margin-top: 5px;
        }
        
        .success-box {
            background: #ECFDF5;
            border: 1px solid #A7F3D0;
            color: #065F46;
            padding: 12px;
            border-radius: 6px;
            margin-top: 5px;
        }
        
        .warning-box {
            background: #FFFBEB;
            border: 1px solid #FDE68A;
            color: #92400E;
            padding: 12px;
            border-radius: 6px;
            margin-top: 5px;
        }
        
        /* COORDINATES & LINKS */
        .coordinates {
            font-family: 'Courier New', monospace;
            background: #F3F4F6;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #D1D5DB;
        }
        
        .maps-link {
            color: #3B82F6;
            text-decoration: none;
            font-size: 11px;
            word-break: break-all;
        }
        
        /* FOOTER */
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #E5E7EB;
            text-align: center;
            font-size: 10px;
            color: #6B7280;
            page-break-inside: avoid;
        }
        
        .footer-info {
            margin-bottom: 8px;
        }
        
        .footer-copyright {
            font-style: italic;
        }
        
        /* ICONS (using Unicode symbols) */
        .icon {
            font-weight: bold;
            margin-right: 8px;
        }
        
        /* PAGE BREAK CONTROLS */
        .page-break {
            page-break-before: always;
        }
        
        .no-break {
            page-break-inside: avoid;
        }
        
        /* TABLE STYLES */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        
        .data-table th,
        .data-table td {
            border: 1px solid #D1D5DB;
            padding: 10px;
            text-align: left;
            vertical-align: top;
        }
        
        .data-table th {
            background: #F9FAFB;
            font-weight: bold;
            color: #374151;
        }
        
        /* RESPONSIVE FIXES FOR PDF */
        @media print {
            .section {
                page-break-inside: avoid;
            }
            
            .section-header {
                page-break-after: avoid;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- HEADER SECTION -->
        <div class="header">
            <div class="company-name">
                🏢 Web Blogger Audit System
            </div>
            <div class="company-subtitle">
                Sistem Manajemen Audit Kunjungan Terpadu
            </div>
            <div class="company-contact">
                📍 Jl. Contoh Alamat No. 123, Kota, Provinsi 12345<br>
                📞 (021) 1234-5678 | 📧 admin@webblogger.com | 🌐 www.webblogger.com
            </div>
            <div class="document-title">
                📋 LAPORAN DETAIL KUNJUNGAN AUDIT
            </div>
        </div>

        <!-- BASIC INFORMATION SECTION -->
        <div class="section">
            <div class="section-header">
                <span class="icon">📝</span>INFORMASI DASAR KUNJUNGAN
            </div>
            <div class="section-content">
                <div class="info-grid">
                    <div class="info-row">
                        <div class="info-label">ID Audit:</div>
                        <div class="info-value"><strong>#{{ $audit->id }}</strong></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Status Kunjungan:</div>
                        <div class="info-value">
                            @if($audit->status === 'pending')
                                <span class="status-badge status-pending">⏳ Pending</span>
                            @elseif($audit->status === 'confirmed_by_author')
                                <span class="status-badge status-confirmed-author">✅ Dikonfirmasi (Author)</span>
                            @elseif($audit->status === 'confirmed_by_admin')
                                <span class="status-badge status-confirmed-admin">✅ Dikonfirmasi (Admin)</span>
                            @else
                                <span class="status-badge status-completed">🎉 Selesai</span>
                            @endif
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Tanggal Kunjungan:</div>
                        <div class="info-value">📅 {{ \Carbon\Carbon::parse($audit->tanggal)->format('l, d F Y') }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Waktu Kunjungan:</div>
                        <div class="info-value">🕐 {{ $audit->waktu ?? 'Belum ditentukan' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Tanggal Dibuat:</div>
                        <div class="info-value">📅 {{ $audit->created_at->format('d F Y, H:i') }} WIB</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Terakhir Diupdate:</div>
                        <div class="info-value">🔄 {{ $audit->updated_at->format('d F Y, H:i') }} WIB</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PERSONNEL INFORMATION SECTION -->
        <div class="section">
            <div class="section-header">
                <span class="icon">👥</span>INFORMASI PERSONEL
            </div>
            <div class="section-content">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Role</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>👤 Author</strong></td>
                            <td>{{ $audit->author->name }}</td>
                            <td>{{ $audit->author->email }}</td>
                            <td>{{ ucfirst($audit->author->role) }}</td>
                        </tr>
                        <tr>
                            <td><strong>🛡️ Auditor</strong></td>
                            <td>{{ $audit->auditor->name }}</td>
                            <td>{{ $audit->auditor->email }}</td>
                            <td>{{ ucfirst($audit->auditor->role) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- LOCATION INFORMATION SECTION -->
        <div class="section">
            <div class="section-header">
                <span class="icon">📍</span>INFORMASI LOKASI KUNJUNGAN
            </div>
            <div class="section-content">
                <div class="info-grid">
                    <div class="info-row">
                        <div class="info-label">Alamat Tujuan:</div>
                        <div class="info-value">
                            <div class="address-box">{{ $audit->alamat }}</div>
                        </div>
                    </div>
                    @if($audit->lat && $audit->long)
                    <div class="info-row">
                        <div class="info-label">Koordinat GPS:</div>
                        <div class="info-value">
                            <div class="coordinates">
                                📍 Latitude: {{ $audit->lat }}<br>
                                📍 Longitude: {{ $audit->long }}
                            </div>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Link Google Maps:</div>
                        <div class="info-value">
                            <a href="https://maps.google.com/?q={{ $audit->lat }},{{ $audit->long }}" class="maps-link">
                                🗺️ https://maps.google.com/?q={{ $audit->lat }},{{ $audit->long }}
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- ADDITIONAL INFORMATION SECTION -->
        @if($audit->keterangan || $audit->reschedule_requested)
        <div class="section">
            <div class="section-header">
                <span class="icon">📄</span>INFORMASI TAMBAHAN
            </div>
            <div class="section-content">
                @if($audit->keterangan)
                <div class="info-grid">
                    <div class="info-row">
                        <div class="info-label">Keterangan Audit:</div>
                        <div class="info-value">
                            <div class="address-box">{{ $audit->keterangan }}</div>
                        </div>
                    </div>
                </div>
                @endif

                @if($audit->reschedule_requested)
                <div class="warning-box">
                    <strong>⚠️ PERMINTAAN PERUBAHAN JADWAL</strong><br>
                    <div style="margin-top: 10px;">
                        @if($audit->preferred_date)
                        📅 <strong>Tanggal yang Diinginkan:</strong> {{ \Carbon\Carbon::parse($audit->preferred_date)->format('d F Y') }}<br>
                        @endif
                        @if($audit->preferred_time)
                        🕐 <strong>Waktu yang Diinginkan:</strong> {{ $audit->preferred_time }}<br>
                        @endif
                        @if($audit->reschedule_reason)
                        💬 <strong>Alasan Reschedule:</strong><br>
                        <div style="margin-top: 5px; padding: 8px; background: rgba(255,255,255,0.7); border-radius: 4px;">
                            {{ $audit->reschedule_reason }}
                        </div>
                        @endif
                        @if($audit->reschedule_requested_at)
                        📝 <strong>Diminta pada:</strong> {{ \Carbon\Carbon::parse($audit->reschedule_requested_at)->format('d F Y, H:i') }} WIB
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- CONFIRMATION STATUS SECTION -->
        <div class="section">
            <div class="section-header">
                <span class="icon">✅</span>STATUS KONFIRMASI
            </div>
            <div class="section-content">
                <div class="info-grid">
                    <div class="info-row">
                        <div class="info-label">Konfirmasi Author:</div>
                        <div class="info-value">
                            @if($audit->author_confirmed)
                                <span class="success-box">✅ Sudah Dikonfirmasi pada {{ $audit->author_confirmed_at->format('d F Y, H:i') }} WIB</span>
                            @else
                                <span class="alert-box">❌ Belum Dikonfirmasi</span>
                            @endif
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Konfirmasi Admin:</div>
                        <div class="info-value">
                            @if($audit->status === 'confirmed_by_admin' || $audit->status === 'selesai')
                                <span class="success-box">✅ Sudah Dikonfirmasi oleh Admin</span>
                            @else
                                <span class="warning-box">⏳ Belum Dikonfirmasi oleh Admin</span>
                            @endif
                        </div>
                    </div>
                </div>

                @if($audit->rejection_reason)
                <div class="alert-box">
                    <strong>❌ ALASAN PENOLAKAN:</strong><br>
                    <div style="margin-top: 8px;">{{ $audit->rejection_reason }}</div>
                </div>
                @endif
            </div>
        </div>

        <!-- AUDIT REPORT SECTION -->
        @if($audit->hasil || $audit->selfie)
        <div class="section">
            <div class="section-header">
                <span class="icon">📊</span>LAPORAN HASIL KUNJUNGAN
            </div>
            <div class="section-content">
                @if($audit->hasil)
                <div class="info-grid">
                    <div class="info-row">
                        <div class="info-label">Hasil Kunjungan:</div>
                        <div class="info-value">
                            <div class="success-box">{{ $audit->hasil }}</div>
                        </div>
                    </div>
                </div>
                @endif

                @if($audit->selfie)
                <div class="info-grid">
                    <div class="info-row">
                        <div class="info-label">Foto Bukti:</div>
                        <div class="info-value">
                            📷 File foto tersimpan: <strong>{{ $audit->selfie }}</strong><br>
                            <small style="color: #6B7280;">*Foto dapat diakses melalui sistem untuk verifikasi</small>
                        </div>
                    </div>
                </div>
                @endif

                <div class="info-grid">
                    <div class="info-row">
                        <div class="info-label">Status Laporan:</div>
                        <div class="info-value">
                            @if($audit->hasil)
                                <span class="success-box">✅ Laporan Sudah Disubmit pada {{ $audit->updated_at->format('d F Y, H:i') }} WIB</span>
                            @else
                                <span class="warning-box">⏳ Laporan Belum Disubmit</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- FOOTER SECTION -->
        <div class="footer">
            <div class="footer-info">
                📅 Laporan ini digenerate secara otomatis pada <strong>{{ now()->format('l, d F Y') }}</strong> pukul <strong>{{ now()->format('H:i:s') }} WIB</strong>
            </div>
            <div class="footer-info">
                🖥️ Web Blogger Audit System v1.0 | System ID: WB-{{ $audit->id }}-{{ now()->format('Ymd') }}
            </div>
            <div class="footer-copyright">
                © {{ date('Y') }} Web Blogger Audit System. All Rights Reserved. | Generated by Admin: {{ Auth::user()->name }}
            </div>
        </div>
    </div>
</body>
</html>