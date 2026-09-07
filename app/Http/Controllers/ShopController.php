<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\StoreShopOrderRequest;
use App\Models\Product;
use App\Models\ShopOrder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function store(StoreShopOrderRequest $request): RedirectResponse
    {
        abort_unless($request->user()?->role === UserRole::Student, 403);

        $productIds = $request->validated('items');

        $products = Product::query()
            ->whereIn('id', $productIds)
            ->where('is_active', true)
            ->get();

        if ($products->count() !== count(array_unique($productIds))) {
            return back()->withErrors(['items' => 'One or more selected products are invalid.']);
        }

        $order = DB::transaction(function () use ($request, $products) {
            $total = $products->sum(fn (Product $product) => (float) $product->price);

            $order = ShopOrder::create([
                'user_id' => $request->user()->id,
                'total' => $total,
                'status' => 'pending',
            ]);

            foreach ($products as $product) {
                $order->items()->create([
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1,
                ]);
            }

            return $order;
        });

        return redirect()
            ->route('courses.search')
            ->with('success', 'Order request submitted. Total: '.number_format((float) $order->total, 2).'. We will contact you about payment.');
    }
}
