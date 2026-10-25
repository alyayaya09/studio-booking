# Framehaus Studio Booking

Aplikasi web untuk memesan sesi foto di studio. User memilih paket, tanggal, dan jam mulai. Sistem lalu mencarikan fotografer yang jadwalnya masih kosong. Admin mengelola paket, fotografer, dan seluruh pesanan lewat dashboard.

Dibuat sebagai final project ujian evaluasi dan penilaian akhir masa magang SMK.

## Fitur

### Admin

- Login dan logout
- Dashboard: ringkasan pesanan dan pendapatan
- CRUD paket foto (nama, deskripsi, harga, durasi sesi, status aktif)
- CRUD fotografer (nama, telepon, email, status aktif)
- Melihat semua pesanan dan mengubah statusnya (pending, confirmed, completed, cancelled)

### User

- Register, login, dan logout
- Dashboard ringkasan pesanan sendiri
- Memesan sesi foto: pilih paket, tanggal, dan jam mulai
- Fotografer dipilih otomatis oleh sistem (fotografer aktif pertama yang jadwalnya tidak bentrok)
- Melihat riwayat dan status pesanan di halaman "Booking Saya"

### Umum

- Hak akses berbasis peran (Role-Based Access Control): halaman admin hanya bisa dibuka oleh admin
- Halaman depan menampilkan paket yang aktif langsung dari database
- Jam operasional dicek saat memesan: Senin sampai Sabtu 09.00-20.00, Minggu 10.00-17.00
- Pemesanan ditolak jika jam mulai sudah lewat, sesi melewati jam tutup, atau semua fotografer sudah penuh di jam itu
- Pesanan baru otomatis berstatus pending, dan admin yang mengubah statusnya
- Tampilan responsif untuk HP dan desktop (tabel admin berubah menjadi kartu di layar kecil)
- Validasi form dan perlindungan CSRF

## Teknologi

- Laravel 12 (PHP)
- MySQL
- Blade
- Tailwind CSS
- Laravel Breeze (autentikasi)
- Vite

## Kebutuhan Sistem

- PHP 8.2 atau lebih baru
- Composer
- Node.js dan npm
- MySQL (bisa memakai Laragon atau XAMPP)
- Git

## Cara Instalasi

1. Clone repository

   ```bash
   git clone https://github.com/alyayaya09/studio-booking.git
   cd studio-booking
   ```

2. Pasang dependensi PHP dan JavaScript

   ```bash
   composer install
   npm install
   ```

3. Buat file `.env`

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   Di Windows (Command Prompt), gunakan `copy .env.example .env`.

4. Atur koneksi database di file `.env`

   Buat database kosong bernama `studio_booking` di MySQL, lalu pastikan bagian database di `.env` seperti ini (hapus tanda `#` di depan baris jika ada):

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=studio_booking
   DB_USERNAME=root
   DB_PASSWORD=
   ```

   Sesuaikan `DB_USERNAME` dan `DB_PASSWORD` dengan pengaturan MySQL kamu.

5. Jalankan migrasi dan isi data contoh

   ```bash
   php artisan migrate --seed
   ```

   Seeder membuat beberapa paket foto contoh (`PackageSeeder`) dan satu akun admin demo (`AdminSeeder`).

6. Build tampilan (Tailwind CSS)

   ```bash
   npm run build
   ```

   Untuk pengembangan, bisa memakai `npm run dev`.

7. Jalankan aplikasi

   ```bash
   php artisan serve
   ```

   Buka `http://127.0.0.1:8000` di browser.

## Akun Demo

Akun ini dibuat oleh seeder dan hanya untuk percobaan lokal.

| Peran | Email | Password |
|---|---|---|
| Admin | `admin@framehaus.test` | `password123` |

Akun baru yang mendaftar lewat halaman Register otomatis berperan sebagai User. Akun admin hanya dibuat lewat seeder atau database, bukan lewat form.

## Struktur Database

- `users`: id, name, email, password, is_admin, timestamps
- `packages`: id, name, description, price, duration_minutes, is_active, timestamps
- `photographers`: id, name, phone, email, is_active, timestamps
- `bookings`: id, user_id, package_id, photographer_id, booking_date, start_time, end_time, status, total_price, notes, timestamps

Relasi: setiap booking milik satu user (`user_id`), satu paket (`package_id`), dan satu fotografer (`photographer_id`). Sebaliknya, satu user, satu paket, dan satu fotografer bisa memiliki banyak booking. Paket yang masih dipakai booking tidak bisa dihapus. Jika fotografer dihapus, kolom `photographer_id` pada booking menjadi kosong dan booking tidak ikut terhapus.

## Hak Akses

| Halaman | Admin | User | Tamu |
|---|---|---|---|
| Kelola paket, fotografer, dan booking (`/admin/...`) | Ya | Tidak (403) | Tidak (diarahkan ke login) |
| Dashboard, Pesan Sesi, dan Booking Saya | Ya | Ya | Tidak (diarahkan ke login) |

## Struktur Folder Penting

```
app/Http/Controllers/        Controller (booking, paket, fotografer, dashboard)
app/Http/Middleware/         EnsureUserIsAdmin (pembatas akses admin, alias "admin")
app/Models/                  User, Package, Photographer, Booking
database/migrations/         Struktur tabel
database/seeders/            DatabaseSeeder, PackageSeeder, AdminSeeder (data contoh)
resources/views/layouts/     Layout bersama (app, guest, navigation)
resources/views/booking/     Tampilan Pesan Sesi dan Booking Saya
resources/views/admin/       Tampilan admin (booking, paket, fotografer)
resources/views/welcome.blade.php     Halaman depan
resources/views/dashboard.blade.php   Dashboard
routes/web.php               Daftar route
```