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
    <h3>Create Invoice</h3>
    <form>
        <div class="mb-3">
            <label for="invoiceNumber" class="form-label">Invoice Number</label>
            <input type="text" class="form-control" id="invoiceNumber" placeholder="Enter Invoice Number">
        </div>
        <div class="mb-3">
            <label for="invoiceDate" class="form-label">Invoice Date</label>
            <input type="date" class="form-control" id="invoiceDate">
        </div>
        <div class="mb-3">
            <label for="customerName" class="form-label">Customer Name</label>
            <input type="text" class="form-control" id="customerName" placeholder="Enter Customer Name">
        </div>
        <div class="mb-3">
            <label for="itemDescription" class="form-label">Item Description</label>
            <textarea class="form-control" id="itemDescription" rows="3" placeholder="Enter Item Description"></textarea>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" class="form-control" id="amount" placeholder="Enter Amount">
        </div>
        <button type="submit" class="btn btn-primary">Create Invoice</button>
    </form>
</div>

</body>
</html>
