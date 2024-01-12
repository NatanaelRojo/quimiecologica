<?php

namespace App\Filament\Resources\AnalysisParameterResource\Pages;

use App\Filament\Resources\AnalysisParameterResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAnalysisParameter extends CreateRecord
{
    protected static string $resource = AnalysisParameterResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
