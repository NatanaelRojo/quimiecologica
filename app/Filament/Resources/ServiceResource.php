<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Condition;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Registros';

    public static function getModelLabel(): string
    {
        return __('filament/resources/service.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament/resources/service.plural_label');
    }

    public static function getAttributeLabel(string $attribute): string
    {
        return __("filament/resources/service.{$attribute}");
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
            Forms\Components\Select::make('service_type_id')->label(static::getAttributeLabel('service_type'))
                ->required()
                ->relationship(
                    name: 'serviceType',
                    titleAttribute: 'name',
                    modifyQueryUsing: fn (Builder $query): Builder => $query->where('is_active', true)
                )
                ->preload()
                ->createOptionForm(ServiceTypeResource::inputForm())
                ->columnSpan('full'),
            Forms\Components\FileUpload::make('banner')->label(static::getAttributeLabel('banner'))
                ->image()
                ->columnSpan('full'),
            Forms\Components\TextInput::make('name')->autofocus()->label(static::getAttributeLabel('name'))
                ->autofocus()
                ->required()->maxLength(20)
                ->columnSpan('full'),
            Forms\Components\RichEditor::make('description')->label(static::getAttributeLabel('description'))
                ->columnSpan('full'),
            Forms\Components\TextInput::make('price')
                ->label(static::getAttributeLabel('price'))
                ->required()->numeric()->minValue(1)
                ->prefix('$')
                ->columnSpan('full'),
            Forms\Components\KeyValue::make('conditions')
                ->label(static::getAttributeLabel('conditions'))
                ->keyLabel(static::getAttributeLabel('name'))->valueLabel(static::getAttributeLabel('description')),
        ];
    }

    public static function tableColumns(): array
    {
        return [
            Tables\Columns\ToggleColumn::make('is_active')->label(static::getAttributeLabel('active')),
            Tables\Columns\TextColumn::make('serviceType.name')->label(static::getAttributeLabel('service_type')),
            Tables\Columns\TextColumn::make('name')->label(static::getAttributeLabel('name'))
                ->searchable(query: function (Builder $query, string $search): Builder {
                    return $query->where('name', 'like', "%{$search}%");
                }),
            Tables\Columns\TextColumn::make('description')->label(static::getAttributeLabel('description'))
                ->html()
                ->words(20),
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

    public static function tableFilters(): array
    {
        return [
            Tables\Filters\TernaryFilter::make('is_active')->label(static::getAttributeLabel('is_active'))
                ->trueLabel(static::getAttributeLabel('active'))->falseLabel(static::getAttributeLabel('inactive'))->placeholder(static::getAttributeLabel('all')),
        ];
    }

    public static function form(Form $form): Form
    {
        return $form->schema(ServiceResource::inputForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(ServiceResource::tableColumns())
            ->filters([
                //
            ])
            ->actions(ServiceResource::tableActions())
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
