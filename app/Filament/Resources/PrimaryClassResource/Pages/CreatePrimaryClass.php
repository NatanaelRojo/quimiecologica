<?php

namespace App\Filament\Resources\PrimaryClassResource\Pages;

use App\Filament\Resources\PrimaryClassResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePrimaryClass extends CreateRecord
{
    protected static string $resource = PrimaryClassResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
