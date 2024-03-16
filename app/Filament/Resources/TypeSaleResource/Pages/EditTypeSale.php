<?php

namespace App\Filament\Resources\TypeSaleResource\Pages;

use App\Filament\Resources\TypeSaleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTypeSale extends EditRecord
{
    protected static string $resource = TypeSaleResource::class;

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
