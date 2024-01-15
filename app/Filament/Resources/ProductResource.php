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

    public static function inputForm(): array
    {
        return [
            // Forms\Components\Select::make('service_id')->label('Service')
            //     ->relationship('service', 'name')->searchable()->preload()
            //     ->createOptionForm(ServiceResource::inputForm()),
            Forms\Components\Select::make('category_id.name')->label('Category')
                ->multiple()->relationship('categories', 'name')->searchable()->preload()
                ->createOptionForm(CategoryResource::inputForm()),
            Forms\Components\Select::make('gender_id')->label('Gender')
                ->relationship('genders', 'name')
                ->multiple()->searchable()->preload()
                ->createOptionForm(GenderResource::inputForm()),
            Forms\Components\TextInput::make('name')->autofocus()->label('Product name')
                ->required()->maxLength(255)->minLength(4)
                ->columnSpan('full'),
            Forms\Components\Textarea::make('description')->label('Product description')
                ->required()
                ->columnSpan('full'),
            Forms\Components\TextInput::make('price')->label('Product price')
                ->required()->numeric()->minValue(1)
                ->prefix('$'),
            Forms\Components\FileUpload::make('image_urls')
                ->label('Product images')
                ->multiple()
                ->image()
                ->minFiles(1)
                ->maxFiles(5),
        ];
    }

    public static function tableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('gender.name')->label('Gender product')->searchable(),
            Tables\Columns\TextColumn::make('category.name')->label('Category product')->searchable(),
            Tables\Columns\TextColumn::make('name')->label('Product name')
                ->searchable(query: function (Builder $query, string $search) {
                    return $query->where('name', 'like', "%{$search}%");
                }),
            Tables\Columns\TextColumn::make('description')->label('Product description')
                ->words(20),
            Tables\Columns\TextColumn::make('price')->money('USD')->sortable(),
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
