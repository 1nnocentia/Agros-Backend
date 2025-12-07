<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DataTanamResource extends JsonResource
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
            'tanggal_tanam' => $this->planting_date,

            'detail_tanam' => [
                'id' => $this->varietas_id,
                'nama_varietas' => $this->varietas->nama_varietas,
                'komoditas_id' => $this->varietas->komoditas_id,
                'nama_komoditas' => $this->varietas->komoditas->name,
            ],

            'status_tanam' => [
                'id' => $this->status_tanam_id,
                'label' => $this->statusTanam->name ?? 'Unknown',
                'warna' => match($this->status_tanam_id) {
                    2 => 'success',
                    3 => 'danger',
                    default => 'warning'
                }
            ],

            'data_panen' => DataPanenResource::collection($this->whenLoaded('dataPanen')),
        ];
    }
}
