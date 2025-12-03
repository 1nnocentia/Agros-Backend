<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\HasName;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser, HasName
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'role_id',
        'kelompok_tani_id',
        'name',
        'phone_number',
        'wa_verified',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'verifikasi_wa' => 'boolean',
    ];

    public function getFilamentName(): string
    {
        return $this->name;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role && in_array($this->role->role_name, ['Admin', 'Bulog', 'Aparat Desa']);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function kelompokTani()
    {
        return $this->belongsTo(KelompokTani::class);
    }

    public function lahan()
    {
        return $this->hasMany(Lahan::class);
    }

    public function isAdmin(): bool
    {
        return $this->role?->role_name === 'Admin';
    }
}
