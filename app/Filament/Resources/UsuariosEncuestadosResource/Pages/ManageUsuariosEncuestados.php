<?php

namespace App\Filament\Resources\UsuariosEncuestadosResource\Pages;

use App\Filament\Resources\UsuariosEncuestadosResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageUsuariosEncuestados extends ManageRecords
{
    protected static string $resource = UsuariosEncuestadosResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
