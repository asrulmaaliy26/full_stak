# 🚀 Panduan Local Development & Deployment (Full Stack)

Karena project ini terbagi menjadi dua folder yaitu **Frontend (React/Vite)** dan **Backend (Laravel)**, proses *development* dan *deployment*-nya memiliki sedikit alur khusus.

---

## 💻 1. Cara Menjalankan Server di Komputer Lokal (Localhost)

Agar aplikasi dapat berjalan utuh, Anda perlu menjalankan **dua terminal** secara bersamaan:

### Terminal 1: Backend (Laravel & API)
Fungsinya untuk menjalankan *database*, API, dan *server view*.
1. Buka terminal, masuk ke folder backend: `cd full_stak/backend`
2. Jalankan perintah: 
   ```bash
   php artisan serve
   ```
*(Biarkan terminal ini terbuka)*

### Terminal 2: Frontend (React & Vite)
Fungsinya untuk *live-reload* kodingan React agar Anda tidak perlu *refresh* berkali-kali saat ngoding.
1. Buka terminal baru, masuk ke folder frontend: `cd full_stak/frontend`
2. Jalankan perintah:
   ```bash
   npm run dev
   ```
*(Biarkan terminal ini terbuka)*

Untuk melihat hasil coding secara langsung (Live Reloading), buka **`http://localhost:3000`** di browser Anda.

---

## 📦 2. Cara Menggabungkan Hasil Coding ke Laravel (Local Deploy)

Ketika kodingan Anda di React sudah dirasa *fix* dan selesai, Anda perlu "menyuntikkan" hasil jadinya ke dalam server Laravel (agar muncul di `http://127.0.0.1:8000` dan siap di-push ke VPS).

**JANGAN** hanya menggunakan `npm run build`, karena hasil build tidak akan otomatis pindah ke Laravel. 

Gunakan perintah khusus ini:

1. Buka terminal (atau matikan dulu proses `npm run dev` dengan Ctrl+C).
2. Pastikan Anda berada di folder frontend: `cd full_stak/frontend`
3. Jalankan perintah otomatis:
   ```bash
   npm run deploy
   ```

**Apa yang dilakukan `npm run deploy`?**
Perintah ini mengeksekusi script `deploy.js` yang akan melakukan 3 hal otomatis:
1. `npm run build` (Meng-compile React menjadi file statis).
2. Meng-copy folder `dist/assets` dari Frontend ke dalam folder `backend/public/assets`.
3. Membaca nama file unik `.js` & `.css` terbaru, lalu menuliskannya secara otomatis ke dalam `backend/resources/views/react_app.blade.php`.

Setelah `npm run deploy` memunculkan pesan **"🎉 Deploy otomatis selesai!"**, Anda bisa membuka **`http://127.0.0.1:8000`** dan melihat hasilnya secara utuh.

---

## ☁️ 3. Cara Push ke Server Produksi (GitHub Actions / VPS)

Jika Anda sudah mengecek kodingannya di `127.0.0.1:8000` dan semuanya normal, Anda tinggal melakukan langkah standar Git:

1. Pastikan posisi terminal ada di *root* repository Anda.
2. Lakukan proses upload:
   ```bash
   git add .
   git commit -m "update fitur X"
   git push origin main
   ```
3. Selesai! Github Actions akan otomatis mengambil kodingan Anda, mem-build ulang menggunakan Linux secara mandiri, lalu mengirimkannya ke Server/VPS `lpialhidayah.or.id`.

---

**⚠️ Peringatan Penting!**
Jika Anda mengganti nama *theme* (misal dari UMUM ke MI), pastikan mengedit kodingannya di dalam `frontend`, BUKAN di `backend/resources/views/react_app.blade.php`. Karena file view blade tersebut akan selalu tertimpa oleh kodingan baru setiap kali Anda menjalankan `npm run deploy`.
