# SIATU SDN 15 Batipuh

Proyek aplikasi berbasis Laravel untuk sistem informasi sekolah SDN 15 Batipuh.

## Persiapan awal

Pastikan komputer Anda sudah memiliki:

- PHP 8.3+
- Composer
- Node.js dan npm
- MySQL / MariaDB
- Laragon, XAMPP, atau server lokal lainnya

## Cara menjalankan project dari awal

### 1. Unduh atau clone project

Jika dari GitHub:

```bash
git clone https://github.com/<username>/<repository>.git
cd <nama-repository>
```

Jika dari file zip:

```bash
# unzip file project
cd <folder-project>
```

### 2. Install dependency PHP

```bash
composer install
```

### 3. Siapkan file environment

Salin file `.env.example` menjadi `.env`:

```bash
copy .env.example .env
```

Atau di Linux/macOS:

```bash
cp .env.example .env
```

Lalu sesuaikan koneksi database di file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_sdn15batipuh
DB_USERNAME=root
DB_PASSWORD=admin1234
```

> Pastikan database sudah dibuat di MySQL sebelum menjalankan migrasi.

### 4. Generate key aplikasi

```bash
php artisan key:generate
```

### 5. Jalankan migrasi database

```bash
php artisan migrate --seed
```

Jika ingin hanya migrasi tanpa seeder:

```bash
php artisan migrate
```

### 6. Install dependency frontend

```bash
npm install
```

### 7. Build aset frontend

```bash
npm run build
```

### 8. Jalankan aplikasi

Untuk mode local dengan server bawaan Laravel:

```bash
php artisan serve
```

Akses aplikasi di browser:

```text
http://localhost:8000
```

## Jika pakai Laragon

- Letakkan project di folder `C:\laragon\www\`
- Pastikan database sudah dibuat dengan nama sesuai `.env`
- Jalankan project dari browser dengan URL seperti:

```text
http://sitatu-sdn15batipuh.test
```

atau gunakan:

```bash
php artisan serve
```

## Catatan penting

- Jika ada error terkait vendor atau dependency, jalankan:

```bash
composer install
```

- Jika file `storage` atau `bootstrap/cache` bermasalah, bisa bersihkan cache:

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## License

Project ini menggunakan lisensi MIT.

