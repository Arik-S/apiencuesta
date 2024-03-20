<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Respuesta;

class RangoEdadChart extends ChartWidget
{
    protected static ?string $heading = 'Rango de edad';

    protected function getData(): array
    {
        $edades = Respuesta::select('rango_edad')
                        ->distinct()
                        ->pluck('rango_edad')
                        ->toArray();
    
        $data = [
            'datasets' => [
                [
                    'label' => 'País de origen',
                    'data' => [], // Aquí se almacenarán los recuentos de cada país
                    'backgroundColor' => ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#00FF00'], // Colores para los segmentos
                    'borderColor' => '#ffffff', // Color del borde
                ],
            ],
            'labels' => [], // Dejar las etiquetas vacías para que no se muestren los nombres de las llegadas en el eje x
        ];
    
        foreach ($edades as $edad) {
            // Obtener el recuento de encuestados por rango_edad
            $count = Respuesta::where('rango_edad', $edad)->count();

            $data['datasets'][0]['data'][] = $count;
            $data['labels'][] = $edad;
        }
    
        return $data;
    }
    
    protected function getType(): string
    {
        return 'doughnut'; // Cambiar el tipo de gráfico a barras
    }

}
