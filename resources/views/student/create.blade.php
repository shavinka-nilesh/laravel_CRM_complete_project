<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <form class="container" action="{{route ('student.store')}}" method="POST">
        {{-- this code will take the errors from the controller and show it here --}}
        @csrf
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error )
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        {{-- this @csrf is a token that used for security pourposes in Laravel --}}
        <div class="form-group mt-2">
          <label for="exampleInputEmail1">First Name</label>
          <input type="text" class="form-control" name="first_name" placeholder="Enter First Name">
        </div>
        <div class="form-group mt-2">
            <label for="exampleInputEmail1">Last Name</label>
            <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name">
        </div>
        <div class="form-group mt-2">
            <label for="exampleInputEmail1">Contact No</label>
            <input type="text" class="form-control" name="contact_no" placeholder="Enter Contact No">
        </div>
        <div class="form-group mt-2">
            <label for="exampleInputEmail1">Address</label>
            <input type="text" class="form-control" name="address" placeholder="Enter Address">
        </div>
        <div class="form-group mt-2">
            <label for="exampleInputEmail1">Birth Day</label>
            <input type="text" class="form-control" name="dob" placeholder="Enter Birthday">
        </div>
        {{-- <div class="form-check mt-2">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div> --}}
        <button type="submit" class="btn btn-primary mt-2">Submit</button>
      </form>
</body>
</html>
