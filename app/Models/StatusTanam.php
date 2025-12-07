<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusTanam extends Model
{   
    public const AKTIF = 1;
    public const PANEN = 2;
    public const GAGAL = 3;
    protected $table = 'status_tanam';
    protected $fillable = [
        'status_tanam'
    ];

    public function dataTanam()
    {
        return $this->hasMany(DataTanam::class);
    }
}
