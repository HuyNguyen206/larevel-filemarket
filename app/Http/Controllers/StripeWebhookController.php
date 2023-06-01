<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Notifications\OrderCompleted;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Webhook;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class StripeWebhookController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            Webhook::constructEvent($content = $request->getContent(), $request->header('STRIPE_SIGNATURE'), config('stripe.secret_signature'));
        } catch (SignatureVerificationException $signatureVerificationException  ){
            throw new AccessDeniedHttpException($signatureVerificationException->getMessage());
        }


        $response = json_decode($content, true);
        $method = 'handle' . Str::of($response['type'])->replace(['.'], '_')->studly();
        if (!method_exists($this, $method)) {
            throw new \Exception("The handle method for event {$response['type']} does not exist!");
        }

        $this->$method($response);

        return new Response();
    }

    protected function handleCheckoutSessionCompleted(array $payload)
    {
        $metadata = Arr::get($payload, 'data.object.metadata');
        $sale = Sale::with('product.user')->create([
            'product_id' => $metadata['product_id'],
            'email' => $email = Arr::get($payload, 'data.object.customer_details.email'),
            'stripe_session_id' => Arr::get($payload, 'data.object.id'),
            'price' => Arr::get($payload, 'data.object.amount_subtotal'),
            'paid_at' => Arr::get($payload, 'data.object.payment_status') === 'paid' ? now() : null,
        ]);

        Notification::route('mail', $email)->notify(new OrderCompleted($sale));
    }

    protected function handleCheckoutAsyncPaymentCompleted($response)
    {
        $productId = Arr::get($response, 'data.object.metadata.product_id');
    }
}
