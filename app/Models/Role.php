<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Role extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
    ];

    // Relación con otros modelos (ejemplo)
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function permisos()
    {
        return $this->belongsToMany(Permisos::class, 'rol_permiso', 'rol_id', 'permiso_id');
    }
}
