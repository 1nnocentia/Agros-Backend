<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusTanam extends Model
{
    protected $fillable = [
        'status_tanam'
    ];

    public function dataTanam()
    {
        return $this->hasMany(DataTanam::class);
    }
}
