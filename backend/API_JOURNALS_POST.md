# 📚 API POST Journals - Documentation

## Endpoint
```
POST http://localhost:8000/api/journals
```

## Headers
```
Content-Type: multipart/form-data
Accept: application/json
```

## Request Body (Form Data)

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| title | string | ✅ Yes | Judul jurnal (max 255 karakter) |
| category | string | ✅ Yes | Kategori jurnal (max 255 karakter) |
| abstract | string | ✅ Yes | Abstrak atau ringkasan jurnal |
| author | string | ✅ Yes | Nama penulis/mahasiswa (max 255 karakter) |
| mentor | string | ✅ Yes | Nama pembimbing/mentor (max 255 karakter) |
| score | integer | ✅ Yes | Nilai jurnal (0-100) |
| date | date | ✅ Yes | Tanggal jurnal (format: YYYY-MM-DD) |
| is_best | boolean | ❌ No | Apakah jurnal terbaik (default: false) |
| jenjang | string | ✅ Yes | Jenjang pendidikan (tk/mi/smp/ma/stai) |
| documentUrl | file | ❌ No | File PDF dokumen jurnal (max 10MB) |

---

## 🔥 Contoh Penggunaan

### 1. cURL (Command Line)

#### Jurnal Biasa
```bash
curl -X POST http://localhost:8000/api/journals \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "title": "Pengaruh Teknologi AI dalam Pendidikan",
    "category": "Pendidikan",
    "abstract": "Penelitian ini membahas dampak penggunaan AI dalam meningkatkan kualitas pembelajaran di era digital",
    "author": "Siti Nurhaliza",
    "mentor": "Dr. Ahmad Fauzi, M.Pd",
    "score": 95,
    "date": "2026-01-30",
    "is_best": false,
    "jenjang": "stai"
  }'
```

#### Jurnal Terbaik
```bash
curl -X POST http://localhost:8000/api/journals \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "title": "Zakat & Ekonomi Digital",
    "category": "Ekonomi Syariah",
    "abstract": "Studi efisiensi pengelolaan zakat via aplikasi",
    "author": "Ahmad Mahasiswa",
    "mentor": "Dr. Zainal",
    "score": 98,
    "date": "2024-06-01",
    "is_best": true,
    "jenjang": "stai"
  }'
```

---

### 2. JavaScript (Fetch API)

```javascript
const journalData = {
    title: "Implementasi IoT dalam Smart Farming",
    category: "Teknologi",
    abstract: "Penelitian tentang penerapan Internet of Things untuk meningkatkan produktivitas pertanian modern",
    author: "Budi Santoso",
    mentor: "Prof. Dr. Ir. Hadi Wijaya",
    score: 92,
    date: "2026-01-30",
    is_best: false,
    jenjang: "stai"
};

fetch('http://localhost:8000/api/journals', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    },
    body: JSON.stringify(journalData)
})
.then(response => response.json())
.then(data => {
    console.log('Success:', data);
    alert('Jurnal berhasil ditambahkan!');
})
.catch(error => {
    console.error('Error:', error);
    alert('Gagal menambahkan jurnal');
});
```

---

### 3. JavaScript (Axios)

```javascript
import axios from 'axios';

async function createJournal() {
    try {
        const response = await axios.post('http://localhost:8000/api/journals', {
            title: 'Metode Pembelajaran Aktif di Era Digital',
            category: 'Pendidikan',
            abstract: 'Studi komparatif efektivitas metode pembelajaran aktif dengan metode konvensional',
            author: 'Dewi Lestari',
            mentor: 'Dr. Siti Aminah, M.Pd',
            score: 90,
            date: '2026-01-30',
            is_best: true,
            jenjang: 'ma'
        }, {
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        });
        
        console.log('Jurnal berhasil dibuat:', response.data);
        return response.data;
    } catch (error) {
        console.error('Error:', error.response?.data || error.message);
        throw error;
    }
}

createJournal();
```

---

### 4. Python (Requests)

```python
import requests
import json
from datetime import date

# Data jurnal
journal_data = {
    'title': 'Dampak Media Sosial terhadap Kesehatan Mental Remaja',
    'category': 'Sosial',
    'abstract': 'Penelitian kuantitatif tentang hubungan penggunaan media sosial dengan tingkat kecemasan remaja',
    'author': 'Rina Kartika',
    'mentor': 'Dr. Psikologi Hendra, M.Psi',
    'score': 88,
    'date': str(date.today()),
    'is_best': False,
    'jenjang': 'smp'
}

# Send request
response = requests.post(
    'http://localhost:8000/api/journals',
    json=journal_data,
    headers={
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    }
)

print(response.json())
```

---

### 5. PHP (Guzzle)

```php
<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();

$journalData = [
    'title' => 'Inovasi Energi Terbarukan di Indonesia',
    'category' => 'Sains',
    'abstract' => 'Analisis potensi dan implementasi energi terbarukan sebagai solusi krisis energi',
    'author' => 'Andi Pratama',
    'mentor' => 'Dr. Ir. Bambang Suryanto',
    'score' => 94,
    'date' => date('Y-m-d'),
    'is_best' => true,
    'jenjang' => 'stai'
];

try {
    $response = $client->post('http://localhost:8000/api/journals', [
        'json' => $journalData,
        'headers' => [
            'Accept' => 'application/json'
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

## 📋 Response Examples

### Success Response (201 Created)

```json
{
    "message": "Jurnal berhasil ditambahkan",
    "data": {
        "id": 1,
        "title": "Zakat & Ekonomi Digital",
        "category": "Ekonomi Syariah",
        "abstract": "Studi efisiensi pengelolaan zakat via aplikasi",
        "author": "Ahmad Mahasiswa",
        "mentor": "Dr. Zainal",
        "score": 98,
        "date": "2024-06-01T00:00:00.000000Z",
        "is_best": true,
        "jenjang": "stai",
        "documentUrl": "http://localhost:8000/storage/journals/documents/jurnal-zakat-ekonomi-digital.pdf",
        "created_at": "2026-01-30T07:34:00.000000Z",
        "updated_at": "2026-01-30T07:34:00.000000Z"
    }
}
```

### Error Response (422 Validation Error)

```json
{
    "message": "The title field is required. (and 4 more errors)",
    "errors": {
        "title": [
            "The title field is required."
        ],
        "category": [
            "The category field is required."
        ],
        "author": [
            "The author field is required."
        ],
        "mentor": [
            "The mentor field is required."
        ],
        "score": [
            "The score field is required."
        ]
    }
}
```

### Error Response (Score Validation)

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

## 📝 Validation Rules

| Field | Rules |
|-------|-------|
| title | required, string, max 255 characters |
| category | required, string, max 255 characters |
| abstract | required, string |
| author | required, string, max 255 characters |
| mentor | required, string, max 255 characters |
| score | required, integer, min 0, max 100 |
| date | required, date format (YYYY-MM-DD) |
| is_best | optional, boolean (true/false or 1/0) |
| jenjang | required, string (tk/mi/smp/ma/stai) |
| documentUrl | optional, file (PDF only), max 10MB |

---

## 🎯 Kategori Jurnal yang Umum

- Ekonomi Syariah
- Pendidikan
- Teknologi
- Sosial
- Kesehatan
- Sains
- Lainnya

---

## 🧪 Testing

### Menggunakan HTML Form
```bash
# Buka file test-api-journals.html di browser
start test-api-journals.html
```

### Menggunakan Postman
1. Method: `POST`
2. URL: `http://localhost:8000/api/journals`
3. Headers:
   - `Content-Type`: `application/json`
   - `Accept`: `application/json`
4. Body → raw (JSON):
```json
{
    "title": "Test Jurnal",
    "category": "Pendidikan",
    "abstract": "Abstrak test",
    "author": "Test Author",
    "mentor": "Test Mentor",
    "score": 85,
    "date": "2026-01-30",
    "is_best": false,
    "jenjang": "stai"
}
```

---

## 💡 Tips

1. **Score Range**: Nilai harus antara 0-100
2. **Is Best**: 
   - Kirim `true` atau `1` untuk jurnal terbaik
   - Kirim `false` atau `0` untuk jurnal biasa
   - Jika tidak dikirim, default adalah `false`
3. **Date Format**: Gunakan format `YYYY-MM-DD` (contoh: `2026-01-30`)
4. **Jenjang**: Harus salah satu dari: `tk`, `mi`, `smp`, `ma`, `stai`

---

## 🔍 Troubleshooting

### Error: "The score must be between 0 and 100"
**Solusi**: Pastikan nilai score antara 0-100

### Error: "The title must not be greater than 255 characters"
**Solusi**: Batasi judul maksimal 255 karakter

### Error: "The date is not a valid date"
**Solusi**: Gunakan format tanggal yang benar (YYYY-MM-DD)

### Error: "The is_best field must be true or false"
**Solusi**: Kirim boolean `true`/`false` atau integer `1`/`0`

---

## 📊 Contoh Data Lengkap

```json
{
    "title": "Zakat & Ekonomi Digital",
    "category": "Ekonomi Syariah",
    "abstract": "Studi efisiensi pengelolaan zakat via aplikasi. Penelitian ini menganalisis bagaimana teknologi digital dapat meningkatkan transparansi dan efisiensi dalam pengelolaan zakat di Indonesia.",
    "author": "Ahmad Mahasiswa",
    "mentor": "Dr. Zainal",
    "score": 98,
    "date": "2024-06-01",
    "is_best": true,
    "jenjang": "stai"
}
```

---

## 🚀 Next Steps

Setelah API berfungsi:
1. ✅ Implementasi UPDATE dan DELETE
2. ✅ Tambahkan pagination
3. ✅ Filter berdasarkan is_best
4. ✅ Filter berdasarkan jenjang
5. ✅ Sorting berdasarkan score
6. ✅ Search berdasarkan title/author

---

**Happy Coding! 🚀**
