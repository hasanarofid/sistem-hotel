# Panduan Interview Freelance & Script Presentasi Sistem Hotel
**Project:** Vije Boutique Resort — Luxury Hotel Website & Direct Booking Management System  
**Tech Stack:** Laravel 11 (PHP 8.2+), Vue 3 (Inertia.js), Tailwind CSS, MySQL, Redis, REST API

---

## 📋 DAFTAR ISI
1. [Executive Summary & Value Proposition (Elevator Pitch)](#1-executive-summary--value-proposition)
2. [Alur Presentasi Step-by-Step (Live Demo Script)](#2-alur-presentasi-step-by-step-live-demo-script)
3. [Daftar Prediksi Pertanyaan Interview & Jawaban Andal](#3-daftar-prediksi-pertanyaan-interview--jawaban-andal)
   - [A. Pertanyaan Bisnis & Hospitality](#a-pertanyaan-bisnis--hospitality)
   - [B. Pertanyaan Teknis & Arsitektur](#b-pertanyaan-teknis--arsitektur)
   - [C. Pertanyaan Keamanan & Concurrency](#c-pertanyaan-keamanan--concurrency)
   - [D. Pertanyaan UI/UX & Performa](#d-pertanyaan-uiux--performa)
   - [E. Pertanyaan Deployment & Maintenance](#e-pertanyaan-deployment--maintenance)
4. [Audit Kesiapan Website untuk Presentasi](#4-audit-kesiapan-website-untuk-presentasi)
5. [Tips & Strategi Menutup Interview (Closing)](#5-tips--strategi-menutup-interview)

---

## 1. Executive Summary & Value Proposition

### 🎙️ Elevator Pitch (30 Detik Pertama):
> *"Sistem yang saya kembangkan untuk **Vije Boutique Resort** bukan sekadar website company profile biasa, melainkan **End-to-End Direct Booking Engine** dengan standar desain **Quiet Luxury**. Tujuannya adalah membebaskan hotel dari ketergantungan komisi OTA (15–25%), meningkatkan konversi direct booking tamu mancanegara/domestik, serta menyediakan back-office management terintegrasi untuk manajemen kamar, reservasi, laporan keuangan, dan verifikasi pembayaran otomatis."*

### 🔑 3 Pilar Utama Sistem:
1. **Design Identity (Quiet Luxury):** Terinspirasi oleh *Aman Resorts* & *Kempinski*, mengutamakan fotografi imersif, tipografi elegan (*Cormorant Garamond* & *Plus Jakarta Sans*), whitespace seimbang, dan nuansa warna earthy (*Warm Ivory, Forest Green, Muted Gold*).
2. **Direct Booking Channel (0% Commission):** Form reservasi instan tanpa reload halaman (Inertia.js), estimasi harga real-time, pencegahan double booking, dan E-Voucher otomatis.
3. **Robust Back-Office & RBAC:** Panel administrasi dengan pembagian hak akses (*Super Admin, Admin, Reservation Staff, Finance, Content Manager*).

---

## 2. Alur Presentasi Step-by-Step (Live Demo Script)

Gunakan alur 5 babak berikut agar presentasi mengalir runut, profesional, dan meyakinkan:

```
[Babak 1: Hook & Landing Page] ──► [Babak 2: Direct Booking Experience] ──► [Babak 3: Admin Dashboard] ──► [Babak 4: Room & Booking Management] ──► [Babak 5: Tech & Keamanan]
```

---

### Babak 1: First Impression & Editorial Landing Page (Durasi: 2 Menit)
- **Tindakan:** Buka halaman utama (`/`). Tunjukkan hero banner, logo brand, dan navigasi.
- **Poin yang Dijelaskan:**
  - Desain *Quiet Luxury*: Mengutamakan pengalaman visual santai tanpa elemen berisik khas OTA.
  - Performa LCP & Lazy Loading aset gambar WebP.
  - Tunjukkan scroll effect: Navbar otomatis bertransisi mulus dari dark gradient ke solid warm ivory dengan logo yang tetap kontras dan tajam.
  - Buka responsive mode (Mobile View via Inspect Element): Tunjukkan bahwa menu drawer mobile terbuka rapi, full-viewport, tanpa tumpang tindih.

---

### Babak 2: Direct Booking Engine Tamu (Durasi: 3 Menit)
- **Tindakan:** Scroll ke modul *"Reservasi Langsung Resort"* (Booking Bar).
- **Poin yang Dijelaskan:**
  - Tamu memilih tanggal Check-in, Check-out, jumlah tamu, dan tipe Villa/Kamar.
  - Kalkulasi total malam dan estimasi biaya terhitung instan.
  - Isi form data tamu (Nama, Email, Nomor WhatsApp).
  - Pilih metode pembayaran (*QRIS Instant / Virtual Account*).
  - Klik **"Konfirmasi & Bayar Reservasi Now"**.
  - **Tunjukkan Modal E-Voucher:** Muncul popup konfirmasi instan berisi Kode Booking unik, status reservasi, rincian kamar, dan simulasi QRIS.
  - *Highlight nilai plus:* Data tamu langsung tersimpan di database dan siap diintegrasikan ke WhatsApp Gateway / Email PDF.

---

### Babak 3: Admin Dashboard & Overview Metrik (Durasi: 2 Menit)
- **Tindakan:** Login sebagai Admin/Staff dan masuk ke `/admin/dashboard`.
- **Poin yang Dijelaskan:**
  - Metrik utama: Total Pendapatan Bulan Ini, Total Reservasi Aktif, Jumlah Kamar Terisi, dan Tingkat Okupansi (Occupancy Rate).
  - Visualisasi grafik tren booking 7 hari / 30 hari terakhir.
  - Tabel reservasi terbaru dengan status badge dinamis (*PENDING, CONFIRMED, CANCELLED, CHECKED_IN*).

---

### Babak 4: Manajemen Kamar & Operasional Booking (Durasi: 2 Menit)
- **Tindakan:** Buka menu **Rooms** (`/admin/rooms`) dan **Bookings** (`/admin/bookings`).
- **Poin yang Dijelaskan:**
  - **Katalog Kamar:** Admin dapat menambah kamar baru, mengubah harga per malam (*dynamic pricing / seasonal rate*), kapasitas, fasilitas, dan kuota unit.
  - **Manajemen Booking:** Front desk / reservation staff dapat mengubah status tamu (misal: tamu sudah bayar -> ubah jadi *CONFIRMED*, tamu datang -> *CHECKED_IN*, selesai -> *CHECKED_OUT*).
  - Perubahan status langsung tercatat di log audit.

---

### Babak 5: Arsitektur, Keamanan & Scalability (Durasi: 2 Menit)
- **Poin yang Dijelaskan:**
  - **Server-Side Price Calculation:** Harga tidak bisa di-manipulasi dari inspect element client.
  - **Anti Double-Booking:** Transaksi database menggunakan database locking (`lockForUpdate()`).
  - **Payment Gateway Idempotency:** Webhook payment gateway diverifikasi dengan cryptographic signature.
  - **Deploy Friendly:** Mendukung shared hosting cPanel/DirectAdmin via FTP serta cloud server.

---

## 3. Daftar Prediksi Pertanyaan Interview & Jawaban Andal

---

### A. Pertanyaan Bisnis & Hospitality

#### Q1: "Mengapa hotel membutuhkan direct booking engine sendiri jika sudah ada OTA seperti Agoda/Booking.com?"
- **Jawaban Andal:**
  > *"OTA mengambil komisi 15% hingga 25% dari setiap transaksi. Dengan direct booking channel:*
  > 1. *Margin profit hotel naik 100% dari transaksi direct.*
  > 2. *Hotel memiliki kepemilikan data tamu (Guest CRM), sehingga bisa melakukan retargeting promo dan loyalty program via WhatsApp/Email.*
  > 3. *Hotel dapat menawarkan add-on eksklusif seperti spa, airport transfer, atau dinner package yang sulit dikustomisasi di OTA."*

#### Q2: "Bagaimana sistem ini menangani seasonal rate (harga berbeda saat high season / weekend)?"
- **Jawaban Andal:**
  > *"Sistem didesain modular. Pada level database, tabel kamar mendukung harga dasar (`price_per_night`), dan arsitektur backend kami telah disiapkan untuk mendukung rule `seasonal_rates` (tanggal mulai, tanggal akhir, surcharge persentase/nominal) yang dikalkulasi secara dinamis saat tamu memilih tanggal check-in."*

---

### B. Pertanyaan Teknis & Arsitektur

#### Q3: "Mengapa memilih arsitektur Laravel + Inertia.js Vue 3 dibanding SPA terpisah (API + React/Vue murni)?"
- **Jawaban Andal:**
  > *"Inertia.js memberikan yang terbaik dari dua dunia (The Best of Both Worlds):*
  > 1. *Sensasi Single Page Application (SPA) yang super cepat tanpa reload halaman bagi user.*
  > 2. *Keamanan dan produktivitas monolith Laravel: autentikasi sesi bawaan, proteksi CSRF otomatis, SSR-ready untuk SEO, tanpa kerumitan mengelola token JWT terpisah atau masalah CORS.*
  > 3. *Maintenance lebih ringkas dan hemat biaya server."*

#### Q4: "Bagaimana cara kerja autentikasi dan otorisasi (RBAC) pada sistem ini?"
- **Jawaban Andal:**
  > *"Kami menggunakan spatie role-permission / Laravel policies yang memisahkan 5 role:*
  > - `Super Admin`: Akses konfigurasi sistem penuh.
  > - `Admin`: Manajemen operasional & katalog kamar.
  > - `Reservation Staff`: Front-desk check-in, check-out, & data tamu.
  > - `Finance`: Laporan keuangan, invoice, dan payout.
  > - `Content Manager`: CMS fasilitas, artikel, dan galeri resort.
  > *Setiap route dan tombol di frontend diproteksi di dua sisi: middleware backend dan conditional rendering frontend."*

---

### C. Pertanyaan Keamanan & Concurrency

#### Q5: "Bagaimana cara Anda mencegah Double Booking jika ada dua tamu memesan tipe kamar yang sama di detik yang bersamaan?"
- **Jawaban Andal:**
  > *"Pencegahan dilakukan di level database backend menggunakan `DB::transaction()` dengan teknik **Pessimistic Locking** (`lockForUpdate()`) atau pengecekan atomic quota:*
  > 1. *Saat request masuk, sistem mengunci baris ketersediaan kamar tersebut.*
  > 2. *Sistem memeriksa apakah `kamar_tersedia - kamar_terboking > 0` pada rentang tanggal tersebut.*
  > 3. *Jika tersedia, kuota dipesan dan transaksi di-commit.*
  > 4. *Jika penuh, transaksi di-rollback seketika dan user kedua mendapatkan pesan ramah bahwa kamar telah terisi."*

#### Q6: "Bagaimana memastikan keamanan pembayaran dan pencegahan manipulasi webhook?"
- **Jawaban Andal:**
  > *"1. **Kalkulasi Server-Side:** Total tagihan selalu dihitung ulang dari database backend, bukan dari payload kiriman frontend.*
  > *2. **Signature Verification:** Setiap callback webhook dari Midtrans/Xendit wajib diverifikasi hash SHA512 signature-nya menggunakan Server Key.*
  > *3. **Idempotency:** Sistem mencatat status transaksi; jika webhook terkirim ganda oleh payment gateway, status tidak akan diproses dua kali."*

---

### D. Pertanyaan UI/UX & Performa

#### Q7: "Bagaimana optimasi performa halaman depan agar tetap cepat dengan foto-foto resort resolusi tinggi?"
- **Jawaban Andal:**
  > *"1. Menggunakan format gambar modern **WebP/AVIF** dengan kompresi lossless/lossy optimal.*
  > *2. Menerapkan **Lazy Loading (`loading='lazy'`)** pada gambar galeri di bawah fold.*
  > *3. Prioritas LCP (Largest Contentful Paint) pada Hero Banner utama.*
  > *4. Bundle aset dikompilasi dengan Vite (minified JS/CSS dan code splitting berbasis route)."*

#### Q8: "Bagaimana Anda memastikan website ini nyaman dibuka di smartphone (Mobile-First)?"
- **Jawaban Andal:**
  > *"Seluruh komponen UI diuji dari ukuran terkecil (360px) hingga layar 4K. Form booking dioptimasi dengan ukuran tap-target minimal 44x44px, ukuran font input minimal 16px untuk mencegah auto-zoom di iOS Safari, dan mobile navigation drawer yang rapi tanpa overlapping konten."*

---

### E. Pertanyaan Deployment & Maintenance

#### Q9: "Bagaimana Anda men-deploy sistem ini ke server (Shared Hosting cPanel vs VPS)?"
- **Jawaban Andal:**
  > *"Sistem kami sangat fleksibel:*
  > - **Untuk Shared Hosting (cPanel / FTP):** *Asset di-build secara lokal (`npm run build`), lalu folder `public/build` diupload via FTP. Konfigurasi document root diarahkan ke folder `public/` dengan keamanan `.env` dan folder penyimpanan terproteksi.*
  > - **Untuk VPS / Cloud Server (Nginx + PHP-FPM + Redis):** *Deploy otomatis menggunakan CI/CD Git webhook, Redis untuk queue pengiriman WA/Email, dan SSL Let's Encrypt."*

---

## 4. Audit Kesiapan Website untuk Presentasi

Gunakan checklist ini sebelum sesi interview dimulai:

| Modul / Komponen | Status | Catatan untuk Demo |
| :--- | :---: | :--- |
| **Landing Page Editorial** | ✅ Siap | Hero banner, transisi navbar saat scroll, typography serif/sans, mobile menu responsive. |
| **Direct Booking Bar** | ✅ Siap | Form tanggal, pemilih tipe kamar, data tamu, pemilihan metode pembayaran. |
| **E-Voucher Confirmation Modal** | ✅ Siap | Muncul otomatis setelah submit booking dengan kode booking acak & data ringkasan. |
| **Admin Dashboard** | ✅ Siap | Akses via `/admin/dashboard` (Statistik okupansi, total pendapatan, kartu ringkasan). |
| **Katalog & Manajemen Kamar** | ✅ Siap | Akses via `/admin/rooms` (Lihat daftar villa/kamar, harga, kapasitas, aksi edit/hapus). |
| **Manajemen Reservasi Admin** | ✅ Siap | Akses via `/admin/bookings` (Filter status booking, update status PENDING -> CONFIRMED). |
| **Manajemen User & RBAC** | ✅ Siap | Akses via `/admin/users` (Daftar staf, role assigner). |
| **Mobile Responsiveness** | ✅ Siap | Drawer menu solid background, logo berganti warna kontras saat scrolled/open. |

---

## 5. Tips & Strategi Menutup Interview (Closing)

1. **Jaga Tempo Bicara:** Jangan terburu-buru. Tunjukkan bahwa Anda menguasai produk baik dari sisi **value bisnis klien** maupun **arsitektur kode**.
2. **Sorot Pengalaman Pengguna (Empathy):** Jelaskan dari sudut pandang tamu resort bintang-5: *"Tamu luxury resort mencari ketenangan, kemudahan, dan kecepatan. Desain dan sistem ini dibuat untuk memberikan impresi tersebut sejak detik pertama."*
3. **Pertanyaan Penutup ke Klien (Tunjukkan Inisiatif):**
   > *"Berdasarkan roadmap Vije Boutique Resort, apakah ada integrasi khusus yang menjadi prioritas hotel dalam waktu dekat, seperti Channel Manager (SiteMinder/Channex) atau integrasi WhatsApp API resmi (WABA)?"*
