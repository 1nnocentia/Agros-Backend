<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelompokTani extends Model
{
    protected $fillable = [
        'nama_kelompok'
    ];

    public function user(){
        return $this->hasMany(User::class);
    }
}

