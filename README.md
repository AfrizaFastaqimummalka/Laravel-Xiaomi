<div align="center">

# 🛒 Xiaomi Store
### Toko online produk Xiaomi — dibangun dengan Laravel 13

![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat-square&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=flat-square&logo=bootstrap&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-8-646CFF?style=flat-square&logo=vite&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/Database-PostgreSQL-4169E1?style=flat-square&logo=postgresql&logoColor=white)
![NeonDB](https://img.shields.io/badge/Cloud-NeonDB-00E699?style=flat-square&logo=neon&logoColor=black)

</div>

---

Project ini dibuat sebagai latihan full-stack dengan Laravel. Fiturnya cukup lengkap — ada halaman toko untuk customer, keranjang belanja, checkout, sampai panel admin buat manage produk, kategori, supplier, dan pesanan.

## ✨ Fitur

**Sisi toko (publik)**
- Listing produk dengan filter kategori dan pencarian
- Halaman detail produk + produk terkait
- Keranjang belanja berbasis session
- Checkout dengan pilihan metode pembayaran (Transfer, COD, E-Wallet)
- Halaman konfirmasi pesanan sukses

**Panel admin** *(login required)*
- Dashboard dengan statistik: total produk, pesanan, pendapatan, pending
- CRUD produk — lengkap dengan upload foto
- CRUD kategori & supplier
- Manajemen transaksi — bisa update status pesanan (pending → processing → completed → cancelled)

## 🚀 Cara Install

```bash
# 1. Clone repo
git clone https://github.com/AfrizaFastaqimummalka/Laravel-Xiaomi.git
cd Laravel-Xiaomi

# 2. Install dependencies
composer install
npm install

# 3. Setup environment
cp .env.example .env
php artisan key:generate
```

### Konfigurasi Database (NeonDB / PostgreSQL)

Project ini pakai **NeonDB** — PostgreSQL serverless gratis di cloud. Edit `.env` dan isi bagian database:

```env
DB_CONNECTION=pgsql
DB_URL=postgresql://USERNAME:PASSWORD@HOST/neondb?sslmode=require
DB_HOST=your-host.neon.tech
DB_PORT=5432
DB_DATABASE=neondb
DB_USERNAME=your-username
DB_PASSWORD=your-password
DB_SSLMODE=require
```

Daftar akun NeonDB gratis di [neon.tech](https://neon.tech), buat project baru, lalu copy connection string-nya ke `.env`.

```bash
# 4. Jalankan migrasi + seeder
php artisan migrate --seed

# 5. Link storage (untuk foto produk)
php artisan storage:link

# 6. Build assets
npm run build

# 7. Jalankan server
php artisan serve
```

Buka di browser: **http://localhost:8000**

## 🔐 Akun Admin

Setelah jalankan `php artisan migrate --seed`, akun admin sudah otomatis tersedia:

| Field | Value |
|-------|-------|
| **Email** | `admin@xiaomistore.com` |
| **Password** | `password` |

Login di: **http://localhost:8000/login**

Setelah login, langsung diarahkan ke dashboard admin di `/admin`.

## 🗂️ Struktur Singkat

```
app/
├── Http/Controllers/
│   ├── Admin/          → DashboardController, ProductController, dll
│   ├── ShopController  → listing & detail produk
│   ├── CartController  → keranjang (session-based)
│   └── CheckoutController
├── Models/             → Product, Category, Supplier, Order, OrderItem

resources/
├── views/
│   ├── layouts/        → app.blade.php (toko) + admin.blade.php (panel)
│   ├── shop/           → index, show, cart, checkout, success
│   ├── admin/          → dashboard, products, categories, suppliers, orders
│   └── partials/       → flash-alerts.blade.php
└── js/
    ├── app.js
    └── flash-alert.js  → auto-dismiss flash notification
```

## 🛠️ Tech Stack

| Layer | Tool |
|-------|------|
| Framework | Laravel 13 |
| Database | PostgreSQL via NeonDB (serverless) |
| CSS | Bootstrap 5.3 + custom |
| Icons | Bootstrap Icons 1.11 |
| Build tool | Vite 8 |
| Auth | Laravel built-in (session) |

## 📸 Tampilan

Halaman toko pakai tema warna Xiaomi (`#FF6900` orange) dengan layout Bootstrap grid. Panel admin pakai sidebar fixed dengan navigasi per fitur.

---

<div align="center">
  <sub>Dibuat untuk keperluan belajar Laravel · 2025</sub>
</div>
