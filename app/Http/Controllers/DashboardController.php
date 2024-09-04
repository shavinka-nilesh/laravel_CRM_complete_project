<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Proposal;
use App\Models\Transaction;
use Inertia\Inertia;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCustomers = Customer::count();//this will take a count in the customers table in the database and return the number of records and store in the $totalcustomers table.
        $totalInvoices = Invoice::count();
        $totalProposals = Proposal::count();
        $totalTransactions = Transaction::count();
        $latestInvoices = Invoice::orderBy('created_at', 'desc')->take(3)->get();//The orderby() method order the invoices by their creation date in descending order, and the take(3) method limits the result to the most recent 5 invoices. The get() method then fetches these records from the database and stores them in the $latestInvoices variable.
        $recentTransactions = Transaction::orderBy('created_at', 'desc')->take(3)->get();
        $recentCustomers = Customer::orderBy('created_at', 'desc')->take(3)->get();

        return Inertia::render('Dashboard', [//this willl render the inertia dashboard vue component and this will allow to directly acccess the variables in the Dashboard component.
            'totalCustomers' => $totalCustomers,//The keys 'totalCustomers', 'totalInvoices', 'latestInvoices', 'recentTransactions', and 'recentCustomers' represent the prop names, while the corresponding variables hold the actual
            'totalInvoices' => $totalInvoices,
            'totalProposals' => $totalProposals,
            'totalTransactions' => $totalTransactions,
            'latestInvoices' => $latestInvoices,
            'recentTransactions' => $recentTransactions,
            'recentCustomers' => $recentCustomers,
        ]);
    }
}
