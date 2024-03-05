<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentMethodResource\Pages;
use App\Filament\Resources\PaymentMethodResource\RelationManagers;
use App\Models\PaymentMethod;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentMethodResource extends Resource
{
    protected static ?string $model = PaymentMethod::class;
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationGroup = 'Ajustes Base';

    public static function getModelLabel(): string
    {
        return __('filament/resources/payment_method.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament/resources/payment_method.plural_label');
    }

    public static function getAttributeLabel(string $attribute): string
    {
        return __("filament/resources/payment_method.{$attribute}");
    }

    public static function inputForm(): array
    {
        return [
            Forms\Components\Toggle::make('is_active')->label(function (bool $state): string {
                return $state ? static::getAttributeLabel('active')
                    : static::getAttributeLabel('inactive');
            })
                ->onColor('success')->offColor('danger')
                ->columnSpan('full')
                ->live(),
            Forms\Components\TextInput::make("name")->label(static::getAttributeLabel('name'))
                ->required()->unique()
                ->autofocus(),
            Forms\Components\Select::make('type')->label(static::getAttributeLabel('type'))
                ->required()
                ->options([
                    'Transferencia' => 'Transferencia',
                    'Pago movil' => 'Pago movil',
                ]),
            Forms\Components\KeyValue::make('data')->label(static::getAttributeLabel('type'))
                ->required()
                ->columnSpan('full'),
        ];
    }

    public static function tableColumns(): array
    {
        return [
            Tables\Columns\ToggleColumn::make('is_active')->label(static::getAttributeLabel('is_active')),
            Tables\Columns\TextColumn::make('name')->label(static::getAttributeLabel('name'))
                ->searchable(query: function (Builder $query, string $search): Builder {
                    return $query->where('name', 'ilike', "%{$search}%");
                }),
            Tables\Columns\TextColumn::make('type')->label(static::getAttributeLabel('type'))
                ->searchable()
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

    public static function tableFilters(): array
    {
        return [
            Tables\Filters\TernaryFilter::make('is_active')->label(static::getAttributeLabel('is_active'))
                ->trueLabel(static::getAttributeLabel('active'))
                ->falseLabel(static::getAttributeLabel('inactive'))
                ->placeholder(static::getAttributeLabel('all')),
        ];
    }

    public static function form(Form $form): Form
    {
        return $form->schema(static::inputForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(static::tableColumns())
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPaymentMethods::route('/'),
            'create' => Pages\CreatePaymentMethod::route('/create'),
            'edit' => Pages\EditPaymentMethod::route('/{record}/edit'),
        ];
    }
}
