<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductosFaltantesResource\Pages;
use App\Filament\Resources\ProductosFaltantesResource\RelationManagers;
use App\Models\ProductoFaltante;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ProductosFaltantesResource extends Resource
{
    protected static ?string $model = ProductoFaltante::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('producto_faltante')
                    ->label('Productos Faltantes')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('sector_producto_faltante')
                    ->label('Sector')
                    ->sortable()
                    ->searchable()
                // Otras columnas si es necesario
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
            'index' => Pages\ManageProductosFaltantes::route('/'),
        ];
    }    
}
