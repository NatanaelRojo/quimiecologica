<?php

namespace App\Filament\Resources\PurchaseOrderResource\RelationManagers;

use App\Filament\Resources\PurchaseOrderItemResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PurchaseOrderItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'purchaseOrderItems';

    public static function getModelLabel(): string
    {
        return __('filament/resources/purchase_item.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament/resources/purchase_item.plural_label');
    }

    public function form(Form $form): Form
    {
        return $form->schema(PurchaseOrderItemResource::inputForm());
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('product_name')
            ->heading(static::getPluralModelLabel())
            ->emptyStateDescription(PurchaseOrderItemResource::getAttributeLabel('empty_table_description'))
            ->columns(PurchaseOrderItemResource::tableColumns())
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
