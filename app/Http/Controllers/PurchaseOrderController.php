<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseOrder\StorePurchaseOrderRequest;
use Illuminate\Support\Str;
use App\Http\Resources\PurchaseOrderResource;
use App\Mail\PurchaseOrderMailable;
use App\Mail\PurchaseOrderMailable1;
use App\Mail\PurchaseOrderMailable2;
use App\Models\Product;
use App\Models\PurchaseOrder;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Inertia\Response;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseOrderRequest $request): JsonResponse
    {
        $imagePath = null;
        $imageName = null;
        $products_info = array();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->storePublicly('public');
            $imageName = basename($imagePath);
        }

        foreach ($request->products_info as $product) {
            array_push($products_info, json_decode($product));
        }

        $newPurchaseOrder = PurchaseOrder::query()->create([
            'owner_firstname' => $request->owner_firstname,
            'owner_lastname' => $request->owner_lastname,
            'owner_email' => $request->owner_email,
            'owner_id' => $request->owner_id,
            'owner_phone_number' => $request->owner_phone_number,
            'owner_state' => $request->owner_state,
            'owner_city' => $request->owner_city,
            'owner_address' => $request->owner_address,
            'reference_number' => $request->reference_number,
            'image' => $imageName,
            'total_price' => $request->total_price,
            'products_info' => $products_info
        ]);

        $this->sendMails($newPurchaseOrder);
        $this->discountProducts($newPurchaseOrder);
        return response()->json([
            'record' => new PurchaseOrderResource($newPurchaseOrder),
            'redirect' => route('purchaseOrders.detail', $newPurchaseOrder->id),
        ], JsonResponse::HTTP_CREATED);
    }

    public function showDetail(Request $request): Response
    {
        if (!Str::isUuid($request->purchase_order)) {
            return Inertia::render('Error/404Error');
        }

        $purchaseOrderData = PurchaseOrder::query()->find($request->purchase_order);
        return Inertia::render('PurchaseOrder/Detail', [
            'purchase_order' => $purchaseOrderData,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchaseOrder $purchase_order): JsonResponse
    {
        $purchaseOrderData = PurchaseOrder::query()->find($purchase_order->id);

        return response()->json(new PurchaseOrderResource($purchaseOrderData), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        //
    }

    private function discountProducts(PurchaseOrder $purchaseOrder): void
    {
        DB::transaction(function () use ($purchaseOrder): void {
            foreach ($purchaseOrder->products_info as $data) {
                $product = Product::query()->find($data['id']);
                if ($data['type_sale']['name'] === 'Detal/Mayor' || $data['type_sale']['name'] === 'Granel') {
                    $product->update([
                        'stock' => $product->stock - $data['quantity'],
                    ]);
                }
            }
        });
    }

    private function sendMails(PurchaseOrder $purchaseOrder): void
    {
        $mail_1 = env('MAIL_1');
        $mail_2 = env('MAIL_2');
        // Enviar los 3 correos.
        $mail = Mail::to($purchaseOrder->owner_email);
        $mail->send(new PurchaseOrderMailable($purchaseOrder));
        $mail1 = Mail::to($mail_1);
        $mail1->send(new PurchaseOrderMailable1($purchaseOrder));
        $mail2 = Mail::to($mail_2);
        $mail2->send(new PurchaseOrderMailable2($purchaseOrder));
    }
}
