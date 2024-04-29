<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Filament\Resources\ProductResource\RelationManagers\ImagesRelationManager;
use App\Filament\Resources\PurchaseOrderResource\RelationManagers\ProductsRelationManager;
use App\Models\Measure;
use App\Models\Product;
use App\Models\Unit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static bool $hasTitleCaseModelLabel = false;
    protected static ?string $model = Product::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationGroup = 'Registros';

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

    public static function tabSchema(Get $get, $livewire, ?Model $record): array
    {
        if ($livewire instanceof Pages\CreateProduct) {
            $type_sale_id = $get('type_sale_id');
            return match ($type_sale_id) {
                '1' => static::retailTypeForm(),
                '2' => static::wholesaleTypeForm(),
                default => [],
            };
        }
        $type_sale_id = ($livewire instanceof Pages\EditProduct && $record) ?
            $record->type_sale_id :
            $get('type_sale_id');
        return match ($type_sale_id) {
            1 => static::retailTypeForm(),
            2 => static::wholesaleTypeForm(),
            default => [],
        };
    }

    public static function showRetailTab(Get $get, $livewire, ?Model $record): bool
    {
        if ($livewire instanceof Pages\CreateProduct) {
            $type_sale_id = $get('type_sale_id');
            return match ($type_sale_id) {
                '1' => true,
                '2' => false,
                default => false,
            };
        }
        $type_sale_id = ($livewire instanceof Pages\EditProduct && $record) ?
            $record->type_sale_id :
            $get('type_sale_id');
        return match ($type_sale_id) {
            1 => true,
            2 => false,
            default => false,
        };
    }

    public static function showWholesaleTab(Get $get, $livewire, ?Model $record): bool
    {
        if ($livewire instanceof Pages\CreateProduct) {
            $type_sale_id = $get('type_sale_id');
            return match ($type_sale_id) {
                '1' => false,
                '2' => true,
                default => false,
            };
        }
        $type_sale_id = ($livewire instanceof Pages\EditProduct && $record) ?
            $record->type_sale_id :
            $get('type_sale_id');
        return match ($type_sale_id) {
            1 => false,
            2 => true,
            default => false,
        };
    }

    protected static function retailTypeForm(): array
    {
        return [
            Forms\Components\TextInput::make('stock')->label(static::getAttributeLabel('stock'))
                ->required()->numeric()->minValue(0),
            Forms\Components\TextInput::make('price')
                ->label(static::getAttributeLabel('price'))
                ->required()->numeric()->minValue(0)
                ->prefix('$'),
            Forms\Components\TextInput::make('wholesale_price')
                ->label(static::getAttributeLabel('wholesale_price'))
                ->required()->numeric()->minValue(0)
                ->prefix('$'),
        ];
    }

    public static function inputForm(): array
    {
        return [
            Forms\Components\Tabs::make()
                ->tabs([
                    Forms\Components\Tabs\Tab::make('basic info')
                        ->label(static::getAttributeLabel('basic_info'))
                        ->schema([
                            Forms\Components\Toggle::make('is_active')->label(function (?bool $state): string {
                                if (!$state) {
                                    return static::getAttributeLabel('inactive');
                                }
                                return static::getAttributeLabel('active');
                            })->required()
                                ->onColor('success')->offColor('danger')
                                ->columnSpan('full')
                                ->live(),
                            Forms\Components\FileUpload::make('image_urls')->label(static::getAttributeLabel('images'))
                                ->multiple()
                                ->image()
                                ->minFiles(1)
                                ->maxFiles(5)
                                ->reorderable()
                                ->columnSpan('full'),
                            Forms\Components\Select::make('brand_id')->label(static::getAttributeLabel('brand'))
                                ->required()
                                ->relationship(name: 'brand', titleAttribute: 'name')
                                ->preload()
                                ->searchable()
                                ->createOptionForm(BrandResource::inputForm()),
                            Forms\Components\Select::make('primary_class_id')->label(static::getAttributeLabel('primary_class'))
                                ->required()
                                ->relationship(name: 'primaryClass', titleAttribute: 'name')
                                ->preload()
                                ->searchable()
                                ->createOptionForm(PrimaryClassResource::inputForm()),
                            // Forms\Components\Select::make('category_id')->label(static::getAttributeLabel('category'))
                            //     ->required()
                            //     ->relationship('category', 'name')->searchable()->preload()
                            //     ->createOptionForm(CategoryResource::inputForm()),
                            // Forms\Components\Select::make('gender_id')->label(static::getAttributeLabel('gender'))
                            //     ->required()
                            //     ->relationship('gender', 'name')
                            //     ->searchable()->preload()
                            //     ->createOptionForm(GenderResource::inputForm()),
                            Forms\Components\Select::make('categories')->label(static::getAttributeLabel('categories'))
                                ->required()
                                ->multiple()
                                ->relationship('categories', 'name')->searchable()->preload()
                                ->createOptionForm(CategoryResource::inputForm()),
                            Forms\Components\Select::make('genders')->label(static::getAttributeLabel('genders'))
                                ->required()
                                ->multiple()
                                ->relationship('genders', 'name')
                                ->searchable()->preload()
                                ->createOptionForm(GenderResource::inputForm()),
                            Forms\Components\Select::make('type_sale_id')->label(static::getAttributeLabel('type_sales'))
                                ->required()
                                ->relationship(name: 'typeSale', titleAttribute: 'name')
                                ->preload()
                                ->createOptionForm(TypeSaleResource::inputForm())
                                ->live(),
                            Forms\Components\Select::make('measures')->label(static::getAttributeLabel('measures'))
                                ->required()
                                ->relationship(
                                    name: 'measures',
                                    modifyQueryUsing: fn (Builder $query): Builder => $query->orderBy('id')
                                )
                                ->multiple()
                                ->getOptionLabelFromRecordUsing(fn (Measure $record): string => $record->name)
                                ->searchable()
                                ->preload()
                                ->createOptionForm(MeasureResource::inputForm()),
                            Forms\Components\Select::make('unit_id')->label(static::getAttributeLabel('unit'))
                                ->required()
                                ->relationship(name: 'unit', titleAttribute: 'name'),
                            Forms\Components\TextInput::make('name')->autofocus()->label(static::getAttributeLabel('name'))
                                ->required()->unique(ignoreRecord: true)->maxLength(255)->minLength(4)
                                ->columnSpan('full'),
                            Forms\Components\RichEditor::make('description')->label(static::getAttributeLabel('description'))
                                ->required()
                                ->columnSpan('full'),
                        ])->columns(2),
                    Forms\Components\Tabs\Tab::make('retail_type_data')->label(static::getAttributeLabel('retail_type_data'))
                        ->schema(fn (Get $get, $livewire, ?Model $record): array => static::tabSchema($get, $livewire, $record))
                        ->visible(fn (Get $get, $livewire, ?Model $record): bool => static::showRetailTab($get, $livewire, $record))
                        ->columns(2),
                    Forms\Components\Tabs\Tab::make('wholesale_type_data')->label(static::getAttributeLabel('wholesale_type_data'))
                        ->schema(fn (Get $get, $livewire, ?Model $record): array => static::tabSchema($get, $livewire, $record))
                        ->visible(fn (Get $get, $livewire, ?model $record): bool => static::showWholesaleTab($get, $livewire, $record))
                        ->columns(2),
                ])->columnSpan('full'),
        ];
    }

    public static function tableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('category.name')->label(static::getAttributeLabel('category'))->searchable(),
            Tables\Columns\TextColumn::make('gender.name')->label(static::getAttributeLabel('gender'))->searchable(),
            Tables\Columns\TextColumn::make('typeSale.name')->label(static::getAttributeLabel('type_sales'))->searchable(),
            Tables\Columns\TextColumn::make('name')->label(static::getAttributeLabel('name'))
                ->searchable(query: function (Builder $query, string $search): Builder {
                    return $query->where('name', 'ilike', "%{$search}%");
                }),
            Tables\Columns\TextColumn::make('description')->label(static::getAttributeLabel('description'))
                ->html()
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

    public static function wholesaleTypeForm(): array
    {
        return [
            Forms\Components\TextInput::make('quantity')->label(static::getAttributeLabel('minimum_quantity'))
                ->required()->numeric()->minValue(1),
            Forms\Components\Select::make('unit_id')->label(static::getAttributeLabel('unit'))
                ->required()
                ->relationship(name: 'unit', titleAttribute: 'name'),
            Forms\Components\TextInput::make('price')
                ->label(static::getAttributeLabel('price_by_unit'))
                ->required()->numeric()->minValue(1)
                ->prefix('$'),
        ];
    }

    public static function tableFilters(): array
    {
        return [
            Tables\Filters\TernaryFilter::make('is_active')->label(static::getAttributeLabel('is_active'))
                ->trueLabel(static::getAttributeLabel('active'))->falseLabel(static::getAttributeLabel('inactive'))->placeholder(static::getAttributeLabel('all')),
            Tables\Filters\SelectFilter::make('type_sale')->label(static::getAttributeLabel('type_sales'))
                ->relationship(name: 'typeSale', titleAttribute: 'name'),
            Tables\Filters\SelectFilter::make('category')->label(static::getAttributeLabel('category'))
                ->multiple()
                ->relationship(name: 'category', titleAttribute: 'name')
                ->preload(),
            Tables\Filters\SelectFilter::make('gender')->label(static::getAttributeLabel('gender'))
                ->multiple()
                ->relationship(name: 'gender', titleAttribute: 'name')
                ->preload(),
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
            ->filters(static::tableFilters())
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
