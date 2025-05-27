<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'Usuarios';

  
    protected $fillable = [
        'nombre',
        'apellido',
        'username',
        'email',
        'password',
        'rol',
        'profile_image',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

  
    public function username()
    {
        return 'username';
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'id_usuario');
    }


    public function vinilosFavoritos()
    {
        return $this->belongsToMany(Vinilo::class, 'Like', 'id_usuario', 'id_vinilo')
                   ->wherePivot('me_gusta', 1);
    }


    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_usuario');
    }

    public function getCarritoAttribute()
    {
        return $this->pedidos()->where('estado', 'carrito')->first();
    }

  
    public function hasLiked($viniloId)
    {
        return $this->likes()->where('id_vinilo', $viniloId)
                     ->where('me_gusta', 1)
                     ->exists();
    }

 
    public function isAdmin()
    {
        return $this->rol === 'admin';
    }


    public function getProfileImageUrlAttribute()
    {
        if ($this->profile_image) {
            return asset('storage/' . $this->profile_image);
        }
        return asset('img/default-profile.png');
    }


    public function getNombreCompletoAttribute()
    {
        return "{$this->nombre} {$this->apellido}";
    }
}