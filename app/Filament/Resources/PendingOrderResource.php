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
    public static array $statusOptions = [
        'Aprobada' => 'Aprobada',
        'En espera' => 'En espera',
        'Rechazada' => 'Rechazada',
    ];

    protected static bool $hasTitleCaseModelLabel = false;
    protected static ?string $model = PendingOrder::class;
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-inbox';
    protected static ?string $navigationLabel = 'Pendientes';
    protected static ?string $navigationGroup = 'Órdenes';

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
        return static::getAttributeLabel('purchase_order.navigation_tooltip');
    }

    /**
     * Get the displayable singular label of the resource.
     * 
     * @return string
     */
    public static function getModelLabel(): string
    {
        return __('filament/resources/pending_order.label');
    }

    /**
     * Get the displayable plural label of the resource.
     * 
     * @return string
     */
    public static function getPluralModelLabel(): string
    {
        return __('filament/resources/pending_order.plural_label');
    }

    /**
     * Get the label for the given attribute.
     * 
     * @param  string  $attribute
     * @return string
     */
    public static function getAttributeLabel(string $attribute): string
    {
        return __("filament/resources/pending_order.{$attribute}");
    }

    /**
     * Get the infolist entries.
     * 
     * @return array
     */
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
                            Infolists\Components\TextEntry::make('status')
                                ->label(static::getAttributeLabel('status')),
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

    /**
     * Get the infolist schema.
     * 
     * @param  Infolist  $infolist
     * @return Infolist
     */
    public static function infoList(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema(static::infolistEntries());
    }

    /**
     * Get the form for creating or editing a resource.
     * 
     * @param  Form  $form
     * @return Form
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
        ];
    }

    /**
     * Get the table columns that should be displayed.
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
            Tables\Columns\TextColumn::make('owner_firstname')
                ->label(static::getAttributeLabel('owner_firstname'))
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
                ->copyable()
                ->searchable(query: function (Builder $query, string $search) {
                    return $query->where('owner_id', 'like', "%{$search}%");
                }),
            Tables\Columns\TextColumn::make('deadline')
                ->label(static::getAttributeLabel('deadline')),
            Tables\Columns\TextColumn::make('owner_request')
                ->label(static::getAttributeLabel('owner_request'))
                ->words(10),
        ];
    }

    /**
     * Get the actions available for the resource.
     * 
     * @return array
     */
    public static function tableActions(): array
    {
        return [
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make()
        ];
    }

    /**
     * Get the form for creating or editing a resource.
     * 
     * @param  Form  $form
     * @return Form
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema(PendingOrderResource::inputForm());
    }

    /**
     * Get the table filters available for the resource.
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
            ->defaultSort('created_at', 'desc')
            ->columns(PendingOrderResource::tableColumns())
            ->filters(static::tableFilters())
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

    /**
     * Get the pages available for the resource.
     * 
     * @return array
     */
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
