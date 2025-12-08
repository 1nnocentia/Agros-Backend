<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\KomoditasResource;
use App\Models\Komoditas;
use App\Models\Varietas;
use App\Http\Resources\VarietasResource;
use App\Models\KelompokTani;
use App\Http\Resources\KelompokTaniResource;

class MasterDataController extends Controller
{
    public function komoditas()
    {
        $data = Komoditas::all();

        return KomoditasResource::collection($data);
    }

    public function varietas(Request $request, $komoditas_id)
    {
        $query = Varietas::query();

        if ($request->has('komoditas_id')) {
            $query->where('komoditas_id', $request->komoditas_id);
        }

        return VarietasResource::collection($query->get());
    }

    public function varietasByKomoditas($komoditas_id)
    {
        $data = Varietas::where('komoditas_id', $komoditas_id)->get();

        return VarietasResource::collection($data);
    }

    public function kelompokTani (Request $request)
    {
        $query = KelompokTani::query();

        if ($request->has('search')) {
            $query->where('kelompok_tani', 'like', '%' . $request->search . '%');
        }

        return KelompokTaniResource::collection($query->get());
    }
}
