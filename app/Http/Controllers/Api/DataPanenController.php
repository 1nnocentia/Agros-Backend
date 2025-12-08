<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataPanen;
use App\Models\StatusPanen;


class DataPanenController extends Controller
{
    // store (input hasil panen (berat dan tanggal panen), update (edit data panen jika ada kesalahan), index (list data panen), show (detail data panen)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'data_tanam_id' => 'required|exists:data_tanam,id',
            'harvest_date'  => 'required|date',
            'yield_weight'  => 'required|numeric|min:0.1',
        ]);

        $panen = DataPanen::create([
            'data_tanam_id'   => $validated['data_tanam_id'],
            'harvest_date'    => $validated['harvest_date'],
            'yield_weight'    => $validated['yield_weight'],
            
            'status_panen_id' => StatusPanen::PENDING, 
        ]);
        return response()->json([
            'message' => 'Data tersimpan.',
            'data'    => $panen
        ]);
    }

    public function DB::update(, ['John']);
}
