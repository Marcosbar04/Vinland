<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'Pedido';

    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'precio_total',
        'estado',
    ];

    protected $casts = [
        'precio_total' => 'decimal:2',
        'fecha_creacion' => 'datetime',
    ];

    const CREATED_AT = 'fecha_creacion';


    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }


    public function items()
    {
        return $this->hasMany(PedidoItem::class, 'id_pedido');
    }

 
    public function vinilos()
    {
        return $this->belongsToMany(Vinilo::class, 'PedidoItem', 'id_pedido', 'id_vinilo')
                   ->withPivot('cantidad', 'precio_unitario');
    }

    public function getTotalItemsAttribute()
    {
        return $this->items->sum('cantidad');
    }

    public function puedeSerCancelado()
    {
        return in_array($this->estado, ['pendiente']);
    }


    public function esCarrito()
    {
        return $this->estado === 'carrito';
    }


    public function scopePedidosReales($query)
    {
        return $query->where('estado', '!=', 'carrito');
    }
}