<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TypeSaleResource\Pages;
use App\Filament\Resources\TypeSaleResource\RelationManagers;
use App\Models\TypeSale;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TypeSaleResource extends Resource
{
    protected static ?string $model = TypeSale::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Carga Inicial';

    public static function getModelLabel(): string
    {
        return __('/filament/resources/type_sale.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('/filament/resources/type_sale.plural_label');
    }

    public static function getAttributeLabel(string $attribute): string
    {
        return __("filament/resources/type_sale.{$attribute}");
    }

    public static function inputForm(): array
    {
        return [
            Forms\Components\TextInput::make('name')->autofocus()->label(static::getAttributeLabel('name'))
                ->required()
                ->columnSpan('full'),
            Forms\Components\Textarea::make('description')->label(static::getAttributeLabel('description'))
                ->columnSpan('full'),
        ];
    }

    public static function tableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')->label(static::getAttributeLabel('name')),
            Tables\Columns\TextColumn::make('description')->label(static::getAttributeLabel('description'))
                ->words(20),
        ];
    }

    public static function tableActions(): array
    {
        return [
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ];
    }

    public static function form(Form $form): Form
    {
        return $form->schema(static::inputForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(static::tableColumns())
            ->filters([
                //
            ])
            ->actions(static::tableActions())
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTypeSales::route('/'),
            'create' => Pages\CreateTypeSale::route('/create'),
            'edit' => Pages\EditTypeSale::route('/{record}/edit'),
        ];
    }
}
