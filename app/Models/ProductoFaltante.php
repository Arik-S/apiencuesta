<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoFaltante extends Model
{
    use HasFactory;

    protected $table = 'producto_faltante';

    protected $fillable = ['producto_faltante', 'sector_producto_faltante', 'id_respuesta'];

    public function respuesta()
    {
        return $this->belongsTo(Respuesta::class, 'id_respuesta');
    }

}
