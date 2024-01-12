<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
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
            Forms\Components\FileUpload::make('thumbnail')->label('Post thumbnail')
                ->image(),
            Forms\Components\RichEditor::make('body')->label('Post body')
                ->required()
                ->columnSpan('full')
                ->fileAttachmentsDirectory('posts')
                ->fileAttachmentsVisibility('public'),
        ];
    }

    public static function form(Form $form): Form
    {
        return $form->schema(PostResource::inputForm());
        // ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
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
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
