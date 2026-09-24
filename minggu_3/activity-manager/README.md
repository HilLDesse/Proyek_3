# Activity Manager

Activity Manager adalah aplikasi web berbasis Laravel 13 untuk mengelola data kegiatan (Activity).

## Cara Menjalankan Proyek

Masuk ke folder project:

```bash
cd Proyek_3/minggu_3/activity-manager
```

Install dependency:

```bash
composer install
```

Salin file environment:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Jalankan aplikasi:

```bash
php artisan serve
```

Aplikasi dapat diakses melalui:

```text
http://127.0.0.1:8000
```

## Setup Database

Sesuaikan konfigurasi database pada file `.env`.

Contoh:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=activity_manager
DB_USERNAME=root
DB_PASSWORD=
```

Kemudian jalankan migration:

```bash
php artisan migrate
```

## Seed Database

Untuk mengisi database dengan data awal, jalankan:

```bash
php artisan db:seed
```

Atau jalankan migration sekaligus seed:

```bash
php artisan migrate --seed
```

## URL Route Utama

Halaman daftar Activity:

```text
http://127.0.0.1:8000/activities
```

Halaman tambah Activity:

```text
http://127.0.0.1:8000/activities/create
```

Filter Activity berdasarkan status:

```text
http://127.0.0.1:8000/activities?status=Planned
http://127.0.0.1:8000/activities?status=Ongoing
http://127.0.0.1:8000/activities?status=Done
```