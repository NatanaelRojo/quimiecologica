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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function inputForm(): array
    {
        return [
            Forms\Components\Select::make('service_id')->label('Service')
                ->relationship('service', 'name')->searchable()->preload()
                ->createOptionForm(ServiceResource::inputForm()),
            Forms\Components\Select::make('category_id')->label('Category')
                ->relationship('category', 'name')->searchable()->preload()
                ->createOptionForm(CategoryResource::inputForm()),
            Forms\Components\Select::make('gender_id')->label('Gender')
                ->relationship('gender', 'name')->searchable()->preload()
                ->createOptionForm(GenderResource::inputForm()),
            Forms\Components\TextInput::make('name')->autofocus()->label('Product name')
                ->required()->maxLength(255)->minLength(4)
                ->columnSpan('full'),
            Forms\Components\Textarea::make('description')->label('Product description')
                ->columnSpan('full'),
            Forms\Components\TextInput::make('price')->label('Product price')
                ->required()->numeric()
                ->prefix('$'),
            Forms\Components\FileUpload::make('image_urls')
                ->label('Product images')
                ->multiple()
                ->image()
                ->minFiles(1)
                ->maxFiles(5),
        ];
    }

    public static function form(Form $form): Form
    {
        return $form->schema(ProductResource::inputForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Product name'),
                Tables\Columns\TextColumn::make('description')->label('Product description')
                    ->words(20),
                Tables\Columns\TextColumn::make('price')->money('DOL')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
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
