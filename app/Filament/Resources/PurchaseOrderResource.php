<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PurchaseOrderResource\Pages;
use App\Filament\Resources\PurchaseOrderResource\RelationManagers;
use App\Filament\Resources\PurchaseOrderResource\RelationManagers\PurchaseOrderItemsRelationManager;
use App\Models\Measure;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Size;
use App\Models\TypeSale;
use App\Models\Unit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PurchaseOrderResource extends Resource
{
    public static array $statusOptions = [
        'Aprobada' => 'Aprobada',
        'En espera' => 'En espera',
        'Rechazada' => 'Rechazada',
    ];

    protected static bool $hasTitleCaseModelLabel = false;
    protected static ?string $model = PurchaseOrder::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationGroup = 'Órdenes';
    protected static ?string $navigationLabel = 'General';

    /**
     * Get the number of pending orders with the `En espera` status.
     * 
     * @return string
     */
    public static function getNavigationBadge(): ?string
    {
        return count(static::getModel()::query()->where('status', 'En espera')->get());
    }

    /**
     * Get the navigation badge color.
     * 
     * @return string
     */
    public static function getNavigationBadgeColor(): ?string
    {
        return 'info';
    }

    /**
     * Get the navigation tooltip.
     * 
     * @return string
     */
    public static function getNavigationBadgeTooltip(): ?string
    {
        return static::getAttributeLabel('navigation_tooltip');
    }

    /**
     * Get the displayable singular label of the resource.
     * 
     * @return string
     */
    public static function getModelLabel(): string
    {
        return __('filament/resources/purchase_order.label');
    }

    /**
     * Get the displayable plural label of the resource.
     * 
     * @return string
     */
    public static function getPluralModelLabel(): string
    {
        return __('filament/resources/purchase_order.plural_label');
    }

    /**
     * Get the label for the given attribute.
     * 
     * @param  string  $attribute
     * @return string
     */
    public static function getAttributeLabel(string $attribute): string
    {
        return __("filament/resources/purchase_order.{$attribute}");
    }

    public static function createProductSchema(): array
    {
        return [
            Forms\Components\TextInput::make('id')
                ->label(static::getAttributeLabel('product_id'))
                ->required()
                ->readonly(),
            Forms\Components\Select::make('name')
                ->label(static::getAttributeLabel('product_name'))
                ->required()
                ->options(function (): array {
                    $options = [];
                    foreach (Product::all(['id', 'name']) as $product) {
                        $options[$product->name] = $product->name;
                    }
                    return $options;
                })
                ->searchable()
                ->live()
                ->afterStateUpdated(function (Get $get, Set $set): void {
                    $product = Product::query()
                        ->where('name', $get('name'))
                        ->first(['id']);
                    $set('id', $product->id);
                }),
            Forms\Components\Select::make('type_sale.name')
                ->label(static::getAttributeLabel('sale_type'))
                ->required()
                ->searchable()
                ->options(function (): array {
                    $options = [];
                    foreach (TypeSale::all(['name']) as $typeSale) {
                        $options[$typeSale->name] = $typeSale->name;
                    }
                    return $options;
                }),
            Forms\Components\TextInput::make('quantity')
                ->label(static::getAttributeLabel('product_quantity'))
                ->required()
                ->numeric()
                ->minValue(1),
            Forms\Components\Repeater::make('measures')
                ->label(static::getAttributeLabel('measures'))
                ->schema([
                    Forms\Components\TextInput::make('quantity')
                        ->label(static::getAttributeLabel('product_content'))
                        ->required()
                        ->numeric()
                        ->minValue(1),
                    Forms\Components\Select::make('unit')
                        ->label(static::getAttributeLabel('product_unit'))
                        ->options(function (): array {
                            $options = [];
                            foreach (Unit::all(['name']) as $unit) {
                                $options[$unit->name] = $unit->name;
                            }
                            $options['No aplica'] = 'No aplica';
                            return $options;
                        })
                        ->searchable(),
                    Forms\Components\Select::make('size')
                        ->label(static::getAttributeLabel('product_size'))
                        ->options(function (): array {
                            $options = [];
                            foreach (Measure::all(['size']) as $measure) {
                                if ($measure->size) {
                                    $options[$measure->size] = $measure->size;
                                }
                            }
                            $options['No aplica'] = 'No aplica';
                            return $options;
                        })
                        ->searchable(),
                ]),
        ];
    }

    public static function editProductSchema(): array
    {
        return [
            Forms\Components\TextInput::make('id')
                ->label(static::getAttributeLabel('product_id'))
                ->required()
                ->readonly(),
            Forms\Components\Select::make('name')
                ->label(static::getAttributeLabel('product_name'))
                ->required()
                ->options(function (): array {
                    $options = [];
                    foreach (Product::all(['name']) as $product) {
                        $options[$product->name] = $product->name;
                    }
                    return $options;
                })
                ->searchable(),
            Forms\Components\Select::make('type_sale.name')
                ->label(static::getAttributeLabel('sale_type'))
                ->required()
                ->options(function (): array {
                    $options = [];
                    foreach (TypeSale::all(['name']) as $typeSale) {
                        $options[$typeSale->name] = $typeSale->name;
                    }
                    return $options;
                })
                ->searchable(),
            Forms\Components\TextInput::make('quantity')
                ->label(static::getAttributeLabel('product_quantity'))
                ->required()
                ->numeric()
                ->minValue(1),
            Forms\Components\Repeater::make('measures')
                ->label(static::getAttributeLabel('measures'))
                ->schema([
                    Forms\Components\TextInput::make('quantity')
                        ->label(static::getAttributeLabel('product_content'))
                        ->required()
                        ->numeric(),
                    Forms\Components\Select::make('unit')
                        ->label(static::getAttributeLabel('product_unit'))
                        ->options(function (): array {
                            $options = [];
                            foreach (Unit::all('name') as $unit) {
                                $options[$unit->name] = $unit->name;
                            }
                            $options['No aplica'] = 'No aplica';
                            return $options;
                        }),
                    Forms\Components\Select::make('size')
                        ->label(static::getAttributeLabel('product_size'))
                        ->options(function (): array {
                            $options = [];
                            foreach (Measure::all(['size']) as $measure) {
                                if ($measure->size) {
                                    $options[$measure->size] = $measure->size;
                                }
                            }
                            $options['No aplica'] = 'No aplica';
                            return $options;
                        })
                        ->searchable(),
                ]),
        ];
    }

    public static function productSchema($livewire): array
    {
        if ($livewire instanceof Pages\CreatePurchaseOrder) {
            return static::createProductSchema();
        }
        return static::editProductSchema();
    }

    /**
     * Get the form fields.
     * 
     * @return array
     */
    public static function inputForm(): array
    {
        return [
            Forms\Components\Select::make('status')->label(static::getAttributeLabel('status'))
                ->required()
                ->options(self::$statusOptions)
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
            Forms\Components\FileUpload::make('image')
                ->label(static::getAttributeLabel('baucher'))
                ->acceptedFileTypes(['application/pdf', 'image/png', 'image/jpeg', 'image/jpg'])
                ->downloadable(),
            Forms\Components\TextInput::make('total_price')
                ->label(static::getAttributeLabel('total_price'))
                ->required()
                ->numeric()
                ->minValue(1)
                ->prefix('$'),
            Forms\Components\Repeater::make('products_info')
                ->label(static::getAttributeLabel('products_info'))
                ->schema(fn ($livewire): array => static::productSchema($livewire))
                ->required()
                ->columnSpan('full')
                ->reorderable(false)
                ->collapsible()
                ->minItems(1)
                ->grid(2),
        ];
    }

    /**
     * Get the infolist entries.
     * 
     * @return array
     */
    public static function infolistEntries(): array
    {
        return [
            Infolists\Components\Tabs::make('tabs')->tabs([
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
                Infolists\Components\Tabs\Tab::make(static::getAttributeLabel('purchase_order'))
                    ->schema([
                        Infolists\Components\TextEntry::make('id')
                            ->label(static::getAttributeLabel('code'))
                            ->copyable(),
                        InfoLists\Components\TextEntry::make('created_at')
                            ->label(static::getAttributeLabel('created_at'))
                            ->date('d/m/Y'),
                        Infolists\Components\TextEntry::make('status')->label(static::getAttributeLabel('status')),
                        Infolists\Components\TextEntry::make('reference_number')->label(static::getAttributeLabel('reference_number'))
                            ->copyable(),
                        Infolists\Components\TextEntry::make('total_price')->label(static::getAttributeLabel('total_price'))
                            ->prefix('$'),
                        Infolists\Components\ImageEntry::make('image')
                            ->label(static::getAttributeLabel('baucher'))
                            ->height(800)
                            ->square()
                            ->extraImgAttributes([
                                'alt' => 'Imagen de comprobante',
                            ]),
                    ]),
                Infolists\Components\Tabs\Tab::make(static::getAttributeLabel('products'))
                    ->schema([
                        Infolists\Components\RepeatableEntry::make('products_info')
                            ->label(static::getAttributeLabel('products_info'))
                            ->schema([
                                Infolists\Components\Section::make(static::getAttributeLabel('product_info'))
                                    ->schema([
                                        Infolists\Components\TextEntry::make('name')
                                            ->label(static::getAttributeLabel('product_name')),
                                        Infolists\Components\TextEntry::make('quantity')
                                            ->label(static::getAttributeLabel('product_quantity')),
                                        Infolists\Components\TextEntry::make('type_sale.name')
                                            ->label(static::getAttributeLabel('sale_type')),
                                        Infolists\Components\RepeatableEntry::make("measures")
                                            ->label(static::getAttributeLabel('measures'))
                                            ->schema([
                                                Infolists\Components\TextEntry::make('quantity')
                                                    ->label(static::getAttributeLabel('product_content')),
                                                Infolists\Components\TextEntry::make('size')
                                                    ->label(static::getAttributeLabel('product_size')),
                                                Infolists\Components\TextEntry::make('unit')
                                                    ->label(static::getAttributeLabel('product_unit')),
                                            ])
                                            ->grid(2),
                                    ])->collapsible(),
                            ]),
                    ]),
            ])->columnSpan('full'),
        ];
    }

    /**
     * Get the table columns.
     * 
     * @return array
     */
    public static function tableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('created_at')
                ->label(static::getAttributeLabel('created_at'))
                ->date('d/m/Y'),
            Tables\Columns\TextColumn::make('status')
                ->label(static::getAttributeLabel('status')),
            Tables\Columns\TextColumn::make('owner_firstname')->label(static::getAttributeLabel('owner_firstname'))
                ->searchable(query: function (Builder $query, string $search) {
                    return $query->where('owner_firstname', 'like', "%{$search}%");
                }),
            Tables\Columns\TextColumn::make('owner_lastname')
                ->label(static::getAttributeLabel('owner_lastname'))
                ->searchable(query: function (Builder $query, string $search) {
                    return $query->where('owner_lastname', 'like', "%{$search}%");
                }),
            Tables\Columns\TextColumn::make('owner_id')
                ->label(static::getAttributeLabel('owner_id'))
                ->searchable(query: function (Builder $query, string $search) {
                    return $query->where('owner_id', 'like', "%{$search}%");
                }),
            Tables\Columns\TextColumn::make('reference_number')
                ->label(static::getAttributeLabel('reference_number'))
                ->copyable(),
            Tables\Columns\TextColumn::make('total_price')->label(static::getAttributeLabel('total_price'))
                ->money('USD')
                ->sortable(),
        ];
    }

    /**
     * Get the table actions for the resource.
     * 
     * @return array
     */
    public static function tableActions(): array
    {
        return [
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ];
    }

    /**
     * Get the form schema for the resource.
     * 
     * @return array
     */
    public static function form(Form $form): Form
    {
        return $form->schema(static::inputForm());
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema(static::infolistEntries());
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public static function tableFilters(): array
    {
        return [
            Tables\Filters\SelectFilter::make('status')
                ->options(self::$statusOptions)
                ->label(static::getAttributeLabel('status')),
        ];
    }

    /**
     * Get the table for the resource.
     * 
     * @param  Table  $table
     * @return Table
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns(static::tableColumns())
            ->defaultSort('created_at', 'desc')
            ->filters(static::tableFilters())
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

    /**
     * Get the pages available for the resource.
     * 
     * @return array
     */
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
