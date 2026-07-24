<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'nombre', 'tipo', 'raza', 'edad', 'observaciones'];

    public function dueno()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function turnos()
    {
        return $this->hasMany(Turno::class);
    }
}
