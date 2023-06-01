<?php

namespace App\Http\Controllers\Subdomain;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubdomainHomeController extends Controller
{
    public function index(\App\Models\User $user)
    {
        $products = $user->products()->live()->get();

        return view('subdomain.index', compact('user' ,'products'));
    }

    public function show(User $user, Product $product)
    {
//        if (!$product->user->is($user)) {
//            abort(Response::HTTP_FORBIDDEN, 'You can not access this product which belong to another user/subdomain');
//        }

//        if (!$product->live) {
//            abort(Response::HTTP_NOT_FOUND);
//        }

        $this->authorize('view', $product);

        return view('subdomain.show', compact('product', 'user'));
    }

    public function checkoutSuccess(User $user, Product $product)
    {
        return view('subdomain.product.checkout-success', compact('user', 'product'));
    }

    public function checkout(User $user, Product $product)
    {;
        $response = app('stripe')->checkout->sessions->create([
            'mode' => 'payment',
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'USD',
                        'unit_amount' => $product->price->getAmount(),
                        'product_data' => [
                            'name' => $product->title
                        ]
                    ],
                    'quantity' => 1
                ]
            ],
            'payment_intent_data' => [
                'application_fee_amount' => $product->applicationFeeAmount()->getAmount(),
            ],
            'success_url' => route('subdomain.products.checkout.success', [$user->subdomain, $product->slug]),
            'cancel_url' => route('subdomain.products.show', [$user->subdomain, $product->slug]),
            'metadata' => [
                'product_id' => $product->id
            ],

        ], [
            'stripe_account' => $user->stripe_account_id
        ]);

        return redirect($response->url);
    }

    public function showMaterial(Request $request, User $user, Sale $sale)
    {
        if ($request->token !== $sale->token) {
            abort(Response::HTTP_BAD_REQUEST, 'The token is invalid');
        }

        if ($request->email !== $sale->email) {
            abort(Response::HTTP_BAD_REQUEST, 'The email is invalid');
        }

        return view('subdomain.sale.show', ['product' => $sale->product, 'user' => $user]);
    }
}
