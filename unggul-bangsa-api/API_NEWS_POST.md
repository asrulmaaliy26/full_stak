# API Documentation - News POST Endpoint

## Endpoint
```
POST /news
```

## Headers
```
Content-Type: multipart/form-data
```

## Request Body (Form Data)

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| title | string | Yes | Judul berita |
| excerpt | string | Yes | Ringkasan berita |
| content | string | Yes | Konten lengkap berita |
| date | date | Yes | Tanggal berita (format: YYYY-MM-DD) |
| category | string | Yes | Kategori berita |
| jenjang | string | Yes | Jenjang pendidikan (KAMPUS/MA/SMPT/MI/UMUM) |
| main_image | file | Yes | Gambar utama (max 2MB) |
| gallery[] | file | No | Array gambar gallery (max 2MB per file) |

## Example Request (cURL)

```bash
curl -X POST http://localhost:8000/news \
  -F "title=Siswa MA Juara Olimpiade" \
  -F "excerpt=Prestasi membanggakan..." \
  -F "content=Siswa Madrasah Aliyah berhasil meraih juara..." \
  -F "date=2024-05-24" \
  -F "category=Prestasi" \
  -F "jenjang=MA" \
  -F "main_image=@/path/to/image.jpg" \
  -F "gallery[]=@/path/to/gallery1.jpg" \
  -F "gallery[]=@/path/to/gallery2.jpg"
```

## Example Request (Postman)

1. Method: **POST**
2. URL: `http://localhost:8000/news`
3. Body: **form-data**
4. Add fields:
   - title: `Siswa MA Juara Olimpiade`
   - excerpt: `Prestasi membanggakan...`
   - content: `Siswa Madrasah Aliyah berhasil meraih juara...`
   - date: `2024-05-24`
   - category: `Prestasi`
   - jenjang: `MA`
   - main_image: [Select File]
   - gallery[]: [Select File] (dapat multiple)

## Success Response (201 Created)

```json
{
  "message": "Berita berhasil ditambahkan",
  "data": {
    "id": 1,
    "title": "Siswa MA Juara Olimpiade",
    "excerpt": "Prestasi membanggakan...",
    "content": "Siswa Madrasah Aliyah berhasil meraih juara...",
    "date": "2024-05-24",
    "views": 0,
    "category": "Prestasi",
    "jenjang": "MA",
    "main_image": "http://localhost:8000/storage/news/main/1234567890_image.jpg",
    "gallery": [
      "http://localhost:8000/storage/news/gallery/1234567891_gallery1.jpg",
      "http://localhost:8000/storage/news/gallery/1234567892_gallery2.jpg"
    ],
    "created_at": "2024-05-24T10:00:00.000000Z",
    "updated_at": "2024-05-24T10:00:00.000000Z"
  }
}
```

## Error Response (422 Validation Error)

```json
{
  "message": "The given data was invalid.",
  "errors": {
    "title": ["The title field is required."],
    "main_image": ["The main image must be an image."]
  }
}
```

## Notes

1. **Image Storage**: Images are stored in `storage/app/public/news/`
   - Main image: `news/main/`
   - Gallery: `news/gallery/`

2. **Full URL**: The API automatically converts file paths to full URLs
   - Example: `news/main/image.jpg` → `http://localhost:8000/storage/news/main/image.jpg`

3. **Gallery**: Gallery field is optional and accepts multiple images

4. **File Size**: Maximum file size is 2MB per image

5. **CSRF**: If you get CSRF error, you may need to disable CSRF for this route or include CSRF token
