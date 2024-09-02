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
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'lkr',//this will change the currency to ruppies
                        'product_data' => [
                            'name' => 'Invoice #' . $invoice->id,
                        ],
                        'unit_amount' => $invoice->amount * 100,//if we remove this 100 the stripe willl give an error because its default payment is with cents.
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('payment.success', ['invoice' => $invoice->id]),
                'cancel_url' => route('payment.cancel', ['invoice' => $invoice->id]),
                'metadata' => [
                    'invoice_id' => $invoice->id, // Pass the invoice ID as metadata
                ],
            ]);

            return redirect($session->url);
        } catch (\Exception $e) {
            Log::error('Error creating Stripe session: ' . $e->getMessage());
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
