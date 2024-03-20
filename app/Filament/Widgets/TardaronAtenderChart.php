<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Respuesta;

class TardaronAtenderChart extends ChartWidget
{
    protected static ?string $heading = 'Tardanza de Atención';

    protected function getData(): array
    {
        // Obtener todas las recomendar distintas
        $tardanzas = Respuesta::select('tardanza_atencion')
            ->distinct()
            ->pluck('tardanza_atencion')
            ->toArray();

        // Inicializar un array para almacenar las recomendar y sus recuentos
        $tardanzasCount = [];

        // Iterar sobre cada llegada
        foreach ($tardanzas as $tardanza) {
            // Obtener el recuento de encuestados por recomendar
            $count = Respuesta::where('tardanza_atencion', $tardanza)->count();
            
            // Almacenar el recuento de la llegada en el array de recuentos
            $tardanzasCount[$tardanza] = $count;
        }
        // Ordenar el array por los valores (recuento) en orden descendente
        arsort($tardanzasCount);

        // Crear los datos para el gráfico
        $data = [
            'datasets' => [
                [
                    'label' => 'Tardanza de Atención',
                    'data' => array_values($tardanzasCount), // Usar solo los valores de recuento
                    'backgroundColor' => [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'
                    ],
                ]
            ],
            'labels' => array_keys($tardanzasCount), // Usar las claves como etiquetas
        ];

        return $data;
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
