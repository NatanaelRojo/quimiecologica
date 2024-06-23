<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrimaryClassResource\Pages;
use App\Filament\Resources\PrimaryClassResource\RelationManagers;
use App\Models\PrimaryClass;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PrimaryClassResource extends Resource
{
    protected static ?string $model = PrimaryClass::class;
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'Clasificacion';

    public static function getModelLabel(): string
    {
        return __('filament/resources/primary_class.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament/resources/primary_class.plural_label');
    }

    public static function getAttributeLabel(string $attribute): string
    {
        return __("filament/resources/primary_class.{$attribute}");
    }

    public static function inputForm(): array
    {
        return [
            Forms\Components\Toggle::make('is_active')->label(function (?bool $state): string {
                if (!$state) {
                    return static::getAttributeLabel('inactive');
                }
                return static::getAttributeLabel('active');
            })->required()
                ->onColor('success')->offColor('danger')
                ->columnSpan('full')
                ->live(),
            Forms\Components\FileUpload::make('logo_url')
                ->label(static::getAttributeLabel('logo'))
                ->required()
                ->columnSpan('full'),
            Forms\Components\Select::make('brands')->label(static::getAttributeLabel('brands'))
                ->required()
                ->multiple()
                ->relationship(
                    name: 'brands',
                    titleAttribute: 'name',
                    modifyQueryUsing: fn (Builder $query): Builder => $query->where('is_active', true)
                )
                ->preload()
                ->searchable()
                ->createOptionForm(BrandResource::inputForm()),
            Forms\Components\TextInput::make('name')->autofocus()->label(static::getAttributeLabel('name'))
                ->required()->maxLength(20),
            Forms\Components\TextInput::make('description')->label(static::getAttributeLabel('description'))
                ->autofocus(),
        ];
    }

    public static function tableColumns(): array
    {
        return [
            Tables\Columns\ToggleColumn::make('is_active')->label(static::getAttributeLabel('active')),
            Tables\Columns\TextColumn::make('brands.name')
                ->label(static::getAttributeLabel('brands'))
                ->listWithLineBreaks(),
            Tables\Columns\ToggleColumn::make('is_active')->label(static::getAttributeLabel('active')),
            Tables\Columns\TextColumn::make('name')->label(static::getAttributeLabel('name'))
                ->searchable(query: function (Builder $query, string $search) {
                    return $query->where('name', 'ilike', "%{$search}%");
                }),
            Tables\Columns\TextColumn::make('description')->label(static::getAttributeLabel('description'))->limit(20),
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
                ->trueLabel(static::getAttributeLabel('active'))->falseLabel(static::getAttributeLabel('inactive'))->placeholder(static::getAttributeLabel('all')),
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
            'index' => Pages\ListPrimaryClasses::route('/'),
            'create' => Pages\CreatePrimaryClass::route('/create'),
            'edit' => Pages\EditPrimaryClass::route('/{record}/edit'),
        ];
    }
}
