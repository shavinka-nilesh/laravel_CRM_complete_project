<?php

;
namespace App\Http\Controllers;
use inertia\Inertia;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
//use App\Models\Transaction;


class TransactionController extends Controller
{
    public function index(Request $request){
       // return Inertia::render('Transaction');
       $proposals = Transaction::all();

        // Pass the invoices data to the view
        return Inertia::render('Transaction', [
            'proposals' => $proposals // 'prop name' => variable name
        ]);
    }
    public function create(Request $request){
        // return Inertia::render('CreateProposal');//return Inertia::render('vue page name');
        $customer = null;

        if ($request->has('customer_id')) {
            $customer = Transaction::findOrFail($request->input('customer_id'));
        }

        return Inertia::render('CreateProposal', [
            'customer' => $customer,
        ]);
    }
}
