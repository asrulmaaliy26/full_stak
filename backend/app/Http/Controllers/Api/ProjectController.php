<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('created_at', 'desc')->get();
        return response()->json(['data' => $projects]);
    }

    public function show($id)
    {
        $item = Project::find($id);

        if (!$item) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(['data' => $item]);
    }

    public function limit($count)
    {
        $projects = Project::orderBy('created_at', 'desc')
                ->limit($count)
                ->get();
        return response()->json(['data' => $projects]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'category' => 'required|string',
            'description' => 'required|string',
            'author' => 'required|string',
            'date' => 'required|date',
            'jenjang' => 'required|string',
            'imageUrl' => 'required|image|max:2048',
            'documents.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120',
            'document_types.*' => 'nullable|string',
            'document_titles.*' => 'nullable|string',
        ]);

        /** ======================
         * Upload IMAGE
         * ====================== */
        $imagePath = $request->file('imageUrl')
            ->store('projects/images', 'public');

        /** ======================
         * Upload DOCUMENTS (optional)
         * ====================== */
        $documentsData = [];

        if ($request->hasFile('documents')) {
            $documents = $request->file('documents');
            $documentTypes = $request->input('document_types', []);
            $documentTitles = $request->input('document_titles', []);

            foreach ($documents as $index => $document) {
                $path = $document->store('projects/documents', 'public');
                $extension = $document->getClientOriginalExtension();
                $originalName = pathinfo($document->getClientOriginalName(), PATHINFO_FILENAME);

                $documentsData[] = [
                    'url' => url('storage/' . $path),
                    'type' => $documentTypes[$index] ?? 'document',
                    'title' => $documentTitles[$index] ?? $originalName,
                    'format' => strtolower($extension),
                ];
            }
        }

        /** ======================
         * Simpan ke DB dengan FULL URL
         * ====================== */
        $project = Project::create([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'author' => $request->author,
            'date' => $request->date,
            'jenjang' => $request->jenjang,
            'imageUrl' => url('storage/' . $imagePath),
            'documents' => $documentsData,
        ]);

        return response()->json([
            'message' => 'Proyek berhasil ditambahkan',
            'data' => $project,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json(['message' => 'Proyek tidak ditemukan'], 404);
        }

        $request->validate([
            'title' => 'nullable|string',
            'category' => 'nullable|string',
            'description' => 'nullable|string',
            'author' => 'nullable|string',
            'date' => 'nullable|date',
            'jenjang' => 'nullable|string',
            'imageUrl' => 'nullable|image|max:2048',
            'documents.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120',
            'document_types.*' => 'nullable|string',
            'document_titles.*' => 'nullable|string',
        ]);

        // Update image if provided
        if ($request->hasFile('imageUrl')) {
            // Delete old image
            $oldPath = str_replace(url('storage/'), '', $project->imageUrl);
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }

            $imagePath = $request->file('imageUrl')->store('projects/images', 'public');
            $project->imageUrl = url('storage/' . $imagePath);
        }

        // Update documents if provided (APPEND new documents)
        if ($request->hasFile('documents')) {
            $newDocumentsData = [];
            $documents = $request->file('documents');
            $documentTypes = $request->input('document_types', []);
            $documentTitles = $request->input('document_titles', []);

            foreach ($documents as $index => $document) {
                $path = $document->store('projects/documents', 'public');
                $extension = $document->getClientOriginalExtension();
                $originalName = pathinfo($document->getClientOriginalName(), PATHINFO_FILENAME);

                $newDocumentsData[] = [
                    'url' => url('storage/' . $path),
                    'type' => $documentTypes[$index] ?? 'document',
                    'title' => $documentTitles[$index] ?? $originalName,
                    'format' => strtolower($extension),
                ];
            }
            
            // Merge with existing documents
            $currentDocuments = $project->documents ?? [];
            $project->documents = array_merge($currentDocuments, $newDocumentsData);
        }

        // Update other fields
        if ($request->has('title')) $project->title = $request->title;
        if ($request->has('category')) $project->category = $request->category;
        if ($request->has('description')) $project->description = $request->description;
        if ($request->has('author')) $project->author = $request->author;
        if ($request->filled('date')) $project->date = $request->date;
        if ($request->has('jenjang')) $project->jenjang = $request->jenjang;

        $project->save();

        return response()->json([
            'message' => 'Proyek berhasil diupdate',
            'data' => $project,
        ], 200);
    }

    public function deleteDocument(Request $request, $id)
    {
        $request->validate([
            'document_url' => 'required|string'
        ]);

        $project = Project::find($id);

        if (!$project) {
            return response()->json(['message' => 'Proyek tidak ditemukan'], 404);
        }

        $documents = $project->documents ?? [];
        $targetUrl = $request->document_url;
        
        // Cari index dokumen yang ingin dihapus
        $foundIndex = -1;
        foreach ($documents as $index => $doc) {
            if (isset($doc['url']) && $doc['url'] === $targetUrl) {
                $foundIndex = $index;
                break;
            }
        }

        if ($foundIndex === -1) {
            return response()->json(['message' => 'Dokumen tidak ditemukan'], 404);
        }

        // Hapus dari array
        array_splice($documents, $foundIndex, 1);
        $project->documents = array_values($documents);
        $project->save();

        // Hapus file fisik
        $path = str_replace(url('storage/'), '', $targetUrl);
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }

        return response()->json([
            'message' => 'Dokumen berhasil dihapus',
            'data' => $project->documents
        ], 200);
    }

    public function destroy($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json(['message' => 'Proyek tidak ditemukan'], 404);
        }

        // Delete project image
        if ($project->imageUrl) {
            $path = str_replace(url('storage/'), '', $project->imageUrl);
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }

        // Delete documents
        if ($project->documents) {
            foreach ($project->documents as $document) {
                if (isset($document['url'])) {
                    $path = str_replace(url('storage/'), '', $document['url']);
                    if (Storage::disk('public')->exists($path)) {
                        Storage::disk('public')->delete($path);
                    }
                }
            }
        }

        $project->delete();

        return response()->json([
            'message' => 'Proyek berhasil dihapus'
        ], 200);
    }
}
