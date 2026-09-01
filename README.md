# Vije Boutique Resort — Luxury Hotel & Direct Booking Management System

**Vije Boutique Resort** adalah platform web hospitality & *Direct Booking Management System* yang dirancang khusus untuk membangun ulang dan meng-elevasi **Vije Boutique Resort** ([www.vijeboutiqueresort.com](https://www.vijeboutiqueresort.com)) menjadi antarmuka digital berkelas dunia mengusung standar **"Quiet Luxury Boutique Resort"** (Inspirasi dari **Aman Resorts** & **Kempinski Hotels**).

- **Dokumen Referensi PRD:** `PRD — Vije Boutique Resort.pdf`
- **Aturan Repositori & Agen:** [.agents/AGENTS.md](file:///.agents/AGENTS.md) / [.cursorrules](file:///.cursorrules)
- **Target Repository:** `git@github.com:hasanarofid/sistem-hotel.git`
- **Developer & Owner:** [@hasanarofid.site](https://hasanarofid.site) | WhatsApp: [Wa.me/628814959247](https://Wa.me/628814959247)

---

## 💎 Prinsip Desain Utama: *"Less, But Better"*

Redesign website Vije Boutique Resort berfokus pada transformasi visual & UX tanpa mengubah bisnis proses utama:
- **Kesan Instan:** Memunculkan nuansa eksklusif, tenang, intimate, dan premium sejak detik pertama dibuka.
- **Hierarki Desain:** **Photography > Typography > Whitespace > Storytelling > CTA**.
- **Tanpa AI Cliché:** Bebas dari elemen dekoratif neon berisik, border berlebihan, shadow berat, atau tampilan kaku khas OTA (Agoda/Booking.com).

---

## 🔒 Aturan Bisnis & Keamanan Utama (PRD Enforced Rules)

1. **Server-Side Calculations Only:** Kalkulasi ketersediaan, tarif kamar, diskon, service charge, dan pajak dilakukan secara atomic di server.
2. **Double Booking Prevention:** Transaksi pemesanan menggunakan database transactions & atomic locks (`lockForUpdate()`).
3. **Payment Abstraction & Webhook Security:** Abstraksi `PaymentGatewayInterface` (Midtrans & Xendit) dengan verifikasi tanda tangan webhook & penanganan *idempotent*.
4. **Role-Based Access Control (RBAC):** Hak akses terisolasi untuk `Super Admin`, `Admin`, `Reservation Staff`, `Finance`, dan `Content Manager`.
5. **Audit Logging:** Setiap aksi perubahan reservasi, harga, dan alokasi kamar tercatat lengkap di Audit Log.

---

## 🎨 Color Palette & Typography

### Palet Warna Natural & Luxury
- **Primary:** Warm Ivory (`#FAF8F5`), Cream (`#F4EFE6`), Sand (`#E6DEC9`), Warm Beige (`#D9CEB2`).
- **Secondary:** Deep Forest Green (`#1C2826`), Dark Olive (`#2B3023`), Charcoal (`#1A1A1A`).
- **Accent:** Muted Gold / Bronze (`#C5A059`).
- **Background:** Off-White / Ivory (`#FDFBF7`) / Obsidian Onyx (`#121212`).

### Tipografi Editorial
- **Heading / Display:** *Cormorant Garamond* / *Playfair Display* / *Cinzel* (Serif Mewah & Spacious).
- **Body Text:** *Plus Jakarta Sans* / *Inter* / *Manrope* (San-Serif Bersih & Highly Readable).

---

## 🏛️ Modul & Modul Sistem PRD

1. **Public Website & Editorial Landing Page**
2. **Room & Accommodation Showcase**
3. **Direct Online Booking Engine**
4. **Guest & CRM Management**
5. **Booking Management & Calendar**
6. **Payment Management & Gateway Abstraction**
7. **Admin Dashboard & CMS**
8. **Gallery & Facility Management**
9. **Promo & Discount Engine**
10. **Financial Reporting & Audit Log**
11. **RBAC & User Access Management**
12. **WhatsApp & Email Automated E-Voucher Notification System**

---

## ⚡ Teknologi & Performa

- **Backend Engine:** Laravel 11 (PHP 8.2+ REST API / Inertia).
- **Frontend Stack:** Next.js / Vue 3 (Inertia.js), Tailwind CSS, Framer Motion, `@lucide/vue`.
- **Database & Cache:** PostgreSQL / MySQL, Redis Cache & Queue.
- **Payment & WA Engine:** Midtrans / Xendit Payment Gateway Abstraction & Automated WhatsApp E-Voucher Engine.

---

## 🚀 Alur Git & Production Deploy

```bash
# Build frontend assets
npm run build

# Commit dan Push ke Repository
git add .
git commit -m "feat/redesign: implement PRD rules, RBAC & Quiet Luxury guidelines"
git push origin master
```

---

## 👨‍💻 Author & Hospitality Web Specialist
- **Developer / Owner:** Hasan Arofid ([hasanarofid.site](https://hasanarofid.site))
- **WhatsApp:** [http://Wa.me/628814959247](http://Wa.me/628814959247)
