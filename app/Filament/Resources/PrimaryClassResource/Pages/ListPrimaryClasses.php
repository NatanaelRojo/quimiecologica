<?php

namespace App\Filament\Resources\PrimaryClassResource\Pages;

use App\Filament\Resources\PrimaryClassResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPrimaryClasses extends ListRecords
{
    protected static string $resource = PrimaryClassResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
