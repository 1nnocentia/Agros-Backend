<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPanen extends Model
{
    protected $fillable = [
        'data_tanam_id',
        'tanggal_panen',
        'bobot_hasil',
        'status_panen_id'
    ];

    protected $casts = [
        'tanggal_panen' => 'datetime',
        'bobot_hasil' => 'decimal:2',
    ];

    public function dataTanam()
    {
        return $this->belongsTo(DataTanam::class);
    }

    public function statusPanen()
    {
        return $this->belongsTo(StatusPanen::class);
    }
}
