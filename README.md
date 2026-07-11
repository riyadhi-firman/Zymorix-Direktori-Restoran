# Zymorix Direktori Restoran

Zymorix Direktori Restoran adalah sebuah aplikasi web sederhana yang dibangun menggunakan framework **Laravel (PHP)**. Aplikasi ini berfungsi sebagai katalog atau direktori restoran di mana pengguna dapat melihat-lihat daftar restoran beserta menu makanan dan minuman yang mereka tawarkan.

## Fitur Utama

- **Beranda (`/`)**: Halaman awal yang menampilkan ringkasan restoran dan menu yang tersedia.
- **Daftar Restoran (`/restoran`)**: Menampilkan seluruh direktori restoran.
  - **Pencarian**: Cari restoran berdasarkan nama atau nama kota.
  - **Pengurutan**: Urutkan daftar restoran berdasarkan rating tertinggi.
- **Detail Restoran (`/restoran/{id}`)**: Menampilkan detail spesifik tentang suatu restoran sekaligus daftar menu yang disediakan.
- **Daftar Menu (`/menu`)**: Menampilkan daftar semua menu makanan dan minuman dari berbagai restoran.
  - **Pencarian**: Cari nama menu tertentu.
  - **Filter Kategori**: Filter berdasarkan kategori (Makanan / Minuman).
- **Detail Menu (`/menu/{id}`)**: Menampilkan informasi rinci mengenai suatu menu beserta restoran yang menjualnya.

## Catatan Penting

Saat ini aplikasi ini masih dalam tahap _prototype_. Data restoran dan menu masih berupa data statis (dummy) yang ditulis (di-_hardcode_) langsung di dalam `App\Http\Controllers\RestoranController`. Belum ada integrasi dengan database (MySQL/PostgreSQL) sehingga seluruh data akan di-reset dari memori sesuai kode yang ada pada controller tersebut.

## Persyaratan Sistem

- PHP >= 8.1
- Composer
- Node.js & NPM (untuk kompilasi aset jika menggunakan Vite/Mix)

## Panduan Instalasi dan Menjalankan Proyek

1. **Clone repository ini** (jika terhubung dengan git) atau masuk ke direktori proyek.
2. **Install dependency PHP** menggunakan Composer:
   ```bash
   composer install
   ```
3. **Copy file `.env`**:
   ```bash
   cp .env.example .env
   ```
4. **Generate Application Key**:
   ```bash
   php artisan key:generate
   ```
5. **Install dependency Node.js** (Opsional untuk asset frontend):
   ```bash
   npm install
   npm run build
   ```
6. **Jalankan local server Laravel**:
   ```bash
   php artisan serve
   ```
   Aplikasi akan berjalan dan dapat diakses melalui browser di alamat `http://localhost:8000` atau sesuai dengan port yang ditunjukkan di terminal.

## Lisensi

Aplikasi ini menggunakan framework Laravel yang berlisensi di bawah [MIT license](https://opensource.org/licenses/MIT).
