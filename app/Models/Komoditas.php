<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komoditas extends Model
{
    protected $fillable = [
        'nama_komoditas'
    ];

    public function varietas()
    {
        return $this->hasMany(Varietas::class);
    }
}
