<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataTanam extends Model
{
    use HasFactory;
    protected $fillable = [
        'lahan_id',
        'varietas_id',
        'status_tanam_id',
        'planting_date'
    ];

    protected $casts = [
        'planting_date' => 'datetime',
    ];

    public function lahan()
    {
        return $this->belongsTo(Lahan::class);
    }

    public function varietas()
    {
        return $this->belongsTo(Varietas::class);
    }

    public function statusTanam()
    {
        return $this->belongsTo(StatusTanam::class);
    }

    public function dataPanen()
    {
        return $this->hasMany(DataPanen::class);
    }
}
