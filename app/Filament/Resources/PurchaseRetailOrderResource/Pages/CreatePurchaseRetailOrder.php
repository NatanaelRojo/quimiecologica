<?php

namespace App\Filament\Resources\PurchaseRetailOrderResource\Pages;

use App\Filament\Resources\PurchaseRetailOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePurchaseRetailOrder extends CreateRecord
{
    protected static string $resource = PurchaseRetailOrderResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
