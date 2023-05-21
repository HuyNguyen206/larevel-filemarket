<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnboardingStripeController extends Controller
{
    public function index()
    {
        return view('onboarding');
    }

    public function redirect(Request $request)
    {
       $response =  app('stripe')->accountLinks->create([
            'type' =>  'account_onboarding',
            'account' =>  $request->user()->stripe_account_id,
            'refresh_url' =>  route('onboard.redirect'),
            'return_url' =>  route('onboard.verify'),
        ]);

       return redirect($response->url);
    }

    public function verify(Request $request)
    {
        $isEnabled = app('stripe')->accounts->retrieve($request->user()->stripe_account_id, [])->payouts_enabled;

        if (!$isEnabled) {
            throw new \Exception('Please recheck your stripe account verification or try on board again with url '. route('onboard.redirect'));
        }

        $request->user()->update([
            'stripe_account_enable' => $isEnabled
        ]);

        return redirect()->route('dashboard');
    }
}
