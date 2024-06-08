<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'priority',
    ];

    protected $dates = [
        'start_date',
        'end_date',
    ];

    // Definir relaciones con otros modelos
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Definir un atributo calculado para la duración de la tarea
    public function getDurationAttribute()
    {
        return $this->start_date->diffInDays($this->end_date);
    }

    // Definir reglas de validación para los datos de la tarea
    public static function rules($id = null)
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'priority' => ['required', Rule::in(['low', 'medium', 'high'])],
        ];
    }
}
