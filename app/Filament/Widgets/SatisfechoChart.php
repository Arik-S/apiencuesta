<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Respuesta;

class SatisfechoChart extends ChartWidget
{
    protected static ?string $heading = 'Cliente Satisfecho';

    protected function getData(): array
    {
        // Obtener todas las recomendar distintas
        $satisfechos = Respuesta::select('satisfecho_servicio')
            ->distinct()
            ->pluck('satisfecho_servicio')
            ->toArray();

        // Inicializar un array para almacenar las recomendar y sus recuentos
        $satisfechosCount = [];

        // Iterar sobre cada llegada
        foreach ($satisfechos as $satisfecho) {
            // Obtener el recuento de encuestados por recomendar
            $count = Respuesta::where('satisfecho_servicio', $satisfecho)->count();
            
            // Almacenar el recuento de la llegada en el array de recuentos
            $satisfechosCount[$satisfecho] = $count;
        }
        // Ordenar el array por los valores (recuento) en orden descendente
        arsort($satisfechosCount);

        // Crear los datos para el gráfico
        $data = [
            'datasets' => [
                [
                    'label' => 'Cliente satisfecho',
                    'data' => array_values($satisfechosCount), // Usar solo los valores de recuento
                    'backgroundColor' => [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'
                    ],
                ]
            ],
            'labels' => array_keys($satisfechosCount), // Usar las claves como etiquetas
        ];

        return $data;
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
