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
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Elementos Base';

    public static function getModelLabel(): string
    {
        return __('filament/resources/post.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament/resources/post.plural_label');
    }

    public static function getAttributeLabel(string $attribute): string
    {
        return __("filament/resources/post.{$attribute}");
    }

    public static function inputForm(): array
    {
        return [
            Forms\Components\Toggle::make('published')->label(function (?bool $state): string {
                if (!$state) {
                    return static::getAttributeLabel('non_published');
                }

                return static::getAttributeLabel('published');
            })
                ->required()
                ->onColor('success')->offColor('danger')
                ->columnSpan(2)
                ->live(),
            Forms\Components\FileUpload::make('thumbnail')->label(static::getAttributeLabel('thumbnail'))
                ->image()
                ->columnSpan(2),
            Forms\Components\Select::make('category_id')->label(static::getAttributeLabel('categories'))
                ->relationship(name: 'categories', titleAttribute: 'name')->preload()->searchable()
                ->multiple()
                ->createOptionForm(CategoryResource::inputForm()),
            Forms\Components\Select::make('gender_id')->label(static::getAttributeLabel('genders'))
                ->relationship(name: 'genders', titleAttribute: 'name')->preload()->searchable()
                ->multiple()
                ->createOptionForm(GenderResource::inputForm()),
            Forms\Components\TextInput::make('title')->label(static::getAttributeLabel('title'))->autofocus()
                ->required()->unique(ignoreRecord: true)
                ->columnSpan(2),
            Forms\Components\RichEditor::make('body')->label(static::getAttributeLabel('body'))
                ->required()
                ->columnSpan('full')
                ->fileAttachmentsDirectory('posts')
                ->fileAttachmentsVisibility('public'),
        ];
    }

    public static function tableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('categories.name')->label(static::getAttributeLabel('categories'))->searchable(),
            Tables\Columns\TextColumn::make('genders.name')->label(static::getAttributeLabel('genders'))->searchable(),
            Tables\Columns\ToggleColumn::make('published')->label(static::getAttributeLabel('published')),
            Tables\Columns\TextColumn::make('title')->label(static::getAttributeLabel('title'))
                ->searchable(query: function (Builder $query, string $search) {
                    return $query->where('name', 'ilike', "%{$search}%");
                }),
        ];
    }

    public static function tableActions(): array
    {
        return [
            Tables\Actions\ViewAction::make()->modalAlignment(Alignment::Justify),
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ];
    }

    public static function form(Form $form): Form
    {
        return $form->schema(PostResource::inputForm());
        // ->columns(1);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\ImageEntry::make('thumbnail')->label('')
                    ->height(350)
                    ->width(1200)
                    ->square(),
                Infolists\Components\TextEntry::make('title')->label('')
                    ->columnSpan('full'),
                Infolists\Components\TextEntry::make('body')->label('')
                    ->columnSpan('full')
                    ->html(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(PostResource::tableColumns())
            ->filters([
                Tables\Filters\TernaryFilter::make('published')->label(static::getAttributeLabel('is_published'))
                    ->trueLabel(static::getAttributeLabel('published'))->falseLabel(static::getAttributeLabel('non_published'))->placeholder(''),
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
