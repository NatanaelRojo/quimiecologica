<?php

namespace App\Filament\Resources\AnalysisParameterResource\Pages;

use App\Filament\Resources\AnalysisParameterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAnalysisParameters extends ListRecords
{
    protected static string $resource = AnalysisParameterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
