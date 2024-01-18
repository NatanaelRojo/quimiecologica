<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConditionResource\Pages;
use App\Filament\Resources\ConditionResource\RelationManagers;
use App\Models\Condition;
use DragonCode\Support\Concerns\Makeable;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConditionResource extends Resource
{
    protected static ?string $model = Condition::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Ajustes Base';

    public static function getModelLabel(): string
    {
        return __('filament/resources/condition.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament/resources/condition.plural_label');
    }

    public static function getAttributeLabel(string $attribute): string
    {
        return __("filament/resources/condition.{$attribute}");
    }

    public static function inputForm(): array
    {
        return [
            Forms\Components\TextInput::make('name')->label(static::getAttributeLabel('name'))->autofocus()
                ->required(),
            Forms\Components\Textarea::make('description')->label(static::getAttributeLabel('description'))
                ->required(),
        ];
    }

    public static function tableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')->label(static::getAttributeLabel('name')),
            Tables\Columns\TextColumn::make('description')->label(static::getAttributeLabel('description')),
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
        return $table->columns(static::tableColumns())
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
            'index' => Pages\ListConditions::route('/'),
            'create' => Pages\CreateCondition::route('/create'),
            'edit' => Pages\EditCondition::route('/{record}/edit'),
        ];
    }
}
