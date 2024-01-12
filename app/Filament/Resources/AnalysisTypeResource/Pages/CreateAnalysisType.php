<?php

namespace App\Filament\Resources\AnalysisTypeResource\Pages;

use App\Filament\Resources\AnalysisTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAnalysisType extends CreateRecord
{
    protected static string $resource = AnalysisTypeResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl();
    }
}
