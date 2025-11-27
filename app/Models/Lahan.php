<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lahan extends Model
{
    protected $fillable = [
        'user_id',
        'luas_lahan',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'luas_lahan' => 'decimal:2',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
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
