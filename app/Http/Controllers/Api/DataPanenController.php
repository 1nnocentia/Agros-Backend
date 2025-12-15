<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DataPanenResource;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDataPanenRequest;
use App\Http\Requests\UpdateDataPanenRequest;
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

    public function store(StoreDataPanenRequest $request)
    {
        $dataTanam = DataTanam::findOrFail($request->data_tanam_id);

        if ($dataTanam->status_tanam_id === StatusTanam::GAGAL) {
            return response()->json([
                'message' => 'Gagal menambahkan data panen. Data tanam ini statusnya Gagal.',
            ], 422);
        }

        $panen = DataPanen::create([
            ...$request->validated(),
            'status_panen_id' => StatusPanen::PENDING,
        ]);
        $panen->load(['dataTanam.varietas.komoditas', 'statusPanen']);
        
        return new DataPanenResource($panen);
    }

    public function update(UpdateDataPanenRequest $request, $id)
    {
        $panen = DataPanen::findOrFail($id);
        $panen->update([
            ...$request->validated(),
            'status_panen_id' => StatusPanen::CORRECTED,
        ]);
        $panen->load(['dataTanam.varietas.komoditas', 'statusPanen']);

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
