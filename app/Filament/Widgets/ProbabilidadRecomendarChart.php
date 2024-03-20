<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Respuesta;

class ProbabilidadRecomendarChart extends ChartWidget
{
    protected static ?string $heading = 'Probabilidad de Recomendar';

    protected function getData(): array
    {
        // Obtener todas las recomendar distintas
        $recomendaciones = Respuesta::select('recomendar')
            ->distinct()
            ->pluck('recomendar')
            ->toArray();

        // Inicializar un array para almacenar las recomendar y sus recuentos
        $recomendacionesCount = [];

        // Iterar sobre cada llegada
        foreach ($recomendaciones as $recomendar) {
            // Obtener el recuento de encuestados por recomendar
            $count = Respuesta::where('recomendar', $recomendar)->count();
            
            // Almacenar el recuento de la llegada en el array de recuentos
            $recomendacionesCount[$recomendar] = $count;
        }
        // Ordenar el array por los valores (recuento) en orden descendente
        arsort($recomendacionesCount);

        // Crear los datos para el gráfico
        $data = [
            'datasets' => [
                [
                    'label' => 'Probabilidad de Recomendar',
                    'data' => array_values($recomendacionesCount), // Usar solo los valores de recuento
                    'backgroundColor' => [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'
                    ],
                ]
            ],
            'labels' => array_keys($recomendacionesCount), // Usar las claves como etiquetas
        ];

        return $data;
    }

    protected function getType(): string
    {
        return 'bar'; // Cambiar el tipo de gráfico a barras
    }
}
