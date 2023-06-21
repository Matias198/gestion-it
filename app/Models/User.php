<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function solicitudes()
    {
        return $this->belongsToMany(Solicitud::class);
    }

    public function hasRole($role)
    {
        //Por cada rol en $role
        foreach ($role as $r) {
            // Si el usuario tiene el rol de Administrador 
            if ($this->role->name == 'Administrador' && $r == 'Administrador') {
                return true;
            }

            // Si el usuario tiene el rol de Usuario Comun
            if ($this->role->name == 'Usuario Comun' && $r == 'Usuario Comun') { 
                return true;
            }

            // Si el usuario tiene el rol de Usuarios del Área de Sistemas
            if ($this->role->name == 'Usuarios del Área de Sistemas' && $r == 'Usuarios del Área de Sistemas') { 
                return true;
            }
        }

        // Si el usuario no tiene el rol requerido
        return false;
    }
}