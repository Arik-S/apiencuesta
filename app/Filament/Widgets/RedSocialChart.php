<?php

namespace App\Filament\Widgets;
use App\Models\Respuesta;
use Filament\Widgets\ChartWidget;

class RedSocialChart extends ChartWidget
{
    protected static ?string $heading = 'Redes Sociales';

    protected function getData(): array
    {
        // Obtener todas las recomendar distintas
        $redes = Respuesta::select('red_social')
            ->distinct()
            ->pluck('red_social')
            ->toArray();

        // Inicializar un array para almacenar las recomendar y sus recuentos
        $redesCount = [];

        // Iterar sobre cada llegada
        foreach ($redes as $red) {
            if ($red !== null) {
                // Obtener el recuento de encuestados por red social
                $count = Respuesta::where('red_social', $red)->count();
    
                // Almacenar el recuento de la red social en el array de recuentos
                $redesCount[$red] = $count;
            }
        }
        // Ordenar el array por los valores (recuento) en orden descendente
        arsort($redesCount);

        // Crear los datos para el gráfico
        $data = [
            'datasets' => [
                [
                    'label' => 'Redes Sociales',
                    'data' => array_values($redesCount), // Usar solo los valores de recuento
                    'backgroundColor' => [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'
                    ],
                ]
            ],
            'labels' => array_keys($redesCount), // Usar las claves como etiquetas
        ];

        return $data;
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
