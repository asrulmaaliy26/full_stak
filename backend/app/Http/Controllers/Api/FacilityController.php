<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function index()
    {
        $query = Facility::query();

        if (request()->has('fakultas') && request()->fakultas) {
            $query->where('fakultas', request()->fakultas);
        }
        if (request()->has('jurusan') && request()->jurusan) {
            $query->where('jurusan', request()->jurusan);
        }

        return response()->json(['data' => $query->get()]);
    }

    public function show($id)
    {
        $item = Facility::find($id);

        if (!$item) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(['data' => $item]);
    }

    public function limit($count)
    {
        $query = Facility::query();

        if (request()->has('fakultas') && request()->fakultas) {
            $query->where('fakultas', request()->fakultas);
        }
        if (request()->has('jurusan') && request()->jurusan) {
            $query->where('jurusan', request()->jurusan);
        }

        $limitedFacilities = $query->limit($count)->get();
        return response()->json(['data' => $limitedFacilities]);
    }
}
