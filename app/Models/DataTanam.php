<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataTanam extends Model
{
    protected $fillable = [
        'tanggal_tanam'
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
