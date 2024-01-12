<?php

namespace App\Filament\Resources\AnalysisParameterResource\Pages;

use App\Filament\Resources\AnalysisParameterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAnalysisParameter extends EditRecord
{
    protected static string $resource = AnalysisParameterResource::class;

    protected function getRedirectResource(): string
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
