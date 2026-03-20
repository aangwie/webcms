# WebCMS

WebCMS adalah sebuah Sistem Manajemen Konten (CMS) berbasis **Laravel 11** yang dirancang secara khusus untuk kebutuhan *Company Profile*, Sekolah, institusi, maupun portofolio personal. Sistem ini dibangun dengan fokus pada performa, estetika tampilan modern, dan kemudahan bagi administrator dalam mengelola konten statis dan dinamis.

Proyek ini menggunakan **Tailwind CSS** dipadukan dengan **Alpine.js** untuk menyajikan antarmuka *responsive* di berbagai perangkat, lengkap dengan transisi halus dan fitur mode gelap (Dark Mode) cerdas.

---

## 🚀 Fitur Utama

### 1. Sistem Frontend Modern
- **Desain Estetik & Responsive:** Tampilan dirancang khusus menggunakan susunan gradasi warna modern dan utilitas layout Tailwind CSS (termasuk *Glassmorphism* & *Micro-animations*).
- **Dark Mode Pintar:** Didukung oleh Alpine.js dengan konfigurasi *Gelap / Terang / Otomatis (mengikuti default sistem)* yang menyimpan referensi preferensi user melalui *localStorage*.
- **Hero Slider Dinamis:** Bagian *Homepage* memadukan tulisan informasi utama (*Split Layout*) bersamaan dengan fungsi Carousel Slider untuk media promosi berbasis *WebP high-quality*.
- **Kategori Dinamis:** Memiliki modul Berita (*News/Blog*), Layanan Pilihan, Galeri Portofolio Klien, hingga daftar Mitra Industri.

### 2. Panel Admin (Dashboard) Konten
- **Manajemen Modul Lengkap:** Antarmuka pengurus *(backend)* memungkinkan administrator menambah, mengubah, atau menghapus konten (*CRUD*) pada Slider, Berita/Pengumuman, Mitra, Layanan, dan Portofolio.
- **Konversi WebP Otomatis & Lossless:** Sistem secara otomatis mengenkripsi dan mengubah gambar tipe JPG/PNG standar dari *uploader* menjadi format `WebP (Kualitas 100)` agar pengaksesan gambar di website jauh lebih efisien dan terhindar dari isu *rendering compression bandwidth*.
- **Pengaturan Konfigurasi Universal (`Setting`):** Semua tulisan dasar sistem (Nama Identitas Sistem, Slogan/Prolog, Logo Website Utama, Ikon/Favicon, Label Sosmed) dapat disesuaikan langsung di panel tanpa perbaikan basis kode sumber (Database Drive Config).
- **Statistik Dashboard Visual:** Antarmuka *admin backend* informatif dengan panel ringkasan berwarna gradien estetik yang responsif disertai sistem *Sidebar Collapse* pada sisi navigasinya.
- **Pembuatan Menu Dinamis:** Konfigurasi penautan Navigasi (termasuk visibilitasnya) pada Frontend dari bilah Administrasi dengan model referensi hirarki aktif / nonaktif (`is_active`).

---

## 🛠️ Tech Stack & Requirements

Pastikan sistem perangkat Anda telah menginstal dan memenuhi prasyarat dependensi pendukung:

- **PHP** `>= 8.2`
- **Composer** (PHP Package Manager)
- **Database Server:** MySQL, MariaDB, atau SQLite (Sesuai kebutuhan, direkomendasikan env: MySQL/MariaDB)
- **Web Server:** Nginx atau Apache (contoh: bundle XAMPP/Laragon dll)
- Ekstensi PHP *(Wajib)*: `BCMath`, `Ctype`, `DOM`, `Fileinfo`, `JSON`, `Mbstring`, `OpenSSL`, `PDO`, `Tokenizer`, `XML`, serta ekstensi `GD` (untuk proses optimasi WebP).

---

## 📋 Panduan Instalasi (Development Lokal)

Ikuti instruksi langkah-langkah di bawah ini untuk memasang WebCMS pada *environment local* Anda:

### 1. Kloning Repositori
Clone proyek repositori ini atau *extract/download* rilis sumber (.zip) ke dalam *root path* *server* lokal Anda (misal: di dalam direktori `htdocs` jika Anda menggunakan XAMPP):
```bash
git clone https://github.com/aangwie/webcms.git
cd webdev
```

### 2. Konfigurasi Depedensi Laravel (Composer)
Unduh seluruh library vendor Laravel via `composer`:
```bash
composer install
```

### 3. File Lingkungan Konfigurasi (.env)
Bentuk berkas konfigurasi env dengan menyalin data *example configuration*.
```bash
cp .env.example .env
```
_**Catatan:** Buka file `.env` kemudian sesuaikan konfigurasi pangkalan data / database (Nama, user & password) di *host* mesin web-*server* Anda masing-masing._ 

### 4. Membuat Kunci / *Application Key*
Guna meningkatkan proteksi aplikasi melalui algoritma enkripsi App:
```bash
php artisan key:generate
```

### 5. Membangun & Menautkan Sistem Database
Berikan trigger ke framework Laravel agar merancang basis tabulasi database-nya dengan model migrasi (serta dummy *Data Seeders* jika diperlukan).
```bash
php artisan migrate

php artisan db:seed
```
Jika Anda memuat aset dari server public storage, eksekusi pembuatan referensi pintas / symlink:
```bash
php artisan storage:link
```

### 6. Menjalankan *Development System Server*
Anda sudah dapat mengakses website anda secara localhost / offline dan mengklik antar tautan tanpa web host asli dengan memanfaatkan terminal `serve`:
```bash
php artisan serve
```
Web dapat dibuka lewat browser di rujukan portal: `http://localhost:8000` atau `http://127.0.0.1:8000`

---

Untuk login admin gunakan akun ini
```bash
username : admin@webcms.com
password : password
```

## 🤝 Keterlibatan dan Kontribusi
Sistem open source Laravel memperbolehkan siapapun terlibat melakukan adaptasi, memberikan *issue*, maupun melakukan permohonan tarik *(Pull Request)*. Pedoman kontribusi secara mendasar dapat Anda ikuti dari kerangka asal milik standar platform resmi Laravel. Silangkan laporkan ke admin pengelola proyek jika Anda menemukan *error* serius (*vulnerability* / masalah sistem).

## 📄 Lisensi
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT). Modifikasi rancangan pada repositori aplikasi ini berlaku pada perundang-undangan Open Source yang diakui pengelola.
