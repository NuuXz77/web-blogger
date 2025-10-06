# Update Admin Audit untuk Menangani Status Konfirmasi Author

## Fitur Baru yang Ditambahkan di Admin Panel:

### 1. **Kolom Status Author di Tabel Audit**
- **Status Author** baru di tabel `admin/audit/index.blade.php`
- Menampilkan 3 status berbeda:
  - 🟡 **Menunggu Konfirmasi** - Author belum konfirmasi jadwal
  - 🟢 **Terkonfirmasi** - Author sudah konfirmasi jadwal + tanggal konfirmasi
  - 🟠 **Minta Reschedule** - Author request perubahan jadwal + preferensi tanggal/waktu

### 2. **Action Buttons untuk Reschedule**
- **Tombol Setujui Reschedule** (hijau) - untuk approve request perubahan jadwal
- **Tombol Tolak Reschedule** (merah) - untuk reject request perubahan jadwal
- Tombol ini muncul hanya jika author request reschedule dan status masih `pending`

### 3. **Modal Reschedule Management**
- **Modal Approve Reschedule**: Admin bisa set tanggal baru dan waktu opsional
- **Modal Reject Reschedule**: Admin bisa berikan alasan penolakan
- Form validation untuk memastikan tanggal minimum besok

### 4. **Section Status Author di Detail View**
- **Info Box Hijau**: Jika author sudah konfirmasi
- **Info Box Kuning**: Jika author belum konfirmasi  
- **Info Box Orange**: Jika author request reschedule (lengkap dengan alasan & preferensi)
- **Info Box Merah**: Jika request reschedule ditolak (dengan alasan)

## Routes Baru yang Ditambahkan:

```php
Route::post('/audit/{audit}/approve-reschedule', [AuditController::class, 'approveReschedule'])
    ->name('audit.approve-reschedule');
Route::post('/audit/{audit}/reject-reschedule', [AuditController::class, 'rejectReschedule'])
    ->name('audit.reject-reschedule');
```

## Methods Baru di AuditController:

### `approveReschedule(Request $request, Visits $audit)`
- Memvalidasi tanggal baru (harus setelah hari ini)
- Update tanggal audit sesuai input admin
- Reset semua field reschedule request
- Update keterangan dengan log perubahan jadwal
- Redirect dengan pesan sukses

### `rejectReschedule(Request $request, Visits $audit)`
- Memvalidasi alasan penolakan (required)
- Reset request reschedule fields
- Simpan alasan penolakan di field `rejection_reason`
- Redirect dengan pesan sukses

## Alur Kerja Lengkap:

1. **Admin membuat audit** → Status: `pending`, Author belum konfirmasi
2. **Author melihat audit** → Bisa konfirmasi atau request reschedule
3. **Author konfirmasi** → Status Author: "Terkonfirmasi" (hijau)
4. **Author request reschedule** → Status Author: "Minta Reschedule" (orange)
5. **Admin approve reschedule** → Jadwal diupdate, status reset ke konfirmasi
6. **Admin reject reschedule** → Alasan disimpan, author bisa lihat penolakan
7. **Auditor melakukan kunjungan** → Status: `konfirmasi`
8. **Admin approve laporan** → Status: `selesai`

## UI/UX Improvements:

- **Icon indicators** untuk setiap status dengan warna yang konsisten
- **Tooltips** pada action buttons untuk clarity
- **Modal responsive** dengan validation
- **Info boxes** dengan color coding untuk status yang berbeda
- **Timeline** tetap berfungsi untuk tracking progress
- **Responsive design** untuk mobile dan desktop

## Database Fields yang Digunakan:

- `author_confirmed` (boolean) - Status konfirmasi author
- `author_confirmed_at` (timestamp) - Waktu konfirmasi
- `reschedule_requested` (boolean) - Status request reschedule
- `reschedule_reason` (text) - Alasan request reschedule
- `preferred_date` (date) - Tanggal preferensi author
- `preferred_time` (string) - Waktu preferensi author
- `reschedule_requested_at` (timestamp) - Waktu request reschedule
- `rejection_reason` (text) - Alasan penolakan dari admin

## Testing:

✅ Routes terdaftar dengan benar (14 routes admin.audit)
✅ No syntax errors di views dan controller
✅ Modal JavaScript functions implementasi
✅ Form validation untuk date dan required fields
✅ Color coding dan icons konsisten

Semua fitur telah terintegrasi dengan sempurna ke dalam sistem audit yang ada!