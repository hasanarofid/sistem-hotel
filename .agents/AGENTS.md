# System Rules & Development Guidelines — Vije Boutique Resort

## 1. Identitas & Tujuan Sistem

- **Nama Project:** Vije Boutique Resort — Luxury Hotel Website & Booking Management System
- **Domain Utama Target:** https://www.vijeboutiqueresort.com / https://hotel.hasanarofid.site
- **Repository Git:** `git@github.com:hasanarofid/sistem-hotel.git`
- **Fokus Utama:** End-to-end Hotel Website & Booking Management System dengan standar **"Quiet Luxury Boutique Resort"** dan *Direct Booking Channel* bebas komisi OTA.

---

## 2. Arsitektur & Tech Stack

- **Frontend:** Next.js / Vue 3 (Inertia.js), TypeScript, Tailwind CSS, Framer Motion / Lucide Icons.
- **Backend:** Laravel REST API (PHP 8.2+).
- **Authentication:** Laravel Sanctum / JWT.
- **Database:** PostgreSQL / MySQL (Skema ERD terstruktur & terindeks).
- **Cache & Queue:** Redis (Processing async jobs, notifications, session/rate-limiting).
- **Storage:** S3-compatible storage / Local abstraction layer.
- **Email & WhatsApp Engine:** SMTP / Transactional Email Provider & WA Gateway API (E-Voucher PDF Delivery).
- **Payment Abstraction:** Interface terisolasi (`PaymentGatewayInterface`) mendukung Midtrans & Xendit.

---

## 3. Aturan Bisnis Kunci & Keamanan (Key Business & Concurrency Rules)

1. **Kalkulasi Harga & Ketersediaan Server-Side Only:**
   - DILARANG mempercayai kalkulasi harga dari client-side. Seluruh harga, pajak, service charge, dan ketersediaan kamar wajib dihitung secara atomic di backend server.
2. **Pencegahan Double Booking (Database Locking):**
   - Transaksi pemesanan kamar WAJIB menggunakan `DB::transaction()` dengan pessimistic locking (`lockForUpdate()`) atau optimistic locking berbasis versi untuk mencegah *race condition* atau pemesanan ganda pada tanggal yang sama.
3. **Konfirmasi Booking Berbasis Webhook Terverifikasi:**
   - Status reservasi hanya berubah menjadi `PAID` / `CONFIRMED` setelah webhook payment gateway diverifikasi tanda tangannya (signature verification) atau melalui konfirmasi manual Super Admin/Admin.
   - Setiap callback webhook harus bersifat *idempotent*.
4. **Audit Logging & Tracing:**
   - Setiap perubahan status reservasi, modifikasi harga kamar, alokasi kuota, dan tindakan sensitif staf wajib dicatat pada Audit Log (`user_id`, `action`, `payload`, `ip_address`, `timestamp`).
5. **Role-Based Access Control (RBAC):**
   - Hak akses dipisahkan secara ketat sesuai peran:
     - `Super Admin`: Akses penuh ke seluruh fitur & konfigurasi sistem.
     - `Admin`: Pengelolaan operasional harian hotel & ketersediaan.
     - `Reservation Staff`: Frontdesk booking, check-in, check-out, & data tamu.
     - `Finance`: Laporan keuangan, pembayaran, & pengembalian dana.
     - `Content Manager`: CMS, galeri, fasilitas, & halaman promo.

---

## 4. Prinsip Desain & Visual Identity ("Quiet Luxury")

- **Inspirasi Brand:** **Aman Resorts** (minimalis, tenang, earthy tones, immersive) & **Kempinski Hotels** (elegansi klasik-modern, presisi, eksklusif).
- **Prinsip Utama:** *"Less, But Better"*. Kesan pertama wajib menyampaikan resort boutique 5-bintang premium.
- **Hierarki Desain:** **Photography > Typography > Whitespace > Storytelling > CTA**.
- **Color Palette Standard:**
  - **Primary:** Warm Ivory (`#FAF8F5`), Cream (`#F4EFE6`), Sand (`#E6DEC9`), Warm Beige (`#D9CEB2`).
  - **Secondary:** Deep Forest Green (`#1C2826`), Dark Olive (`#2B3023`), Charcoal (`#1A1A1A`).
  - **Accent:** Muted Gold / Bronze (`#C5A059`).
  - **Background:** Off-White / Ivory (`#FDFBF7`) / Obsidian Onyx (`#121212`).
- **Tipografi:**
  - **Heading / Display:** Elegant Serif (*Cormorant Garamond* / *Playfair Display* / *Cinzel*).
  - **Body / Subtitle:** Clean Sans-Serif (*Plus Jakarta Sans* / *Inter* / *Manrope*).
- **Dilarang (Strictly Avoid):**
  - Neon gradients berisik atau elemen dekoratif AI yang terlalu mencolok.
  - Border/shadow tebal kaku.
  - Layout padat & crowded khas OTA (Agoda/Booking.com).

---

## 5. Standar Kode & Prosedur Git

1. **Kualitas Kode:** Terapkan prinsip DRY (Don't Repeat Yourself) dan KISS (Keep It Simple, Stupid). Sertakan strict typing.
2. **Tanpa Masking Error:** Dilarang menyembunyikan exception dengan `try-catch` kosong atau mengembalikan dummy fallback tanpa log.
3. **Verifikasi Wajib:** Selalu jalankan `npm run build` dan pengujian fungsi/API sebelum menganggap tugas selesai.
4. **Git Commit Standard:**
   ```bash
   git add .
   git commit -m "feat/redesign: implement PRD rules, RBAC & Quiet Luxury guidelines"
   git push origin master
   ```
