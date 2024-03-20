<?php
namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Respuesta;

class PaisesChart extends ChartWidget
{
    protected static ?string $heading = 'Países de origen de los Encuestados';

    protected function getData(): array
    {
        $paises = Respuesta::select('pais_origen')
                        ->distinct()
                        ->pluck('pais_origen')
                        ->toArray();
    
        $coloresDisponibles = [
            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF66CC', '#FF9999', '#66CC66', '#FF9933', '#FFCC66',
            '#666699', '#6699CC', '#669999', '#CCCC99', '#CC6666', '#99CC66', '#CC99CC', '#9999CC', '#FF6666', '#6699CC',
            '#CCCC66', '#669966', '#FF9966', '#99CC99', '#FFCC99', '#669999', '#996699', '#CC9999', '#FF6666', '#6699FF',
            '#6666FF', '#FF66FF', '#9966CC'
        ];
    
        $data = [
            'datasets' => [
                [
                    'label' => 'País de origen',
                    'data' => [], // Aquí se almacenarán los recuentos de cada país
                    'backgroundColor' => [], // Colores para los segmentos
                    'borderColor' => '#ffffff', // Color del borde
                ],
            ],
            'labels' => [], // Aquí se almacenarán los nombres de los países
        ];
    
        foreach ($paises as $index => $pais) {
            // Si el país es "Otro", consultamos la columna "pais_faltante" para obtener el país correspondiente
            if ($pais === 'Otro') {
                $paisCorrespondiente = Respuesta::select('pais_faltante')
                                            ->whereRaw('UPPER(pais_origen) = ?', ['OTRO'])
                                            ->distinct()
                                            ->pluck('pais_faltante')
                                            ->first();
                $pais = $paisCorrespondiente ?: 'Otro';
    
                // Obtener el recuento de encuestados por país en la columna "pais_faltante"
                $count = Respuesta::whereRaw('UPPER(pais_faltante) = ?', [strtoupper($pais)])->count();
            } else {
                // Obtener el recuento de encuestados por país en la columna "pais_origen"
                $count = Respuesta::whereRaw('UPPER(pais_origen) = ?', [strtoupper($pais)])->count();
            }
            
            $data['datasets'][0]['data'][] = $count;
            $data['labels'][] = $pais;
    
            // Asignar color al país
            $colorIndex = $index % count($coloresDisponibles);
            $color = $coloresDisponibles[$colorIndex];
            $data['datasets'][0]['backgroundColor'][] = $color;
        }
    
        return $data;
    }
    

    protected function getType(): string
    {
        return 'doughnut';
    }
}
