# Panduan Integrasi Frontend ke Backend (Full Stack)

Repository ini terdiri dari **Frontend (React + Vite)** dan **Backend (Laravel)**. Berikut adalah panduan untuk menggabungkan keduanya agar bisa dideploy dalam satu root hosting.

## Prasyarat
- Node.js & npm (untuk Frontend)
- PHP & Composer (untuk Backend)

---

## Cara Cepat (Menggunakan Script)

Jika Anda menggunakan Windows (PowerShell), Anda bisa menjalankan script otomatis yang sudah disediakan di root folder:

1. Buka PowerShell.
2. Jalankan:
   ```powershell
   ./deploy_frontend.ps1
   ```
Script ini akan otomatis melakukan build frontend, menyalin file ke folder `public` backend, dan mengatur view Laravel.

---

## Cara Manual (Langkah demi Langkah)

Jika Anda ingin melakukannya secara manual, ikuti langkah-langkah berikut:

### 1. Build Frontend
Masuk ke folder frontend dan buat file produksi:
```bash
cd frontend
npm install
npm run build
```
Hasil build akan berada di folder `frontend/dist`.

### 2. Pindahkan ke Backend
Setelah proses build selesai, pindahkan hasilnya ke folder backend:

- Salin semua file dari `frontend/dist/assets/` ke `backend/public/assets/`.
- Salin semua file statis lainnya dari `frontend/dist/` ke `backend/public/`.
- **PENTING**: Ubah nama file `frontend/dist/index.html` menjadi `react_app.blade.php` dan letakkan di folder `backend/resources/views/`.

### 3. Konfigurasi API
Pastikan file `.env` di folder `frontend` sudah memiliki URL API yang benar:
```env
VITE_API_BASE_URL=https://nama-domain-anda.com
```

---

## Struktur Folder Setelah Digabung
Untuk hosting, arahkan **Document Root** web server Anda ke folder:
`backend/public`

File-file utama yang akan diakses oleh browser:
- `backend/public/index.php` (Entry point Laravel)
- `backend/public/assets/...` (File JS/CSS React)
- `backend/resources/views/react_app.blade.php` (Tampilan utama React yang dipanggil Laravel)

---

## Update Kode
Setiap kali Anda melakukan perubahan di folder `frontend`, Anda harus mengulangi langkah **Build & Pindahkan** di atas agar perubahan muncul di website.
