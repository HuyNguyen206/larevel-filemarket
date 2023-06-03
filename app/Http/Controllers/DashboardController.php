<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $sale = $request->user()->load('sales.product')->loadCount('sales')->loadSum('sales', 'price');
        $user = $request->user();

        return view('dashboard', compact('sale', 'user'));
    }
}
