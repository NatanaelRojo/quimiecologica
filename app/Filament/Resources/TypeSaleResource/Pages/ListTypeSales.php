<?php

namespace App\Filament\Resources\TypeSaleResource\Pages;

use App\Filament\Resources\TypeSaleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTypeSales extends ListRecords
{
    protected static string $resource = TypeSaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
