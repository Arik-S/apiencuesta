<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Respuesta;

class Encuesta extends Model
{
    use HasFactory;

    protected $table = 'encuesta';
    protected $fillable = ['created_at'];

    public function respuestas()
    {
        return $this->hasMany(Respuesta::class);
    }
}
