<?php
function formatRevenue($revenue)
{
    if ($revenue >= 1000) {
        return number_format($revenue);
    } else {
        return $revenue;
    }
}
?>
@php
    $totalPrice = 0;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $full_name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fff;
        }

        h1 {
            font-size: 28px;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tfoot td {
            text-align: right;
            font-weight: bold;
        }

        .total {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Invoice</h1>
        <p>Customer: {{ $full_name }}<span style="float: right">Generated on:
                {{ now()->timezone('Asia/Manila')->format('F j, Y') }}</span></p>
        @foreach ($products as $product)
            <p>Order ID: {{ $product->order_id }}<span style="float: right;">Paid with:
                    {{ ucfirst($product->mode_of_payment) }}</span></p>
        @endforeach
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            @foreach ($products as $product)
                <tbody>
                    <tr>
                        <td>{{ $product->product_name }}</td>
                        <td>P{{ formatRevenue($product->base_price) }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>P{{ formatRevenue($product->base_price * $product->quantity) }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    @php
                        $tax = $product->base_price * $product->quantity * 0.0349;
                        $taxFormatted = number_format($tax, 2);
                    @endphp
                    <tr>
                        <td colspan="3">Tax:</td>
                        <td style="text-align: left;">P{{ formatRevenue($taxFormatted) }}</td>
                    </tr>
                    <tr>
                        <td colspan="3">Handling fee:</td>
                        <td style="text-align: left;">P{{ formatRevenue(25) }}</td>
                    </tr>
                    <tr>
                        <td colspan="3">Total:</td>
                        <td style="text-align: left;">P{{ formatRevenue($product->total_amount) }}</td>
                    </tr>
                </tfoot>
                @php
                    $payBeforeDate = $product->purchased_date;
                @endphp
            @endforeach
        </table>
        <div class="total">
            <p><strong>Paid on </strong>{{ \Carbon\Carbon::parse($payBeforeDate)->format('F d, Y') }}</p>
        </div>
    </div>
</body>

</html>
