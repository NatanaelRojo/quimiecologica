<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MeasureResource\Pages;
use App\Filament\Resources\MeasureResource\RelationManagers;
use App\Models\Measure;
use App\Models\Unit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MeasureResource extends Resource
{
    protected static ?string $model = Measure::class;
    protected static ?string $navigationIcon = 'heroicon-o-scale';
    protected static ?string $navigationGroup = 'Carga Inicial';

    /**
     * Get the displayable singular label of the resource.
     * 
     * @return string
     */
    public static function getModelLabel(): string
    {
        return __('filament/resources/measure.label');
    }

    /**
     * Get the displayable plural label of the resource.
     * 
     * @return string
     */
    public static function getPluralModelLabel(): string
    {
        return __('filament/resources/measure.plural_label');
    }

    /**
     * Get the label for the given attribute.
     * 
     * @param  string  $attribute
     * @return string
     */
    public static function getAttributeLabel(string $attribute): string
    {
        return __("filament/resources/measure.{$attribute}");
    }

    /**
     * Get the form fields displayed by the resource.
     *
     * @return array
     */
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
            Forms\Components\Select::make('type')->label(static::getAttributeLabel('type'))
                ->options([
                    'Tallas' => 'Tallas',
                    'Unidades' => 'Unidades',
                ])
                ->live(),
            Forms\Components\TextInput::make('quantity')->label(static::getAttributeLabel('quantity'))->autofocus()
                ->required()->numeric()
                ->minValue(0)
                ->live()
                ->afterStateUpdated(fn (Get $get, Set $set, ?string $state) => $set('name', "{$get('quantity')} {$get('unit')}"))
                ->visible(fn (Get $get): bool => $get('type') === 'Unidades' ? true : false),
            Forms\Components\Select::make('unit')->label(static::getAttributeLabel('unit'))
                ->options(function (): array {
                    $options = array();
                    $units = Unit::query()->orderBy('name')->get();
                    foreach ($units as $unit) {
                        $options[$unit->name] = $unit->name;
                    }
                    return $options;
                })
                ->live()
                ->afterStateUpdated(function (Get $get, Set $set, ?string $state): void {
                    $presentationName = '';
                    if ($get('quantity') != 1) {
                        $presentationName = "{$get('unit')}s";
                    }
                    $set('name', "{$get('quantity')} {$presentationName}");
                })
                ->visible(fn (Get $get): bool => $get('type') === 'Unidades' ? true : false),
        ];
    }

    /**
     * Get the table columns displayed by the resource.
     *
     * @return array
     */
    public static function tableColumns(): array
    {
        return [
            Tables\Columns\ToggleColumn::make('is_active')->label(static::getAttributeLabel('active')),

            Tables\Columns\ToggleColumn::make('is_active')
                ->label(static::getAttributeLabel('is_active')),
            Tables\Columns\TextColumn::make('name')->label(static::getAttributeLabel('name')),
        ];
    }

    /**
     * Get the table actions available for the resource.
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
     * Get the filters available for the resource.
     *
     * @return array
     */
    public static function tableFilters(): array
    {
        return [
            Tables\Filters\TernaryFilter::make('is_active')->label(static::getAttributeLabel('is_active'))
                ->trueLabel(static::getAttributeLabel('active'))->falseLabel(static::getAttributeLabel('inactive'))->placeholder(static::getAttributeLabel('all')),
        ];
    }

    /**
     * Show the form for creating or editing a resource.
     * 
     * @param  Form  $form
     * @return Form
     */
    public static function form(Form $form): Form
    {
        return $form->schema(static::inputForm());
    }

    /**
     * Show the table for the resource.
     * 
     * @param  Table  $table
     * @return Table
     */
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

    /**
     * Get the pages available for the resource.
     * 
     * @return array
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMeasures::route('/'),
            'create' => Pages\CreateMeasure::route('/create'),
            'edit' => Pages\EditMeasure::route('/{record}/edit'),
        ];
    }
}
