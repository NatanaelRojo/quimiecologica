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
    protected static bool $hasTitleCaseModelLabel = false;
    protected static ?string $model = TypeSale::class;
    protected static ?string $navigationIcon = 'heroicon-o-wallet';
    protected static ?string $navigationGroup = 'Carga Inicial';

    /**
     * Get the displayable singular label of the resource.
     * 
     * @return string
     */
    public static function getModelLabel(): string
    {
        return __('/filament/resources/type_sale.label');
    }

    /**
     * Get the displayable plural label of the resource.
     * 
     * @return string
     */
    public static function getPluralModelLabel(): string
    {
        return __('/filament/resources/type_sale.plural_label');
    }

    /**
     * Get the label for the given attribute.
     * 
     * @param  string  $attribute
     * @return string
     */
    public static function getAttributeLabel(string $attribute): string
    {
        return __("filament/resources/type_sale.{$attribute}");
    }

    /**
     * Get the form fields displayed by the resource.
     *
     * @return array
     */
    public static function inputForm(): array
    {
        return [
            Forms\Components\Toggle::make('is_active')
                ->label(function (?bool $state): string {
                    if (!$state) {
                        return static::getAttributeLabel('inactive');
                    }
                    return static::getAttributeLabel('active');
                })->required()
                ->onColor('success')
                ->offColor('danger')
                ->columnSpan('full')
                ->live(),
            Forms\Components\TextInput::make('name')->autofocus()->label(static::getAttributeLabel('name'))
                ->required()
                ->columnSpan('full'),
            Forms\Components\Textarea::make('description')->label(static::getAttributeLabel('description'))
                ->columnSpan('full'),
        ];
    }

    /**
     * Get the table columns displayed by the resource.
     *
     * @return array
     */
    public static function tableColumns(): array
    {
        return [
            Tables\Columns\ToggleColumn::make('is_active')->label(static::getAttributeLabel('is_active')),
            Tables\Columns\TextColumn::make('name')->label(static::getAttributeLabel('name')),
            Tables\Columns\TextColumn::make('description')->label(static::getAttributeLabel('description'))
                ->words(20),
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array
     */
    public static function tableActions(): array
    {
        return [
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make()
                ->hidden(fn (TypeSale $record): bool => !$record->deletable),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public static function tableFilters(): array
    {
        return [
            Tables\Filters\TernaryFilter::make('is_active')->label(static::getAttributeLabel('is_active'))
                ->trueLabel(static::getAttributeLabel('active'))->falseLabel(static::getAttributeLabel('inactive'))->placeholder(static::getAttributeLabel('all')),
        ];
    }

    /**
     * Get the form for creating or editing a resource.
     * 
     * @param Form $form
     * @return Form
     */
    public static function form(Form $form): Form
    {
        return $form->schema(static::inputForm());
    }

    /**
     * Get the table for the resource.
     * 
     * @param Table $table
     * @return Table
     */
    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
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

    /**
     * Get the actions available for the resource.
     * 
     * @return array
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTypeSales::route('/'),
            'create' => Pages\CreateTypeSale::route('/create'),
            'edit' => Pages\EditTypeSale::route('/{record}/edit'),
        ];
    }
}
