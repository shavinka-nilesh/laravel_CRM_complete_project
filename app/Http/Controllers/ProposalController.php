<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Inertia\Inertia;//it is crucial to add this inertia here
use Illuminate\Http\Request;
use App\Models\Customer;

class ProposalController extends Controller
{
    public function create(Request $request){
        // return Inertia::render('CreateProposal');//return Inertia::render('vue page name');
        $customer = null;

        if ($request->has('customer_id')) {
            $customer = Customer::findOrFail($request->input('customer_id'));
        }

        return Inertia::render('CreateProposal', [
            'customer' => $customer,
        ]);
    }

    public function index(){
        // return Inertia::render('Proposal');//return Inertia::render('vue page name');
         // Fetch all invoices from the database
         $proposals = Proposal::all(); //$variable name = model name::all();

         // Pass the invoices data to the view
         return Inertia::render('Proposal', [
             'proposals' => $proposals // 'prop name' => variable name
         ]);
    }

    public function store(Request $request)
    {
        //return Inertia::render('Invoice');//return Inertia::render('vue page name');
        //return $request;
        // Validate the form data
        $validated = $request->validate([
            'title' => 'required|string|max:255',//'column Name' => 'required->this means this filed cannot be empty|datatype|maximum output',
            'date' => 'required|date',
            'name' => 'required|string|max:255',
            'details' => 'required|string|max:1000',
            'cost' => 'required|numeric',
        ]);

        // Save the data to the database
        Proposal::create($validated); //this Invoice is the model name

        // Redirect back with success message
        return redirect()->route('proposal')->with('success', 'Proposal Created Successfully!');//return redirect()->route('rout name')->with('success', 'success message');
    }

    //View Proposal Details
    public function show($id)
    {
        $customer = Proposal::findOrFail($id);// $customer = model name::findOrFail($id);

        return Inertia::render('ProposalShow', [
            'customer' => $customer
        ]);
    }

    //Edit Record
    public function edit($id)
    {
        $customer = Proposal::findOrFail($id);

        return Inertia::render('ProposalEdit', [
            'customer' => $customer
        ]);
    }

    // Update record
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'name' => 'required|string|max:255',
            'details' => 'nullable|string|max:255',
            'cost' => 'nullable|numeric|min:0',
        ]);

        $customer = Proposal::findOrFail($id);
        $customer->update($validated);

        return redirect()->route('proposal', $customer->id)->with('success', 'Proposal Updated Successfully!');
    }

    //Delete a record
    public function destroy($id)
    {
        $customer = Proposal::findOrFail($id);
        $customer->delete();

        return redirect()->route('proposal')->with('success', 'Proposal Deleted Successfully!');
    }

       //Status Change
       public function changeStatus($id)
       {
           $customer = Proposal::findOrFail($id);

           // Toggle the status
           $customer->status = $customer->status === 'approved' ? 'rejected' : 'approved';

           // Save the updated status
           $customer->save();

           // Redirect back with a success message
           return redirect()->route('proposal')->with('success', 'Proposal Status Updated Successfully!');
       }

}
