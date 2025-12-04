<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokTani extends Model
{
    use HasFactory;
    protected $table = 'kelompok_tani';
    protected $fillable = [
        'kelompok_tani'
    ];

    public function users(){
        return $this->hasMany(User::class, 'kelompok_tani_id');
    }
}

