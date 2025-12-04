<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lahan extends Model
{
    use HasFactory;
    protected $table = 'lahan';
    protected $fillable = [
        'user_id',
        'land_area',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'land_area' => 'decimal:2',
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
