<?php

namespace App\Filament\Resources\WholesalePackageResource\Pages;

use App\Filament\Resources\WholesalePackageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWholesalePackage extends EditRecord
{
    protected static string $resource = WholesalePackageResource::class;

    public function getRedirectUrl(): string
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
