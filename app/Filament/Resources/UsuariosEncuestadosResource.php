<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UsuariosEncuestadosResource\Pages;
use App\Filament\Resources\UsuariosEncuestadosResource\RelationManagers;
use App\Models\UsuariosEncuestados;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class UsuariosEncuestadosResource extends Resource
{
    protected static ?string $model = UsuariosEncuestados::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->select(['id', 'nombre_contacto', 'contacto'])
            ->where('nombre_contacto', '!=', null);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre_contacto')
                    ->label('Nombre Contacto')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('contacto')
                    ->label('Contacto')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
                //Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                //Tables\Actions\DeleteBulkAction::make(),
                ExportBulkAction::make()
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUsuariosEncuestados::route('/'),
        ];
    }
}
