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
        th, td {
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
        <p>To: {{ $full_name }}<span style="float: right">Generated on: {{ now()->timezone('Asia/Manila')->format('F j, Y') }}</span></p>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalPrice = 0;
                @endphp
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->title }}</td>
                        <td>P{{ formatRevenue($product->price) }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>P{{ formatRevenue($product->price * $product->quantity) }}</td>
                    </tr>
                    @php
                        $totalPrice += $product->price * $product->quantity;
                    @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">Total:</td>
                    <td style="text-align: left;">P{{ formatRevenue($totalPrice) }}</td>
                </tr>
            </tfoot>
        </table>
        <div class="total">
            @php
                $payBeforeDate = date('F j, Y', strtotime('+3 days'));
            @endphp
            <p><strong>Pay before :</strong> {{ $payBeforeDate }}</p>
        </div>        
    </div>
</body>
</html>
