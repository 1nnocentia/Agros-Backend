<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public const DMIN = 1;
    public const PETANI = 2;
    public const BULOG = 3;
    public const APARATDESA = 4;
    protected $fillable = [
        'role_name'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
