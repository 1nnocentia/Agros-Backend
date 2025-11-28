<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Varietas extends Model
{
    protected $fillable = [
        'komoditas_id',
        'varietas_name'
    ];

    public function komoditas()
    {
        return $this->belongsTo(Komoditas::class);
    }

    public function dataTanam()
    {
        return $this->hasMany(DataTanam::class);
    }
}