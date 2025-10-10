<table>
    <!-- HEADER SECTION -->
    <tr>
        <td colspan="6" style="font-size: 18px; font-weight: bold; text-align: center;">
            WEB BLOGGER AUDIT SYSTEM
        </td>
    </tr>
    <tr>
        <td colspan="6" style="font-size: 12px; text-align: center;">
            Sistem Manajemen Audit Kunjungan
        </td>
    </tr>
    <tr>
        <td colspan="6" style="font-size: 10px; text-align: center;">
            Jl. Contoh No. 123, Kota, Provinsi | Tel: (021) 1234-5678 | Email: admin@webblogger.com
        </td>
    </tr>
    <tr>
        <td colspan="6" style="font-size: 10px; text-align: center;">
            ═══════════════════════════════════════════════════════════════
        </td>
    </tr>
    <tr><td colspan="6"></td></tr> <!-- Empty row -->

    <!-- TITLE SECTION -->
    <tr>
        <td colspan="6" style="font-size: 16px; font-weight: bold; text-align: center;">
            LAPORAN DETAIL KUNJUNGAN AUDIT
        </td>
    </tr>
    <tr><td colspan="6"></td></tr> <!-- Empty row -->

    <!-- BASIC INFORMATION SECTION -->
    <tr>
        <td colspan="6" style="font-weight: bold; background-color: #F3F4F6; padding: 8px;">
            📋 INFORMASI DASAR KUNJUNGAN
        </td>
    </tr>
    <tr>
        <td style="font-weight: bold;">ID Audit:</td>
        <td>{{ $audit->id }}</td>
        <td style="font-weight: bold;">Status:</td>
        <td>
            @if($audit->status === 'pending')
                Pending
            @elseif($audit->status === 'confirmed_by_author')
                Dikonfirmasi (Author)
            @elseif($audit->status === 'confirmed_by_admin')
                Dikonfirmasi (Admin)
            @else
                Selesai
            @endif
        </td>
        <td style="font-weight: bold;">Tanggal Dibuat:</td>
        <td>{{ $audit->created_at->format('d F Y H:i') }}</td>
    </tr>
    <tr>
        <td style="font-weight: bold;">Tanggal Kunjungan:</td>
        <td>{{ \Carbon\Carbon::parse($audit->tanggal)->format('d F Y') }}</td>
        <td style="font-weight: bold;">Waktu:</td>
        <td>{{ $audit->waktu ?? 'Tidak ditentukan' }}</td>
        <td style="font-weight: bold;">Last Update:</td>
        <td>{{ $audit->updated_at->format('d F Y H:i') }}</td>
    </tr>
    <tr><td colspan="6"></td></tr> <!-- Empty row -->

    <!-- PERSONNEL INFORMATION SECTION -->
    <tr>
        <td colspan="6" style="font-weight: bold; background-color: #F3F4F6; padding: 8px;">
            👥 INFORMASI PERSONEL
        </td>
    </tr>
    <tr>
        <td style="font-weight: bold;">Author:</td>
        <td>{{ $audit->author->name }}</td>
        <td style="font-weight: bold;">Email Author:</td>
        <td>{{ $audit->author->email }}</td>
        <td style="font-weight: bold;">Role:</td>
        <td>{{ ucfirst($audit->author->role) }}</td>
    </tr>
    <tr>
        <td style="font-weight: bold;">Auditor:</td>
        <td>{{ $audit->auditor->name }}</td>
        <td style="font-weight: bold;">Email Auditor:</td>
        <td>{{ $audit->auditor->email }}</td>
        <td style="font-weight: bold;">Role:</td>
        <td>{{ ucfirst($audit->auditor->role) }}</td>
    </tr>
    <tr><td colspan="6"></td></tr> <!-- Empty row -->

    <!-- LOCATION INFORMATION SECTION -->
    <tr>
        <td colspan="6" style="font-weight: bold; background-color: #F3F4F6; padding: 8px;">
            📍 INFORMASI LOKASI
        </td>
    </tr>
    <tr>
        <td style="font-weight: bold; vertical-align: top;">Alamat Tujuan:</td>
        <td colspan="5" style="word-wrap: break-word;">{{ $audit->alamat }}</td>
    </tr>
    @if($audit->lat && $audit->long)
    <tr>
        <td style="font-weight: bold;">Koordinat GPS:</td>
        <td colspan="2">{{ $audit->lat }}, {{ $audit->long }}</td>
        <td style="font-weight: bold;">Google Maps:</td>
        <td colspan="2">https://maps.google.com/?q={{ $audit->lat }},{{ $audit->long }}</td>
    </tr>
    @endif
    <tr><td colspan="6"></td></tr> <!-- Empty row -->

    <!-- ADDITIONAL INFORMATION SECTION -->
    @if($audit->keterangan || $audit->reschedule_requested)
    <tr>
        <td colspan="6" style="font-weight: bold; background-color: #F3F4F6; padding: 8px;">
            📝 INFORMASI TAMBAHAN
        </td>
    </tr>
    @if($audit->keterangan)
    <tr>
        <td style="font-weight: bold; vertical-align: top;">Keterangan:</td>
        <td colspan="5" style="word-wrap: break-word;">{{ $audit->keterangan }}</td>
    </tr>
    @endif
    @if($audit->reschedule_requested)
    <tr>
        <td style="font-weight: bold;">Reschedule:</td>
        <td>Ya</td>
        <td style="font-weight: bold;">Tanggal Diinginkan:</td>
        <td>{{ $audit->preferred_date ? \Carbon\Carbon::parse($audit->preferred_date)->format('d F Y') : '-' }}</td>
        <td style="font-weight: bold;">Waktu Diinginkan:</td>
        <td>{{ $audit->preferred_time ?? '-' }}</td>
    </tr>
    @if($audit->reschedule_reason)
    <tr>
        <td style="font-weight: bold; vertical-align: top;">Alasan Reschedule:</td>
        <td colspan="5" style="word-wrap: break-word;">{{ $audit->reschedule_reason }}</td>
    </tr>
    @endif
    @endif
    <tr><td colspan="6"></td></tr> <!-- Empty row -->
    @endif

    <!-- CONFIRMATION STATUS SECTION -->
    <tr>
        <td colspan="6" style="font-weight: bold; background-color: #F3F4F6; padding: 8px;">
            ✅ STATUS KONFIRMASI
        </td>
    </tr>
    <tr>
        <td style="font-weight: bold;">Author Confirmed:</td>
        <td>{{ $audit->author_confirmed ? 'Ya' : 'Tidak' }}</td>
        <td style="font-weight: bold;">Tanggal Konfirmasi:</td>
        <td>{{ $audit->author_confirmed_at ? $audit->author_confirmed_at->format('d F Y H:i') : '-' }}</td>
        <td style="font-weight: bold;">Admin Confirmed:</td>
        <td>{{ $audit->status === 'confirmed_by_admin' || $audit->status === 'selesai' ? 'Ya' : 'Tidak' }}</td>
    </tr>
    @if($audit->rejection_reason)
    <tr>
        <td style="font-weight: bold; vertical-align: top;">Alasan Penolakan:</td>
        <td colspan="5" style="word-wrap: break-word; color: #DC2626;">{{ $audit->rejection_reason }}</td>
    </tr>
    @endif
    <tr><td colspan="6"></td></tr> <!-- Empty row -->

    <!-- AUDIT REPORT SECTION -->
    @if($audit->hasil || $audit->selfie)
    <tr>
        <td colspan="6" style="font-weight: bold; background-color: #F3F4F6; padding: 8px;">
            📊 LAPORAN HASIL KUNJUNGAN
        </td>
    </tr>
    @if($audit->hasil)
    <tr>
        <td style="font-weight: bold; vertical-align: top;">Hasil Kunjungan:</td>
        <td colspan="5" style="word-wrap: break-word;">{{ $audit->hasil }}</td>
    </tr>
    @endif
    @if($audit->selfie)
    <tr>
        <td style="font-weight: bold;">Foto Bukti:</td>
        <td colspan="5">{{ $audit->selfie }} (File tersimpan di storage)</td>
    </tr>
    @endif
    <tr>
        <td style="font-weight: bold;">Laporan Disubmit:</td>
        <td colspan="2">{{ $audit->hasil ? 'Ya' : 'Tidak' }}</td>
        <td style="font-weight: bold;">Tanggal Submit:</td>
        <td colspan="2">{{ $audit->hasil ? $audit->updated_at->format('d F Y H:i') : '-' }}</td>
    </tr>
    <tr><td colspan="6"></td></tr> <!-- Empty row -->
    @endif

    <!-- FOOTER SECTION -->
    <tr><td colspan="6"></td></tr> <!-- Empty row -->
    <tr>
        <td colspan="6" style="font-size: 10px; text-align: center; font-style: italic; color: #6B7280;">
            Laporan ini digenerate secara otomatis pada {{ now()->format('d F Y H:i:s') }} WIB
        </td>
    </tr>
    <tr>
        <td colspan="6" style="font-size: 10px; text-align: center; font-style: italic; color: #6B7280;">
            Web Blogger Audit System v1.0 | © {{ date('Y') }} All Rights Reserved
        </td>
    </tr>
</table>