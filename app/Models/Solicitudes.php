<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitudes extends Model
{
    use HasFactory;

    
    public function equipos()
    {
        return $this->hasMany(Equipo::class, 'listado_equipos');
    }
    // Relación con otros modelos (ejemplo)
    public function users()
    {
        return $this->hasOne(User::class);
    }
}
