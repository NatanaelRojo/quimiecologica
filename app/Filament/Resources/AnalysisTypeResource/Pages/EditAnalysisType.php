<?php

namespace App\Filament\Resources\AnalysisTypeResource\Pages;

use App\Filament\Resources\AnalysisTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAnalysisType extends EditRecord
{
    protected static string $resource = AnalysisTypeResource::class;

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
