<?php

namespace App\Filament\Resources\PurchaseWholesaleOrderResource\Pages;

use App\Filament\Resources\PurchaseWholesaleOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePurchaseWholesaleOrder extends CreateRecord
{
    protected static string $resource = PurchaseWholesaleOrderResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
