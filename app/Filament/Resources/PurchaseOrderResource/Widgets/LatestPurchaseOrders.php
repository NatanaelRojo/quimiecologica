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
            ->heading(PurchaseOrderResource::getAttributeLabel('latest_purchase_orders'))
            ->defaultSort('created_at', 'desc')
            ->query(function (Builder $query): Builder {
                return PurchaseOrder::query()
                    ->where('status', 'En espera')
                    ->latest()
                    ->limit(10);
            })
            ->columns(PurchaseOrderResource::tableColumns());
    }
}
