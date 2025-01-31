<x-app-layout :assets="$assets ?? []">
    <section id="services" class="container-fluid p-3 p-md-5" style="min-height: calc(100vh - 72px);">
        <input type="hidden" id="first_name_input" value="{{ auth()->check() ? auth()->user()->first_name : '' }}" />
        <input type="hidden" id="last_name_input" value="{{ auth()->check() ? auth()->user()->last_name : '' }}" />
        <div class="card2 border-1 border-primary">
            <div class="row row-cols-2">
                <div class="col-12 col-xl-9 col-lg-6">
                    <div class="container-fluid h-100">
                        <h3 class="mt-3 mb-5 text-center text-md-start" style="color:gray; font-weight: 100;">OFFERS /
                            <span style="color: #242423; font-weight:700; opacity: 1;">PRODUCTS</span>
                        </h3>
                    </div>
                </div>
                <div class="col-12 col-xl-3 col-lg-6">
                    <div class="contianer-fluid h-100 mx-5 mx-xl-0">
                        <form class="mt-3 mb-5 w-100 d-flex justify-content-center justify-content-xl-end"
                            id="searchForm" action="{{ route('products') }}" method="GET">
                            <div class="form-group has-search">
                                <span class="fa fa-search form-control-feedback"></span>
                                <input type="search" class="form-control border-2 rounded-start" placeholder="Search Product" name="search"
                                id="search" value="{{ $query ?? null }}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
            <div class="container-fluid
                                        px-2 px-md-3">
                @isset($products)
                    <div class="d-flex justify-content-center  ">
                        <div class="px-3 pb-5 mb-1 w-100">
                            @foreach ($products->chunk(4) as $chunk)
                                <div class="row row-cols-4">
                                    @foreach ($chunk as $product)
                                        <a
                                            class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3 mb-4 {{ !$product->isAvailable ? 'out-of-stock' : '' }}">
                                            <div class="card shadow-lg border border-primary h-100 status-stamp"
                                                data-status="
                                                @if ($product->status === 'new') NEW
                                                @elseif($product->status === 'like_new')
                                                    USED - LIKE NEW
                                                @elseif($product->status === 'good')
                                                    USED - GOOD
                                                @elseif($product->status === 'fair')
                                                    USED - FAIR @endif
                                            ">
                                                <div class="text-center border-bottom border-primary rounded-top h-100 p-3 p-md-5 product-link"
                                                    data-product-id="{{ $product->id }}"
                                                    data-product-title="{{ $product->title }}"
                                                    data-product-price="{{ $product->price }}"
                                                    data-product-description="{{ $product->description }}">
                                                    <center>
                                                        <img src="{{ asset('storage/product_images/' . $product->image) }}"
                                                            alt="Product Image" class="img-fluid rounded"
                                                            style="height: 190px;">
                                                    </center>
                                                    <h6 class="card-title text-center mt-4">
                                                        {{ $product->title }}</h6>
                                                    <p class="px-3 mt-2" style="text-align: justify !important;">
                                                        {{ Str::limit($product->description, 100) }}
                                                    </p>
                                                </div>
                                                <h5 class="text-center p-3">
                                                    ₱{{ formatRevenue($product->price) }}</h5>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Paginate the products -->
                    <div class="row mt-4">
                        <div class="col-12 d-flex justify-content-center">
                            <div class="pagination-container" style="overflow-x: auto;">
                                {{ $products->appends(['search' => $query])->links() }}
                            </div>
                        </div>
                    </div>
                @endisset
            </div>
        </div>
    </section>

    <div class="modal fade" id="product_details_modal" tabindex="-1" role="dialog"
        aria-labelledby="productDetailsModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productDetailsModal">Product Details</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Product details will be displayed here -->
                </div>
                <div class="modal-footer justify-content-center">
                    @if (Auth::guest() || Auth::user()->hasRole('user|employee'))
                        <button type="button" class="btn btn-secondary" id="inquire">Inquire</button>
                        <button type="button" class="btn btn-primary" id="addToCart">Add To Cart</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="paypal_payment_modal" tabindex="-1" role="dialog"
        aria-labelledby="paypalPaymentModalLabel" aria-hidden="true">
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


    <style>
        html,
        body {
            height: 100%;
            width: 100%;
            padding: 0;
            margin: 0;
            overflow-x: hidden;
        }

        label {
            text-align: center;
        }

        .img-fluid {
            max-height: 150px;
            object-fit: cover;
        }

        .button {
            background: #004065FF;
            border-color: none;
        }

        .border-primary {
            border-color: rgb(175, 195, 202) !important;
        }

        .card2 {
            position: relative;
            display: flex;
            flex-direction: column;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, 0.125);
            border-radius: 1rem;
            box-shadow: 0 10px 30px 0 rgba(17, 38, 146, 0.05);
            padding: 3rem;
        }

        .card:hover {
            background-color: var(--bs-primary-tint-20);
            cursor: pointer !important;
        }

        @media (max-width: 500px) {
            .card2 {
                padding: 0rem;
            }

            .out-of-stock {
                font-size: 12px;
            }

            #search {
                width: 300px !important;
            }
        }

        @media (max-width: 768px) {
            #search {
                width: 300px !important;
            }
        }

        .out-of-stock {
            position: relative;
            pointer-events: none;
        }

        .out-of-stock:hover .card {
            box-shadow: none;
        }

        .out-of-stock .card {
            opacity: 0.5;
            transition: opacity 0.3s ease;
        }

        .out-of-stock .card::before {
            content: 'OUT OF STOCK';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, 70%);
            background-color: red;
            color: white;
            padding: 10px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            z-index: 1;
        }

        .status-stamp::before {
            content: attr(data-status);
            position: absolute;
            top: 0px;
            right: 10px;
            color: green;
            padding: 5px;
            font-size: 12px;
            font-weight: bold;
            transform: rotate(0deg);
            z-index: 1;
        }

        .has-search .form-control {
            padding-left: 2.375rem;
        }

        .has-search .form-control-feedback {
            position: absolute;
            z-index: 2;
            display: block;
            width: 2.375rem;
            height: 2.375rem;
            line-height: 2.375rem;
            text-align: center;
            pointer-events: none;
            color: #aaa;
        }
    </style>

    <script
        src="https://www.paypal.com/sdk/js?locale=en_PH&client-id=ASK_IzoAnCAY99BmK2FpSrKbtZraYgcq3jcSDWztm1A884RS-rE9DN3iJArUqHrVGe6bjzfiRbk17_47&currency=PHP">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#search').on('keypress', function(event) {
                if (event.key === "Enter") {
                    $('#searchForm').submit();
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            var productLinks = document.querySelectorAll(".product-link");
            productLinks.forEach(function(link) {
                link.addEventListener("click", function(event) {
                    event.preventDefault();
                    // Billing address details
                    var firstName = document.getElementById('first_name_input').value;
                    var lastName = document.getElementById('last_name_input').value;

                    // Product details
                    var productId = this.dataset.productId;
                    var productTitle = this.dataset.productTitle;
                    var productPrice = this.dataset.productPrice;
                    var productDescription = this.dataset.productDescription;
                    const parentDiv = this.closest('.col-12');

                    var basePrice = parseFloat(this.dataset.productPrice);
                    var percentageFee = 3.49 / 100;
                    var tax_total = basePrice * percentageFee;
                    tax_total = tax_total.toFixed(2);
                    var fixedFee = 25;
                    var totalAmount = basePrice + (basePrice * percentageFee) + fixedFee;
                    totalAmount = totalAmount.toFixed(2);

                    $.ajax({
                        type: "GET",
                        url: "{{ route('products.show') }}?product_id=" + productId,
                        dataType: "json",
                        success: function(response) {

                            // Display the product details in a modal
                            $('#product_details_modal .modal-body').html(response.view);
                            $('#product_details_modal').modal('show');
                            $('#paypal-button-container').empty();

                            $('#product_details_modal').off('click', '#inquire').on(
                                'click', '#inquire',
                                function(event) {
                                    event.preventDefault();
                                    var loginModal = new bootstrap.Modal($(
                                        '#loginModal')[0]);

                                    if ({{ auth()->guest() ? 'true' : 'false' }}) {
                                        event.preventDefault();
                                        $('#product_details_modal').modal('hide');
                                        loginModal.show();
                                    } else {
                                        html2canvas(parentDiv).then(canvas => {
                                            // Convert canvas to a Blob
                                            canvas.toBlob(blob => {
                                                $('#product_details_modal')
                                                    .modal('hide');
                                                // Send the image data to imgbb.com API
                                                uploadImageToImgbb(
                                                    blob,
                                                    productTitle
                                                );
                                            }, 'image/jpeg');
                                        });
                                    }
                                });

                            $('#product_details_modal').off('click', '#addToCart').on(
                                'click', '#addToCart',
                                function(event) {
                                    event.preventDefault();
                                    var loginModal = new bootstrap.Modal($(
                                        '#loginModal')[0]);

                                    if ({{ auth()->guest() ? 'true' : 'false' }}) {
                                        event.preventDefault();
                                        $('#product_details_modal').modal('hide');
                                        loginModal.show();
                                    } else {
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
                                                    text: response
                                                        .message,
                                                    icon: 'success',
                                                    confirmButtonText: 'OK',
                                                });
                                            },
                                            error: function(xhr, status,
                                                error) {
                                                Swal.fire({
                                                    title: 'ERROR!',
                                                    text: `You have already added the maximum quantity to your cart`,
                                                    icon: 'error',
                                                    confirmButtonText: 'OK',
                                                });
                                                console.error(
                                                    'Error adding product to cart:',
                                                    error);
                                            }
                                        });
                                    }
                                });
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                            disable_loading();
                            Swal.fire(error, '', 'error');
                        }
                    });

                });
            });
        });

        function uploadImageToImgbb(imageBlob, productTitle) {
            var formData = new FormData();
            formData.append('image', imageBlob);

            //https://api.imgbb.com/1/upload?expiration=600&key=789c907aac131f84e2fb54e40deb27a3
            fetch('https://api.imgbb.com/1/upload?key=789c907aac131f84e2fb54e40deb27a3', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to upload image');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data && data.success) {
                        // Image uploaded successfully
                        var imageUrl = data.data.url;
                        console.log('Image uploaded successfully:', imageUrl);

                        // Open Crisp chat window
                        $crisp.push(["do", "chat:open"]);

                        // Send a message along with the uploaded image URL
                        $crisp.push(["do", "message:send", ["text", "Is the item '" + productTitle +
                            "' still available?"
                        ]]);
                        $crisp.push(["do", "message:send", ["file", {
                            name: "Screenshot",
                            url: imageUrl,
                            type: "image/jpeg"
                        }]]);
                    } else {
                        throw new Error('Invalid response from server');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        window.onload = function(event) {
            Swal.close();
        };

        window.addEventListener('pagehide', function(event) {
            Swal.close();
        });
    </script>
</x-app-layout>
