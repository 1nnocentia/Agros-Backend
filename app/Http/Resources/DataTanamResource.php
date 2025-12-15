<?php

namespace App\Http\Resources;

use App\Models\StatusTanam;
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
                'nama_varietas' => $this->varietas->varietas_name ?? null,
                'komoditas_id' => $this->varietas->komoditas_id ?? null,
                'nama_komoditas' => $this->varietas->komoditas->komoditas_name ?? null,
            ],

            'kelompok_tani' => [
                'id' => $this->lahan->user->kelompokTani->id ?? null,
                'nama' => $this->lahan->user->kelompokTani->kelompok_tani ?? null,
            ],

            'status_tanam' => [
                'id' => $this->status_tanam_id,
                'label' => $this->statusTanam->status_tanam ?? 'Unknown',
                'warna' => match($this->status_tanam_id) {
                    StatusTanam::AKTIF => 'warning',
                    StatusTanam::PANEN => 'success',
                    StatusTanam::GAGAL => 'danger',
                    default => 'gray'
                }
            ],

            'data_panen' => DataPanenResource::collection($this->whenLoaded('dataPanen')),
        ];
    }
}
