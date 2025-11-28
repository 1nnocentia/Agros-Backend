<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komoditas extends Model
{
    protected $fillable = [
        'komoditas_name'
    ];

    public function varietas()
    {
        return $this->hasMany(Varietas::class);
    }
}
