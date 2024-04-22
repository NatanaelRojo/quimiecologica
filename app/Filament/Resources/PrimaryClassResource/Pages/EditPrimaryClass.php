<?php

namespace App\Filament\Resources\PrimaryClassResource\Pages;

use App\Filament\Resources\PrimaryClassResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPrimaryClass extends EditRecord
{
    protected static string $resource = PrimaryClassResource::class;

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
