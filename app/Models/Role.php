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
        'permisos',
    ];

    // Relación con otros modelos (ejemplo)
    public function users()
{
    return $this->hasMany(User::class);
}
}
