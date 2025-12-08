<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\KomoditasResource;
use App\Models\Komoditas;

class MasterDataController extends Controller
{
    public function komoditas()
    {
        $data = Komoditas::all();

        return KomoditasResource::collection($data);
    }
}
