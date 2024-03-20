<?php

namespace App\Filament\Widgets;

use App\Models\Respuesta;
use Filament\Widgets\ChartWidget;

class PosibilidadVolverChart extends ChartWidget
{
    protected static ?string $heading = 'Probabilidad de Volver';

    protected function getData(): array
    {
        // Obtener todas las posibilidad_volver distintas
        $posibilidades = Respuesta::select('posibilidad_volver')
            ->distinct()
            ->pluck('posibilidad_volver')
            ->toArray();

        // Inicializar un array para almacenar las posibilidad_volver y sus recuentos
        $posibilidadesCount = [];

        // Iterar sobre cada llegada
        foreach ($posibilidades as $posibilidad) {
            // Obtener el recuento de encuestados por recomendar
            $count = Respuesta::where('posibilidad_volver', $posibilidad)->count();
            
            // Almacenar el recuento de la llegada en el array de recuentos
            $posibilidadesCount[$posibilidad] = $count;
        }
        // Ordenar el array por los valores (recuento) en orden descendente para que las barras se muestren en ese orden
        arsort($posibilidadesCount);

        // Crear los datos para el gráfico
        $data = [
            'datasets' => [
                [
                    'label' => 'Probabilidades de Volver',
                    'data' => array_values($posibilidadesCount), // Usar solo los valores de recuento
                    'backgroundColor' => [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'
                    ],
                ]
            ],
            'labels' => array_keys($posibilidadesCount), // Usar las claves como etiquetas
        ];

        return $data;
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
