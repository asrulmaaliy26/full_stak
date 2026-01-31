<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JournalController extends Controller
{
    public function index()
    {
        $journals = Journal::orderBy('created_at', 'desc')->get();
        return response()->json(['data' => $journals]);
    }

    public function show($id)
    {
        $item = Journal::find($id);

        if (!$item) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(['data' => $item]);
    }

    public function limit($count)
    {
        $journals = Journal::orderBy('created_at', 'desc')
                ->limit($count)
                ->get();
        return response()->json(['data' => $journals]);
    }

    public function best()
    {
        $bestJournals = Journal::where('is_best', true)->latest()->get();
        return response()->json(['data' => $bestJournals]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'abstract' => 'required|string',
            'author' => 'required|string|max:255',
            'mentor' => 'required|string|max:255',
            'score' => 'required|integer|min:0|max:100',
            'date' => 'required|date',
            'is_best' => 'nullable|boolean',
            'jenjang' => 'required|string',
            'documentUrl' => 'nullable|file|mimes:pdf|max:10240', // Max 10MB
        ]);

        /** ======================
         * Upload DOCUMENT PDF (optional)
         * ====================== */
        $documentUrl = null;

        if ($request->hasFile('documentUrl')) {
            $documentPath = $request->file('documentUrl')
                ->store('journals/documents', 'public');
            $documentUrl = url('storage/' . $documentPath);
        }

        $journal = Journal::create([
            'title' => $request->title,
            'category' => $request->category,
            'abstract' => $request->abstract,
            'author' => $request->author,
            'mentor' => $request->mentor,
            'score' => $request->score,
            'date' => $request->date,
            'is_best' => $request->input('is_best', false),
            'jenjang' => $request->jenjang,
            'documentUrl' => $documentUrl,
        ]);

        return response()->json([
            'message' => 'Jurnal berhasil ditambahkan',
            'data' => $journal,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $journal = Journal::find($id);

        if (!$journal) {
            return response()->json(['message' => 'Jurnal tidak ditemukan'], 404);
        }

        $request->validate([
            'title' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'abstract' => 'nullable|string',
            'author' => 'nullable|string|max:255',
            'mentor' => 'nullable|string|max:255',
            'score' => 'nullable|integer|min:0|max:100',
            'date' => 'nullable|date',
            'is_best' => 'nullable|boolean',
            'jenjang' => 'nullable|string',
            'documentUrl' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        // Update PDF document if provided
        if ($request->hasFile('documentUrl')) {
            // Delete old document
            if ($journal->documentUrl) {
                $oldPath = str_replace(url('storage/'), '', $journal->documentUrl);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $documentPath = $request->file('documentUrl')->store('journals/documents', 'public');
            $journal->documentUrl = url('storage/' . $documentPath);
        }

        // Update other fields
        if ($request->has('title')) $journal->title = $request->title;
        if ($request->has('category')) $journal->category = $request->category;
        if ($request->has('abstract')) $journal->abstract = $request->abstract;
        if ($request->has('author')) $journal->author = $request->author;
        if ($request->has('mentor')) $journal->mentor = $request->mentor;
        if ($request->has('score')) $journal->score = $request->score;
        if ($request->filled('date')) $journal->date = $request->date; // Fix: Only update date if filled
        if ($request->has('is_best')) $journal->is_best = $request->input('is_best');
        if ($request->has('jenjang')) $journal->jenjang = $request->jenjang;

        $journal->save();

        return response()->json([
            'message' => 'Jurnal berhasil diupdate',
            'data' => $journal,
        ], 200);
    }

    public function destroy($id)
    {
        $journal = Journal::find($id);

        if (!$journal) {
            return response()->json(['message' => 'Jurnal tidak ditemukan'], 404);
        }

        // Delete PDF document
        if ($journal->documentUrl) {
            $oldPath = str_replace(url('storage/'), '', $journal->documentUrl);
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        $journal->delete();

        return response()->json([
            'message' => 'Jurnal berhasil dihapus'
        ], 200);
    }
}
