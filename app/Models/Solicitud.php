<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitud';

    public function equipo()
    {
        return $this->belongsToMany(Equipo::class, 'solicitud_equipos');
    }

    public function usuarios()
    {
        return $this->hasMany(User::class);
    }
}
