<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceTypeResource\Pages;
use App\Filament\Resources\ServiceTypeResource\RelationManagers;
use App\Models\ServiceType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceTypeResource extends Resource
{
    protected static ?string $model = ServiceType::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __('filament/resources/service_type.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament/resources/service_type.plural_label');
    }

    public static function getAttributeLabel(string $attribute): string
    {
        return __("filament/resources/service_type.{$attribute}");
    }

    public static function inputForm(): array
    {
        return [
            Forms\Components\TextInput::make('name')->label(static::getAttributeLabel('name'))
                ->required()
                ->columnSpan('full'),
        ];
    }

    public static function tableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')->label(static::getAttributeLabel('name'))
                ->searchable(query: function (Builder $query, string $search): Builder {
                    return $query->where('name', 'like', "%{$search}%");
                }),
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns(static::tableColumns())
            ->filters([
                //
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServiceTypes::route('/'),
            'create' => Pages\CreateServiceType::route('/create'),
            'edit' => Pages\EditServiceType::route('/{record}/edit'),
        ];
    }
}
