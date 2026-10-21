# Framehaus Studio Booking

Aplikasi web untuk memesan sesi foto di studio. Pelanggan bisa memilih paket, tanggal, dan jam. Sistem lalu mencarikan fotografer yang jadwalnya masih kosong. Admin mengelola paket, fotografer, dan seluruh pesanan lewat dashboard.

Dibuat sebagai final project ujian akhir masa magang SMK.

## Fitur

### Admin
- Login dan logout
- Dashboard ringkasan pesanan dan pendapatan
- Kelola paket foto (tambah, ubah, hapus) lengkap dengan harga dan durasi sesi
- Kelola fotografer (tambah, ubah, hapus)
- Melihat semua pesanan dan mengubah statusnya (pesanan baru otomatis berstatus pending)

### Pelanggan
- Register, login, dan logout
- Dashboard berisi ringkasan pesanan sendiri
- Memesan sesi foto: pilih paket, tanggal, dan jam mulai
- Fotografer ditentukan otomatis oleh sistem (yang pertama tidak bentrok jadwalnya)
- Melihat riwayat dan status pesanan di halaman "Booking saya"

### Umum
- Hak akses berbasis peran (Role-Based Access Control): halaman `/admin` hanya bisa dibuka admin
- Halaman depan menampilkan paket yang aktif langsung dari database
- Pelanggan harus memverifikasi email sebelum bisa membuka dashboard dan memesan sesi
- Jam operasional dicek saat memesan: Senin sampai Sabtu 09.00-20.00, Minggu 10.00-17.00
- Tampilan responsif untuk HP dan desktop
- Validasi form dan perlindungan CSRF

## Teknologi

- Laravel 12 (PHP 8.2 atau lebih baru)
- MySQL
- Blade
- Tailwind CSS
- Laravel Breeze (autentikasi)
- Vite

## Kebutuhan Sistem

- PHP 8.2 atau lebih baru
- Composer
- Node.js dan npm
- MySQL (bisa lewat Laragon atau XAMPP)
- Git

## Cara Instalasi

1. **Clone repository**
```bash
   git clone https://github.com/alyayaya09/studio-booking.git
   cd studio-booking
```

2. **Install dependensi PHP dan JavaScript**
```bash
   composer install
   npm install
```

3. **Buat file `.env` dan app key**
```bash
   cp .env.example .env
   php artisan key:generate
```
   Di Command Prompt Windows, pakai `copy .env.example .env`.

4. **Buat database kosong** bernama `studio_booking` di MySQL (lewat phpMyAdmin, HeidiSQL, atau terminal).

5. **Atur konfigurasi di `.env`** (lihat bagian "Konfigurasi .env" di bawah).

6. **Jalankan migrasi dan seeder**
```bash
   php artisan migrate --seed
```
   Seeder membuat beberapa paket foto contoh (`PackageSeeder`) dan satu akun admin demo