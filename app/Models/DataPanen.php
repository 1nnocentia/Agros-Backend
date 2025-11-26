<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPanen extends Model
{
    protected $fillable = [
        'tanggal_panen',
        'bobot_hasil'
    ];
}
