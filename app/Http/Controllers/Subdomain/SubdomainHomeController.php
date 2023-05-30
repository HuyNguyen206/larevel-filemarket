<?php

namespace App\Http\Controllers\Subdomain;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;

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
}
