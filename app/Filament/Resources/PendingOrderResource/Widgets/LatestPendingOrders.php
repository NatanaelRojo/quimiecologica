<?php

namespace App\Filament\Resources\PendingOrderResource\Widgets;

use App\Filament\Resources\PendingOrderResource;
use App\Models\PendingOrder;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestPendingOrders extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    public function table(Table $table): Table
    {
        return $table
            ->heading(PendingOrderResource::getAttributeLabel('latest_pending_orders'))
            ->defaultSort('created_at', 'desc')
            ->query(function (Builder $query): Builder {
                return PendingOrder::query()
                    ->where('status', 'En espera')
                    ->limit(10);
            })
            ->columns(PendingOrderResource::tableColumns())
            ->filters(PendingOrderResource::tableFilters());
    }
}
