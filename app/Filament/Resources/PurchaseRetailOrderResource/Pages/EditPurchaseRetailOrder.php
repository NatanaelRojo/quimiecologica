<?php

namespace App\Filament\Resources\PurchaseRetailOrderResource\Pages;

use App\Filament\Resources\PurchaseRetailOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPurchaseRetailOrder extends EditRecord
{
    protected static string $resource = PurchaseRetailOrderResource::class;

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
