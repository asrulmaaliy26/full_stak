# 📚 Contoh Penggunaan API POST News

## Endpoint
```
POST http://localhost:8000/api/news
```

## Headers
```
Content-Type: multipart/form-data
Accept: application/json
```

## Request Body (Form Data)

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| title | string | ✅ Yes | Judul berita |
| excerpt | string | ✅ Yes | Ringkasan berita |
| content | string | ✅ Yes | Konten lengkap berita |
| date | date | ✅ Yes | Tanggal berita (format: YYYY-MM-DD) |
| category | string | ✅ Yes | Kategori berita |
| level | string | ❌ No | Tingkat prestasi (Nasional, Regional, dll) - Opsional |
| jenjang | string | ✅ Yes | Jenjang pendidikan (tk/mi/smp/ma/stai) |
| main_image | file | ✅ Yes | Gambar utama (max 2MB) |
| gallery[] | file[] | ❌ No | Array gambar galeri (max 2MB per file) |

---

## 🔥 Contoh 1: Menggunakan cURL (Command Line)

### Tanpa Gallery
```bash
curl -X POST http://localhost:8000/api/news \
  -F "title=Prestasi Siswa MI Al-Hidayah di Olimpiade Matematika" \
  -F "excerpt=Siswa MI Al-Hidayah berhasil meraih medali emas dalam Olimpiade Matematika tingkat nasional" \
  -F "content=Pada tanggal 25 Januari 2026, siswa kelas 6 MI Al-Hidayah atas nama Ahmad Fauzi berhasil meraih medali emas dalam Olimpiade Matematika Nasional yang diselenggarakan di Jakarta. Prestasi ini merupakan yang pertama kali diraih oleh sekolah kami." \
  -F "date=2026-01-25" \
  -F "category=Prestasi" \
  -F "level=Nasional" \
  -F "jenjang=mi" \
  -F "main_image=@C:/path/to/your/image.jpg"
```

### Dengan Gallery (Multiple Images)
```bash
curl -X POST http://localhost:8000/api/news \
  -F "title=Kegiatan Outbound Siswa SMP" \
  -F "excerpt=Siswa SMP mengikuti kegiatan outbound untuk meningkatkan kerjasama tim" \
  -F "content=Kegiatan outbound dilaksanakan di Taman Wisata Alam dengan berbagai permainan edukatif yang melatih kerjasama, kepemimpinan, dan problem solving." \
  -F "date=2026-01-28" \
  -F "category=Kegiatan" \
  -F "jenjang=smp" \
  -F "main_image=@C:/path/to/main-image.jpg" \
  -F "gallery[]=@C:/path/to/gallery1.jpg" \
  -F "gallery[]=@C:/path/to/gallery2.jpg" \
  -F "gallery[]=@C:/path/to/gallery3.jpg"
```

---

## 🌐 Contoh 2: Menggunakan JavaScript (Fetch API)

```javascript
// Persiapkan FormData
const formData = new FormData();
formData.append('title', 'Wisuda Santri MA Al-Hidayah Angkatan 2026');
formData.append('excerpt', 'Sebanyak 150 santri MA Al-Hidayah diwisuda pada acara wisuda akbar');
formData.append('content', 'Acara wisuda dihadiri oleh para wali santri, pengurus yayasan, dan tamu undangan. Wisuda ini menandai kelulusan santri yang telah menyelesaikan pendidikan selama 3 tahun.');
formData.append('date', '2026-01-30');
formData.append('category', 'Wisuda');
formData.append('jenjang', 'ma');

// Upload main image
const mainImageInput = document.querySelector('#main_image');
formData.append('main_image', mainImageInput.files[0]);

// Upload gallery (optional)
const galleryInput = document.querySelector('#gallery');
for (let i = 0; i < galleryInput.files.length; i++) {
    formData.append('gallery[]', galleryInput.files[i]);
}

// Kirim request
fetch('http://localhost:8000/api/news', {
    method: 'POST',
    body: formData,
    headers: {
        'Accept': 'application/json'
    }
})
.then(response => response.json())
.then(data => {
    console.log('Success:', data);
    alert('Berita berhasil ditambahkan!');
})
.catch(error => {
    console.error('Error:', error);
    alert('Gagal menambahkan berita');
});
```

---

## 📱 Contoh 3: Menggunakan Axios (JavaScript)

```javascript
import axios from 'axios';

async function createNews() {
    const formData = new FormData();
    
    // Data berita
    formData.append('title', 'Penerimaan Siswa Baru TK Al-Hidayah 2026');
    formData.append('excerpt', 'Pendaftaran siswa baru TK Al-Hidayah tahun ajaran 2026/2027 telah dibuka');
    formData.append('content', 'Yayasan Al-Hidayah membuka pendaftaran siswa baru untuk TK dengan kuota 60 siswa. Pendaftaran dibuka mulai 1 Februari hingga 31 Maret 2026.');
    formData.append('date', '2026-01-30');
    formData.append('category', 'Pengumuman');
    formData.append('jenjang', 'tk');
    
    // Upload file
    const mainImage = document.querySelector('#main_image').files[0];
    formData.append('main_image', mainImage);
    
    try {
        const response = await axios.post('http://localhost:8000/api/news', formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
                'Accept': 'application/json'
            }
        });
        
        console.log('Berita berhasil dibuat:', response.data);
        return response.data;
    } catch (error) {
        console.error('Error:', error.response?.data || error.message);
        throw error;
    }
}

// Panggil fungsi
createNews();
```

---

## 🐘 Contoh 4: Menggunakan PHP (Guzzle)

```php
<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();

try {
    $response = $client->post('http://localhost:8000/api/news', [
        'multipart' => [
            [
                'name' => 'title',
                'contents' => 'Seminar Pendidikan Karakter di STAI Al-Hidayah'
            ],
            [
                'name' => 'excerpt',
                'contents' => 'STAI Al-Hidayah mengadakan seminar pendidikan karakter dengan narasumber Prof. Dr. Ahmad'
            ],
            [
                'name' => 'content',
                'contents' => 'Seminar dihadiri oleh 200 mahasiswa dan dosen. Tema yang diangkat adalah "Membangun Karakter Generasi Muda di Era Digital".'
            ],
            [
                'name' => 'date',
                'contents' => '2026-01-29'
            ],
            [
                'name' => 'category',
                'contents' => 'Seminar'
            ],
            [
                'name' => 'jenjang',
                'contents' => 'stai'
            ],
            [
                'name' => 'main_image',
                'contents' => fopen('C:/path/to/image.jpg', 'r'),
                'filename' => 'seminar.jpg'
            ],
            // Gallery (optional)
            [
                'name' => 'gallery[]',
                'contents' => fopen('C:/path/to/gallery1.jpg', 'r'),
                'filename' => 'gallery1.jpg'
            ],
            [
                'name' => 'gallery[]',
                'contents' => fopen('C:/path/to/gallery2.jpg', 'r'),
                'filename' => 'gallery2.jpg'
            ]
        ]
    ]);

    $result = json_decode($response->getBody(), true);
    echo "Success: " . $result['message'] . "\n";
    print_r($result['data']);
    
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
```

---

## 🧪 Contoh 5: Menggunakan Postman

### Langkah-langkah:

1. **Buka Postman** dan buat request baru
2. **Set Method**: `POST`
3. **Set URL**: `http://localhost:8000/api/news`
4. **Headers**:
   - Key: `Accept`, Value: `application/json`
5. **Body** → Pilih `form-data`:
   - `title` (Text): "Judul Berita Anda"
   - `excerpt` (Text): "Ringkasan berita"
   - `content` (Text): "Konten lengkap berita"
   - `date` (Text): "2026-01-30"
   - `category` (Text): "Prestasi"
   - `jenjang` (Text): "mi"
   - `main_image` (File): Pilih file gambar
   - `gallery[]` (File): Pilih file gambar (bisa multiple)
6. **Klik Send**

---

## 📋 Contoh Response Sukses

```json
{
    "message": "Berita berhasil ditambahkan",
    "data": {
        "id": 1,
        "title": "Prestasi Siswa MI Al-Hidayah di Olimpiade Matematika",
        "excerpt": "Siswa MI Al-Hidayah berhasil meraih medali emas...",
        "content": "Pada tanggal 25 Januari 2026...",
        "date": "2026-01-25",
        "views": 0,
        "category": "Prestasi",
        "jenjang": "mi",
        "main_image": "http://localhost:8000/storage/news/main/abc123.jpg",
        "gallery": [
            "http://localhost:8000/storage/news/gallery/def456.jpg",
            "http://localhost:8000/storage/news/gallery/ghi789.jpg"
        ],
        "created_at": "2026-01-30T06:38:00.000000Z",
        "updated_at": "2026-01-30T06:38:00.000000Z"
    }
}
```

---

## ❌ Contoh Response Error (Validation Failed)

```json
{
    "message": "The title field is required. (and 2 more errors)",
    "errors": {
        "title": [
            "The title field is required."
        ],
        "date": [
            "The date field is required."
        ],
        "main_image": [
            "The main image field is required."
        ]
    }
}
```

---

## 📝 Catatan Penting

1. **Format Tanggal**: Gunakan format `YYYY-MM-DD` (contoh: `2026-01-30`)
2. **Jenjang Valid**: `tk`, `mi`, `smp`, `ma`, `stai`
3. **Ukuran File**: Maksimal 2MB per gambar
4. **Format Gambar**: jpg, jpeg, png, gif, svg, webp
5. **Gallery**: Opsional, bisa upload multiple images dengan key `gallery[]`
6. **URL Storage**: Gambar akan disimpan dengan full URL otomatis

---

## 🔐 Tips Keamanan (Untuk Production)

Untuk production, tambahkan:
- Authentication (Laravel Sanctum/Passport)
- Rate Limiting
- CSRF Protection (jika dari web)
- Validasi file type lebih ketat
- Compress image sebelum upload

---

## 🚀 Testing Cepat

Gunakan cURL ini untuk testing cepat (ganti path image):

```bash
curl -X POST http://localhost:8000/api/news \
  -F "title=Test Berita" \
  -F "excerpt=Ini excerpt test" \
  -F "content=Ini konten lengkap test berita" \
  -F "date=2026-01-30" \
  -F "category=Test" \
  -F "jenjang=mi" \
  -F "main_image=@C:/path/to/test-image.jpg"
```
