<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->get();
        return response()->json(['data' => $news]);
    }

    public function show($id)
    {
        $item = News::find($id);

        if (!$item) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(['data' => $item]);
    }

    public function limit($count, $jenjang = null)
    {
        $query = News::orderBy('created_at', 'desc');

        // Jika ada parameter jenjang, filter dulu
        if ($jenjang) {
            $query->where('jenjang', $jenjang);
        }

        $news = $query->limit($count)->get();
        return response()->json(['data' => $news]);
    }

    public function getByCategory($category)
    {
        $news = News::where('category', $category)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['data' => $news]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'date' => 'required|date',
            'category' => 'required|string',
            'level' => 'nullable|string',
            'jenjang' => 'required|string',
            'main_image' => 'required|image|max:2048',
            'gallery.*' => 'nullable|image|max:2048',
        ]);

        /** ======================
         * Upload MAIN IMAGE
         * ====================== */
        $mainImagePath = $request->file('main_image')
            ->store('news/main', 'public');

        /** ======================
         * Upload GALLERY (optional)
         * ====================== */
        $galleryPaths = [];

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $galleryPaths[] = $image->store('news/gallery', 'public');
            }
        }

        /** ======================
         * Simpan ke DB dengan FULL URL
         * ====================== */
        $news = News::create([
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'content' => $request->input('content'),
            'date' => $request->date,
            'views' => 0,
            'category' => $request->category,
            'level' => $request->input('level'),
            'jenjang' => $request->jenjang,
            'main_image' => url('storage/' . $mainImagePath),
            'gallery' => collect($galleryPaths)->map(fn ($p) => url('storage/' . $p))->toArray(),
        ]);

        return response()->json([
            'message' => 'Berita berhasil ditambahkan',
            'data' => $news,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $news = News::find($id);

        if (!$news) {
            return response()->json(['message' => 'Berita tidak ditemukan'], 404);
        }

        $request->validate([
            'title' => 'nullable|string',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'date' => 'nullable|date',
            'category' => 'nullable|string',
            'level' => 'nullable|string',
            'jenjang' => 'nullable|string',
            'main_image' => 'nullable|image|max:2048',
            'gallery.*' => 'nullable|image|max:2048',
        ]);

        // Update main image if provided
        if ($request->hasFile('main_image')) {
            // Delete old image
            $oldPath = str_replace(url('storage/'), '', $news->main_image);
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }

            $mainImagePath = $request->file('main_image')->store('news/main', 'public');
            $news->main_image = url('storage/' . $mainImagePath);
        }

        // Update gallery if provided (APPEND new images)
        if ($request->hasFile('gallery')) {
            $galleryPaths = [];
            foreach ($request->file('gallery') as $image) {
                $galleryPaths[] = $image->store('news/gallery', 'public');
            }
            
            // Convert to URLs
            $newGalleryUrls = collect($galleryPaths)->map(fn ($p) => url('storage/' . $p))->toArray();
            
            // Merge with existing gallery
            $currentGallery = $news->gallery ?? [];
            $news->gallery = array_merge($currentGallery, $newGalleryUrls);
        }

        // Update other fields
        if ($request->has('title')) $news->title = $request->title;
        if ($request->has('excerpt')) $news->excerpt = $request->excerpt;
        if ($request->has('content')) $news->content = $request->input('content');
        if ($request->filled('date')) $news->date = $request->date;
        if ($request->has('category')) $news->category = $request->category;
        if ($request->has('level')) $news->level = $request->input('level');
        if ($request->has('jenjang')) $news->jenjang = $request->jenjang;

        $news->save();

        return response()->json([
            'message' => 'Berita berhasil diupdate',
            'data' => $news,
        ], 200);
    }

    public function deleteGalleryImage(Request $request, $id)
    {
        $request->validate([
            'image_url' => 'required|string'
        ]);

        $news = News::find($id);

        if (!$news) {
            return response()->json(['message' => 'Berita tidak ditemukan'], 404);
        }

        $gallery = $news->gallery ?? [];
        $targetUrl = $request->image_url;
        
        // Cek apakah image ada di gallery
        if (!in_array($targetUrl, $gallery)) {
            return response()->json(['message' => 'Gambar tidak ditemukan di gallery'], 404);
        }

        // Hapus dari array (filter out the matching URL)
        $updatedGallery = array_values(array_filter($gallery, fn($url) => $url !== $targetUrl));
        $news->gallery = $updatedGallery;
        $news->save();

        // Hapus file fisik
        $path = str_replace(url('storage/'), '', $targetUrl);
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }

        return response()->json([
            'message' => 'Gambar berhasil dihapus dari gallery',
            'data' => $news->gallery
        ], 200);
    }

    public function destroy($id)
    {
        $news = News::find($id);

        if (!$news) {
            return response()->json(['message' => 'Berita tidak ditemukan'], 404);
        }

        // Delete main image
        if ($news->main_image) {
            $path = str_replace(url('storage/'), '', $news->main_image);
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }

        // Delete gallery images
        if ($news->gallery) {
            foreach ($news->gallery as $imageUrl) {
                $path = str_replace(url('storage/'), '', $imageUrl);
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
        }

        $news->delete();

        return response()->json([
            'message' => 'Berita berhasil dihapus'
        ], 200);
    }
    public function incrementViews($id)
    {
        \Illuminate\Support\Facades\Log::info("Incrementing views for news ID: $id");
        $news = News::find($id);

        if (!$news) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $news->increment('views');
        
        \Illuminate\Support\Facades\Log::info("New views: " . $news->views);

        return response()->json(['message' => 'Views incremented', 'views' => $news->views]);
    }
}
