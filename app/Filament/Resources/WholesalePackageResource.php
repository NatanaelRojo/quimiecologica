<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WholesalePackageResource\Pages;
use App\Filament\Resources\WholesalePackageResource\RelationManagers;
use App\Models\WholesalePackage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WholesalePackageResource extends Resource
{
    protected static ?string $model = WholesalePackage::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Carga Inicial';

    public static function getModelLabel(): string
    {
        return __('filament/resources/wholesale_package.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament/resources/wholesale_package.plural_label');
    }

    public static function getAttributeLabel(string $attribute): string
    {
        return __("filament/resources/wholesale_package.{$attribute}");
    }

    public static function inputForm(): array
    {
        return [
            Forms\Components\TextInput::make('quantity')->label(static::getAttributeLabel('quantity'))->autofocus()
                ->required()->numeric()
                ->minValue(0),
            // ->live()
            // ->afterStateUpdated(fn (Get $get, Set $set, string $state) => $set('name', "{$get('quantity')} {$get('unit_id')}")),
            Forms\Components\Select::make('unit_id')->label(static::getAttributeLabel('unit'))
                ->relationship(name: 'unit', titleAttribute: 'name')
                ->preload(),
            // ->live()
            // ->afterStateUpdated(fn (Get $get, Set $set, string $state) => $set('name', "{$get('quantity')} {$get('unit_id')}")),
            // Forms\Components\TextInput::make('name')->label(static::getAttributeLabel('name'))
            //     ->required(),
        ];
    }

    public static function tableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')->label(static::getAttributeLabel('name')),
            Tables\Columns\TextColumn::make('quantity')->label(static::getAttributeLabel('quantity')),
            Tables\Columns\TextColumn::make('unit.name')->label(static::getAttributeLabel('unit')),
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
            'index' => Pages\ListWholesalePackages::route('/'),
            'create' => Pages\CreateWholesalePackage::route('/create'),
            'edit' => Pages\EditWholesalePackage::route('/{record}/edit'),
        ];
    }
}
