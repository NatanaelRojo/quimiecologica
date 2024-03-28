<?php

namespace App\Filament\Resources\PurchaseOrderResource\Widgets;

use App\Filament\Resources\PurchaseOrderResource;
use App\Models\PurchaseOrder;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestPurchaseOrders extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(function (Builder $query): Builder {
                return PurchaseOrder::query()->where('status', 'En espera');
            })
            ->columns(PurchaseOrderResource::tableColumns());
    }
}
