<?php

namespace App\Filament\Resources\AnalysisTypeResource\Pages;

use App\Filament\Resources\AnalysisTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAnalysisTypes extends ListRecords
{
    protected static string $resource = AnalysisTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
