<?php

namespace App\Filament\Resources\PendingOrderResource\Pages;

use App\Filament\Resources\PendingOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePendingOrder extends CreateRecord
{
    protected static string $resource = PendingOrderResource::class;
}
