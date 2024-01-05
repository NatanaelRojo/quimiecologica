<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendingOrderResource\Pages;
use App\Filament\Resources\PendingOrderResource\RelationManagers;
use App\Models\PendingOrder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PendingOrderResource extends Resource
{
    protected static ?string $model = PendingOrder::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
            Forms\Components\Select::make('product_id')
                ->label('Product')
                ->relationship(
                    name: 'product',
                    titleAttribute: 'name',
                )->preload()
                ->searchable()
                ->required(),
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(PendingOrderResource::inputForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListPendingOrders::route('/'),
            'create' => Pages\CreatePendingOrder::route('/create'),
            'edit' => Pages\EditPendingOrder::route('/{record}/edit'),
        ];
    }
}
