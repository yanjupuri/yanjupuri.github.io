<x-app-layout :assets="$assets ?? []">
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
    @if (Auth::check())
        @hasrole('user')
            <div class="container-fluid p-0 p-md-2" style="min-height: calc(100vh - 72px);">
                <div class="card m-3 bg-soft-light border border-light">
                    <div class="card-header">
                        <h3 class="lexend-font-style pb-3">Order History</h3>
                    </div>
                    <div class="card-body">
                        @isset($history)
                            @foreach ($history as $order)
                                <div class="card" data-order-id="{{ $order->id }}">
                                    <div class="card-body">
                                        <div class="row row-cols-5 align-items-center">
                                            {{-- <div class="col-4 col-sm-4 col-xxl-1">
                                                <img src="{{ asset('images/avatars/avtar_2.png') }}" class="img-fluid rounded">
                                            </div> --}}
                                            <div class="col-6 col-xxl-4 col-sm-6 py-3 py-md-0">
                                                <h5 class="manrope-font-style rfs-1">{{ $order->product_name }}</h5>
                                            </div>
                                            <div
                                                class="col-6 col-xxl-2 col-sm-6 pb-0 pb-md-3 pb-xxl-0 pt-0 pt-md-3 pt-xxl-0  d-flex justify-content-start justify-content-xxl-center">
                                                <p class="card-text rfs-1">
                                                    {{ \Carbon\Carbon::parse($order->purchased_date)->format('F d, Y') }}</p>
                                            </div>
                                            <div
                                                class="col-12 col-md-10 col-xxl-2 pb-2 pb-md-0 pb-xxl-0 pt-2 pt-md-3 pt-md-3 pt-xxl-0  d-flex justify-content-start justify-content-xxl-center">
                                                <h3 class="m-0 text-info fw-bold">Total:
                                                    ₱{{ formatRevenue($order->total_amount) }}
                                                </h3>
                                            </div>
                                            <div class="col-12 col-sm-2 col-md-2 col-xxl-1 p-0 d-flex justify-content-end justify-content-xxl-center"
                                                style="text-transform: capitalize;">
                                                @if ($order->status == 'pending')
                                                    <div class="container p-0 p-md-2 mx-5 mx-md-0">
                                                        <h6 class="bg-soft-danger rounded text-center">{{ $order->status }}</h6>
                                                    </div>
                                                @else
                                                    <div class="container p-0 p-md-2 mx-5 mx-md-0">
                                                        <h6 class="bg-soft-info rounded text-center">{{ $order->status }}</h6>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-12 col-sm-12 col-xxl-3 d-flex justify-content-center">
                                                <div class="row row-cols-2 w-100 py-3 py-xl-0">
                                                    @if ($order->status == 'pending')
                                                        <div
                                                            class="col-6 d-flex justify-content-sm-start justify-content-xxl-center">
                                                            <button type="button" class="btn btn-info btn-sm mark-as-done"
                                                                style="font-size: 80%">Mark
                                                                as
                                                                done</button>
                                                        </div>
                                                    @endif
                                                    <div class="col-6 d-flex justify-content-end justify-content-xxl-center">
                                                        <button type="button" class="btn btn-info btn-sm print-receipt"
                                                            style="font-size: 80%">Print
                                                            Receipt</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endisset

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
            // Add click event listener to the Print Receipt button
            $('.print-receipt').click(function() {
                var orderId = $(this).closest('.card').data('order-id');
                var csrfToken = '{{ csrf_token() }}';
                if (!orderId) {
                    console.error('Order ID is empty');
                    return;
                }

                window.location.href = "{{ route('print.paypal.invoice') }}?orderId=" + JSON.stringify(
                    orderId) + "&_token=" + csrfToken;
            });

            $('.mark-as-done').click(function() {
                var orderId = $(this).closest('.card').data('order-id');
                var csrfToken = '{{ csrf_token() }}';

                if (!orderId) {
                    console.error('Order ID is empty');
                    return;
                }

                showLoading('Processing...');
                console.log(orderId);
                $.ajax({
                    url: "{{ route('mark-as-done') }}",
                    method: 'POST',
                    data: {
                        orderID: orderId,
                        _token: csrfToken
                    },
                    success: function(response) {
                        console.log('Success');
                        Swal.close();
                        Swal.fire({
                            title: 'SUCCESS!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // window.location.href = "{{ route('history') }}";
                                window.location.href = response.redirect;
                            } else {
                                // window.location.href = "{{ route('history') }}";
                                window.location.href = response.redirect;
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        Swal.close();
                        Swal.fire({
                            title: 'ERROR!',
                            text: 'Error marking as done',
                            icon: 'error',
                            confirmButtonText: 'OK',
                        });
                    }
                })
            });
        });
    </script>
</x-app-layout>
