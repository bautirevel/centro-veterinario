<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'rol',
        'telefono',
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
        ];
    }

    public function mascotas()
    {
        return $this->hasMany(Mascota::class);
    }

    public function turnosComoVeterinario()
    {
        return $this->hasMany(Turno::class, 'veterinario_id');
    }

    public function esCliente(): bool
    {
        return $this->rol === 'cliente';
    }

    public function esEncargado(): bool
    {
        return $this->rol === 'encargado';
    }

    public function esSecretario(): bool
    {
        return $this->rol === 'secretario';
    }

    public function esVeterinario(): bool
    {
        return $this->rol === 'veterinario';
    }
}
