<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Respuesta;

class EncontrarProductoChart extends ChartWidget
{
    protected static ?string $heading = 'Encontró el producto';

    protected function getData(): array
    {
        // Obtener todas las recomendar distintas
        $encontraron = Respuesta::select('busqueda')
            ->distinct()
            ->pluck('busqueda')
            ->toArray();

        // Inicializar un array para almacenar las recomendar y sus recuentos
        $encontraronCount = [];

        // Iterar sobre cada llegada
        foreach ($encontraron as $encontrar) {
            // Obtener el recuento de encuestados por recomendar
            $count = Respuesta::where('busqueda', $encontrar)->count();
            
            // Almacenar el recuento de la llegada en el array de recuentos
            $encontraronCount[$encontrar] = $count;
        }
        // Ordenar el array por los valores (recuento) en orden descendente
        arsort($encontraronCount);

        // Crear los datos para el gráfico
        $data = [
            'datasets' => [
                [
                    'label' => 'Encontró el Producto',
                    'data' => array_values($encontraronCount), // Usar solo los valores de recuento
                    'backgroundColor' => [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'
                    ],
                ]
            ],
            'labels' => array_keys($encontraronCount), // Usar las claves como etiquetas
        ];

        return $data;
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
