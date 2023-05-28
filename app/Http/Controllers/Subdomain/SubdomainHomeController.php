<?php

namespace App\Http\Controllers\Subdomain;

use App\Http\Controllers\Controller;

class SubdomainHomeController extends Controller
{
    public function show(\App\Models\User $user)
    {
        return view('subdomain.show', compact('user'));
    }
}
