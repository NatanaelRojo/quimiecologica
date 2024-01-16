<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PurchaseWholesaleOrderResource\Pages;
use App\Filament\Resources\PurchaseWholesaleOrderResource\RelationManagers;
use App\Models\PurchaseWholesaleOrder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PurchaseWholesaleOrderResource extends Resource
{
    protected static ?string $model = PurchaseWholesaleOrder::class;

    public static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationLabel = 'Al mayor';

    protected static ?string $navigationGroup = 'Órdenes';

    public static function getModelLabel(): string
    {
        return __('filament/resources/purchase_wholesale_order.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament/resources/purchase_wholesale_order.plural_label');
    }

    public static function getAttributeLabel(string $attribute): string
    {
        return __("filament/resources/purchase_wholesale_order.{$attribute}");
    }

    public static function inputForm(): array
    {
        return [
            Forms\Components\TextInput::make('owner_firstname')->label(static::getAttributeLabel('owner_firstname'))->autofocus()
                ->required()->maxLength(30),
            Forms\Components\TextInput::make('owner_lastname')->label(static::getAttributeLabel('owner_lastname'))
                ->required()->maxLength(30),
            Forms\Components\TextInput::make('owner_id')->label(static::getAttributeLabel('owner_id'))
                ->required(),
            Forms\Components\TextInput::make('owner_phone_number')->label(static::getAttributeLabel('owner_phone_number'))
                ->tel()->required(),
            Forms\Components\TextInput::make('owner_state')->label(static::getAttributeLabel('owner_state'))
                ->required(),
            Forms\Components\TextInput::make('owner_city')->label(static::getAttributeLabel('owner_city'))
                ->required(),
            Forms\Components\TextInput::make('owner_address')->label(static::getAttributeLabel('owner_address'))
                ->required(),
            Forms\Components\TextInput::make('reference_number')->label(static::getAttributeLabel('reference_number'))
                ->required(),
            Forms\Components\FileUpload::make('image')->label(static::getAttributeLabel('baucher'))
                ->acceptedFileTypes(['application/pdf', 'image/png', 'image/jpeg']),
            Forms\Components\TextInput::make('total_price')->label(static::getAttributeLabel('total_price'))
                ->required()->numeric()->minValue(1)
                ->prefix('$'),
            Forms\Components\Select::make('product_id')->label(static::getAttributeLabel('product'))
                ->required()
                ->relationship(name: 'product', titleAttribute: 'name')->preload()
                ->searchable()->noSearchResultsMessage('No products found')->SearchPrompt('Search product')
                ->createOptionForm(ProductResource::inputForm()),
            Forms\Components\Select::make('unit')->label(static::getAttributeLabel('unit'))
                ->options([
                    'Litro',
                    'Kilo',
                ])->required(),
            Forms\Components\TextInput::make('product_quantity')->label(static::getAttributeLabel('product_quantity'))
                ->required()->minValue(1)->numeric(),
        ];
    }

    public static function tableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('owner_firstname')->label(static::getAttributeLabel('owner_firstname'))
                ->searchable(query: function (Builder $query, string $search) {
                    return $query->where('owner_firstname', 'like', "%{$search}%");
                }),
            Tables\Columns\TextColumn::make('owner_lastname')->label(static::getAttributeLabel('owner_lastname'))
                ->searchable(query: function (Builder $query, string $search) {
                    return $query->where('owner_lastname', 'like', "%{$search}%");
                }),
            Tables\Columns\TextColumn::make('owner_id')->label(static::getAttributeLabel('owner_id'))
                ->searchable(query: function (Builder $query, string $search) {
                    return $query->where('owner_id', 'like', "%{$search}%");
                }),
            Tables\Columns\TextColumn::make('product.name')->label(static::getAttributeLabel('product'))
                ->searchable(),
            Tables\Columns\TextColumn::make('reference_number')->label(static::getAttributeLabel('reference_number'))->copyable(),
            Tables\Columns\TextColumn::make('total_price')->label(static::getAttributeLabel('total_price'))
                ->money('USD')->sortable(),
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
        return $form->schema(PurchaseWholesaleOrderResource::inputForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(PurchaseWholesaleOrderResource::tableColumns())
            ->filters([
                //
            ])
            ->actions(PurchaseRetailOrderResource::tableActions())
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
            'index' => Pages\ListPurchaseWholesaleOrders::route('/'),
            'create' => Pages\CreatePurchaseWholesaleOrder::route('/create'),
            'edit' => Pages\EditPurchaseWholesaleOrder::route('/{record}/edit'),
        ];
    }
}
