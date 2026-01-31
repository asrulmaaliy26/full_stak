# 📁 API POST Projects - Documentation

## Endpoint
```
POST http://localhost:8000/api/projects
```

## Headers
```
Content-Type: multipart/form-data
Accept: application/json
```

## Request Body (Form Data)

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| title | string | ✅ Yes | Judul proyek |
| category | string | ✅ Yes | Kategori proyek |
| description | string | ✅ Yes | Deskripsi lengkap proyek |
| author | string | ✅ Yes | Nama penulis/author |
| date | date | ✅ Yes | Tanggal proyek (format: YYYY-MM-DD) |
| jenjang | string | ✅ Yes | Jenjang pendidikan (tk/mi/smp/ma/stai) |
| imageUrl | file | ✅ Yes | Gambar proyek (max 2MB) |
| documents[] | file[] | ❌ No | Array dokumen pendukung (max 5MB per file) |
| document_types[] | string[] | ❌ No | Array tipe dokumen (proposal/report/presentation/data/document/other) |
| document_titles[] | string[] | ❌ No | Array judul dokumen |

**Note**: Jika mengirim `documents[]`, disarankan untuk juga mengirim `document_types[]` dan `document_titles[]` dengan index yang sama.

---

## 🔥 Contoh Penggunaan

### 1. cURL (Command Line)

#### Tanpa Dokumen
```bash
curl -X POST http://localhost:8000/api/projects \
  -F "title=Penelitian Energi Terbarukan" \
  -F "category=Penelitian" \
  -F "description=Penelitian tentang pengembangan energi terbarukan dari limbah organik untuk mendukung program kampus hijau" \
  -F "author=Dr. Ahmad Fauzi, M.Pd" \
  -F "date=2026-01-30" \
  -F "jenjang=stai" \
  -F "imageUrl=@C:/path/to/project-image.jpg"
```

#### Dengan Dokumen (dengan Metadata)
```bash
curl -X POST http://localhost:8000/api/projects \
  -F "title=Pengabdian Masyarakat Desa Sukamaju" \
  -F "category=Pengabdian Masyarakat" \
  -F "description=Program pengabdian masyarakat untuk meningkatkan literasi digital di Desa Sukamaju" \
  -F "author=Tim Pengabdian STAI Al-Hidayah" \
  -F "date=2026-01-28" \
  -F "jenjang=stai" \
  -F "imageUrl=@C:/path/to/image.jpg" \
  -F "documents[]=@C:/path/to/proposal.pdf" \
  -F "documents[]=@C:/path/to/laporan.pdf" \
  -F "documents[]=@C:/path/to/dokumentasi.pptx" \
  -F "document_types[]=proposal" \
  -F "document_types[]=report" \
  -F "document_types[]=presentation" \
  -F "document_titles[]=Proposal Pengabdian Masyarakat" \
  -F "document_titles[]=Laporan Akhir Kegiatan" \
  -F "document_titles[]=Dokumentasi Kegiatan"
```

---

### 2. JavaScript (Fetch API)

```javascript
const formData = new FormData();
formData.append('title', 'Inovasi Pembelajaran Digital');
formData.append('category', 'Inovasi');
formData.append('description', 'Pengembangan platform pembelajaran digital interaktif untuk meningkatkan engagement siswa');
formData.append('author', 'Drs. Bambang Sutrisno, M.Kom');
formData.append('date', '2026-01-30');
formData.append('jenjang', 'ma');

// Upload image
const imageInput = document.querySelector('#imageUrl');
formData.append('imageUrl', imageInput.files[0]);

// Upload documents (optional)
const documentsInput = document.querySelector('#documents');
for (let i = 0; i < documentsInput.files.length; i++) {
    formData.append('documents[]', documentsInput.files[i]);
}

// Send request
fetch('http://localhost:8000/api/projects', {
    method: 'POST',
    body: formData,
    headers: {
        'Accept': 'application/json'
    }
})
.then(response => response.json())
.then(data => {
    console.log('Success:', data);
    alert('Proyek berhasil ditambahkan!');
})
.catch(error => {
    console.error('Error:', error);
    alert('Gagal menambahkan proyek');
});
```

---

### 3. Python (Requests)

```python
import requests

# Data proyek
data = {
    'title': 'Karya Ilmiah: Metode Pembelajaran Aktif',
    'category': 'Karya Ilmiah',
    'description': 'Penelitian tentang efektivitas metode pembelajaran aktif dalam meningkatkan prestasi siswa',
    'author': 'Dr. Siti Nurhaliza, M.Pd',
    'date': '2026-01-30',
    'jenjang': 'smp'
}

# Files
files = {
    'imageUrl': ('project.jpg', open('project-image.jpg', 'rb'), 'image/jpeg'),
    'documents[]': [
        ('paper.pdf', open('paper.pdf', 'rb'), 'application/pdf'),
        ('data.xlsx', open('data.xlsx', 'rb'), 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
    ]
}

# Send request
response = requests.post(
    'http://localhost:8000/api/projects',
    data=data,
    files=files,
    headers={'Accept': 'application/json'}
)

print(response.json())
```

---

### 4. PHP (Guzzle)

```php
<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();

$response = $client->post('http://localhost:8000/api/projects', [
    'multipart' => [
        [
            'name' => 'title',
            'contents' => 'Kompetisi Robotika Nasional'
        ],
        [
            'name' => 'category',
            'contents' => 'Kompetisi'
        ],
        [
            'name' => 'description',
            'contents' => 'Tim robotika SMP Al-Hidayah meraih juara 1 dalam kompetisi robotika tingkat nasional'
        ],
        [
            'name' => 'author',
            'contents' => 'Tim Robotika SMP Al-Hidayah'
        ],
        [
            'name' => 'date',
            'contents' => '2026-01-25'
        ],
        [
            'name' => 'jenjang',
            'contents' => 'smp'
        ],
        [
            'name' => 'imageUrl',
            'contents' => fopen('robot.jpg', 'r'),
            'filename' => 'robot.jpg'
        ],
        [
            'name' => 'documents[]',
            'contents' => fopen('sertifikat.pdf', 'r'),
            'filename' => 'sertifikat.pdf'
        ]
    ]
]);

$result = json_decode($response->getBody(), true);
print_r($result);
```

---

## 📋 Response Examples

### Success Response (201 Created)

```json
{
    "message": "Proyek berhasil ditambahkan",
    "data": {
        "id": 1,
        "title": "Penelitian Energi Terbarukan",
        "category": "Penelitian",
        "description": "Penelitian tentang pengembangan energi terbarukan...",
        "author": "Dr. Ahmad Fauzi, M.Pd",
        "date": "2026-01-30",
        "jenjang": "stai",
        "imageUrl": "http://localhost:8000/storage/projects/images/abc123.jpg",
        "documents": [
            {
                "url": "http://localhost:8000/storage/projects/documents/proposal.pdf",
                "type": "proposal",
                "title": "Proposal Penelitian Energi Terbarukan",
                "format": "pdf"
            },
            {
                "url": "http://localhost:8000/storage/projects/documents/laporan.pdf",
                "type": "report",
                "title": "Laporan Akhir Penelitian",
                "format": "pdf"
            },
            {
                "url": "http://localhost:8000/storage/projects/documents/presentasi.pptx",
                "type": "presentation",
                "title": "Presentasi Hasil Penelitian",
                "format": "pptx"
            }
        ],
        "created_at": "2026-01-30T06:55:00.000000Z",
        "updated_at": "2026-01-30T06:55:00.000000Z"
    }
}
```

### Error Response (422 Validation Error)

```json
{
    "message": "The title field is required. (and 3 more errors)",
    "errors": {
        "title": [
            "The title field is required."
        ],
        "category": [
            "The category field is required."
        ],
        "imageUrl": [
            "The imageUrl field is required."
        ],
        "date": [
            "The date field is required."
        ]
    }
}
```

### Error Response (File Too Large)

```json
{
    "message": "The imageUrl must not be greater than 2048 kilobytes.",
    "errors": {
        "imageUrl": [
            "The imageUrl must not be greater than 2048 kilobytes."
        ]
    }
}
```

---

## 📝 Validation Rules

| Field | Rules |
|-------|-------|
| title | required, string |
| category | required, string |
| description | required, string |
| author | required, string |
| date | required, date format (YYYY-MM-DD) |
| jenjang | required, string (tk/mi/smp/ma/stai) |
| imageUrl | required, image file, max 2MB |
| documents.* | optional, file (pdf,doc,docx,xls,xlsx,ppt,pptx), max 5MB per file |

---

## 🎯 Kategori Proyek yang Tersedia

- Penelitian
- Pengabdian Masyarakat
- Karya Ilmiah
- Inovasi
- Kompetisi
- Lainnya

---

## 📂 File Storage Structure

```
storage/
└── app/
    └── public/
        └── projects/
            ├── images/          # Gambar proyek
            │   └── abc123.jpg
            └── documents/       # Dokumen pendukung
                ├── proposal.pdf
                ├── laporan.pdf
                └── presentasi.pptx
```

---

## 🧪 Testing

### Menggunakan HTML Form
```bash
# Buka file test-api-projects.html di browser
start test-api-projects.html
```

### Menggunakan Postman
1. Method: `POST`
2. URL: `http://localhost:8000/api/projects`
3. Body → form-data:
   - title: "Test Project"
   - category: "Penelitian"
   - description: "Test description"
   - author: "Test Author"
   - date: "2026-01-30"
   - jenjang: "stai"
   - imageUrl: (File)
   - documents[]: (File) - Optional, multiple files

---

## 💡 Tips

1. **Ukuran File**: 
   - Image max 2MB
   - Documents max 5MB per file
   
2. **Format Dokumen yang Didukung**:
   - PDF (.pdf)
   - Word (.doc, .docx)
   - Excel (.xls, .xlsx)
   - PowerPoint (.ppt, .pptx)

3. **Multiple Documents**:
   - Gunakan key `documents[]` untuk upload multiple files
   - Bisa upload sampai beberapa dokumen sekaligus

4. **Storage Link**:
   - Pastikan sudah menjalankan: `php artisan storage:link`
   - URL akan otomatis di-generate dengan full path

---

## 🔍 Troubleshooting

### Error: "The imageUrl must be an image"
**Solusi**: Pastikan file yang diupload adalah gambar (jpg, png, gif, svg, webp)

### Error: "The documents.0 must be a file of type: pdf, doc, docx..."
**Solusi**: Pastikan dokumen yang diupload memiliki format yang didukung

### Error: "The imageUrl must not be greater than 2048 kilobytes"
**Solusi**: Compress gambar atau gunakan gambar dengan ukuran lebih kecil

### Error: "Storage path not found"
**Solusi**: 
```bash
php artisan storage:link
```

---

## 🚀 Next Steps

Setelah API berfungsi:
1. ✅ Implementasi UPDATE dan DELETE
2. ✅ Tambahkan pagination
3. ✅ Implementasi search & filter
4. ✅ Tambahkan authentication
5. ✅ Optimize file upload (compression, validation)

---

**Happy Coding! 🚀**
