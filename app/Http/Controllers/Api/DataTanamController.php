<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataTanam;
use App\Models\StatusTanam;
use App\Http\Resources\DataTanamResource;

class DataTanamController extends Controller
{
    // index (history tanam), show (detail data tanam), store (mulai tanam, pilih lahan, komoditas, varietas, tgl tanam)
    public function index (Request $request)
    {
        $userId = $request->user()->id;
        $riwayatTanam = DataTanam::query()
            ->with(['lahan', 'varietas.komoditas', 'statusTanam'])
            ->whereHas('lahan', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->latest('planting_date')
            ->paginate(5);

        return DataTanamResource::collection($riwayatTanam);
    }

    public function show (Request $request, $id)
    {
        $userId = $request->user()->id;
        $tanam = DataTanam::with(['lahan', 'varietas.komoditas', 'statusTanam'])
            ->whereHas('lahan', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->findOrFail($id);

        return new DataTanamResource($tanam);
    }

    public function store (Request $request)
    {
        $validated = $request->validate([
            'lahan_id'      => 'required|exists:lahan,id',
            'varietas_id'   => 'required|exists:varietas,id',
            'planting_date' => 'required|date',
        ]);

        $tanam = DataTanam::create([
            'lahan_id'      => $validated['lahan_id'],
            'varietas_id'   => $validated['varietas_id'],
            'planting_date' => $validated['planting_date'],
            'status_tanam_id' => StatusTanam::AKTIF,
        ]);
        $tanam ->load(['lahan', 'varietas.komoditas', 'statusTanam']);

        return new DataTanamResource($tanam);
    }

    public function update (Request $request, $id)
    {
        $tanam = DataTanam::findOrFail($id);
        $validated = $request->validate([
            'lahan_id'      => 'sometimes|exists:lahan,id',
            'komoditas_id'  => 'sometimes|exists:komoditas,id',
            'varietas_id'   => 'sometimes|exists:varietas,id',
            'planting_date' => 'sometimes|date',
            'status_tanam_id' => 'sometimes|in:' . implode(',', [
                StatusTanam::AKTIF,
                StatusTanam::PANEN,
                StatusTanam::GAGAL,
            ]),
        ]);
        $tanam->update($validated);
        return new DataTanamResource($tanam);
    }

    public function showOnGoing (DataTanam $dataTanam)
    {
        if($dataTanam->status_tanam_id != StatusTanam::AKTIF){
            return response()->json([
                'message' => 'Data tidak ditemukan.',
            ], 404);
        }

        return new DataTanamResource($dataTanam);
    }
}
