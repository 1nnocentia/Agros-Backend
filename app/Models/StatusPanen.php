<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusPanen extends Model
{   
    public const PENDING = 1;
    public const VERIFIED = 2;
    public const CORRECTED = 3;
    protected $table = 'status_panen';
    protected $fillable = [
        'status_panen'
    ];

    public function dataPanen()
    {
        return $this->hasMany(DataPanen::class);
    }
}
