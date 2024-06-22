<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendingOrderResource\Pages;
use App\Filament\Resources\PendingOrderResource\RelationManagers;
use App\Models\PendingOrder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PendingOrderResource extends Resource
{
    protected static bool $hasTitleCaseModelLabel = false;
    protected static ?string $model = PendingOrder::class;
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationLabel = 'Pendientes';
    protected static ?string $navigationGroup = 'Órdenes';

    public static function getModelLabel(): string
    {
        return __('filament/resources/pending_order.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament/resources/pending_order.plural_label');
    }

    public static function getAttributeLabel(string $attribute): string
    {
        return __("filament/resources/pending_order.{$attribute}");
    }

    public static function infolistEntries(): array
    {
        return [
            Infolists\Components\Tabs::make('tabs')
                ->tabs([
                    Infolists\Components\Tabs\Tab::make(static::getAttributeLabel('owner'))
                        ->schema([
                            Infolists\Components\Section::make(static::getAttributeLabel('personal_data'))
                                ->description(static::getAttributeLabel('personal_data_description'))
                                ->schema([
                                    Infolists\Components\TextEntry::make('owner_firstname')
                                        ->label(static::getAttributeLabel('owner_firstname')),
                                    Infolists\Components\TextEntry::make('owner_lastname')
                                        ->label(static::getAttributeLabel('owner_lastname')),
                                    Infolists\Components\TextEntry::make('owner_id')
                                        ->label(static::getAttributeLabel('owner_id')),
                                    Infolists\Components\TextEntry::make('owner_email')
                                        ->label(static::getAttributeLabel('owner_email'))
                                        ->copyable(),
                                    Infolists\Components\TextEntry::make('owner_phone_number')
                                        ->label(static::getAttributeLabel('owner_phone_number'))
                                        ->copyable(),
                                ])->collapsible(),
                            Infolists\Components\Section::make(static::getAttributeLabel('location_data'))
                                ->description(static::getAttributeLabel('location_data_description'))
                                ->schema([
                                    Infolists\Components\TextEntry::make('owner_state')->label(static::getAttributeLabel('owner_state')),
                                    Infolists\Components\TextEntry::make('owner_city')->label(static::getAttributeLabel('owner_city')),
                                    Infolists\Components\TextEntry::make('owner_address')->label(static::getAttributeLabel('owner_address'))
                                ])->collapsible(),
                        ]),
                    Infolists\Components\Tabs\Tab::make(static::getAttributeLabel('pending_order'))
                        ->schema([
                            Infolists\Components\TextEntry::make('id')
                                ->label(static::getAttributeLabel('code'))
                                ->copyable(),
                            InfoLists\Components\TextEntry::make('created_at')
                                ->label(static::getAttributeLabel('created_at'))
                                ->date('d/m/Y'),
                            Infolists\Components\TextEntry::make('status')->label(static::getAttributeLabel('status')),
                        ]),
                    Infolists\Components\Tabs\Tab::make(static::getAttributeLabel('requirements'))
                        ->schema([
                            Infolists\Components\TextEntry::make('owner_request')
                                ->label(static::getAttributeLabel('owner_request')),
                            Infolists\Components\TextEntry::make('deadline')
                                ->label(static::getAttributeLabel('deadline')),
                        ]),
                ]),
        ];
    }

    public static function infoList(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema(static::infolistEntries());
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
                ->required()->maxLength(20),
            Forms\Components\TextInput::make('owner_email')->label(static::getAttributeLabel('owner_email'))
                ->email()->required(),
            Forms\Components\TextInput::make('owner_phone_number')->label(static::getAttributeLabel('owner_phone_number'))
                ->tel()->required(),
            Forms\Components\TextInput::make('owner_state')->label(static::getAttributeLabel('owner_state'))
                ->required(),
            Forms\Components\TextInput::make('owner_city')->label(static::getAttributeLabel('owner_city'))
                ->required(),
            Forms\Components\TextInput::make('owner_address')->label(static::getAttributeLabel('owner_address'))
                ->required(),
            Forms\Components\TextInput::make('owner_request')->label(static::getAttributeLabel('owner_request'))
                ->required(),
            // Forms\Components\Select::make('product_id')
            //     ->label('Product')
            //     ->relationship(
            //         name: 'product',
            //         titleAttribute: 'name',
            //     )->preload()
            //     ->searchable()
            //     ->required(),
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
                ->copyable()
                ->searchable(query: function (Builder $query, string $search) {
                    return $query->where('owner_id', 'like', "%{$search}%");
                }),
            Tables\Columns\TextColumn::make('owner_email')->label(static::getAttributeLabel('owner_email'))
                ->copyable()
                ->searchable(query: function (Builder $query, string $search) {
                    return $query->where('owner_email', 'like', "%{$search}%");
                }),
            Tables\Columns\TextColumn::make('owner_request')->label(static::getAttributeLabel('owner_request'))->words(10),
        ];
    }

    public static function tableActions(): array
    {
        return [
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make()
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
            ->columns(PendingOrderResource::tableColumns())
            ->filters([
                //
            ])
            ->actions(PendingOrderResource::tableActions())
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
            'view' => Pages\ViewPendingOrder::route('/{record}'),
            'edit' => Pages\EditPendingOrder::route('/{record}/edit'),
        ];
    }
}
