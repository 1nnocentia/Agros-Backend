<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusPanen extends Model
{   
    protected $table = 'status_panen';
    protected $fillable = [
        'status_panen'
    ];

    public function dataPanen()
    {
        return $this->hasMany(DataPanen::class);
    }
}
