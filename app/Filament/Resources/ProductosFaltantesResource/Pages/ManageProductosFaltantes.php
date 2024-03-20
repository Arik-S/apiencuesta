<?php

namespace App\Filament\Resources\ProductosFaltantesResource\Pages;

use App\Filament\Resources\ProductosFaltantesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageProductosFaltantes extends ManageRecords
{
    protected static string $resource = ProductosFaltantesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
