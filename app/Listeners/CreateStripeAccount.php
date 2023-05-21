<?php

namespace App\Listeners;

class CreateStripeAccount
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $response = resolve('stripe')->accounts->create(['type' => 'standard']);
        $event->user->update([
            'stripe_account_id' => $response->id
        ]);
    }
}
