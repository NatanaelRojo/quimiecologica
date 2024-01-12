<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnalysisTypeResource\Pages;
use App\Filament\Resources\AnalysisTypeResource\RelationManagers;
use App\Models\AnalysisType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnalysisTypeResource extends Resource
{
    protected static ?string $model = AnalysisType::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationLabel = 'Types';

    protected static ?string $navigationGroup = 'Analysis Settings';

    public static function inputForm(): array
    {
        return [
            Forms\Components\Select::make('analysis_id')->label('Analysis')
                ->relationship(
                    name: 'analysis',
                    titleAttribute: 'name'
                )->preload()->searchable()
                ->required()
                ->createOptionForm(AnalysisResource::inputForm()),
            Forms\Components\TextInput::make('name')->label('Analysis type name')
                ->required()->maxLength(20),
            Forms\Components\Textarea::make('description')->label('Analysis type description')
                ->maxLength(255),
        ];
    }

    public static function tableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('analysis.name')->label('Analysis name')->searchable(),
            Tables\Columns\TextColumn::make('name')->label('Analysis type name')
                ->searchable(query: function (Builder $query, string $search) {
                    return $query->where('name', 'like', "%{$search}%");
                }),
            Tables\Columns\TextColumn::make('description')->label('analysis type description')
                ->words(20),
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
        return $form->schema(AnalysisTypeResource::inputForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(AnalysisTypeResource::tableColumns())
            ->filters([
                //
            ])
            ->actions(AnalysisTypeResource::tableActions())
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
            'index' => Pages\ListAnalysisTypes::route('/'),
            'create' => Pages\CreateAnalysisType::route('/create'),
            'edit' => Pages\EditAnalysisType::route('/{record}/edit'),
        ];
    }
}
