<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Respuesta;

class SectorChart extends ChartWidget
{
    protected static ?string $heading = 'Sectores visitados';

    protected function getData(): array
    {
        // Obtener todas las respuestas
        $respuestas = Respuesta::all();
    
        // Inicializar un array para almacenar los sectores y sus recuentos
        $sectoresCount = [];
    
        // Iterar sobre cada respuesta
        foreach ($respuestas as $respuesta) {
            // Obtener el campo 'sector_visitado' de la respuesta y separar los sectores por coma
            $sectores = explode(',', $respuesta->sector_visitado);
            
            // Iterar sobre cada sector
            foreach ($sectores as $sector) {
                // Limpiar el sector (eliminar espacios en blanco al inicio y al final)
                $sector = trim($sector);
    
                // Verificar si el sector ya está en el array de recuentos
                if (array_key_exists($sector, $sectoresCount)) {
                    // Incrementar el recuento del sector si ya existe
                    $sectoresCount[$sector]++;
                } else {
                    // Agregar el sector al array de recuentos con un recuento de 1 si no existe
                    $sectoresCount[$sector] = 1;
                }
            }
        }
        //Ordenar el array por los valores en orden descendente
        arsort($sectoresCount);
    
        // Crear los datos para el gráfico
        $data = [
            'datasets' => [
                [
                    'label' => 'Sectores Visitados',
                    'data' => array_values($sectoresCount), // Usar solo los valores de recuento
                    'backgroundColor' => [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#00FF00', '#FF00FF', 
                        '#FF5733', '#33FF57', '#5733FF', '#33FFD8', '#D833FF', '#FFD833', '#D8FF33'
                    ],
                ]
            ],
            'labels' => array_keys($sectoresCount), // Usar las claves como etiquetas
        ];
    
        return $data;
    }
    
    
    protected function getType(): string
    {
        return 'bar'; // Cambiar el tipo de gráfico a barras
    }
}
