<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Invoice; //need to import the model
use App\Models\Customer;
use App\Models\Transaction;
use App\Mail\InvoiceCreated;
use Illuminate\Support\Facades\Mail;

class InvoiceController extends Controller
{
    //Creating invoice
        public function create(Request $request)
    {
        $customer = null;

        if ($request->has('customer_id')) {
            $customer = Customer::findOrFail($request->input('customer_id'));
        }

        return Inertia::render('CreateInvoice', [
            'customer' => $customer,
        ]);
    }


    //Storing invoice details in the database and generate link to payment
    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'invoice_number' => 'required|string|max:255',
            'invoice_date' => 'required|date',
            'customer_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'item_description' => 'required|string|max:1000',
            'amount' => 'required|numeric',
        ]);

        // Create the invoice
        $invoice = Invoice::create([
            'invoice_number' => $request->invoice_number,
            'customer_name' => $request->customer_name,
            'email' => $request->email,
            'amount' => $request->amount,
            'item_description' => $request->item_description,
            'invoice_date' => $request->invoice_date,
        ]);

        // Create a transaction for the invoice
        $transaction = Transaction::create([
            'invoice_number' => $invoice->id,
            'customer_name' => $request->customer_name,
            'amount' => $request->amount,
            'invoice_date' => $request->invoice_date,
            'status' => 'pending', // or any default status
        ]);

        // Generate the checkout URL
        $checkoutUrl = route('checkout', ['invoice' => $invoice->id]);

        // Send the invoice email with the checkout URL
        $this->sendInvoiceEmail($invoice, $checkoutUrl);

        return redirect()->route('invoice')->with('success', 'Invoice and Transaction Created and Email sent Successfully!');
    }

    //this will send email with the payment button
    protected function sendInvoiceEmail(Invoice $invoice, $checkoutUrl)
    {
        Mail::to($invoice->email)
            ->send(new InvoiceCreated($invoice, $checkoutUrl));
    }

    //Index method for view data in the page
    public function index()
    {
        // Fetch all invoices from the database
        $invoices = Invoice::all(); //$variable name = model name::all();

        // Pass the invoices data to the view
        return Inertia::render('Invoice', [
            'invoices' => $invoices // 'prop name' => variable name
        ]);
    }

    // public function getCustomerDetails($id)
    // {
    //     $customer = Customer::findOrFail($id);
    //     return response()->json($customer);
    // }


    //View Invoice Details
    public function show($id)
    {
        $customer = Invoice::findOrFail($id);// $customer = model name::findOrFail($id);

        return Inertia::render('InvoiceShow', [
            'customer' => $customer
        ]);
    }

    //Edit Record
    public function edit($id)
    {
        $customer = Invoice::findOrFail($id);

        return Inertia::render('InvoiceEdit', [
            'customer' => $customer
        ]);
    }

    // Update record
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'invoice_number' => 'required|string|max:255',
            'invoice_date' => 'required|date',
            'customer_name' => 'required|string|max:255',
            'item_description' => 'nullable|string|max:255',
            'amount' => 'nullable|numeric|min:0',
        ]);

        $customer = Invoice::findOrFail($id);
        $customer->update($validated);

        return redirect()->route('invoice', $customer->id)->with('success', 'Invoice Updated Successfully!');
    }

    //Delete a record
    public function destroy($id)
    {
        $customer = Invoice::findOrFail($id);
        $customer->delete();

        return redirect()->route('invoice')->with('success', 'Invoice Deleted Successfully!');
    }
    //Status Change
    public function changeStatus($id)
    {
        $customer = Invoice::findOrFail($id);

        // Toggle the status
        $customer->status = $customer->status === 'approved' ? 'rejected' : 'Approved';

        // Save the updated status
        $customer->save();

        // Redirect back with a success message
        return redirect()->route('invoice')->with('success', 'Invoice Status Updated Successfully!');
    }


}
