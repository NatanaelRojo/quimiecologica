<?php

namespace App\Filament\Resources\WholesalePackageResource\Pages;

use App\Filament\Resources\WholesalePackageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWholesalePackages extends ListRecords
{
    protected static string $resource = WholesalePackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
