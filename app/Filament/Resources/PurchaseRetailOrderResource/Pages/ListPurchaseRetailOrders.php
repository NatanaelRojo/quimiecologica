<?php

namespace App\Filament\Resources\PurchaseRetailOrderResource\Pages;

use App\Filament\Resources\PurchaseRetailOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPurchaseRetailOrders extends ListRecords
{
    protected static string $resource = PurchaseRetailOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
