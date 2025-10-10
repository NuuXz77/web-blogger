# 📋 Fitur Cetak Audit - Documentation

## 🎯 Overview
Fitur "Cetak Audit" memungkinkan admin untuk mengunduh laporan detail kunjungan audit dalam format Excel (.xlsx) yang dapat dicetak, disimpan, atau dibagikan.

## ✨ Features
- **Format Excel Professional**: Output dalam format .xlsx dengan styling yang rapi
- **Layout A4 Ready**: Dioptimalkan untuk pencetakan ukuran A4
- **3 Bagian Utama**: Header, Body, dan Footer yang terstruktur
- **Auto-sizing**: Kolom otomatis menyesuaikan ukuran konten
- **Professional Styling**: Warna, border, dan formatting yang konsisten

## 🚀 Implementasi

### 1. Button UI (admin/audit/show.blade.php)
```php
<a href="{{ route('admin.audit.export-pdf', $audit) }}"
    class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors flex items-center gap-2 text-sm">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
        </path>
    </svg>
    Cetak Audit
</a>
```

### 2. Route (web.php)
```php
Route::get('/audit/{audit}/export-pdf', [App\Http\Controllers\AuditController::class, 'exportPdf'])->name('audit.export-pdf');
```

### 3. Controller Method (AuditController.php)
```php
public function exportPdf(Visits $audit)
{
    // Security check
    if (!Auth::user() || Auth::user()->role !== 'admin') {
        abort(403, 'Unauthorized access');
    }

    // Generate filename
    $filename = 'Laporan_Audit_Detail_' . 
               $audit->id . '_' . 
               \Carbon\Carbon::parse($audit->tanggal)->format('Y-m-d') . '_' .
               now()->format('Y-m-d_H-i-s') . '.xlsx';

    return Excel::download(
        new AuditDetailExport($audit),
        $filename
    );
}
```

### 4. Export Class (AuditDetailExport.php)
- **FromView**: Menggunakan Blade template untuk konten
- **ShouldAutoSize**: Auto-resize kolom berdasarkan konten
- **WithCustomStartCell**: Mulai dari cell A1
- **WithEvents**: Styling dan formatting advanced

## 📊 Layout Document

### 🏢 HEADER SECTION
- **Company Name**: WEB BLOGGER AUDIT SYSTEM
- **Subtitle**: Sistem Manajemen Audit Kunjungan
- **Contact Info**: Alamat, telepon, email
- **Separator Line**: Visual pemisah

### 📝 BODY SECTION

#### 1. Informasi Dasar Kunjungan
- ID Audit, Status, Tanggal Dibuat
- Tanggal Kunjungan, Waktu, Last Update

#### 2. Informasi Personel
- **Author**: Nama, Email, Role
- **Auditor**: Nama, Email, Role

#### 3. Informasi Lokasi
- Alamat Tujuan (multiline support)
- Koordinat GPS (jika ada)
- Link Google Maps

#### 4. Informasi Tambahan
- Keterangan audit
- Status Reschedule (jika ada)
- Alasan reschedule

#### 5. Status Konfirmasi
- Author confirmation status
- Admin confirmation status
- Tanggal konfirmasi
- Alasan penolakan (jika ada)

#### 6. Laporan Hasil Kunjungan
- Hasil kunjungan (jika sudah disubmit)
- Foto bukti (referensi file)
- Tanggal submit laporan

### 🔖 FOOTER SECTION
- Timestamp generate
- Copyright information
- System version

## 🎨 Styling Features

### Color Scheme
- **Header**: Dark Gray (#1F2937) dengan teks putih
- **Title**: Blue (#3B82F6) dengan teks putih  
- **Section Headers**: Light Gray (#F3F4F6)
- **Borders**: Light Gray (#D1D5DB)
- **Footer**: Very Light Gray (#F9FAFB)

### Typography
- **Headers**: Bold, berbagai ukuran (10px-18px)
- **Content**: Regular weight, readable sizes
- **Footer**: Italic, smaller size

### Layout
- **Page**: A4 Portrait orientation
- **Margins**: Optimized untuk printing
- **Columns**: 6 kolom dengan auto-width
- **Borders**: Thin borders pada semua cells

## 📱 Responsive Features
- Auto-sizing kolom berdasarkan konten
- Word-wrap untuk teks panjang
- Fit-to-page untuk printing
- Margin optimization

## 🔒 Security Features
- **Authorization**: Hanya admin yang dapat mengakses
- **Data Validation**: Audit harus exist dan valid
- **Error Handling**: 403 Unauthorized untuk akses ilegal

## 📁 File Structure
```
app/
├── Exports/
│   └── AuditDetailExport.php
├── Http/Controllers/
│   └── AuditController.php (method exportPdf)
resources/
├── views/
│   ├── admin/audit/
│   │   └── show.blade.php (button)
│   └── exports/
│       └── audit-detail.blade.php
routes/
└── web.php (route definition)
```

## 🎯 User Experience

### 1. **Admin Click Flow**:
   1. Masuk ke detail audit (`/admin/audit/{id}`)
   2. Klik tombol "Cetak Audit" (merah dengan icon download)
   3. File otomatis terdownload dengan nama yang descriptive

### 2. **Filename Format**:
   ```
   Laporan_Audit_Detail_{ID}_{TanggalKunjungan}_{TimestampGenerate}.xlsx
   ```
   Contoh: `Laporan_Audit_Detail_5_2025-10-15_2025-10-10_14-30-25.xlsx`

### 3. **File Capabilities**:
   - ✅ Dapat dibuka di Excel, LibreOffice, Google Sheets
   - ✅ Ready untuk print (A4 size)
   - ✅ Professional formatting
   - ✅ Lengkap dengan semua data audit

## 🔧 Customization Options

### Mengubah Layout
Edit file: `resources/views/exports/audit-detail.blade.php`

### Mengubah Styling
Edit file: `app/Exports/AuditDetailExport.php` pada method `registerEvents()`

### Menambah Data
Tambahkan field baru di template dan pastikan relasi model sudah benar

## 🚨 Troubleshooting

### Error "Class not found"
```bash
composer dump-autoload
php artisan config:clear
```

### Styling tidak muncul
Pastikan PhpSpreadsheet dependencies lengkap dan versi Excel mendukung styling

### File tidak terdownload
Check browser settings dan pastikan route accessible

## 📋 Testing Checklist
- [x] Button muncul di halaman detail audit
- [x] Route dapat diakses oleh admin
- [x] File tergenerate dengan nama yang benar
- [x] Konten lengkap sesuai data audit
- [x] Styling dan formatting bekerja
- [x] Ready untuk print dalam ukuran A4
- [x] Security authorization berfungsi

## 🎉 Result
Fitur "Cetak Audit" telah berhasil diimplementasikan dengan:
- ✅ Professional document layout
- ✅ Complete audit information
- ✅ Print-ready format
- ✅ Secure access control
- ✅ User-friendly interface

Admin sekarang dapat dengan mudah mengunduh, mencetak, dan menyimpan laporan detail audit dalam format yang professional dan terstruktur!