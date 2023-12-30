<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('service_id')->label('Service')->relationship('service', 'name')->searchable()->preload()->createOptionForm([
                    Forms\Components\TextInput::make('name')->autofocus()->label('Service name')->required()->maxLength(20),
                    Forms\Components\Textarea::make('description')->label('Service description'),
                ]),
                Forms\Components\Select::make('category_id')->label('Category')->relationship('category', 'name')->createOptionForm([
                    Forms\Components\TextInput::make('name')->autofocus()->label('Category name')->required()->maxLength(20),
                ]),
                Forms\Components\Select::make('gender_id')->label('Gender')->relationship('gender', 'name')->createOptionForm([
                    Forms\Components\TextInput::make('name')->autofocus()->label('Gender name')->required()->maxLength(20),
                ]),
                Forms\Components\TextInput::make('name')->autofocus()->label('Product name')->required()->maxLength(255)->columnSpan('full'),
                Forms\Components\Textarea::make('description')->label('Product description')->columnSpan('full'),
                Forms\Components\TextInput::make('price')->label('Product price')->required()->numeric()->prefix('$'),
                Forms\Components\FileUpload::make('image_urls')->multiple()->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Name'),
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
            //
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
