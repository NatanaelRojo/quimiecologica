<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GenderResource\Pages;
use App\Filament\Resources\GenderResource\RelationManagers;
use App\Models\Gender;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GenderResource extends Resource
{
    protected static ?string $model = Gender::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationGroup = 'Clasificacion';

    public static function getModelLabel(): string
    {
        return __('filament/resources/gender.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament/resources/gender.plural_label');
    }

    public static function getAttributeLabel(string $attribute): string
    {
        return __("filament/resources/gender.{$attribute}");
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
            Forms\Components\Select::make('categories')->label(static::getAttributeLabel('categories'))
                ->required()
                ->multiple()
                ->relationship(name: 'categories', titleAttribute: 'name')
                ->preload()
                ->createOptionForm(CategoryResource::inputForm())
                ->columnSpan('full'),
            Forms\Components\TextInput::make('name')->autofocus()->label(static::getAttributeLabel('name'))
                ->required()->maxLength(20),
        ];
    }

    public static function tableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('brands')
                ->label(static::getAttributeLabel('brands'))
                ->state(function (Gender $record) {
                    $brands = [];
                    $stringBrands = '';
                    foreach ($record?->categories as $category) {
                        foreach ($category?->primaryClasses as $primaryClass) {
                            foreach ($primaryClass?->brands as $brand) {
                                array_push($brands, "<p>{$brand?->name}</p>");
                            }
                        }
                    }
                    return implode('', $brands);
                })
                ->html(),
            Tables\Columns\TextColumn::make('primary_class')
                ->label(static::getAttributeLabel('primary_classes'))
                ->state(function (Gender $record) {
                    $primaryClasses = [];
                    $stringPrimaryClasses = '';
                    foreach ($record?->categories as $category) {
                        foreach ($category?->primaryClasses as $primaryClass) {
                            array_push($primaryClasses, "<p>{$primaryClass?->name}</p>");
                        }
                    }
                    return implode('', $primaryClasses);
                })
                ->html(),
            Tables\Columns\TextColumn::make('categories.name')
                ->label(static::getAttributeLabel('categories'))
                ->listWithLineBreaks(),
            Tables\Columns\TextColumn::make('name')->label(static::getAttributeLabel('name'))
                ->searchable(query: function (Builder $query, string $search) {
                    return $query->where('name', 'ilike', "%{$search}%");
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
        return $form->schema(GenderResource::inputForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(GenderResource::tableColumns())
            ->filters([
                //
            ])
            ->actions(GenderResource::tableActions())
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
            'index' => Pages\ListGenders::route('/'),
            'create' => Pages\CreateGender::route('/create'),
            'edit' => Pages\EditGender::route('/{record}/edit'),
        ];
    }
}
