<?php

namespace App\Http\Controllers; //import the controller class
use App\Models\Student;// import the student model
use Illuminate\Http\Request; //import the request class
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index(){ //crate a function called a index. this function will return the index.php file ine student folder
        // return"Sucess"; to check whether the web php will use this controller to view index.php
        $students = Student::all(); // this will get the all the data from database table using Student model to this $student object
        return view("student.index", compact('students')); //return the index file in the student folder in view with the data in $students object.when giving the object name remove$ and put it in the ''.
    }
    public function create(){
        return view("student.create");
    }
    //create an object called request to store data
    public function store(Request $request){

        $rules=[
            'first_name'=>'required|string', //creating the rules for validation
            'address'=>'required|string',
            'last_name'=>'required|string',
        ];

        // $validator= Validator::make($request->all(),$rules);//give validator the above created rules to check and validate
        $validator=Validator::make($request->all(),$rules,$messages=[
            'first_name.required'=>'First Name field cannot be empty',
            'address.required'=>'Address field cannot be empty',//input field name.required=>Message you want to display
        ]);//give validator the above created rules to check and validate
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput(); //this will chceck if the validator is success of failed if the validator is failed then the rules will be checked and the errors with input data will be redirected to the create page
        }
        //method 01
        // return $request;//view the returened data in the request method
        $student = new Student();// create a object called $student using Student class in student model
        $student->first_name = $request->first_name;// insert the value in first_name in $request object to the first_name in $student object
        $student->last_name = $request->last_name;
        $student->contact_no = $request->contact_no;
        $student->address = $request->address;
        $student->dob = $request->dob;
        $student->save();//save all the data

        //method 02
        // $student=Student::create($request->all());//we create this object to pass all the values from the create from to this object using fillables in model.
        return "Success"; //return the success message after save

     }
}
