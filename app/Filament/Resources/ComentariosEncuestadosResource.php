<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComentariosEncuestadosResource\Pages;
use App\Filament\Resources\ComentariosEncuestadosResource\Pages\ManageComentariosEncuestados;
use App\Filament\Resources\ComentariosEncuestadosResource\RelationManagers;
use App\Models\ComentariosEncuestados;
use App\Models\Respuesta;
use Filament\Forms;
use Filament\Pages\Actions\DeleteAction;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ComentariosEncuestadosResource extends Resource
{
    protected static ?string $model = ComentariosEncuestados::class;

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
            ->select(['id', 'nombre_contacto', 'comentarios'])
            ->where('comentarios', '!=', null);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre_contacto')
                    ->label('Nombre Contacto')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('comentarios')
                    ->label('Comentarios')
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
            'index' => Pages\ManageComentariosEncuestados::route('/'),
        ];
    }
}
