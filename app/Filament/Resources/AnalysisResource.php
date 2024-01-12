<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnalysisResource\Pages;
use App\Filament\Resources\AnalysisResource\RelationManagers;
use App\Models\Analysis;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Commands\Aliases\MakeColumnCommand;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnalysisResource extends Resource
{
    protected static ?string $model = Analysis::class;

    protected static ?int $navigationSort = 0;

    protected static ?string $navigationIcon = 'heroicon-o-magnifying-glass';

    protected static ?string $navigationLabel = 'Names';

    protected static ?string $navigationGroup = 'Analysis Settings';

    public static function inputForm(): array
    {
        return [
            Forms\Components\TextInput::make('name')->label('Analysis name')->autofocus()
                ->required()->maxLength(20),
            Forms\Components\Textarea::make('description')->label('Analysis description')
                ->maxLength(255),
        ];
    }

    public static function tableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')->label('Analysis name')
                ->searchable(query: function (Builder $query, string $search) {
                    return $query->where('name', 'like', "%{$search}%");
                }),
            Tables\Columns\TextColumn::make('description')->label('analysis description')
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
        return $form->schema(AnalysisResource::inputForm());
    }

    public static function table(Table $table): Table
    {
        return $table->columns(AnalysisResource::tableColumns())
            ->filters([
                //
            ])
            ->actions(AnalysisResource::tableActions())
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
            'index' => Pages\ListAnalyses::route('/'),
            'create' => Pages\CreateAnalysis::route('/create'),
            'edit' => Pages\EditAnalysis::route('/{record}/edit'),
        ];
    }
}
