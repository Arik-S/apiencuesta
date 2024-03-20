<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Respuesta;

class LlegadaChart extends ChartWidget
{
    protected static ?string $heading = 'Llegada';

    protected function getData(): array
    {
        // Obtener todas las llegadas distintas
        $llegadas = Respuesta::select('llegada')
            ->distinct()
            ->pluck('llegada')
            ->toArray();

        // Inicializar un array para almacenar las llegadas y sus recuentos
        $llegadasCount = [];

        // Iterar sobre cada llegada
        foreach ($llegadas as $llegada) {
            // Obtener el recuento de encuestados por llegada
            $count = Respuesta::where('llegada', $llegada)->count();
            
            // Almacenar el recuento de la llegada en el array de recuentos
            $llegadasCount[$llegada] = $count;
        }
        // Ordenar el array por los valores (recuento) en orden descendente
        arsort($llegadasCount);

        // Crear los datos para el gráfico
        $data = [
            'datasets' => [
                [
                    'label' => 'Llegadas',
                    'data' => array_values($llegadasCount), // Usar solo los valores de recuento
                    'backgroundColor' => [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'
                    ],
                ]
            ],
            'labels' => array_keys($llegadasCount), // Usar las claves como etiquetas
        ];

        return $data;
    }

    protected function getType(): string
    {
        return 'bar'; // Cambiar el tipo de gráfico a barras
    }
}
