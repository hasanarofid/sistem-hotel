# Hasan Hotel — Luxury Resort & Direct Booking System

**Hasan Hotel** adalah platform aplikasi berbasis web untuk **Sistem Manajemen Hotel & Direct Booking Engine** yang dirancang dengan sudut pandang *Hospitality Revenue & Operations Analyst*. Sistem ini dibangun untuk memaksimalkan angka *Direct Booking* (bebas komisi pihak ketiga/OTA), mempercepat alur transaksi reservasi tamu, serta mengotomatisasi operasional resort/hotel menggunakan arsitektur modern berbasis **Laravel 11**, **Vue 3 (Inertia.js)**, **Tailwind CSS**, dan **MySQL**.

- **Repository Git Target:** `git@github.com:hasanarofid/sistem-hotel.git`
- **Developer & Owner:** [@hasanarofid.site](https://hasanarofid.site) | WhatsApp: [Wa.me/628814959247](https://Wa.me/628814959247)

---

## 🏛️ Filosofi Analis Hotel & Konsep Desain UI/UX

Sistem **Hasan Hotel** mengadopsi standar visual *5-star luxury boutique resort* (inspirasi dari **Aman Resorts & Kempinski Hotels**):
- **Desain Modern & Responsif:** Tampilan adaptif sempurna di layar perangkat smartphone, tablet, dan desktop.
- **Bebas Cliché Visual AI:** Menghindari elemen dekoratif berlebihan atau gradien berisik. Fokus pada keanggunan autentik, tipografi premium (*Cormorant Garamond / Plus Jakarta Sans*), *whitespace* seimbang, dan gambar resolusi tinggi.
- **Zero-Friction Guest Journey:** Meminimalisir langkah pemesanan kamar agar tamu dapat menyelesaikan transaksi dalam hitungan detik.

---

## 🚀 Fitur Utama Sistem

### 1. Direct Booking Engine (Alur Pemesanan Tamu)
- 🔍 **Filter Pencarian Real-time:** Check-in, Check-out, & Jumlah Tamu.
- 🛏️ **Room & Villa Showcase:** Galeri foto interaktif, amenitas kamar, bed type, & kebijakan pembatalan.
- 🏷️ **Dynamic Rate Plan:** Pilihan *Best Available Rate*, *With Breakfast*, atau paket diskon promosi.
- 🍷 **Layanan Add-ons:** Spa Treatment, Airport Transfer, Candlelight Dinner, & Extra Bed.
- 📱 **WhatsApp Instant E-Voucher:** Pengiriman tiket/voucher digital otomatis berformat PDF & QR Code ke WhatsApp tamu saat pembayaran berhasil.

### 2. PMS Light & Control Panel Operasional (Admin Hotel)
- 📅 **Interactive Reservation Calendar:** Visualisasi status kamar (*Booked*, *Checked-In*, *Checked-Out*, *Maintenance*).
- 💰 **Dynamic Pricing & Allotment:** Kemudahan mengubah harga kamar berdasarkan musim (*Peak/High/Low Season*) dan mengunci kuota kamar.
- 📝 **Manual Reservation Input:** Fitur entri cepat untuk reservasi *walk-in* atau via telepon.
- 📊 **Revenue & Occupancy Analytics:** Laporan tingkat hunian (*Occupancy Rate %*), *Average Daily Rate (ADR)*, dan proyeksi pendapatan.

### 3. Payment Gateway & Webhook Asinkron
- 💳 **Metode Pembayaran Lengkap:** QRIS, Virtual Account Bank (BCA, Mandiri, BRI, BNI), Credit Card, dan E-Wallet via Midtrans / Xendit.
- 🔒 **Webhook Security Idempotent:** Pemrosesan callback aman dari ganda transaksi dan otomatis memperbarui status DB secara *real-time*.

---

## 💳 Arsitektur Integrasi Payment Gateway & WhatsApp Engine

```
[ Tamu (Frontend Vue/Inertia) ] ──(1. Tokenisasi)──> [ Payment Gateway (Midtrans) ]
               │                                                  │
   (2. Charge Transaction)                               (3. Otorisasi Finansial)
               ▼                                                  ▼
[ Backend (Laravel 11 Engine) ]  <──(4. Webhook Callback)── [ Bank / E-Wallet ]
               │
               └──(5. Trigger Notifikasi)──> [ WhatsApp Engine Gateway ] ──> [ WA Tamu (PDF Voucher) ]
```

---

## 🛠️ Instalasi & Pengoperasian Lokal

### 1. Clone & Install Dependensi
```bash
git clone git@github.com:hasanarofid/sistem-hotel.git
cd sistem-hotel
composer install
npm install
```

### 2. Environment & Database Migration
```bash
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
```

### 3. Jalankan Development Server
```bash
# Terminal 1: Vite Frontend Development Server
npm run dev

# Terminal 2: Laravel Backend Server
php artisan serve
```

---

## 🔄 Alur Git & Production Auto-Deploy

1. Build frontend assets:
   ```bash
   npm run build
   ```
2. Commit dan Push ke Repository Git Baru:
   ```bash
   git add .
   git commit -m "feat: setup sistem-hotel direct booking engine & rules"
   git remote set-url origin git@github.com:hasanarofid/sistem-hotel.git
   git push -u origin master
   ```

---

## 👨‍💻 Author & Hospitality Web Specialist
- **Developer / Owner:** Hasan Arofid ([hasanarofid.site](https://hasanarofid.site))
- **WhatsApp:** [http://Wa.me/628814959247](http://Wa.me/628814959247)
