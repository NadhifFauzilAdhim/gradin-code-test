# Gradin Courier CRUD Test

Aplikasi Laravel sederhana untuk mengelola master data kurir. Modul ini mencakup migration, model, controller CRUD, validasi request, UI Tailwind CSS, dan feature test.

## Tech Stack

- PHP 8.3
- Laravel 13
- MySQL atau SQLite
- Pest PHP
- Tailwind CSS 4
- Vite

## Fitur

- CRUD master data courier.
- Pagination pada halaman index.
- Default sorting berdasarkan nama courier.
- Sorting opsional berdasarkan tanggal didaftarkan.
- Search nama courier dengan multi keyword.
- Filter courier berdasarkan level 1 sampai 5.
- Validasi lengkap untuk store dan update.
- Feature test untuk create, read, update, delete, filter, search, sorting, dan pagination.

## Struktur Data Courier

Tabel `couriers` memiliki kolom:

- `id`
- `name`
- `code`
- `email`
- `phone`
- `service_area`
- `level`
- `is_active`
- `registered_at`
- `created_at`
- `updated_at`

`level` hanya menerima nilai 1 sampai 5.

## Instalasi

Clone repository:

```bash
git clone https://github.com/NadhifFauzilAdhim/gradin-code-test.git
cd gradin-code-test
```

Install dependency PHP dan JavaScript:

```bash
composer install
npm install
```

Siapkan file environment:

```bash
cp .env.example .env
php artisan key:generate
```

Atur koneksi database di `.env`, lalu jalankan migration:

```bash
php artisan migrate
```

Build asset frontend:

```bash
npm run build
```

Jalankan aplikasi:

```bash
php artisan serve
```

Aplikasi dapat dibuka di:

```text
http://127.0.0.1:8000/couriers
```

## Development

Untuk menjalankan Vite selama development:

```bash
npm run dev
```

Untuk menjalankan server Laravel:

```bash
php artisan serve
```

## Routes

| Method | URL | Deskripsi |
| --- | --- | --- |
| GET | `/couriers` | Menampilkan list courier |
| GET | `/couriers/create` | Form tambah courier |
| POST | `/couriers` | Menyimpan courier baru |
| GET | `/couriers/{courier}` | Menampilkan detail courier |
| GET | `/couriers/{courier}/edit` | Form edit courier |
| PUT/PATCH | `/couriers/{courier}` | Memperbarui courier |
| DELETE | `/couriers/{courier}` | Menghapus courier |

Endpoint yang sama juga mendukung response JSON jika request mengirim header `Accept: application/json`.

## Query Parameter Index

Default:

```text
GET /couriers
```

Pagination:

```text
GET /couriers?per_page=10
```

Search multi keyword:

```text
GET /couriers?search=budi+agung
```

Contoh di atas dapat menemukan nama seperti `Budiono Hadi Agung`.

Filter level:

```text
GET /couriers?level=2,3
```

Sort berdasarkan tanggal didaftarkan:

```text
GET /couriers?sort=registered_at&direction=desc
```

## Validasi

Field yang divalidasi pada store dan update:

- `name`: required, string, max 255
- `code`: required, string, max 50, unique
- `email`: nullable, email, max 255, unique
- `phone`: nullable, string, max 30
- `service_area`: nullable, string, max 255
- `level`: required, integer, between 1 and 5
- `is_active`: sometimes, boolean
- `registered_at`: nullable, date

## Testing

Jalankan seluruh test:

```bash
php artisan test
```

Format kode:

```bash
vendor/bin/pint
```

Build asset:

```bash
npm run build
```

## Repository

Public repository:

```text
https://github.com/NadhifFauzilAdhim/gradin-code-test
```
