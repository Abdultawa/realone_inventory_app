<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $invoice->invoice_number }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .invoice-header { margin-bottom: 20px; }
        .company-info { margin-bottom: 30px; }
        .invoice-info { margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
        .text-right { text-align: right; }
        .total-row { font-weight: bold; }
        .footer { margin-top: 50px; font-size: 0.8em; }
    </style>
</head>
<body>
    <div class="invoice-header">
        @if(file_exists($company['logo']))
            <img src="{{ $company['logo'] }}" alt="Company Logo" style="height: 80px; margin-bottom: 20px;">
        @endif
        <h1>INVOICE</h1>
    </div>

    <div class="company-info">
        <h3>{{ $company['name'] }}</h3>
        <p>{{ $company['address'] }}</p>
        <p>Phone: {{ $company['phone'] }}</p>
        <p>Email: {{ $company['email'] }}</p>
    </div>

    <div class="invoice-info">
        <div style="float: left; width: 50%;">
            <h4>Bill To:</h4>
            <p><strong>{{ $invoice->customer_name }}</strong></p>
            <p>{{ $invoice->customer_address }}</p>
        </div>
        <div style="float: right; width: 40%;">
            <p><strong>Invoice #:</strong> {{ $invoice->invoice_number }}</p>
            <p><strong>Date:</strong> {{ $invoice->created_at->format('d M Y') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($invoice->status) }}</p>
        </div>
        <div style="clear: both;"></div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Description</th>
                <th class="text-right">Qty</th>
                <th class="text-right">Unit Price</th>
                <th class="text-right">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->items as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->product->name ?? 'Product deleted' }}</td>
                <td class="text-right">{{ $item->quantity }}</td>
                <td class="text-right">₦{{ number_format($item->price, 2) }}</td>
                <td class="text-right">₦{{ number_format($item->price * $item->quantity, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="4" class="text-right">TOTAL</td>
                <td class="text-right">₦{{ number_format($invoice->total_amount, 2) }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p><strong>Notes:</strong> {{ $invoice->notes }}</p>
        <p>Thank you for your business!</p>
    </div>
</body>
</html>
