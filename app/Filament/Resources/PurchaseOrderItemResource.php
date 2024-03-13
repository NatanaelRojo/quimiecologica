<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PurchaseOrderItemResource\Pages;
use App\Filament\Resources\PurchaseOrderItemResource\RelationManagers;
use App\Models\Product;
use App\Models\PurchaseOrderItem;
use App\Models\Unit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PurchaseOrderItemResource extends Resource
{
    protected static ?string $model = PurchaseOrderItem::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static bool $shouldRegisterNavigation = false;

    public static function getModelLabel(): string
    {
        return __('filament/resources/purchase_item.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament/resources/purchase_item.plural_label');
    }

    public static function getAttributeLabel(string $attribute): string
    {
        return __("filament/resources/purchase_item.{$attribute}");
    }

    public static function inputForm(): array
    {
        return [
            Forms\Components\Select::make('product_name')->label(static::getAttributeLabel('product_name'))
                ->required()
                ->options(function (): array {
                    $options = array();
                    $products = Product::all();
                    foreach ($products as $product) {
                        // array_push($options, "{$product->name}");
                        $options[$product->name] = $product->name;
                    }
                    return $options;
                }),
            Forms\Components\Select::make('purchase_type')->label(static::getAttributeLabel('purchase_type'))
                ->required()
                ->options([
                    'Al mayor' => 'Al mayor',
                    'Al detal' => 'Al detal',
                ]),
            Forms\Components\TextInput::make('product_quantity')->label(static::getAttributeLabel('product_quantity'))
                ->required()
                ->numeric()->minValue(1),
            Forms\Components\Select::make('product_unit')->label(static::getAttributeLabel('product_unit'))
                ->required()
                ->options(function (): array {
                    $options = array();
                    foreach (Unit::all('name') as $unit) {
                        // array_push($options, $unit->name);
                        $options[$unit->name] = $unit->name;
                    }
                    // array_push($options, 'No aplica');
                    $options["No aplica"] = 'No aplica';
                    return $options;
                }),
            Forms\Components\TextInput::make('product_price')->label(static::getAttributeLabel('product_price'))
                ->required()->numeric()->minValue(1)
                ->prefix('$')
        ];
    }

    public static function tableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('product_name')->label(static::getAttributeLabel('product_name')),
            Tables\Columns\TextColumn::make('purchase_type')->label(static::getAttributeLabel('purchase_type')),
            Tables\Columns\TextColumn::make('product_price')->label(static::getAttributeLabel('product_price'))
                ->money('USD')->sortable(),
            Tables\Columns\TextColumn::make('product_quantity')->label(static::getAttributeLabel('product_quantity')),
            Tables\Columns\TextColumn::make('product_unit')->label(static::getAttributeLabel('product_unit')),
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
            'index' => Pages\ListPurchaseOrderItems::route('/'),
            'create' => Pages\CreatePurchaseOrderItem::route('/create'),
            'edit' => Pages\EditPurchaseOrderItem::route('/{record}/edit'),
        ];
    }
}
