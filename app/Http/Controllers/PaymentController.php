<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    //Cretae the session for the checkout
    public function createCheckoutSession(Invoice $invoice)
    {
    //     // Check if the invoice is already paid
    // if ($invoice->status === 'paid') {
    //     // Redirect to an error page or show an error message
    //     return redirect()->route('error.page')->with('error', 'This invoice has already been paid.');
    // }
        Stripe::setApiKey(config('services.stripe.secret'));// This line sets the Stripe API key used for authenticating requests to Stripe's API

        try {//The try-catch block is used to handle any exceptions that might occur while creating the Stripe session. If an error occurs, the catch block will log the error and redirect the user back with an error message.
            $session = Session::create([//This creates a new payment session with Stripe. A session is essentially a set of instructions that tells Stripe how to process the payment.
                'payment_method_types' => ['card'],//Specifies that the payment method allowed is a card (credit or debit).
                'line_items' => [[// This array contains the details of the items being purchased.
                    'price_data' => [
                        'currency' => 'lkr',//this will change the currency to ruppies
                        'product_data' => [
                            'name' => 'Invoice #' . $invoice->id,//Defines named "Invoice #", followed by the invoice ID.
                        ],
                        'unit_amount' => $invoice->amount * 100,//if we remove this 100 the stripe willl give an error because its default payment is with cents.
                    ],
                    'quantity' => 1,//Specifies the quantity of the item. Here, it's 1, because it's billing for a single invoice.
                ]],
                'mode' => 'payment',//Specifies that the session is for a one-time payment. Stripe also supports subscription modes, but here it's a simple paymen
                'success_url' => route('payment.success', ['invoice' => $invoice->id]),//This URL is where the user will be redirected after a successful payment. It’s dynamically generated using the route helper to include the invoice ID.
                'cancel_url' => route('payment.cancel', ['invoice' => $invoice->id]),//This URL is where the user will be redirected if they cancel the payment process. Like the success URL, it includes the invoice ID.
                'metadata' => [//Metadata can store additional information with the session, like the invoice ID, this is useful later when handling webhooks to automatically update the status to paid.
                    'invoice_id' => $invoice->id, // Pass the invoice ID as metadata
                ],
            ]);

            return redirect($session->url);//After successfully creating the Stripe session, the user is redirected to the Stripe-hosted payment page ($session->url), where they can complete the payment.
        } catch (\Exception $e) {
            Log::error('Error creating Stripe session: ' . $e->getMessage());//If something goes wrong while creating the session (e.g., network issues, incorrect API keys, etc.), the error is caught, logged for debugging (Log::error(...)), and the user is redirected back to the previous page with an error message.
            return back()->with('error', 'Unable to create payment session. Please try again later.');
        }
    }
    //The success mehtod
    public function success(Request $request)
    {

        // Fetch the invoice ID from the request
        $invoiceId = $request->input('invoice');

        try {

            DB::beginTransaction();//this will temporarely store the data for the database
            // Find the invoice and update its status
            $invoice = Transaction::where('invoice_number', $invoiceId)->first();
            $invoice->status = 'paid'; // Update status
            $invoice->save();
            DB::commit();//this will save the temporarely data tothe databases. this will prevent null fields entering to the database.

            //  redirect with a success message
            return redirect()->route('transactions')->with('success', 'Payment was successful!');
        } catch (\Exception $e) {
            Log::error('Error processing payment success: ' . $e->getMessage());
            return redirect()->route('transactions')->with('error', 'Unable to process payment. Please contact support.');
        }
    }

    //The cancel method
    public function cancel(Request $request)
    {
        // Validate the request
        $request->validate([
            'id' => 'required|integer|exists:invoices,id',
            'session_id' => 'required|string',
        ]);

        $invoiceId = $request->input('id');

        try {
            // Find the invoice and update its status
            $invoice = Invoice::findOrFail($invoiceId);
            $invoice->status = 'canceled';
            $invoice->save();

            // Return a response or redirect
            return redirect()->route('invoice')->with('error', 'Payment was canceled.');
        } catch (\Exception $e) {
            Log::error('Error processing payment cancellation: ' . $e->getMessage());
            return redirect()->route('invoice')->with('error', 'Unable to process payment cancellation. Please contact support.');
        }
    }
}
