<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataPanen extends Model
{
    use HasFactory;
    protected $fillable = [
        'data_tanam_id',
        'harvest_date',
        'yield_weight',
        'status_panen_id'
    ];

    protected $casts = [
        'harvest_date' => 'datetime',
        'yield_weight' => 'decimal:2',
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
