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
    Stripe::setApiKey(config('services.stripe.secret'));// This line sets the Stripe API key used for authenticating requests to Stripe's API

    $payload = $request->getContent();//This variable captures the raw content of the incoming HTTP request. It contains the JSON payload sent by Stripe.
    $sigHeader = $request->header('Stripe-Signature');// This captures the Stripe-Signature header from the request, which Stripe uses to sign the webhook to ensure its authenticity.

    try {
        $event = Webhook::constructEvent($payload, $sigHeader, config('services.stripe.webhook_secret'));//This line verifies the integrity of the webhook by checking the signature ($sigHeader) using the constructEvent method provided by Stripe. It ensures that the webhook was actually sent by Stripe and hasn't been tampered with.

        if ($event->type === 'checkout.session.completed') {//his checks the type of the event received from Stripe. Here, it specifically looks for the checkout.session.completed event, which indicates that a payment session was successfully completed.
            $session = $event->data->object;//This extracts the session object from the event data. The session object contains details about the completed checkout session.
            $invoiceId = $session->metadata->invoice_id;//This retrieves the invoice_id from the session's metadata.This meta data set when the checkout session was created, linking the session to a invoices in the system.

            $invoice = Invoice::findOrFail($invoiceId);//This looks up the corresponding invoice in  database using the invoice_id retrieved from the session metadata. If the invoice isn't found, it will throw a ModelNotFoundException.
            $invoice->status = 'paid';//This updates the status of the invoice to 'paid'
            $invoice->save();// This saves the updated invoice status to the database.
        }

        return response()->json(['status' => 'success'], 200);//If the webhook is successfully processed (i.e., the signature is verified, and the event type is checkout.session.completed), the server returns a JSON response with a status of 'success' and an HTTP status code of 200.
    } catch (SignatureVerificationException $e) {
        return response()->json(['status' => 'invalid signature'], 400);//If something goes wrong while creating the session (e.g., network issues, incorrect API keys, etc.), the error is caught, logged for debugging (Log::error(...)), and the user is redirected back to the previous page with an error message
    }
}
}
