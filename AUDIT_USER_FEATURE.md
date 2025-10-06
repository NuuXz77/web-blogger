# Fitur Audit untuk User/Author

## Alur Kerja Audit

### 1. Admin membuat jadwal audit
- Admin membuat kunjungan audit baru di panel admin
- Audit ditugaskan ke auditor dan author tertentu
- Status awal: `pending`

### 2. Author melihat dan merespons jadwal audit
- Author dapat melihat daftar audit di menu "Audit Saya"
- Author dapat melihat detail audit dengan informasi lengkap
- Author memiliki 2 pilihan:
  - **Konfirmasi jadwal**: Menyetujui tanggal dan waktu yang ditentukan admin
  - **Request reschedule**: Meminta perubahan jadwal dengan alasan dan preferensi waktu

### 3. Konfirmasi dari Author
- Jika author konfirmasi: Status tetap `pending`, field `author_confirmed` = true
- Admin akan melihat bahwa author sudah konfirmasi
- Auditor dapat mulai mempersiapkan kunjungan

### 4. Request Reschedule dari Author
- Author mengisi alasan perubahan jadwal
- Author dapat memberikan preferensi tanggal dan waktu baru
- Request dikirim ke admin untuk ditinjau
- Admin dapat menyetujui atau menolak request reschedule

### 5. Proses Audit
- Auditor melakukan kunjungan sesuai jadwal
- Status berubah menjadi `konfirmasi` saat auditor melaporkan hasil
- Admin mengonfirmasi laporan auditor
- Status berubah menjadi `selesai`

## Files yang Dibuat/Dimodifikasi

### Routes
- `routes/web.php`: Ditambahkan routes untuk user audit
  - `GET /user/audit` - Melihat daftar audit
  - `GET /user/audit/{audit}` - Detail audit
  - `POST /user/audit/{audit}/confirm` - Konfirmasi jadwal
  - `POST /user/audit/{audit}/request-reschedule` - Request reschedule

### Controller
- `app/Http/Controllers/User/AuditController.php`: Controller khusus untuk user audit
  - `index()` - Menampilkan daftar audit untuk author
  - `show()` - Menampilkan detail audit
  - `confirm()` - Konfirmasi jadwal audit
  - `requestReschedule()` - Request perubahan jadwal

### Views
- `resources/views/user/audit/index.blade.php`: Halaman daftar audit
- `resources/views/user/audit/show.blade.php`: Halaman detail audit dengan form konfirmasi/reschedule

### Database
- Migration: `add_author_confirmation_to_visits_table`
  - `author_confirmed` (boolean): Status konfirmasi author
  - `author_confirmed_at` (timestamp): Waktu konfirmasi
  - `reschedule_requested` (boolean): Status request reschedule
  - `reschedule_reason` (text): Alasan request reschedule
  - `preferred_date` (date): Tanggal preferensi author
  - `preferred_time` (string): Waktu preferensi author
  - `reschedule_requested_at` (timestamp): Waktu request reschedule
  - `rejection_reason` (text): Alasan penolakan dari admin

### Model
- `app/Models/Visits.php`: Ditambahkan fillable fields dan casts untuk kolom baru

### UI/UX
- Sidebar user ditambahkan menu "Audit Saya"
- Interface yang konsisten dengan desain yang sudah ada
- Filter dan pencarian audit berdasarkan status
- Modal untuk request reschedule
- Notifikasi success/error

## Fitur-fitur

### Untuk Author:
1. **Dashboard Audit**: Melihat ringkasan audit (total, pending, dalam proses, selesai)
2. **Filter Audit**: Filter berdasarkan status (semua, menunggu konfirmasi, dalam proses, selesai)
3. **Detail Audit**: Informasi lengkap audit dengan informasi auditor, tanggal, alamat, dll
4. **Konfirmasi Jadwal**: One-click confirmation untuk menyetujui jadwal
5. **Request Reschedule**: Form untuk meminta perubahan jadwal dengan alasan dan preferensi
6. **Status Tracking**: Melihat status real-time audit

### Security & Validation:
- Author hanya bisa melihat audit mereka sendiri
- Konfirmasi dan reschedule hanya untuk audit dengan status `pending`
- Validasi input form reschedule
- Authorization check di setiap method controller

## Next Steps untuk Admin
Admin perlu mengupdate dashboard dan view audit mereka untuk:
1. Menampilkan status konfirmasi author
2. Menangani request reschedule dari author
3. Memberikan respons terhadap request reschedule
4. Menampilkan informasi preferensi waktu author

## Testing
Semua routes telah terdaftar dengan benar:
- `user.audit.index`
- `user.audit.show` 
- `user.audit.confirm`
- `user.audit.request-reschedule`

Model dan migration telah dijalankan tanpa error.