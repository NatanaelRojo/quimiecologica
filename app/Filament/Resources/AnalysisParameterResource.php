<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnalysisParameterResource\Pages;
use App\Filament\Resources\AnalysisParameterResource\RelationManagers;
use App\Models\AnalysisParameter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnalysisParameterResource extends Resource
{
    protected static bool $hasTitleCaseModelLabel = false;
    protected static ?string $model = AnalysisParameter::class;
    protected static bool $shouldRegisterNavigation = false;

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';

    protected static ?string $navigationLabel = 'Parámetros';

    protected static ?string $navigationGroup = 'Ajustes de los Análisis';

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
        return __("filament/resources/analysis_parameter.{$attribute}");
    }

    public static function inputForm(): array
    {
        return [
            Forms\Components\Select::make('analysis_id')->label(static::getAttributeLabel('analysis'))
                ->relationship(
                    name: 'analysis',
                    titleAttribute: 'name'
                )->preload()->searchable()
                ->required()
                ->createOptionForm(AnalysisResource::inputForm()),
            Forms\Components\Select::make('analysis_type_id')->label(static::getAttributeLabel('analysis_type'))
                ->relationship(
                    name: 'analysisType',
                    titleAttribute: 'name'
                )->preload()->searchable()
                ->required()
                ->createOptionForm(AnalysisTypeResource::inputForm()),
            Forms\Components\TextInput::make('name')->label(static::getAttributeLabel('name'))->autofocus()
                ->required()->maxLength(20),
            Forms\Components\Textarea::make('description')->label(static::getAttributeLabel('description'))
                ->maxLength(255),
            Forms\Components\TextInput::make('price_per_hour')->label(static::getAttributeLabel('price_per_hour'))
                ->required()->numeric()->minValue(1)
                ->prefix('$'),
        ];
    }

    public static function tableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('analysis.name')->label(static::getAttributeLabel('analysis'))->searchable(),
            Tables\Columns\TextColumn::make('analysisType.name')->label(static::getAttributeLabel('analysis_type'))->searchable(),
            Tables\Columns\TextColumn::make('name')->label(static::getAttributeLabel('name'))
                ->searchable(query: function (Builder $query, string $search) {
                    return $query->where('name', 'like', "%{$search}%");
                }),
            Tables\Columns\TextColumn::make('description')->label(static::getAttributeLabel('description'))
                ->words(20),
            Tables\Columns\TextColumn::make('price_per_hour')->label(static::getAttributeLabel('price_per_hour'))
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

    public static function form(Form $form): Form
    {
        return $form->schema(AnalysisParameterResource::inputForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(AnalysisParameterResource::tableColumns())
            ->filters([
                //
            ])
            ->actions(AnalysisParameterResource::tableActions())
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ConditionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAnalysisParameters::route('/'),
            'create' => Pages\CreateAnalysisParameter::route('/create'),
            'edit' => Pages\EditAnalysisParameter::route('/{record}/edit'),
        ];
    }
}
