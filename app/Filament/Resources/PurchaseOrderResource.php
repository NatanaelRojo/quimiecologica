<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PurchaseOrderResource\Pages;
use App\Filament\Resources\PurchaseOrderResource\RelationManagers;
use App\Filament\Resources\PurchaseOrderResource\RelationManagers\PurchaseOrderItemsRelationManager;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Unit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PurchaseOrderResource extends Resource
{
    protected static ?string $model = PurchaseOrder::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Órdenes';
    protected static ?string $navigationLabel = 'General';

    public static array $statusOptions = [
        'Aprobada' => 'Aprobada',
        'En espea' => 'En espera',
        'Rechazada' => 'Rechazada',
    ];

    public static function getModelLabel(): string
    {
        return __('filament/resources/purchase_order.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament/resources/purchase_order.plural_label');
    }

    public static function getAttributeLabel(string $attribute): string
    {
        return __("filament/resources/purchase_order.{$attribute}");
    }

    public static function inputForm(): array
    {
        return [
            Forms\Components\Select::make('status')->label(static::getAttributeLabel('status'))
                ->required()
                ->options([
                    'Aprobada' => 'Aprobada',
                    'En espera' => 'En espera',
                    'Rechazada' => 'Rechazada',
                ])
                ->columnSpan('full'),
            Forms\Components\TextInput::make('owner_firstname')->label(static::getAttributeLabel('owner_firstname'))->autofocus()
                ->required()->maxLength(30),
            Forms\Components\TextInput::make('owner_lastname')->label(static::getAttributeLabel('owner_lastname'))
                ->required()->maxLength(30),
            Forms\Components\TextInput::make('owner_id')->label(static::getAttributeLabel('owner_id'))
                ->required(),
            Forms\Components\TextInput::make('owner_email')->label(static::getAttributeLabel('owner_email'))
                ->required()->email(),
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
                ->acceptedFileTypes(['application/pdf', 'image/png', 'image/jpeg', 'image/jpg']),
            Forms\Components\TextInput::make('total_price')->label(static::getAttributeLabel('total_price'))
                ->required()->numeric()->minValue(1)
                ->prefix('$'),
            // Forms\Components\CheckboxList::make('items')->label(static::getAttributeLabel('products'))
            //     ->relationship(name: 'purchaseOrderItems', titleAttribute: 'product_name')
            //     ->searchable()->noSearchResultsMessage(static::getAttributeLabel('not_found'))->SearchPrompt(static::getAttributeLabel('search_message'))
            //     ->columns(2)
            //     ->bulkToggleable(),
            Forms\Components\Repeater::make('products_info')->label(static::getAttributeLabel('products_info'))
                ->required()
                ->columnSpan('full')
                ->schema([
                    Forms\Components\Select::make('product_id')->label(static::getAttributeLabel('product_name'))
                        ->options(function (): array {
                            $options = array();
                            foreach (Product::all(['id', 'name']) as $product) {
                                $options[$product->id] = $product->name;
                            }
                            return $options;
                        }),
                    Forms\Components\TextInput::make('product_quantity')->label(static::getAttributeLabel('product_quantity'))
                        ->required()
                        ->numeric()->minValue(1),
                    Forms\Components\Select::make('sale_type')->label(static::getAttributeLabel('sale_type'))
                        ->required()
                        ->options([
                            'Al detal' => 'Al detal',
                            'Al mayor' => 'Al mayor',
                        ]),
                    Forms\Components\Select::make('product_unit')->label(static::getAttributeLabel('product_unit'))
                        ->required()
                        ->options(function (): array {
                            $options = array();
                            foreach (Unit::all('name') as $unit) {
                                $options[$unit->name] = $unit->name;
                            }
                            $options['No aplica'] = 'No aplica';
                            return $options;
                        }),
                ])->reorderable(false)->collapsible()
                ->minItems(1)
                ->grid(2),
        ];
    }

    public static function infolistEntries(): array
    {
        return [
            Infolists\Components\Tabs::make('tabs')->tabs([
                Infolists\Components\Tabs\Tab::make(static::getAttributeLabel('owner'))
                    ->schema([
                        Infolists\Components\Section::make(static::getAttributeLabel('personal_data'))
                            ->description(static::getAttributeLabel('personal_data_description'))
                            ->schema([
                                Infolists\Components\TextEntry::make('owner_firstname')->label(static::getAttributeLabel('owner_firstname')),
                                Infolists\Components\TextEntry::make('owner_lastname')->label(static::getAttributeLabel('owner_lastname')),
                                Infolists\Components\TextEntry::make('owner_id')->label(static::getAttributeLabel('owner_id')),
                                Infolists\Components\TextEntry::make('owner_email')->label(static::getAttributeLabel('owner_email'))
                                    ->copyable(),
                                Infolists\Components\TextEntry::make('owner_phone_number')->label(static::getAttributeLabel('owner_phone_number'))
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
                Infolists\Components\Tabs\Tab::make(static::getAttributeLabel('purchase_order'))
                    ->schema([
                        Infolists\Components\TextEntry::make('status')->label(static::getAttributeLabel('status')),
                        Infolists\Components\TextEntry::make('reference_number')->label(static::getAttributeLabel('reference_number'))
                            ->copyable(),
                        Infolists\Components\ImageEntry::make('baucher')->label(static::getAttributeLabel('baucher')),
                        Infolists\Components\TextEntry::make('total_price')->label(static::getAttributeLabel('total_price'))
                            ->prefix('$'),
                    ]),
                Infolists\Components\Tabs\Tab::make(static::getAttributeLabel('products'))
                    ->schema([
                        Infolists\Components\RepeatableEntry::make('products_info')
                            ->label(static::getAttributeLabel('products_info'))
                            ->schema([
                                Infolists\Components\Section::make(static::getAttributeLabel('product_info'))
                                    ->schema([
                                        Infolists\Components\TextEntry::make('product_name'),
                                        Infolists\Components\TextEntry::make('product_quantity'),
                                        Infolists\Components\TextEntry::make('sale_type'),
                                        Infolists\Components\TextEntry::make('product_unit'),
                                    ])->collapsible(),
                            ]),
                    ]),
            ])->columnSpan('full'),
        ];
    }

    public static function tableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('status')->label(static::getAttributeLabel('status')),
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
        return $form->schema(static::inputForm());
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema(static::infolistEntries());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(static::tableColumns())
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(self::$statusOptions)->label(static::getAttributeLabel('status')),
            ])
            ->actions(static::tableActions())
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // PurchaseOrderItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPurchaseOrders::route('/'),
            'create' => Pages\CreatePurchaseOrder::route('/create'),
            'view' => Pages\ViewPurchaseOrder::route('/{record}'),
            'edit' => Pages\EditPurchaseOrder::route('/{record}/edit'),
        ];
    }
}
