<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Webhook;
use App\Models\Invoice;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Webhook as StripeWebhook; // Use the correct namespace
use Stripe\Exception\SignatureVerificationException;

class WebhookController extends Controller
{
    public function handleStripeWebhook(Request $request)
{
    Stripe::setApiKey(config('services.stripe.secret'));

    $payload = $request->getContent();
    $sigHeader = $request->header('Stripe-Signature');

    try {
        $event = Webhook::constructEvent($payload, $sigHeader, config('services.stripe.webhook_secret'));

        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;
            $invoiceId = $session->metadata->invoice_id;

            $invoice = Invoice::findOrFail($invoiceId);
            $invoice->status = 'paid';
            $invoice->save();
        }

        return response()->json(['status' => 'success'], 200);
    } catch (SignatureVerificationException $e) {
        return response()->json(['status' => 'invalid signature'], 400);
    }
}
}
