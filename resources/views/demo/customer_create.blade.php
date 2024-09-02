<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    {{-- this code will take the errors from the controller and show it here --}}
        <!-- @csrf
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error )
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif -->
        {{-- this @csrf is a token that used for security pourposes in Laravel --}}
    <h3>Add New Customer</h3>
    <form>
        <div class="mb-3">
            <label for="customerName" class="form-label">Customer Name</label>
            <input type="text" class="form-control" id="customerName" placeholder="Enter Customer Name">
        </div>
        <div class="mb-3">
            <label for="customerEmail" class="form-label">Customer Email</label>
            <input type="email" class="form-control" id="customerEmail" placeholder="Enter Customer Email">
        </div>
        <div class="mb-3">
            <label for="customerPhone" class="form-label">Customer Phone</label>
            <input type="tel" class="form-control" id="customerPhone" placeholder="Enter Customer Phone">
        </div>
        <div class="mb-3">
            <label for="customerAddress" class="form-label">Customer Address</label>
            <textarea class="form-control" id="customerAddress" rows="3" placeholder="Enter Customer Address"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Customer</button>
    </form>
</div>
</body>
</html>
