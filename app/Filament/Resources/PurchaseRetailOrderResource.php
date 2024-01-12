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

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Retail';

    protected static ?string $navigationGroup = 'Orders';

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
            Forms\Components\TextInput::make('owner_firstname')->label('Owner firstname')->autofocus()
                ->required()->maxLength(30),
            Forms\Components\TextInput::make('owner_lastname')->label('Owner lastname')
                ->required()->maxLength(30),
            Forms\Components\TextInput::make('owner_id')->label('Owner ID')
                ->required(),
            Forms\Components\TextInput::make('owner_phone_number')->label('Owner phone number')
                ->tel()->required(),
            Forms\Components\TextInput::make('owner_state')->label('Owner state')
                ->required(),
            Forms\Components\TextInput::make('owner_city')->label('Owner city')
                ->required(),
            Forms\Components\TextInput::make('owner_address')->label('Owner address')
                ->required(),
            Forms\Components\TextInput::make('reference_number')->label('Reference')
                ->required(),
            Forms\Components\FileUpload::make('image')->label('Baucher')
                ->acceptedFileTypes(['application/pdf', 'image/png', 'image/jpeg']),
            Forms\Components\TextInput::make('total_price')->label('Total price')
                ->required()->numeric()->minValue(1)
                ->prefix('$'),
            Forms\Components\CheckboxList::make('products')->label('Products')
                ->relationship(titleAttribute: 'name')
                ->searchable()->noSearchResultsMessage('No products found')->SearchPrompt('Search products')
                ->columns(2)
                ->bulkToggleable(),
        ];
    }

    public static function tableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('owner_firstname')->label('Owner first name')
                ->searchable(query: function (Builder $query, string $search) {
                    return $query->where('owner_firstname', 'like', "%{$search}%");
                }),
            Tables\Columns\TextColumn::make('owner_lastname')->label('Owner last name')
                ->searchable(query: function (Builder $query, string $search) {
                    return $query->where('owner_lastname', 'like', "%{$search}%");
                }),
            Tables\Columns\TextColumn::make('owner_id')->label('Owner ID')
                ->searchable(query: function (Builder $query, string $search) {
                    return $query->where('owner_id', 'like', "%{$search}%");
                }),
            Tables\Columns\TextColumn::make('reference_number')->label('Baucher reference')
                ->copyable(),
            Tables\Columns\TextColumn::make('total_price')->label('Total price')
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
