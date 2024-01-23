<?php

namespace App\Filament\Resources\AnalysisParameterResource\RelationManagers;

use App\Filament\Resources\ConditionResource;
use DragonCode\Support\Concerns\Makeable;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConditionsRelationManager extends RelationManager
{
    protected static string $relationship = 'conditions';

    public static function getModelLabel(): string
    {
        return __('filament/resources/condition.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament/resources/condition.plural_label');
    }

    public function form(Form $form): Form
    {
        return $form->schema(ConditionResource::relationManagerInputForm());
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns(ConditionResource::relationManagerTableColumns())
            ->heading(static::getPluralModelLabel())
            ->emptyStateDescription(ConditionResource::getAttributeLabel('empty_table_description'))
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
