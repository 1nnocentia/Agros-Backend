<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class DataPanenResource extends JsonResource
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
            'data_tanam_id' => $this->data_tanam_id,
            'tanggal_panen' => $this->harvest_date,
            'tanggal_display' => $this->harvest_date 
                ? Carbon::parse($this->harvest_date)->translatedFormat('d F Y')
                : '-',
            'jumlah_panen' => (float) $this->yield_weight,
            'jumlah_display' => $this->yield_weight . ' Ton',
            'status_panen' => [
                'id' => $this->status_panen_id,
                'label' => $this->statusPanen->name ?? 'Unknown',
                'warna' => match($this->status_panen_id) {
                    2 => 'success',
                    3 => 'danger',
                    default => 'warning'
                }
            ],
        ];
    }
}
