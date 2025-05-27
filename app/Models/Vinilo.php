<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vinilo extends Model
{
    use HasFactory;

    protected $table = 'Vinilo';


    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'artista',
        'genero',
        'anio',
        'imagen',
        'preview_audio',
        'precio_unitario',
    ];

 
    protected $casts = [
        'precio_unitario' => 'decimal:2',
        'anio' => 'integer',
        'fecha_creacion' => 'datetime',
    ];


    const CREATED_AT = 'fecha_creacion';

    public function usuariosQueLesGusta()
    {
        return $this->belongsToMany(Usuario::class, 'Like', 'id_vinilo', 'id_usuario')
                   ->wherePivot('me_gusta', 1);
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'id_vinilo');
    }


    public function pedidoItems()
    {
        return $this->hasMany(PedidoItem::class, 'id_vinilo');
    }

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'PedidoItem', 'id_vinilo', 'id_pedido')
                   ->withPivot('cantidad', 'precio_unitario');
    }

    public function getNumeroLikesAttribute()
    {
        return $this->likes()->where('me_gusta', 1)->count();
    }

  
    public function getImagenUrlAttribute()
    {
        if ($this->imagen) {
            return asset('storage/' . $this->imagen);
        }
        return asset('img/no-cover.jpg');
    }


    public function getAudioUrlAttribute()
    {
        if ($this->preview_audio) {
            return asset('storage/' . $this->preview_audio);
        }
        return null;
    }

    public function scopeBuscar($query, $texto)
    {
        if ($texto) {
            return $query->where('titulo', 'like', "%{$texto}%")
                        ->orWhere('artista', 'like', "%{$texto}%")
                        ->orWhere('genero', 'like', "%{$texto}%");
        }
        
        return $query;
    }
}