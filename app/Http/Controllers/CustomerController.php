<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    //
    // public function index(){ //crate a function called a index. this function will return the index.php file ine invoice folder
    //    // return"Sucess"; //to check whether the web php will use this controller to view index.php
    //     return view("invoice.index"); //return the index file in the invoice folder in view
    // }
    // // public function create(){
    //     return view("student.customers");
    // }
    //Create a new record
    public function create(){
        return Inertia::render('CreateCustomer');//return view("foldername.pagename")
    }
    public function index(){
        // return Inertia::render('Customer');//return view("foldername.pagename")
        // Fetch all invoices from the database
        $customers = Customer::all(); //$variable name = model name::all();

        // Pass the invoices data to the view
        return Inertia::render('Customer', [
            'customers' => $customers // 'prop name' => variable name
        ]);

    }
    // public function show($id)
    // {
    //     $customer = Customer::findOrFail($id);
    //     return response()->json($customer);
    // }

    //create an object called request to store data
    public function store(Request $request){

        // $rules=[
        //     'first_name'=>'required|string', //creating the rules for validation
        //     'address'=>'required|string',
        //     'last_name'=>'required|string',
        // ];

        // // $validator= Validator::make($request->all(),$rules);//give validator the above created rules to check and validate
        // $validator=Validator::make($request->all(),$rules,$messages=[
        //     'first_name.required'=>'First Name field cannot be empty',
        //     'address.required'=>'Address field cannot be empty',//input field name.required=>Message you want to display
        // ]);//give validator the above created rules to check and validate
        // if($validator->fails()){
        //     return redirect()->back()->withErrors($validator)->withInput(); //this will chceck if the validator is success of failed if the validator is failed then the rules will be checked and the errors with input data will be redirected to the create page
        // }
        //method 01
        // return $request;//view the returened data in the request method
        // $student = new Customer();// create a object called $student using Student class in student model
        // $student->first_name = $request->first_name;// insert the value in first_name in $request object to the first_name in $student object
        // $student->last_name = $request->last_name;
        // $student->contact_no = $request->contact_no;
        // $student->address = $request->address;
        // $student->dob = $request->dob;
        // $student->save();//save all the data

        //method 02
        // $student=Student::create($request->all());//we create this object to pass all the values from the create from to this object using fillables in model.


        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',//'column Name' => 'required->this means this filed cannot be empty|datatype|maximum output',
            'email' => 'required|string',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:1000',
        ]);

        // Save the data to the database
        Customer::create($validated); //this Invoice is the model name

        // Redirect back with success message
        return redirect()->route('customer')->with('success', 'Customer Added Successfully!');//return redirect()->route('rout name')->with('success', 'success message');
        //return "Success"; //return the success message after save

     }

     //Edit Record
        public function edit($id)
    {
        $customer = Customer::findOrFail($id);

        return Inertia::render('CustomerEdit', [
            'customer' => $customer
        ]);
    }

    // Update record
        public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($validated);

        return redirect()->route('customer', $customer->id)->with('success', 'Customer Updated Successfully!');
    }
    //View Customer Details
        public function show($id)
    {
        $customer = Customer::findOrFail($id);

        return Inertia::render('CustomerShow', [
            'customer' => $customer
        ]);
    }

    //Delete a record
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customer')->with('success', 'Customer deleted successfully!');
    }

        //Status Change
        public function changeStatus($id)
    {
        $customer = Customer::findOrFail($id);

        // Toggle the status
        $customer->status = $customer->status === 'active' ? 'inactive' : 'active';

        // Save the updated status
        $customer->save();

        // Redirect back with a success message
        return redirect()->route('customer')->with('success', 'Customer status updated successfully!');
    }



}
