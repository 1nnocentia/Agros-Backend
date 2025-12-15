<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LahanResource extends JsonResource
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
            'lahan_name' => $this->lahan_name,
            'land_area' => (float) $this->land_area,
            'lokasi' => [
                'latitude' => (float) $this->latitude,
                'longitude' => (float) $this->longitude,
            ],
            'display_text' => $this->land_area . ' Hektar',
            'riwayat_tanam' => DataTanamResource::collection($this->whenLoaded('dataTanam')),
        ];
    }
}
