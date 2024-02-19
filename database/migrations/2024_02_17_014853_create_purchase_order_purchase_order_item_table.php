<?php

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('purchase_order_purchase_order_item')) {
            Schema::create('purchase_order_purchase_order_item', function (Blueprint $table) {
                $table->id();
                $table->foreignIdFor(PurchaseOrder::class)->constrained()->cascadeOnUpdate();
                $table->foreignIdFor(PurchaseOrderItem::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order_purchase_order_item');
    }
};
