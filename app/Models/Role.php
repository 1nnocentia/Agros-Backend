<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public const ROLE_ADMIN = 1;
    public const ROLE_PETANI = 2;
    public const ROLE_BULOG = 3;
    public const ROLE_APARATDESA = 4;
    protected $fillable = [
        'role_name'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
