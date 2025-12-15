<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLahanRequest;
use App\Http\Requests\UpdateLahanRequest;
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

    public function store (StoreLahanRequest $request)
    {
        $validated = $request->validated();
        
        if (empty($validated['lahan_name'])) {
            $lahanCount = $request->user()->lahan()->count() + 1;
            $validated['lahan_name'] = 'Lahan ' . $lahanCount;
        }
        
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

    public function update (UpdateLahanRequest $request, Lahan $lahan)
    {
        if ($lahan->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        
        $validated = $request->validated();
        $lahan->update($validated);
        
        // $lahan->refresh();

        return new LahanResource($lahan);
    }
    
}
