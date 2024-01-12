<?php

namespace App\Filament\Resources\PurchaseWholesaleOrderResource\Pages;

use App\Filament\Resources\PurchaseWholesaleOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPurchaseWholesaleOrders extends ListRecords
{
    protected static string $resource = PurchaseWholesaleOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
