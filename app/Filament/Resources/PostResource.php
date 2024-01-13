<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Base Elements';

    public static function inputForm(): array
    {
        return [
            Forms\Components\Toggle::make('published')
                ->onColor('success')->offColor('danger')
                ->columnSpan('full'),
            Forms\Components\FileUpload::make('thumbnail')->label('Post thumbnail')
                ->image()
                ->columnSpan('full'),
            Forms\Components\Select::make('category_id')->label('Post category')
                ->relationship(name: 'categories', titleAttribute: 'name')->preload()->searchable()
                ->multiple()
                ->createOptionForm(CategoryResource::inputForm()),
            Forms\Components\Select::make('gender_id')->label('Post category')
                ->relationship(name: 'genders', titleAttribute: 'name')->preload()->searchable()
                ->multiple()
                ->createOptionForm(GenderResource::inputForm()),
            Forms\Components\TextInput::make('title')->label('Post title')->autofocus()
                ->live(onBlur: true)
                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                ->required(),
            Forms\Components\TextInput::make('slug')->label('Post slug')
                ->disabled()->hidden(),

            Forms\Components\RichEditor::make('body')->label('Post body')
                ->required()
                ->columnSpan('full')
                ->fileAttachmentsDirectory('posts')
                ->fileAttachmentsVisibility('public'),
        ];
    }

    public static function tableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('categories.name')->label('Post category')->searchable(),
            Tables\Columns\TextColumn::make('genders.name')->label('Post category')->searchable(),
            Tables\Columns\ToggleColumn::make('published')->label('Is published'),
            Tables\Columns\TextColumn::make('title')->label('Post title')
                ->searchable(query: function (Builder $query, string $search) {
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
        return $form->schema(PostResource::inputForm());
        // ->columns(1);
    }

    public static function infolist(InfoList $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\ImageEntry::make('thumbnail')->label('')
                    ->width(1200)
                    ->height(350)
                    ->square(),
                Infolists\Components\TextEntry::make('title')->label('')
                    ->columnSpan('full'),
                Infolists\Components\TextEntry::make('body')->label('')
                    ->html()
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(PostResource::tableColumns())
            ->filters([
                //
            ])
            ->actions(PostResource::tableActions())
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'view' => Pages\ViewPost::route('/{record}'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
