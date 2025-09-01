<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pegawai extends Authenticatable {
    use HasFactory, Notifiable;

    protected $fillable = [
        'nip', 'nama', 'email', 'password', 'jabatan', 'level', 'is_active'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function surats()
    {
        return $this->hasMany(Surat::class);
    }

    public function pelayananDukcapils()
    {
        return $this->hasMany(PelayananDukcapil::class);
    }
}
