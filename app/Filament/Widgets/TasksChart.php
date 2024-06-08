<?php
 
 namespace App\Filament\Widgets;
 
 use App\Models\Task;
 use Flowframe\Trend\Trend;
 use Illuminate\Support\Carbon;
 use Flowframe\Trend\TrendValue;
 use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
 use Filament\Forms\Components\DatePicker;
  
 class TasksChart extends ApexChartWidget
 {
     protected int | string | array $columnSpan = 'full';
  
     protected static string $chartId = 'tasksChart';
  
     protected static ?string $heading = 'TasksChart';
  
     protected function getOptions(): array
     {
         $data = Trend::model(Task::class) 
             ->between(
                 start: now()->subMonth(),
                 end: now(),
             )
             ->perDay()
             ->count(); 
  
         return [
             'chart' => [
                 'type' => 'line',
                 'height' => 300,
             ],
             'series' => [
                 [
                     'name' => 'TasksChart',
                     'data' => [7, 4, 6, 10, 14, 7, 5, 9, 10, 15, 13, 18], 
                     'data' => $data->map(fn (TrendValue $value) => $value->aggregate), 
                 ],
             ],
             'xaxis' => [
                 'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], 
                 'categories' => $data->map(fn (TrendValue $value) => $value->date), 
                 'labels' => [
                     'style' => [
                         'colors' => '#9ca3af',
                         'fontWeight' => 600,
                     ],
                 ],
             ],
             'yaxis' => [
                 'labels' => [
                     'style' => [
                         'colors' => '#9ca3af',
                         'fontWeight' => 600,
                     ],
                 ],
             ],
             'colors' => ['#6366f1'],
             'stroke' => [
                 'curve' => 'smooth',
             ],
         ];
     }
     protected function getFormSchema(): array
    {
        return [
            DatePicker::make('date_start')
                ->default(now()->subMonth()),
            DatePicker::make('date_end')
                ->default(now()),
        ];
    }
 }