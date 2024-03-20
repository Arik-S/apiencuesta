<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Respuesta;

class ComentariosEncuestados extends Model
{
    use HasFactory;

    protected $table = 'respuestas';
    protected $fillable = [
        'encuesta_id',
        'pais_origen',
        'llegada',
        'cliente_habitual',
        'satisfaccion',
        'recomendar',
        'posibilidad_volver',
        'satisfecho_servicio',
        'tardanza_atencion',
        'busqueda',
        'sector_visitado',
        'comentarios',
        'nombre_contacto',
        'contacto',
        'red_social',
        'rango_edad',
        'pais_faltante',
    ];

    public function respuestas()
    {
        return $this->hasMany(Respuesta::class);
    }
}
