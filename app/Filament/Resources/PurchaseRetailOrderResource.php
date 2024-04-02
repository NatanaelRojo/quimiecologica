<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PurchaseRetailOrderResource\Pages;
use App\Filament\Resources\PurchaseRetailOrderResource\RelationManagers;
use App\Models\PurchaseRetailOrder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PurchaseRetailOrderResource extends Resource
{
    protected static ?string $model = PurchaseRetailOrder::class;
    protected static ?int $navigationSort = 0;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationLabel = 'Al detal';
    protected static ?string $navigationGroup = 'Órdenes';
    protected static bool $shouldRegisterNavigation = false;

    public static function getModelLabel(): string
    {
        return __('filament/resources/purchase_retail_order.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament/resources/purchase_retail_order.plural_label');
    }

    public static function getAttributeLabel(string $attribute): string
    {
        return __("filament/resources/purchase_retail_order.{$attribute}");
    }

    public static function inputForm(): array
    {
        return [
            // Forms\Components\Select::make('service_id')->label('Service')
            //     ->relationship(
            //         name: 'service',
            //         titleAttribute: 'name'
            //     )->preload()
            //     ->searchable()
            //     ->required()
            //     ->createOptionForm(ServiceResource::inputForm()),
            // Forms\Components\Select::make('gender_id')->label('Gender ')
            //     ->relationship(
            //         name: 'gender',
            //         titleAttribute: 'name'
            //     )->preload()
            //     ->searchable()
            //     ->required()
            //     ->createOptionForm(GenderResource::inputForm()),
            // Forms\Components\Select::make('category_id')->label('Category')
            //     ->relationship(
            //         name: 'category',
            //         titleAttribute: 'name'
            //     )->preload()
            //     ->searchable()
            //     ->required()
            //     ->createOptionForm(CategoryResource::inputForm()),
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
            Forms\Components\CheckboxList::make('products')->label(static::getAttributeLabel('products'))
                ->relationship(titleAttribute: 'name')
                ->searchable()->noSearchResultsMessage('No products found')->SearchPrompt('Search products')
                ->columns(2)
                ->bulkToggleable(),
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
            Tables\Columns\TextColumn::make('reference_number')->label(static::getAttributeLabel('reference_number'))
                ->copyable(),
            Tables\Columns\TextColumn::make('total_price')->label(static::getAttributeLabel('total_price'))
                ->money('USD')
                ->sortable(),
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
        return $form->schema(PurchaseRetailOrderResource::inputForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(PurchaseRetailOrderResource::tableColumns())
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
            'index' => Pages\ListPurchaseRetailOrders::route('/'),
            'create' => Pages\CreatePurchaseRetailOrder::route('/create'),
            'edit' => Pages\EditPurchaseRetailOrder::route('/{record}/edit'),
        ];
    }
}
