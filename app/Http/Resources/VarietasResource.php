<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VarietasResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama_varietas' => $this->varietas_name,
            'komoditas_id' => $this->komoditas_id,
            'komoditas_name' => $this->komoditas->komoditas_name ?? null,
        ];
    }
}
