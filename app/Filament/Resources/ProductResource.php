<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Filament\Resources\ProductResource\RelationManagers\ImagesRelationManager;
use App\Filament\Resources\PurchaseOrderResource\RelationManagers\ProductsRelationManager;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationGroup = 'Elementos Base';

    public static function getModelLabel(): string
    {
        return __('filament/resources/product.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament/resources/product.plural_label');
    }

    public static function getAttributeLabel(string $attribute): string
    {
        return __("filament/resources/product.{$attribute}");
    }

    public static function inputForm(): array
    {
        return [
            // Forms\Components\Select::make('service_id')->label('Service')
            //     ->relationship('service', 'name')->searchable()->preload()
            //     ->createOptionForm(ServiceResource::inputForm()),
            Forms\Components\Select::make('categories')->label(static::getAttributeLabel('categories'))
                ->required()
                ->multiple()->relationship('categories', 'name')->searchable()->preload()
                ->createOptionForm(CategoryResource::inputForm()),
            Forms\Components\Select::make('genders')->label(static::getAttributeLabel('genders'))
                ->required()
                ->relationship('genders', 'name')
                ->multiple()->searchable()->preload()
                ->createOptionForm(GenderResource::inputForm()),
            Forms\Components\Select::make('type_sales')->label(static::getAttributeLabel('type_sales'))
                ->required()
                ->relationship(name: 'typeSales', titleAttribute: 'name')
                ->multiple()->searchable()->preload()
                ->createOptionForm(TypeSaleResource::inputForm()),
            Forms\Components\TextInput::make('name')->autofocus()->label(static::getAttributeLabel('name'))
                ->required()->maxLength(255)->minLength(4)
                ->columnSpan('full'),
            Forms\Components\Textarea::make('description')->label(static::getAttributeLabel('description'))
                ->required()
                ->columnSpan('full'),
            Forms\Components\TextInput::make('stock')->label(static::getAttributeLabel('stock'))
                ->required()->numeric()->minValue(1),
            Forms\Components\TextInput::make('price')->label(static::getAttributeLabel('price'))
                ->required()->numeric()->minValue(1)
                ->prefix('$'),
            Forms\Components\FileUpload::make('image_urls')->label(static::getAttributeLabel('images'))
                ->multiple()
                ->image()
                ->minFiles(1)
                ->maxFiles(5)
                ->reorderable(),
        ];
    }

    public static function tableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('categories.name')->label(static::getAttributeLabel('categories'))->searchable(),
            Tables\Columns\TextColumn::make('genders.name')->label(static::getAttributeLabel('genders'))->searchable(),
            Tables\Columns\TextColumn::make('typeSales.name')->label(static::getAttributeLabel('type_sales'))->searchable(),
            Tables\Columns\TextColumn::make('name')->label(static::getAttributeLabel('name'))
                ->searchable(query: function (Builder $query, string $search): Builder {
                    return $query->where('name', 'like', "%{$search}%");
                }),
            Tables\Columns\TextColumn::make('description')->label(static::getAttributeLabel('description'))
                ->words(20),
            Tables\Columns\TextColumn::make('stock')->label(static::getAttributeLabel('stock')),
            Tables\Columns\TextColumn::make('price')->label(static::getAttributeLabel('price'))
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
        return $form->schema(ProductResource::inputForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(ProductResource::tableColumns())
            ->filters([
                //
            ])
            ->actions(ProductResource::tableActions())
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // ImagesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
