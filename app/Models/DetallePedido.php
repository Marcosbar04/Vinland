<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    use HasFactory;


    protected $table = 'detalle_pedidos';

 
    protected $fillable = [
        'pedido_id',
        'vinilo_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];


    protected $casts = [
        'precio_unitario' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }

    public function vinilo()
    {
        return $this->belongsTo(Vinilo::class, 'vinilo_id');
    }
}