<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PurchaseOrderResource\Pages;
use App\Filament\Resources\PurchaseOrderResource\RelationManagers;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Laravel\Prompts\SearchPrompt;

class PurchaseOrderResource extends Resource
{
    protected static ?string $model = PurchaseOrder::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    public static function inputForm(): array
    {
        return [
            Forms\Components\Select::make('service_id')->label('Service')
                ->relationship(
                    name: 'service',
                    titleAttribute: 'name'
                )->preload()
                ->searchable()
                ->required()
                ->createOptionForm(ServiceResource::inputForm()),
            Forms\Components\Select::make('gender_id')->label('Gender ')
                ->relationship(
                    name: 'gender',
                    titleAttribute: 'name'
                )->preload()
                ->searchable()
                ->required()
                ->createOptionForm(GenderResource::inputForm()),
            Forms\Components\Select::make('category_id')->label('Category')
                ->relationship(
                    name: 'category',
                    titleAttribute: 'name'
                )->preload()
                ->searchable()
                ->required()
                ->createOptionForm(CategoryResource::inputForm()),
            Forms\Components\TextInput::make('owner_firstname')->label('Owner firstname')
                ->required()->maxLength(30),
            Forms\Components\TextInput::make('owner_lastname')->label('Owner lastname')
                ->required()->maxLength(30),
            Forms\Components\TextInput::make('owner_phone_number')->label('Owner phone number')
                ->tel()->required(),
            Forms\Components\TextInput::make('owner_state')->label('Owner state')
                ->required(),
            Forms\Components\TextInput::make('owner_city')->label('Owner city')
                ->required(),
            Forms\Components\TextInput::make('reference_number')->label('Reference')
                ->required(),
            Forms\Components\FileUpload::make('image')->label('Baucher')
                ->acceptedFileTypes(['application/pdf', 'image/png', 'image/jpeg']),
            Forms\Components\TextInput::make('total_price')->label('Total price')
                ->required()->numeric()
                ->prefix('$'),
            Forms\Components\CheckboxList::make('products')->label('Products')
                ->relationship(titleAttribute: 'name')
                ->searchable()->noSearchResultsMessage('No products found')->SearchPrompt('Search products')
                ->columns(2)
                ->bulkToggleable(),
        ];
    }

    public static function form(Form $form): Form
    {
        return $form->schema(PurchaseOrderResource::inputForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Product name'),
                Tables\Columns\TextColumn::make('owner_firstname')->label('Owner first name'),
                Tables\Columns\TextColumn::make('owner_lastname')->label('Owner last name'),
                Tables\Columns\TextColumn::make('reference')->label('Baucher reference'),
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
            'index' => Pages\ListPurchaseOrders::route('/'),
            'create' => Pages\CreatePurchaseOrder::route('/create'),
            'edit' => Pages\EditPurchaseOrder::route('/{record}/edit'),
        ];
    }
}
