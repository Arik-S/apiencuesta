<?php

namespace App\Filament\Resources\ComentariosEncuestadosResource\Pages;

use App\Filament\Resources\ComentariosEncuestadosResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageComentariosEncuestados extends ManageRecords
{
    protected static string $resource = ComentariosEncuestadosResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
