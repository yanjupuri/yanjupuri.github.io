<x-app-layout :assets="$assets ?? []">
    @if (Auth::check())
        @hasrole('user')
            <div class="container-fluid p-0 p-md-2" style="min-height: calc(100vh - 72px);">
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
                <div class="card bg-soft-light border border-light m-0 m-xxl-5 m-xl-5 m-lg-5">
                    <div class="card-header d-flex justify-content-between pb-4">
                        <h2 class="lexend-font-style">Your Shopping Cart</h2>
                        <div class="ml-auto order-history">
                            <button class="btn btn-primary d-none d-sm-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                    height="24">
                                    <path fill="currentColor"
                                        d="M21 3h-4.18C16.4 1.84 14.86 1 13 1s-3.4.84-3.82 2H3c-.55 0-1 .45-1 1v18c0 .55.45 1 1 1h18c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1zm-1 18H4V5h3c.34 0 .67.16.86.44l1.14 1.52c.23.31.57.49.94.49s.71-.18.94-.49L13 5.44c.19-.28.52-.44.86-.44h3v16zm-8-5h-2v-2h2v2zm0-4h-2V7h2v5z" />
                                </svg>
                                <span class="d-none d-md-inline-block">Order History</span>
                            </button>
                            <svg class="d-inline-block d-sm-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                width="24" height="24">
                                <path fill="currentColor"
                                    d="M21 3h-4.18C16.4 1.84 14.86 1 13 1s-3.4.84-3.82 2H3c-.55 0-1 .45-1 1v18c0 .55.45 1 1 1h18c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1zm-1 18H4V5h3c.34 0 .67.16.86.44l1.14 1.52c.23.31.57.49.94.49s.71-.18.94-.49L13 5.44c.19-.28.52-.44.86-.44h3v16zm-8-5h-2v-2h2v2zm0-4h-2V7h2v5z" />
                            </svg>
                        </div>
                    </div>
        
                    <div class="card-body">
                        @if (count($cartItems) > 0)
                            @foreach ($cartItems as $cartItem)
                                @php
                                    $totalPrice = null;
                                @endphp
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div
                                                class="col-2 col-sm-1 col-md-1 col-xxl-1 d-flex justify-content-center justify-content-sm-start">
                                                <input type="checkbox" name="product_checkbox[]"
                                                    class="form-check-input" value="{{ $cartItem->id }}">
                                            </div>
                                            <div class="col-4 col-sm-11 col-md-3 col-xxl-1 ">
                                                <img src="{{ asset('storage/product_images/' . $cartItem->image) }}"
                                                    class="img-fluid rounded" alt="Product Image">
                                            </div>
                                            <div class="col-6 col-md-8 col-xxl-3 p-0 py-3 py-md-0">
                                                <h5 class="card-title rfs-1">{{ $cartItem->title }}</h5>
                                            </div>
                                            <div
                                                class="col-8 col-sm-10 col-md-10 col-xxl-2 pb-0 pb-md-3 pb-xxl-0 pt-0 pt-md-3 pt-xxl-0  d-flex justify-content-start justify-content-xxl-center">
                                                <p class="card-text">Price:
                                                    ₱{{ formatRevenue($cartItem->price) }}</p>
                                            </div>
                                            <div
                                                class="col-4 col-sm-2 col-md-2 col-xxl-1 p-0 d-flex justify-content-end justify-content-xxl-center">
                                                <div class="input-group">
                                                    <button type="button"
                                                        class="btn btn-outline-secondary btn-sm decrement p-0">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-minus" width="24"
                                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <line x1="5" y1="12" x2="19"
                                                                y2="12" />
                                                        </svg>
                                                    </button>
                                                    <input type="text" class="form-control text-center p-0"
                                                        value="{{ $cartItem->quantity }}" aria-label="Quantity"
                                                        readonly>
                                                    <button type="button"
                                                        class="btn btn-outline-secondary btn-sm p-0 increment{{ $cartItem->disableAddToCart ? ' disabled' : '' }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-plus" width="24"
                                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <line x1="12" y1="5" x2="12"
                                                                y2="19" />
                                                            <line x1="5" y1="12" x2="19"
                                                                y2="12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                            @php
                                                $totalPrice += $cartItem->price * $cartItem->quantity;
                                            @endphp
                                            <div
                                                class="col-12 col-md-8 col-xxl-2 pb-2 pb-md-0 pb-xxl-0 pt-2 pt-md-3 pt-md-3 pt-xxl-0  d-flex justify-content-start justify-content-xxl-center">
                                                <h3 class="m-0 text-info fw-bold responsive-font-size-price">Total:
                                                    ₱{{ formatRevenue($totalPrice) }}</h3>
                                            </div>
                                            <div
                                                class="col-12 col-xxl-2 d-flex justify-content-end justify-content-xxl-center">
                                                <button type="button" class="btn btn-soft-danger text-danger btn-sm remove-item" data-product-id="{{ $cartItem->id }}">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="text-right" style="text-align: right; float:right">
                                <a href="#" class="btn btn-primary checkout">Checkout</a>
                            </div>
                        @else
                            <p>Your cart is empty</p>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <script>
                window.location = "{{ route('dashboard') }}";
            </script>
        @endhasrole
    @else
        <script>
            window.location = "{{ route('dashboard') }}";
        </script>
    @endif
    <style>
        .rfs-1 {
            font-size: 100%;
        }

        .rfs-2 {
            font-size: 150%;
        }

        .rfs-3 {
            font-size: 200%;
        }

        .rfs-4 {
            font-size: 250%;
        }

        .rfs-5 {
            font-size: 300%;
        }


        .responsive-font-size-price {
            font-size: 100%;
        }

        @media(max-width: 767px) {
            .rfs-1 {
                font-size: 60%;
            }

            .responsive-font-size-price {
                font-size: 150%;
            }
        }
    </style>
    <script>
        $(document).ready(function() {
            $('.remove-item').click(function() {
                var productId = $(this).data('product-id');
                Swal.fire({
                    title: 'CONFIRMATION!',
                    text: 'Are you sure you want to remove this item on your cart?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'YES',
                    cancelButtonText: 'NO',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('remove-from-cart') }}",
                            method: 'POST',
                            data: {
                                productId: productId,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'SUCCESS!',
                                    text: 'Product removed from cart',
                                    icon: 'success',
                                    confirmButtonText: 'OK',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.reload();
                                    } else {
                                        window.location.reload();
                                    }
                                });
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                                Swal.fire({
                                    title: 'ERROR!',
                                    text: 'Error removing product from cart',
                                    icon: 'error',
                                    confirmButtonText: 'OK',
                                });
                            }
                        });
                    }
                });
            });

            $('.decrement').click(function() {
                var productId = $(this).closest('.card').find('.remove-item').data('product-id');
                $.ajax({
                    url: "{{ route('remove-one-from-cart') }}",
                    method: 'POST',
                    data: {
                        productId: productId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'SUCCESS!',
                            text: 'Product quantity decremented',
                            icon: 'success',
                            confirmButtonText: 'OK',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            } else {
                                window.location.reload();
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'ERROR!',
                            text: 'Error decrementing product quantity',
                            icon: 'error',
                            confirmButtonText: 'OK',
                        });
                    }
                });
            });

            $('.increment').click(function() {
                var productId = $(this).closest('.card').find('.remove-item').data('product-id');
                $.ajax({
                    url: "{{ route('cart.add') }}",
                    method: 'POST',
                    data: {
                        productId: productId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'SUCCESS!',
                            text: 'Product quantity incremented',
                            icon: 'success',
                            confirmButtonText: 'OK',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            } else {
                                window.location.reload();
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'ERROR!',
                            text: 'Error incrementing product quantity',
                            icon: 'error',
                            confirmButtonText: 'OK',
                        });
                    }
                });
            });

            $('.checkout').click(function() {
                var checkedItems = $('input[name="product_checkbox[]"]:checked').map(function() {
                    return $(this).val();
                }).get();

                console.log("Items checked: " + checkedItems);
                if (checkedItems.length === 0){
                    Swal.fire({
                        title: 'ERROR!',
                        text: 'Please select at least one item',
                        icon: 'error',
                        confirmButtonText: 'OK',
                    });
                }

                if (checkedItems.length > 0) {
                    var form = $(`<form action="{{ route('checkout') }}" method='get'></form>`);
                    form.append('<input type="hidden" name="_token" value="{{ csrf_token() }}">');
                    checkedItems.forEach(function(item) {
                        form.append(`<input type="hidden" name="checkedItems[]" value="${item}">`);
                    });
                    $('body').append(form);

                    form.submit();
                }
            });

            $('.order-history').click(function() {
                $.ajax({
                    url: "{{ route('history') }}",
                    method: "GET",
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        window.location.href = "{{ route('history') }}";
                        console.log("Successfully redirect to order history page!");
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });

        });

        window.onload = function(event) {
            Swal.close();
        };

        window.addEventListener('pagehide', function(event) {
            Swal.close();
        });
    </script>
</x-app-layout>
