<?php

namespace App\Filament\Resources\PurchaseWholesaleOrderResource\Pages;

use App\Filament\Resources\PurchaseWholesaleOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPurchaseWholesaleOrder extends EditRecord
{
    protected static string $resource = PurchaseWholesaleOrderResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
