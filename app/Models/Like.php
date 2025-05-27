<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $table = 'Like';
 
    public $timestamps = false;
  
    protected $fillable = [
        'id_usuario',
        'id_vinilo',
        'me_gusta',
    ];


    protected $casts = [
        'me_gusta' => 'boolean',
        'fecha_creacion' => 'datetime',
    ];

    const CREATED_AT = 'fecha_creacion';

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }


    public function vinilo()
    {
        return $this->belongsTo(Vinilo::class, 'id_vinilo');
    }
}