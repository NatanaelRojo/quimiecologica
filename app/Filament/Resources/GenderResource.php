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

    protected static ?string $navigationGroup = 'Base Settings';

    public static function inputForm(): array
    {
        return [
            Forms\Components\TextInput::make('name')->autofocus()->label('Gender name')
                ->required()->maxLength(20),
        ];
    }

    public static function tableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')->label('Gender name')
                ->searchable(query: function (Builder $query, string $search) {
                    return $query->where('name', 'like', "%{$search}%");
                }),
            Tables\Columns\TextColumn::make('description')->label('Gender description')
                ->words(20)
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
