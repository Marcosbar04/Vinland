<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
    use HasFactory;


    protected $table = 'PedidoItem';

    public $timestamps = false;


    protected $fillable = [
        'id_pedido',
        'id_vinilo',
        'cantidad',
        'precio_unitario',
    ];


    protected $casts = [
        'precio_unitario' => 'decimal:2',
        'cantidad' => 'integer',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedido');
    }

    public function vinilo()
    {
        return $this->belongsTo(Vinilo::class, 'id_vinilo');
    }

    public function getSubtotalAttribute()
    {
        return $this->cantidad * $this->precio_unitario;
    }
}