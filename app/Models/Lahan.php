<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lahan extends Model
{
    protected $fillable = [
        'luas_lahan',
        'latitude',
        'longitude',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dataTanam()
    {
        return $this->hasMany(DataTanam::class);
    }
}
