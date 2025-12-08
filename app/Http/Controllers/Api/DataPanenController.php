<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DataPanenResource;
use Illuminate\Http\Request;
use App\Models\DataPanen;
use App\Models\StatusPanen;
use App\Models\StatusTanam;
use App\Models\DataTanam;


class DataPanenController extends Controller
{
    // store (input hasil panen (berat dan tanggal panen), update (edit data panen jika ada kesalahan), index (list data panen), show (detail data panen)
    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $riwayatPanen = DataPanen::query()
            ->with(['dataTanam.varietas.komoditas', 'statusPanen'])
            ->whereHas('dataTanam.lahan', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->latest('harvest_date')
            ->paginate(5);

        return DataPanenResource::collection($riwayatPanen);
    }

    public function show(Request $request, $id)
    {
        $userId = $request->user()->id;
        $panen = DataPanen::with(['dataTanam.varietas.komoditas', 'statusPanen'])
            ->whereHas('dataTanam.lahan', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->findOrFail($id);

        return new DataPanenResource($panen);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'data_tanam_id' => 'required|exists:data_tanam,id',
            'harvest_date'  => 'required|date',
            'yield_weight'  => 'required|numeric|min:0.1',
        ]);

        $dataTanam = DataPanen::findOrFail($request->data_tanam_id);

        if ($dataTanam->status_tanam_id === StatusTanam::GAGAL) {
        return response()->json([
            'message' => 'Gagal menambahkan data panen. Data tanam ini statusnya Gagal.',
            ], 422);
        }

        $panen = DataPanen::create([
            'data_tanam_id'   => $validated['data_tanam_id'],
            'harvest_date'    => $validated['harvest_date'],
            'yield_weight'    => $validated['yield_weight'],
            
            'status_panen_id' => StatusPanen::PENDING, 
        ]);
        return new DataPanenResource($panen);
    }

    public function update(Request $request, $id)
    {
        $panen = DataPanen::findOrFail($id);

        $validated = $request->validate([
            'harvest_date'  => 'sometimes|date',
            'yield_weight'  => 'sometimes|numeric|min:0.1',
            'status_panen_id' => StatusPanen::CORRECTED,
        ]);

        $panen->update($validated);

        return new DataPanenResource($panen);
    }

    public function verify (DataPanen $dataPanen)
    {
        if ($dataPanen->status_panen_id === StatusPanen::VERIFIED) {
            return response()->json(['message' => 'Data sudah terverifikasi sebelumnya.'], 400);
        }

        $dataPanen->update([
            'status_panen_id' => StatusPanen::VERIFIED,
        ]);

        return new DataPanenResource($dataPanen);
    }
}
