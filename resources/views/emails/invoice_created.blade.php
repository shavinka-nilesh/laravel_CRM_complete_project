<!DOCTYPE html>
<html>
<head>
    <title>New Invoice</title>
</head>
<body>
    <h1>Invoice #{{  $invoice->invoice_number }}</h1>
    <p>Dear {{ $invoice->customer_name }},</p>
    <p>An Invoice for your proposal is created.</p>
    <p><strong>Invoice Details:</strong></p>
    <ul>
        <li>Amount: {{ $invoice->amount }}</li>
        <li>Due Date: {{ $invoice->invoice_date }}</li>
    </ul>
    <p>Please click the button below to proceed with the payment.</p>
    <a href="{{ $checkoutUrl }}" style="display:inline-block;padding:10px 20px;color:#fff;background-color:#007bff;border:none;border-radius:5px;text-decoration:none;">Pay Now</a>
    <p>Thank you for your business.</p>
</body>
</html>
