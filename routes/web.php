<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WebhookController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Main landing page
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Authenticated routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Dashboard route handled by DashboardController
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Invoice related routes
    Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('create_invoice');
    Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoice');
    Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoice_store');
    Route::get('/invoices/{id}', [InvoiceController::class, 'show'])->name('invoice.show');
    Route::get('/invoices/{id}/edit', [InvoiceController::class, 'edit'])->name('invoice.edit');
    Route::put('/invoices/{id}', [InvoiceController::class, 'update'])->name('invoice.update');
    Route::delete('/invoices/{id}', [InvoiceController::class, 'destroy'])->name('invoice.destroy');
    Route::post('/invoices/{id}/change-status', [InvoiceController::class, 'changeStatus'])->name('invoice.changeStatus');

    // Customer related routes
    Route::get('/create-customer', [CustomerController::class, 'create'])->name('create_customer');
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customer_store');
    Route::get('/customer/{id}', [CustomerController::class, 'show'])->name('customer.show');
    Route::get('/customer/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::put('/customer/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::get('/customers/{id}', [CustomerController::class, 'show'])->name('customer.show');
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');
    Route::post('/customer/{id}/change-status', [CustomerController::class, 'changeStatus'])->name('customer.changeStatus');



    // Proposal related routes
    Route::get('/create-proposal', [ProposalController::class, 'create'])->name('create_proposal');
    Route::get('/proposal', [ProposalController::class, 'index'])->name('proposal');
    Route::post('/proposals', [ProposalController::class, 'store'])->name('proposal_store');
    Route::get('/proposals/{id}', [ProposalController::class, 'show'])->name('proposal.show');
    Route::get('/proposals/{id}/edit', [ProposalController::class, 'edit'])->name('proposal.edit');
    Route::put('/proposals/{id}', [ProposalController::class, 'update'])->name('proposal.update');
    Route::delete('/proposals/{id}', [ProposalController::class, 'destroy'])->name('proposal.destroy');
    Route::post('/proposals/{id}/change-status', [ProposalController::class, 'changeStatus'])->name('proposal.changeStatus');

    //Payment Process related routes
    //Route::get('/checkout', [PaymentController::class, 'createCheckoutSession'])->name('checkout');
    Route::get('/payment-success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment-cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
    Route::get('/checkout/{invoice}', [PaymentController::class, 'createCheckoutSession'])->name('checkout');
    Route::post('/webhook/stripe', [WebhookController::class, 'handleStripeWebhook']);

    ///Tranasaction Related Routes
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');
    Route::post('/transaction', [TransactionController::class, 'store'])->name('transactions_store');

    //Dashboard Related Routes
    //Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


});
