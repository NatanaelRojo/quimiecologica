<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MeasureResource\Pages;
use App\Filament\Resources\MeasureResource\RelationManagers;
use App\Models\Measure;
use App\Models\Unit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MeasureResource extends Resource
{
    protected static ?string $model = Measure::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __('filament/resources/measure.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament/resources/measure.plural_label');
    }

    public static function getAttributeLabel(string $attribute): string
    {
        return __("filament/resources/measure.{$attribute}");
    }

    public static function inputForm(): array
    {
        return [
            Forms\Components\Select::make('type')->label(static::getAttributeLabel('type'))
                ->options([
                    'Tallas' => 'Tallas',
                    'Unidades' => 'Unidades',
                ])
                ->live(),
            Forms\Components\TextInput::make('quantity')->label(static::getAttributeLabel('quantity'))->autofocus()
                ->required()->numeric()
                ->minValue(0)
                ->live()
                ->afterStateUpdated(fn (Get $get, Set $set, ?string $state) => $set('name', "{$get('quantity')} {$get('unit')}"))
                ->visible(fn (Get $get): bool => $get('type') === 'Unidades' ? true : false),
            Forms\Components\Select::make('unit')->label(static::getAttributeLabel('unit'))
                ->options(function (): array {
                    $options = array();
                    $units = Unit::query()->orderBy('name')->get();
                    foreach ($units as $unit) {
                        $options[$unit->name] = $unit->name;
                    }
                    return $options;
                })
                ->live()
                ->afterStateUpdated(function (Get $get, Set $set, ?string $state): void {
                    $presentationName = '';
                    if ($get('quantity') != 1) {
                        $presentationName = "{$get('unit')}s";
                    }
                    $set('name', "{$get('quantity')} {$presentationName}");
                })
                ->visible(fn (Get $get): bool => $get('type') === 'Unidades' ? true : false),
        ];
    }

    public static function tableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')->label(static::getAttributeLabel('name')),
            // Tables\Columns\TextColumn::make('quantity')->label(static::getAttributeLabel('quantity')),
            // Tables\Columns\TextColumn::make('unit')->label(static::getAttributeLabel('unit')),
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
            'index' => Pages\ListMeasures::route('/'),
            'create' => Pages\CreateMeasure::route('/create'),
            'edit' => Pages\EditMeasure::route('/{record}/edit'),
        ];
    }
}
