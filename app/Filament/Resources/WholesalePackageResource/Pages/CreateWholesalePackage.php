<?php

namespace App\Filament\Resources\WholesalePackageResource\Pages;

use App\Filament\Resources\WholesalePackageResource;
use App\Models\Unit;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWholesalePackage extends CreateRecord
{
    protected static string $resource = WholesalePackageResource::class;

    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     $unitName = Unit::query()->find($data['unit_id'])->abbreviation;
    //     $data['name'] = "{$data['quantity']} {$unitName}";
    //     return $data;
    // }
}
