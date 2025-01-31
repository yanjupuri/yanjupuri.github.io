<x-app-layout :assets="$assets ?? []">
<!DOCTYPE html>
<html>
    <head>
      <title>Payment</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
      <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
      <style>
        .payment-form{
          padding-bottom: 50px;
          font-family: 'Montserrat', sans-serif;
        }
    
        .payment-form.dark{
          background-color: #f6f6f6;
        }
    
        .payment-form .content{
          box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
          background-color: white;
        }
    
        .payment-form .block-heading{
            padding-top: 50px;
            margin-bottom: 40px;
            text-align: center;
        }
    
        .payment-form .block-heading p{
          text-align: center;
          max-width: 420px;
          margin: auto;
          opacity:0.7;
        }
    
        .payment-form.dark .block-heading p{
          opacity:0.8;
        }
    
        .payment-form .block-heading h1,
        .payment-form .block-heading h2,
        .payment-form .block-heading h3 {
          margin-bottom:1.2rem;
          color: #3b99e0;
        }
    
        .payment-form form{
          border-top: 2px solid #5ea4f3;
          box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
          background-color: #ffffff;
          padding: 0;
          max-width: 600px;
          margin: auto;
        }
    
        .payment-form .title{
          font-size: 1em;
          border-bottom: 1px solid rgba(0,0,0,0.1);
          margin-bottom: 0.8em;
          font-weight: 600;
          padding-bottom: 8px;
        }
    
        .payment-form .products{
          background-color: #f7fbff;
            padding: 25px;
        }
    
        .payment-form .products .item{
          margin-bottom:1em;
        }
    
        .payment-form .products .item-name{
          font-weight:600;
          font-size: 0.9em;
        }
    
        .payment-form .products .item-price{
          font-size:0.8em;
          opacity:0.6;
        }
    
        .payment-form .products .item p{
          margin-bottom:0.2em;
        }
    
        .payment-form .products .price{
          float: right;
          font-weight: 600;
          font-size: 0.9em;
        }
    
        .payment-form .products .total{
          border-top: 1px solid rgba(0, 0, 0, 0.1);
          margin-top: 10px;
          padding-top: 19px;
          font-weight: 600;
          line-height: 1;
        }
    
        .payment-form .card-details{
          padding: 25px 25px 15px;
        }
    
        .payment-form .card-details label{
          font-size: 12px;
          font-weight: 600;
          margin-bottom: 15px;
          color: #79818a;
          text-transform: uppercase;
        }
    
        .payment-form .card-details button{
          margin-top: 0.6em;
          padding:12px 0;
          font-weight: 600;
        }
    
        .payment-form .date-separator{
          margin-left: 10px;
            margin-right: 10px;
            margin-top: 5px;
        }
    
        @media (min-width: 576px) {
          .payment-form .title {
            font-size: 1.2em; 
          }
    
          .payment-form .products {
            padding: 40px; 
          }
    
          .payment-form .products .item-name {
            font-size: 1em; 
          }
    
          .payment-form .products .price {
              font-size: 1em; 
          }
    
          .payment-form .card-details {
            padding: 40px 40px 30px; 
          }
    
          .payment-form .card-details button {
            margin-top: 2em; 
          } 
        }
      </style>
    </head>
    <body>
        <input type="hidden" id="first_name_input" value="{{ auth()->check() ? auth()->user()->first_name : '' }}" />
        <input type="hidden" id="last_name_input" value="{{ auth()->check() ? auth()->user()->last_name : '' }}" />
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
        @isset($products)
            <main class="page payment-page" style="min-height: calc(100vh - 72px);">
                <section class="payment-form">
                    <div class="container">
                        <div class="block-heading">
                        <h2>Payment</h2>
                        </div>
                        <form>
                            @csrf
                            @php
                                $totalPrice = 0;
                            @endphp
                            <div class="products">
                                <h3 class="title">Checkout</h3>
                                @foreach ($products as $product)
                                    <div class="item" data-product-id="{{ $product->id }}" data-product-title="{{ $product->title }}" data-product-price="{{ $product->price }}" data-product-description="{{ $product->description }}" data-product-quantity="{{ $product->quantity }}">
                                        <span class="price">₱{{ formatRevenue($product->price * $product->quantity) }}</span>
                                        <p class="item-name">{{ $product->title }}</p>
                                        <p class="item-price">Price: {{ $product->price }}<br>Quantity: {{ $product->quantity }}</p>
                                    </div>                        
                                    @php
                                        $totalPrice += $product->price * $product->quantity;
                                    @endphp
                                @endforeach
                                <div class="total">Total<span class="price">₱{{ formatRevenue($totalPrice) }}</span></div>
                            </div>   

                            <div class="card-details">
                                <h3 class="title">Payment method</h3>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <button type="button" class="btn btn-primary btn-block paypal" id="purchaseButton">PayPal</button>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <button type="button" class="btn btn-primary btn-block cash" id="cashButton">Cash</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </main>       
        @endisset

        <div class="modal fade" id="paypal_payment_modal" tabindex="-1" role="dialog" aria-labelledby="paypalPaymentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="paypalPaymentModalLabel">Pay with PayPal</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- PayPal button container -->
                        <div id="paypal-button-container"></div>
                    </div>
                </div>
            </div>
        </div>
        
    <!-- Sandbox test API -->    
    <script src="https://www.paypal.com/sdk/js?locale=en_PH&client-id=AY3H_gV1JvwI574nemwgev49r3HHa_RNex-Vm9U_IiIn1_9MukHf0E_I8Q5DYZMqKbcN84xCkQ-PTGaf&currency=PHP"></script>

    <!-- Live API -->
    {{-- <script src="https://www.paypal.com/sdk/js?locale=en_PH&client-id=ASK_IzoAnCAY99BmK2FpSrKbtZraYgcq3jcSDWztm1A884RS-rE9DN3iJArUqHrVGe6bjzfiRbk17_47&currency=PHP"></script> --}}
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            // Billing address details
            var firstName = document.getElementById('first_name_input').value;
            var lastName = document.getElementById('last_name_input').value;
    
            var items = $('.item');
            var itemsData = [];
            
            items.each(function() {
                var item = $(this);
                var productId = item.data('productId');
                var productTitle = item.data('productTitle');
                var productPrice = parseFloat(item.data('productPrice'));
                var productDescription = item.data('productDescription');
                var productQty = item.data('productQuantity');

                var basePrice = productPrice * productQty;
                var percentageFee = 3.49 / 100;
                var tax_total = basePrice * percentageFee;
                tax_total = tax_total.toFixed(2);
                var fixedFee = 25;

                var totalAmount = basePrice + (basePrice * percentageFee) + fixedFee;
                totalAmount = totalAmount.toFixed(2);
                var itemData = {
                    productId: productId,
                    productTitle: productTitle,
                    productPrice: productPrice,
                    productDescription: productDescription,
                    productQty: productQty,
                    totalAmount: totalAmount,
                    tax_total: tax_total,
                    fixedFee: fixedFee,
                    basePrice: basePrice
                };

                itemsData.push(itemData);
            });

            $('#cashButton').click(function (event){
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                var ids = [];
                itemsData.forEach(function(itemData) {
                    ids.push(itemData.productId);
                });
                console.log(ids);
                window.location.href = "{{ route('print.cash.invoice') }}?checkedItems=" + JSON.stringify(ids) + "&_token=" + csrfToken;
            });

    
            $('#purchaseButton').click(function (event){
                $('#paypal-button-container').empty();
                $('#paypal_payment_modal').modal('show');
                paypal.Buttons({
                    style: {
                        layout: 'vertical',
                        color: 'blue',
                        shape: 'pill',
                        label: 'paypal',
                    },
                    createOrder: function(data, actions) {
                        var purchase_units = [];

                        // Construct purchase_units for each item
                        itemsData.forEach(function(itemData, index) {
                            var referenceId = 'item_' + index;
                            var purchaseUnit = {
                                reference_id: referenceId,
                                description: itemData.productTitle,
                                amount: {
                                    currency_code: "PHP",
                                    value: itemData.totalAmount,
                                    breakdown: {
                                        handling: {
                                            currency_code: "PHP",
                                            value: itemData.fixedFee
                                        },
                                        tax_total: {
                                            currency_code: "PHP",
                                            value: itemData.tax_total
                                        },
                                        item_total: {
                                            currency_code: "PHP",
                                            value: itemData.basePrice
                                        }
                                    }
                                },
                                payment_source: "paypal"
                            };

                            purchase_units.push(purchaseUnit);
                        });
                        return actions.order.create({
                            purchase_units: purchase_units,
                            payer: {
                                name: {
                                    given_name: firstName,
                                    surname: lastName
                                }
                            },
                            application_context: {
                                shipping_preference: 'NO_SHIPPING',
                                payment_method: {
                                    payer_selected: "PAYPAL",
                                    payee_preferred: "IMMEDIATE_PAYMENT_REQUIRED"
                                }
                            }
                        });
                    },
                    onApprove: function(data, actions) {
                        var options = { timeZone: 'Asia/Manila' };
                        var currentDate = new Date().toLocaleString('en-US', options);
                        var year = new Date(currentDate).getFullYear();
                        var month = String(new Date(currentDate).getMonth() + 1).padStart(2, '0');
                        var day = String(new Date(currentDate).getDate()).padStart(2, '0');
                        var formattedDate = year + '-' + month + '-' + day;
                        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                        var ids = [];
                        itemsData.forEach(function(itemData) {
                            ids.push(itemData.productId);
                        });
                        console.log(ids);
                        // window.location.href = "{{ route('print.paypal.invoice') }}?checkedItems=" + JSON.stringify(ids) + "&_token=" + csrfToken;
                        
                        setTimeout(() => {
                            itemsData.forEach(function(itemData) {
                                var formData = {
                                    types: 'product',
                                    amount: itemData.productPrice,
                                    quantity: itemData.productQty,
                                    product: itemData.productTitle,
                                    product_id: itemData.productId,
                                    purchased_date: formattedDate,
                                    _token: csrfToken
                                };

                                var orderHistory = {
                                    product_id: itemData.productId,
                                    product_name: itemData.productTitle,
                                    purchased_date: formattedDate,
                                    total_amount: itemData.totalAmount,
                                    status: 'pending',
                                    base_price: itemData.productPrice,
                                    quantity: itemData.productQty,
                                    orderID: data.orderID,
                                    MOP: 'paypal',
                                    _token: csrfToken
                                };

                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('create.order.history') }}",
                                    data: orderHistory,
                                    success: function(response){
                                        if (response.success) {
                                            console.log("Successfully added to order history");
                                        } else {
                                            console.log("Failed to add to order history");
                                        }
                                    },
                                    error: function(xhr, textStatus, errorThrown){
                                        console.log(xhr.responseText);
                                        Swal.fire({
                                            title: 'Error',
                                            text: 'An error occurred while processing your request.',
                                            icon: 'error',
                                            confirmButtonText: 'OK',
                                        });
                                    }
                                });

                                // $.ajax({
                                //     type: "POST",
                                //     url: "{{ route('add.revenue') }}",
                                //     data: formData,
                                //     success: function(response) {
                                //         console.log("Successfully added to revenue");
                                //     },
                                //     error: function(xhr, textStatus, errorThrown) {
                                //         console.log(xhr.responseText);
                                //         Swal.fire({
                                //             title: 'Error',
                                //             text: 'An error occurred while processing your request.',
                                //             icon: 'error',
                                //             confirmButtonText: 'OK',
                                //         });
                                //     }
                                // });

                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('remove-from-cart') }}",
                                    data: {
                                        productId: itemData.productId,
                                        _token: csrfToken
                                    },
                                    success: function(response){
                                        console.log(response.message);
                                    },
                                    error: function(xhr, textStatus, errorThrown){
                                        console.log(xhr.responseText);
                                    }
                                });
                            });

                            Swal.fire({
                                title: 'TRANSACTION COMPLETED!',
                                html: `Order ID: ${data.orderID}<br>Please pick up your item at the shop. Thank you for your purchase!`,
                                icon: 'success',
                                confirmButtonText: 'OK',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "{{ route('cart') }}";
                                }else{
                                    window.location.href = "{{ route('cart') }}";
                                }
                            });

                            $('#paypal_payment_modal').modal('hide');
                            return actions.order.capture();                         
                        }, 1000);

                    },
                    onCancel: function(data) {
                        $('#paypal_payment_modal').modal('hide');
                        console.log('Payment cancelled:', data);
                        Swal.fire({
                            title: 'PAYMENT CANCELLED!',
                            text: `Order ID: ${data.orderID}`,
                            icon: 'error',
                            confirmButtonText: 'OK',
                        });
                    }
                }).render('#paypal-button-container');

            });
        });

        window.onload = function(event) {
            Swal.close();
        };

        window.addEventListener('pagehide', function(event) {
            Swal.close();
        });
    </script>
    
    </body>
</html>
</x-app-layout>