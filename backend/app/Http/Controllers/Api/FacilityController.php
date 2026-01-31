<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function index()
    {
        return response()->json(['data' => Facility::all()]);
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
        $limitedFacilities = Facility::limit($count)->get();
        return response()->json(['data' => $limitedFacilities]);
    }
}
