# 📝 API UPDATE (Edit) - Documentation

Dokumentasi lengkap untuk endpoint UPDATE News, Projects, dan Journals.

---

## 📰 1. UPDATE News

### Endpoint
```
PUT http://localhost:8000/api/news/{id}
```

### Headers
```
Content-Type: multipart/form-data
Accept: application/json
```

### Request Body (Form Data - Semua Field Optional)

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| title | string | ❌ No | Judul berita |
| excerpt | string | ❌ No | Ringkasan berita |
| content | string | ❌ No | Konten lengkap berita |
| date | date | ❌ No | Tanggal berita (YYYY-MM-DD) |
| category | string | ❌ No | Kategori berita |
| level | string | ❌ No | Tingkat prestasi (Nasional, Regional, dll) |
| jenjang | string | ❌ No | Jenjang (tk/mi/smp/ma/stai) |
| main_image | file | ❌ No | Gambar utama baru (max 2MB) |
| gallery[] | file[] | ❌ No | Galeri gambar baru (max 2MB per file) |

**Note**: 
- Hanya kirim field yang ingin diupdate
- Jika upload gambar baru, gambar lama akan otomatis dihapus
- Jika upload gallery baru, semua gallery lama akan diganti

### Contoh cURL
```bash
# Update hanya title, category, dan level
curl -X PUT http://localhost:8000/api/news/1 \
  -F "title=Judul Berita Baru" \
  -F "category=Prestasi" \
  -F "level=Nasional"

# Update dengan gambar baru
curl -X PUT http://localhost:8000/api/news/1 \
  -F "title=Judul Update" \
  -F "main_image=@/path/to/new-image.jpg"
```

### Success Response (200 OK)
```json
{
    "message": "Berita berhasil diupdate",
    "data": {
        "id": 1,
        "title": "Judul Berita Baru",
        "excerpt": "Ringkasan berita...",
        "content": "Konten lengkap...",
        "date": "2026-01-30",
        "views": 150,
        "category": "Prestasi",
        "jenjang": "stai",
        "main_image": "http://localhost:8000/storage/news/main/new-image.jpg",
        "gallery": [...],
        "created_at": "2026-01-30T07:00:00.000000Z",
        "updated_at": "2026-01-30T07:50:00.000000Z"
    }
}
```

---

## 📁 2. UPDATE Projects

### Endpoint
```
PUT http://localhost:8000/api/projects/{id}
```

### Headers
```
Content-Type: multipart/form-data
Accept: application/json
```

### Request Body (Form Data - Semua Field Optional)

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| title | string | ❌ No | Judul proyek |
| category | string | ❌ No | Kategori proyek |
| description | string | ❌ No | Deskripsi proyek |
| author | string | ❌ No | Nama penulis |
| date | date | ❌ No | Tanggal (YYYY-MM-DD) |
| jenjang | string | ❌ No | Jenjang (tk/mi/smp/ma/stai) |
| imageUrl | file | ❌ No | Gambar proyek baru (max 2MB) |
| documents[] | file[] | ❌ No | Dokumen baru (max 5MB per file) |
| document_types[] | string[] | ❌ No | Tipe dokumen |
| document_titles[] | string[] | ❌ No | Judul dokumen |

**Note**: 
- Jika upload documents baru, semua dokumen lama akan diganti
- Gambar lama akan dihapus jika upload gambar baru

### Contoh cURL
```bash
# Update hanya title dan description
curl -X PUT http://localhost:8000/api/projects/1 \
  -F "title=Proyek Update" \
  -F "description=Deskripsi baru"

# Update dengan gambar dan dokumen baru
curl -X PUT http://localhost:8000/api/projects/1 \
  -F "title=Proyek Update" \
  -F "imageUrl=@/path/to/new-image.jpg" \
  -F "documents[]=@/path/to/doc1.pdf" \
  -F "documents[]=@/path/to/doc2.pdf" \
  -F "document_types[]=proposal" \
  -F "document_types[]=report" \
  -F "document_titles[]=Proposal Baru" \
  -F "document_titles[]=Laporan Baru"
```

### Success Response (200 OK)
```json
{
    "message": "Proyek berhasil diupdate",
    "data": {
        "id": 1,
        "title": "Proyek Update",
        "category": "Penelitian",
        "description": "Deskripsi baru",
        "author": "Dr. Ahmad",
        "date": "2026-01-30",
        "jenjang": "stai",
        "imageUrl": "http://localhost:8000/storage/projects/images/new-image.jpg",
        "documents": [
            {
                "url": "http://localhost:8000/storage/projects/documents/doc1.pdf",
                "type": "proposal",
                "title": "Proposal Baru",
                "format": "pdf"
            }
        ],
        "created_at": "2026-01-30T07:00:00.000000Z",
        "updated_at": "2026-01-30T07:50:00.000000Z"
    }
}
```

---

## 📚 3. UPDATE Journals

### Endpoint
```
PUT http://localhost:8000/api/journals/{id}
```

### Headers
```
Content-Type: multipart/form-data
Accept: application/json
```

### Request Body (Form Data - Semua Field Optional)

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| title | string | ❌ No | Judul jurnal (max 255) |
| category | string | ❌ No | Kategori jurnal (max 255) |
| abstract | string | ❌ No | Abstrak jurnal |
| author | string | ❌ No | Nama penulis (max 255) |
| mentor | string | ❌ No | Nama mentor (max 255) |
| score | integer | ❌ No | Nilai (0-100) |
| date | date | ❌ No | Tanggal (YYYY-MM-DD) |
| is_best | boolean | ❌ No | Jurnal terbaik (true/false) |
| jenjang | string | ❌ No | Jenjang (tk/mi/smp/ma/stai) |
| documentUrl | file | ❌ No | File PDF baru (max 10MB) |

**Note**: 
- Jika upload PDF baru, PDF lama akan otomatis dihapus

### Contoh cURL
```bash
# Update hanya score dan is_best
curl -X PUT http://localhost:8000/api/journals/1 \
  -F "score=95" \
  -F "is_best=1"

# Update dengan PDF baru
curl -X PUT http://localhost:8000/api/journals/1 \
  -F "title=Jurnal Update" \
  -F "score=98" \
  -F "documentUrl=@/path/to/new-jurnal.pdf"
```

### Success Response (200 OK)
```json
{
    "message": "Jurnal berhasil diupdate",
    "data": {
        "id": 1,
        "title": "Jurnal Update",
        "category": "Ekonomi Syariah",
        "abstract": "Abstrak...",
        "author": "Ahmad Mahasiswa",
        "mentor": "Dr. Zainal",
        "score": 98,
        "date": "2024-06-01T00:00:00.000000Z",
        "is_best": true,
        "jenjang": "stai",
        "documentUrl": "http://localhost:8000/storage/journals/documents/new-jurnal.pdf",
        "created_at": "2026-01-30T07:00:00.000000Z",
        "updated_at": "2026-01-30T07:50:00.000000Z"
    }
}
```

---

## 🔍 Error Responses

### 404 Not Found
```json
{
    "message": "Berita tidak ditemukan"
}
```
atau
```json
{
    "message": "Proyek tidak ditemukan"
}
```
atau
```json
{
    "message": "Jurnal tidak ditemukan"
}
```

### 422 Validation Error
```json
{
    "message": "The score must be between 0 and 100.",
    "errors": {
        "score": [
            "The score must be between 0 and 100."
        ]
    }
}
```

---

## 💡 Tips Penggunaan

### 1. **Partial Update**
Anda hanya perlu mengirim field yang ingin diupdate:
```bash
# Hanya update title
curl -X PUT http://localhost:8000/api/news/1 -F "title=Judul Baru"
```

### 2. **File Upload**
- Jika upload file baru, file lama akan **otomatis dihapus**
- Tidak perlu menghapus file lama secara manual

### 3. **JavaScript FormData**
```javascript
const formData = new FormData();
formData.append('title', 'Judul Update');
formData.append('category', 'Kategori Baru');

// Tambahkan file jika ada
const fileInput = document.getElementById('imageFile');
if (fileInput.files[0]) {
    formData.append('main_image', fileInput.files[0]);
}

fetch('http://localhost:8000/api/news/1', {
    method: 'PUT',
    body: formData,
    headers: {
        'Accept': 'application/json'
    }
})
.then(r => r.json())
.then(data => console.log(data));
```

### 4. **Postman**
- Method: `PUT`
- URL: `http://localhost:8000/api/news/1`
- Body → form-data
- Tambahkan field yang ingin diupdate

---

## 🚀 Fitur Update

| Feature | News | Projects | Journals |
|---------|------|----------|----------|
| Partial Update | ✅ Yes | ✅ Yes | ✅ Yes |
| Auto Delete Old Files | ✅ Yes | ✅ Yes | ✅ Yes |
| Validation | ✅ Yes | ✅ Yes | ✅ Yes |
| 404 Handling | ✅ Yes | ✅ Yes | ✅ Yes |

---

## 📋 Summary Routes

| Method | Endpoint | Description |
|--------|----------|-------------|
| PUT | /api/news/{id} | Update berita |
| PUT | /api/projects/{id} | Update proyek |
| PUT | /api/journals/{id} | Update jurnal |

---

**Happy Coding! 🚀**
