# Panduan Migrasi ke NeonDB (PostgreSQL)

## Apa yang sudah diubah

1. **`.env`** — DB_CONNECTION diganti ke `pgsql`, DB_URL diisi connection string NeonDB
2. **`config/database.php`** — Hapus `use Pdo\Mysql` (hanya ada di PHP 8.5+), set default ke `pgsql`

## Langkah migrasi (jalankan di terminal project)

### 1. Install dependency PostgreSQL driver

```bash
composer require doctrine/dbal
```

> Laravel sudah include `pdo_pgsql` secara native, tapi `doctrine/dbal` diperlukan untuk beberapa operasi schema.

### 2. Install composer packages

```bash
composer install
```

### 3. Clear config cache

```bash
php artisan config:clear
php artisan cache:clear
```

### 4. Jalankan migration ke NeonDB

```bash
php artisan migrate --fresh
```

### 5. Jalankan seeder

```bash
php artisan db:seed
```

### 6. Verifikasi

```bash
php artisan tinker
# Di dalam tinker:
# DB::connection()->getPdo();  // cek koneksi
# \App\Models\User::count();   // cek data
```

## Catatan penting

- **enum** di PostgreSQL: Laravel otomatis buat sebagai VARCHAR + check constraint. Tidak perlu ubah migration.
- **unsignedBigInteger/unsignedInteger**: Di PostgreSQL tidak ada unsigned, Laravel map ke BIGINT/INT biasa.
- **mediumText/longText**: Di PostgreSQL semua jadi TEXT. Sudah handled otomatis oleh Laravel.
- **SSL**: NeonDB wajib SSL, sudah dikonfigurasi via `DB_SSLMODE=require` dan `DB_URL`.

## Kredensial NeonDB

- Host: `ep-billowing-smoke-aoelqfsg-pooler.c-2.ap-southeast-1.aws.neon.tech`
- Database: `neondb`
- Username: `neondb_owner`
- Region: Asia Pacific (Singapore)
