<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;

    protected $table = 'sectores';
    
    protected $guarded = [];

    public function respuestas()
    {
        return $this->belongsToMany(Respuesta::class, 'respuesta_sectors');
    }
}
