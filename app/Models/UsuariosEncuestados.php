<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuariosEncuestados extends Model
{
    use HasFactory;

    protected $table = 'respuestas';
    public $timestamps = false;
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
        'producto_faltante',
        'sector_visitado',
        'comentarios',
        'nombre_contacto',
        'contacto',
        'red_social',
        'rango_edad',
        'pais_faltante',
    ];
    
    public static function getUsuariosEncuestados()
    {
        return static::whereNotNull('nombre_completo')->whereNotNull('contacto')->get();
    }

    public function encuesta()
    {
        return $this->belongsTo(Encuesta::class, 'encuesta_id');
    }
}
