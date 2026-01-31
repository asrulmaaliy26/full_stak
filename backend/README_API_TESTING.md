# 📚 Dokumentasi & Contoh Penggunaan API

## 📋 Daftar File

Berikut adalah file-file yang telah dibuat untuk membantu Anda menggunakan API POST News:

### 1. 📖 `API_USAGE_EXAMPLES.md`
Dokumentasi lengkap dengan contoh penggunaan API menggunakan berbagai tools dan bahasa pemrograman:
- ✅ cURL (Command Line)
- ✅ JavaScript (Fetch API & Axios)
- ✅ PHP (Guzzle)
- ✅ Postman
- ✅ Contoh Response (Success & Error)

### 2. 🌐 `test-api-news.html`
Form HTML interaktif untuk testing API langsung di browser:
- ✅ Form lengkap dengan semua field yang diperlukan
- ✅ Preview gambar sebelum upload
- ✅ Real-time response display
- ✅ Validasi form
- ✅ Design modern dan responsive

**Cara Menggunakan:**
1. Buka file `test-api-news.html` di browser
2. Isi semua field yang diperlukan
3. Upload gambar
4. Klik "Kirim Berita"
5. Lihat response di bawah form

### 3. 🐍 `test_api_news.py`
Script Python untuk automated testing:
- ✅ Test membuat berita tanpa galeri
- ✅ Test membuat berita dengan galeri
- ✅ Test validasi error
- ✅ Auto-generate dummy image

**Cara Menggunakan:**
```bash
# Install dependencies
pip install requests pillow

# Jalankan script
python test_api_news.py
```

---

## 🚀 Quick Start

### Metode 1: Menggunakan HTML Form (Paling Mudah)
```bash
# 1. Pastikan Laravel server berjalan
php artisan serve

# 2. Buka file test-api-news.html di browser
start test-api-news.html

# 3. Isi form dan klik submit
```

### Metode 2: Menggunakan cURL
```bash
curl -X POST http://localhost:8000/api/news \
  -F "title=Test Berita" \
  -F "excerpt=Ini excerpt test" \
  -F "content=Ini konten lengkap test berita" \
  -F "date=2026-01-30" \
  -F "category=Test" \
  -F "jenjang=mi" \
  -F "main_image=@path/to/image.jpg"
```

### Metode 3: Menggunakan Python Script
```bash
python test_api_news.py
```

---

## 📝 API Endpoint Details

### POST /api/news

**URL:** `http://localhost:8000/api/news`

**Method:** `POST`

**Content-Type:** `multipart/form-data`

**Headers:**
```
Accept: application/json
```

**Request Body:**

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| title | string | ✅ Yes | Judul berita |
| excerpt | string | ✅ Yes | Ringkasan berita |
| content | string | ✅ Yes | Konten lengkap berita |
| date | date | ✅ Yes | Tanggal berita (YYYY-MM-DD) |
| category | string | ✅ Yes | Kategori berita |
| jenjang | string | ✅ Yes | Jenjang (tk/mi/smp/ma/stai) |
| main_image | file | ✅ Yes | Gambar utama (max 2MB) |
| gallery[] | file[] | ❌ No | Array gambar galeri (max 2MB/file) |

**Success Response (201):**
```json
{
    "message": "Berita berhasil ditambahkan",
    "data": {
        "id": 1,
        "title": "...",
        "excerpt": "...",
        "content": "...",
        "date": "2026-01-30",
        "views": 0,
        "category": "...",
        "jenjang": "mi",
        "main_image": "http://localhost:8000/storage/news/main/...",
        "gallery": [...],
        "created_at": "...",
        "updated_at": "..."
    }
}
```

**Error Response (422):**
```json
{
    "message": "The title field is required. (and 2 more errors)",
    "errors": {
        "title": ["The title field is required."],
        "date": ["The date field is required."],
        "main_image": ["The main image field is required."]
    }
}
```

---

## 🔍 Testing Checklist

Gunakan checklist ini untuk memastikan API berfungsi dengan baik:

- [ ] ✅ Test dengan data lengkap (tanpa gallery)
- [ ] ✅ Test dengan data lengkap (dengan gallery)
- [ ] ✅ Test validasi error (data tidak lengkap)
- [ ] ✅ Test upload gambar besar (> 2MB) - harus error
- [ ] ✅ Test format gambar tidak valid - harus error
- [ ] ✅ Test jenjang tidak valid - harus error
- [ ] ✅ Test format tanggal tidak valid - harus error

---

## 🛠️ Troubleshooting

### Error: "Connection refused" atau "Failed to fetch"
**Solusi:**
```bash
# Pastikan Laravel server berjalan
php artisan serve
```

### Error: "The main image field is required"
**Solusi:**
- Pastikan Anda mengirim file dengan key `main_image`
- Pastikan file adalah gambar yang valid
- Pastikan ukuran file tidak melebihi 2MB

### Error: "The gallery.0 must be an image"
**Solusi:**
- Pastikan file gallery adalah gambar yang valid
- Gunakan key `gallery[]` untuk multiple files

### Error: "Storage path not found"
**Solusi:**
```bash
# Buat symbolic link untuk storage
php artisan storage:link
```

### Error: "CORS policy"
**Solusi:**
Jika menggunakan frontend dari domain berbeda, install Laravel CORS:
```bash
composer require fruitcake/laravel-cors
```

---

## 📚 Referensi Tambahan

- **Laravel Documentation:** https://laravel.com/docs
- **File Upload Laravel:** https://laravel.com/docs/filesystem
- **Validation Laravel:** https://laravel.com/docs/validation
- **API Resources:** https://laravel.com/docs/eloquent-resources

---

## 💡 Tips

1. **Gunakan Postman Collection** untuk menyimpan request yang sering digunakan
2. **Buat seeder** untuk data testing
3. **Gunakan Factory** untuk generate dummy data
4. **Implementasi rate limiting** untuk production
5. **Tambahkan authentication** (Laravel Sanctum/Passport)
6. **Compress image** sebelum upload untuk performa lebih baik
7. **Gunakan queue** untuk proses upload yang berat

---

## 🎯 Next Steps

Setelah API berfungsi dengan baik, Anda bisa:

1. ✅ Implementasi endpoint UPDATE dan DELETE
2. ✅ Tambahkan authentication & authorization
3. ✅ Implementasi pagination untuk list news
4. ✅ Tambahkan search & filter
5. ✅ Implementasi image optimization
6. ✅ Tambahkan API documentation (Swagger/OpenAPI)
7. ✅ Setup automated testing (PHPUnit)

---

## 📞 Support

Jika ada pertanyaan atau masalah, silakan:
- Cek dokumentasi di `API_USAGE_EXAMPLES.md`
- Test menggunakan `test-api-news.html`
- Run automated test dengan `test_api_news.py`

---

**Happy Coding! 🚀**
