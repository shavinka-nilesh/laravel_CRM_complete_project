<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="container">
    {{-- add a button to go to create.blade.php --}}
    <a href="{{route('student.create')}}" class="btn btn-secondary mt-3">Create</a>
    <table class="table">
        <thead class="thead-dark mt-5">
          <tr>
            <th scope="col">#</th>
            <th scope="col">First Name</th>
            <th scope="col">Contact No</th>
            <th scope="col">Date of Birth</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
            {{-- this will get the object arrays and create raw eqal to the data raws in the object --}}
            @foreach ($students as $student)
          <tr>
            {{-- this will load the id from the object to this table,$object name->column name in the database you want to view --}}
            <th scope="row">{{$student->id}}</th>
            <td>{{$student->first_name}}</td>
            <td>{{$student->contact_no}}</td>
            <td>{{$student->dob}}</td>
            <td></td>
          </tr>
          @endforeach
        </tbody>
      </table>
</body>
</html>
