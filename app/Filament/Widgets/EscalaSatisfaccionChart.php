<?php

namespace App\Filament\Widgets;

use App\Models\Respuesta;
use Filament\Widgets\ChartWidget;

class EscalaSatisfaccionChart extends ChartWidget
{
    protected static ?string $heading = 'Escala de Satisfacción';

    protected function getData(): array
    {
        $escalas = Respuesta::select('satisfaccion')
            ->distinct()
            ->pluck('satisfaccion')
            ->toArray();
        
        $escalasCount = [];

        foreach ($escalas as $escala){
            $count = Respuesta::where('satisfaccion', $escala)->count();

            $escalasCount[$escala] = $count;
        }

        //Ordenar el array en orden descendente
        arsort($escalasCount);

        $data = [
            'datasets' => [
                [
                    'label' => 'Escala de Satisfacción',
                    'data' => array_values($escalasCount),
                    'backgroundColor' => [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#00FF00', '#FF00FF', '#FF5733', '#33FF57', '#5733FF'
                    ],
                ]
            ],
            'labels' => array_keys($escalasCount),
        ];
        return $data;
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
