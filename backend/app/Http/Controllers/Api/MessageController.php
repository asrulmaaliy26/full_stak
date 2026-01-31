<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_info' => 'required|string|max:255',
            'message' => 'required|string',
            'jenjang' => 'nullable|string',
        ]);

        $message = Message::create([
            'name' => $validated['name'],
            'contact_info' => $validated['contact_info'],
            'message' => $validated['message'],
            'jenjang' => $validated['jenjang'] ?? 'UMUM',
            'type' => 'contact',
        ]);

        return response()->json([
            'message' => 'Pesan Anda berhasil dikirim.',
            'data' => $message
        ], 201);
    }

    public function storeComplaint(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_info' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'message' => 'required|string',
            'jenjang' => 'nullable|string',
        ]);

        $message = Message::create([
            'name' => $validated['name'],
            'contact_info' => $validated['contact_info'],
            'category' => $validated['category'],
            'message' => $validated['message'],
            'jenjang' => $validated['jenjang'] ?? 'UMUM',
            'type' => 'complaint',
        ]);

        return response()->json([
            'message' => 'Pengaduan Anda berhasil dikirim.',
            'data' => $message
        ], 201);
    }
}
