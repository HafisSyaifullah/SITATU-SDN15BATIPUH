<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'foto',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function suratMasuk()
    {
        return $this->hasMany(SuratMasuk::class);
    }

    public function suratKeluar()
    {
        return $this->hasMany(SuratKeluar::class);
    }

    public function agenda()
    {
        return $this->hasMany(Agenda::class);
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    public function getFotoUrlAttribute(): string
    {
        if ($this->foto && Storage::disk('public')->exists($this->foto)) {
            return asset('storage/' . $this->foto);
        }

        return 'https://ui-avatars.com/api/?name=' .
            urlencode($this->name) .
            '&background=0D8ABC&color=fff';
    }
}
