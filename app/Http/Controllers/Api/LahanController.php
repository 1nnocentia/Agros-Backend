<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\LahanResource;
use App\Models\Lahan;

class LahanController extends Controller
{
    //list lahan, strore (tambah lahan baru), update data lahan, destroy(hapus)
    public function index(Request $request)
    {
        $lahan = $request->user()
            ->lahan()
            ->latest()
            ->paginate(5);
        
        return LahanResource::collection($lahan);
    }

    public function store (Request $request)
    {
        $validated = $request->validate([
            'land_area' => 'required|numeric|min:0.01',
            'latitude'  => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        $lahan = $request->user()->lahan()->create($validated);

        return new LahanResource($lahan);
    }

    public function show (Request $request, Lahan $lahan)
    {
        if ($lahan->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $lahan->load(['dataTanam.varietas.komoditas', 'dataTanam.varietas', 'dataTanam.statusTanam']);

        return new LahanResource($lahan);
    }

    public function update (Request $request, Lahan $lahan)
    {
        if ($lahan->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'land_area' => 'sometimes|required|numeric|min:0.01',
            'latitude'  => 'sometimes|required|numeric|between:-90,90',
            'longitude' => 'sometimes|required|numeric|between:-180,180',
        ]);

        $lahan->update($validated);

        return new LahanResource($lahan);
    }
    
}
