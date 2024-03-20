<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Respuesta;

class HabitualChart extends ChartWidget
{
    protected static ?string $heading = 'Cliente Habitual';

    protected function getData(): array
    {
        $habituales = Respuesta::select('cliente_habitual')
                        ->distinct()
                        ->pluck('cliente_habitual')
                        ->toArray();
        
        $habitualCount = [];

        foreach ($habituales as $habitual){
            $count = Respuesta::where('cliente_habitual', $habitual)->count();

            $habitualCount[$habitual] = $count;
        }

        // Ordenar el array por los valores (recuento) en orden descendente
        arsort($habitualCount);

        $data = [
            'datasets' => [
                [
                    'label' => 'Clientes Habituales',
                    'data' => array_values($habitualCount),
                    'backgroundColor' => [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'
                    ],
                ]
            ],
            'labels' => array_keys($habitualCount), // Dejar las etiquetas vacías para que no se muestren los nombres de las llegadas en el eje x
        ];
    
        return $data;
    }
    
    protected function getType(): string
    {
        return 'bar'; // Cambiar el tipo de gráfico a barras
    }

}
