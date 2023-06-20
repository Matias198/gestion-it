<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    public function categoria()
    {
        return $this->belongsTo(Categorias::class);
    }

    public function componentes()
    {
        return $this->belongsToMany(Componentes::class, 'equipo_componente');
    }
}
