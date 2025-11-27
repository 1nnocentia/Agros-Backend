<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelompokTani extends Model
{
    protected $fillable = [
        'kelompok_tani'
    ];

    public function user(){
        return $this->hasMany(User::class);
    }
}

