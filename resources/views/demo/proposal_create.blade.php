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
    <h3>Create Proposal</h3>
    <form>
        <div class="mb-3">
            <label for="proposalTitle" class="form-label">Proposal Title</label>
            <input type="text" class="form-control" id="proposalTitle" placeholder="Enter Proposal Title">
        </div>
        <div class="mb-3">
            <label for="proposalDate" class="form-label">Proposal Date</label>
            <input type="date" class="form-control" id="proposalDate">
        </div>
        <div class="mb-3">
            <label for="clientName" class="form-label">Client Name</label>
            <input type="text" class="form-control" id="clientName" placeholder="Enter Client Name">
        </div>
        <div class="mb-3">
            <label for="proposalDetails" class="form-label">Proposal Details</label>
            <textarea class="form-control" id="proposalDetails" rows="4" placeholder="Enter Proposal Details"></textarea>
        </div>
        <div class="mb-3">
            <label for="estimatedCost" class="form-label">Estimated Cost</label>
            <input type="number" class="form-control" id="estimatedCost" placeholder="Enter Estimated Cost">
        </div>
        <button type="submit" class="btn btn-primary">Create Proposal</button>
    </form>
</div>


</body>
</html>
