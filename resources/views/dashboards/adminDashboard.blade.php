<x-app-layout :assets="$assets ?? []">
    @guest
        <script>
            window.location = "{{ route('dashboard') }}";
        </script>
    @else
        @auth
            @if (auth()->user()->hasRole('admin'))
                <div class="container-fluid pt-3" style="min-height: calc(100vh - 72px);">
                    <div class="card border-2 border-light shadow-none">
                        <h3 class="p-3 lexend-font-style text-center">Analytics</h3>
                        <div class="card-body">
                            <div class="container-fluid">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addTransactionModal">
                                    Add Transaction
                                </button>
                            </div>
                            <div class="row row-cols-2">
                                <div class="col-12 col-xxl-7 col-xl-12 col-lg-12 col-md-12 col-sm-12 pb-3">
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
                                    <div
                                        class="col-12 col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 pb-3 d-flex align-content-stretch align-items-lg-stretch">
                                        <div class="card px-3 mt-5 mb-5 pt-5 pb-5 w-100">
                                            <div class="row row-cols-2">
                                                <div class="col-12 col-xxl-6 col-xl-6 d-flex justify-content-center">
                                                    <div class="card border border-soft-primary text-center">
                                                        <div class="card-body">
                                                            Total Revenue
                                                            <h1 class="text-center manrope-font-style bg-soft-info p-2 rounded">
                                                                ₱{{ formatRevenue($totalRevenue) }}</h1>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-xxl-6 col-xl-6 d-flex justify-content-center">
                                                    <div class="card border-soft-info text-center">
                                                        <div class="card-body">
                                                            Total Income
                                                            <h1
                                                                class="text-center manrope-font-style bg-soft-primary p-2 rounded">
                                                                ₱{{ formatRevenue($total_income) }}
                                                            </h1>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="spline-chart">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xxl-5 col-xl-12 col-md-12 col-sm-12 pb-3">
                                    <div class="card">
                                        <div class="row row-cols-2 px-1 px-md-4 pt-5">
                                            <div class="col-12 col-xxl-6 col-xl-6 col-lg-12">
                                                <div class="row row-cols-2">
                                                    <div class="col-12 col-xxl-12 col-sm">
                                                        <div class="card border border-light">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div class="bg-soft-primary text-primary rounded p-2 m-2">
                                                                    <svg class="icon-20" xmlns="http://www.w3.org/2000/svg"
                                                                        width="20px" fill="none" viewBox="0 0 26 26"
                                                                        stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                                            stroke-width="2"
                                                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                                                        </path>
                                                                    </svg>
                                                                </div>
                                                                <div class="text-end fs-6 pe-2">
                                                                    Customers
                                                                    <h2 class="counter fs-6 pe-2" style="visibility: visible;">
                                                                        {{ $customerCounts ?? 0 }}
                                                                    </h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-xxl-12 col-sm">
                                                        <div class="card border border-light">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div class="bg-soft-info text-info rounded p-2 m-2">
                                                                    <svg class="icon-20" xmlns="http://www.w3.org/2000/svg"
                                                                        width="20px" fill="none" viewBox="0 0 26 26"
                                                                        stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                                            stroke-width="2"
                                                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                                                        </path>
                                                                    </svg>
                                                                </div>
                                                                <div class="text-end fs-6 pe-2">
                                                                    Products
                                                                    <h2 class="counter fs-6 pe-2" style="visibility: visible;">
                                                                        {{ $productCounts ?? 0 }}
                                                                    </h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card border border-light">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="bg-soft-warning text-warning rounded p-2 m-2">
                                                            <svg class="icon-20" xmlns="http://www.w3.org/2000/svg"
                                                                width="20px" fill="none" viewBox="0 0 26 26"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                        <div class="text-end fs-6 pe-2">
                                                            Services
                                                            <h2 class="counter fs-6 pe-2" style="visibility: visible;">
                                                                {{ $serviceCounts ?? 0 }}</h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-xxl-6 col-xl-6 col-lg-12">
                                                <div class="card w-100">
                                                    <div class="card-body">
                                                        <div class="row row-cols-2 py-1  py-xxl-3 py-xl-3 py-lg-3">
                                                            <div class="col-6">
                                                                <h1 class="px-3 pt-4 text-center text-info manrope-font-style">
                                                                    {{ $visitorCount ?? 0 }}</h1>
                                                                <p class="text-center">Website Visitors</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <h1
                                                                    class="px-3 pt-4 text-center text-danger manrope-font-style">
                                                                    {{ $customerCounts ?? 0 }}
                                                                </h1>
                                                                <p class="text-center">Customers</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card aos-init aos-animate" data-aos="fade-up" data-aos-delay="600">
                                        <div class="flex-wrap card-header d-flex justify-content-between">
                                            <div class="header-title">
                                                <h6 class="mb-2 card-title">Activity Overview</h6>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @isset($latestRevenues)
                                                @if ($latestRevenues->count() > 0)
                                                    @foreach ($latestRevenues as $revenue)
                                                        <div class="mb-2  d-flex profile-media align-items-top">
                                                            {{-- <div class="mt-1 profile-dots-pills border-primary"></div> --}}
                                                            <div class="ms-4">
                                                                <h6 class="mb-1 ">₱{{ formatRevenue($revenue->amount) }} -
                                                                    {{ $revenue->category }}</h6>
                                                                <span
                                                                    class="mb-0">{{ date('F d, Y', strtotime($revenue->purchase_date)) }}</span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="row mt-4">
                                                        <div class="col-12 text-center">
                                                            <p>No reviews available.</p>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive px-3">
                                <table class="table table-hover rounded shadow" data-toggle="data-table">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">Type</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Purchased Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($tableRevenues)
                                            @foreach ($tableRevenues as $revenue)
                                                <tr style="text-transform: capitalize;">
                                                    <td>{{ $revenue->types }}</td>
                                                    <td>{{ $revenue->category }}</td>
                                                    <td>₱{{ formatRevenue($revenue->amount) }}</td>
                                                    <td>{{ date('F d, Y', strtotime($revenue->purchase_date)) }}</td>
                                                </tr>
                                            @endforeach
                                        @endisset
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <script>
                    window.location = "{{ route('dashboard') }}";
                </script>
            @endif
        @endauth
    @endguest

    <div class="modal mt-2 mt-xxl-5 mt-xl-5 fade" id="addTransactionModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('add.revenue') }}" method="POST"
                        onsubmit="showLoading('Processing...')">
                        @csrf
                        <input type="hidden" name="product_id" id="product_id">
                        <input type="hidden" name="order_id" id="order_id">
                        <div class="row px-2">
                            <div class="col-12">
                                <div class="container">
                                    <h5 class="py-2 manrope-font-style">Transaction Type:</h5>
                                </div>
                                <select name="transaction_type" id="transaction_type" class="form-select" required>
                                    <option value="" {{ old('transaction_type') == '' ? 'selected' : '' }} disabled>Please select a transaction</option>
                                    <option value="system">System Transaction</option>
                                    <option value="walk_in">Walk-in Transaction</option>
                                </select>
                            </div>
                        </div>
                        <div id="system_transaction_fields" style="display: none;">
                            <div class="row px-2">
                                <div class="col-12 col-xxl-6 col-xl-6">
                                    <div class="container">
                                        <h5 class="py-2 manrope-font-style">Select user: </h5>
                                    </div>
                                    <select name="users" id="users" class="form-select" onchange="updateProduct(this);" required>
                                        <option value="" {{ old('users') == '' ? 'selected' : '' }} disabled>Please select a user</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" data-user="{{ $user->id }}">{{ $user->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6">
                                    <div class="toggler" id="product-name">
                                        <div class="container">
                                            <h5 class="py-2 manrope-font-style">Product: </h5>
                                        </div>
                                        <select class="form-select" id="product_name" name="product_name" required>
                                            <option value="" {{ old('product_name') == '' ? 'selected' : '' }} disabled>Please select a product</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="row">
                                    <div class="col">
                                        <button class="btn btn-soft-info" type="submit">Submit</button>
                                    </div>
                                    <div class="col" data-bs-dismiss="modal">
                                        <button class="btn btn-soft-danger" type="button">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="walk_in_transaction_fields" style="display: none;">
                            <div class="row px-2">
                                <div class="col-12 col-xxl-6 col-xl-6">
                                    <div class="container">
                                        <h5 class="py-2 manrope-font-style">Type: </h5>
                                    </div>
                                    <select name="types" id="types" class="form-select" required>
                                        <option selected value="product">Products</option>
                                        <option value="service">Services</option>
                                    </select>
                                </div>
                                <div class="col-12 col-xxl-6 col-xl-6">
                                    <div class="toggler" id="quantity">
                                        <div class="container">
                                            <h5 class="py-2 manrope-font-style">Quantity: </h5>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Quantity"
                                            name="quantity" id="qty" value="1" required>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-5 container">
                                <div class="container">
                                    <h5 class="py-3 manrope-font-style">Category: </h5>
                                </div>
                                <select name="product" class="form-select" id="products"
                                    onchange="updateAmount(this); updateProductId(this);" required>
                                    <option value="" {{ old('product') == '' ? 'selected' : '' }} disabled>Please select a category</option>
                                    @foreach ($productCategories as $product)
                                        <option value="{{ $product->title }}" data-amount="{{ $product->price }}"
                                            data-id="{{ $product->id }}">
                                            {{ $product->title }}</option>
                                    @endforeach
                                </select>
                                <select name="service" class="form-select" id="services" style="display: none;"
                                    onchange="updateAmount(this)" required>
                                    <option value="" {{ old('service') == '' ? 'selected' : '' }} disabled>Please select a category</option>
                                    @foreach ($serviceCategories as $service)
                                        <option value="{{ $service->title }}" data-amount="{{ $service->price }}">
                                            {{ $service->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="container">
                                <div class="container">
                                    <h5 class="py-3 manrope-font-style">Amount: </h5>
                                </div>
                                <input type="text" class="form-control" name="amount" id="amount"
                                    placeholder="₱123" required>
                            </div>
                            <div class="container">
                                <div class="container">
                                    <h5 class="py-3 manrope-font-style">Transaction Date: </h5>
                                </div>
                                <input type="date" class="form-control" name="purchased_date" id="purchased-date"
                                    required>
                            </div>

                            <div class="modal-footer">
                                <div class="row">
                                    <div class="col">
                                        <button class="btn btn-soft-info" type="submit">Submit</button>
                                    </div>
                                    <div class="col" data-bs-dismiss="modal">
                                        <button class="btn btn-soft-danger">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
<style>
    html,
    body {
        height: 100%;
        width: 100%;
        padding: 0;
        margin: 0;
        overflow-x: hidden;
    }

    @media(max-width: 989px) {
        .positionchange {
            position: static !important;
        }
    }

    .apexcharts-toolbar {
        display: none !important;
    }

    label {
        text-align: center;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    window.onload = function(event) {
        Swal.close();
    };

    window.addEventListener('pagehide', function(event) {
        Swal.close();
    });

    function updateProduct(select) {
        var userId = select.value;
        var productNameSelect = document.getElementById("product_name");
        var orderID = document.getElementById('order_id');

        productNameSelect.innerHTML = '<option value="" {{ old("product_name") == "" ? "selected" : "" }} disabled>Please select a product</option>';
        if (!userId) return;

        // url: `/fetch-order-history/${userId}`,
        $.ajax({
            url: '{{ route("fetch.order", ":userId") }}'.replace(':userId', userId),
            type: 'GET',
            success: function(response) {
                console.log(response);
                response.forEach(function(order) {
                    console.log(order);
                    var option = document.createElement('option');
                    option.value = order.id;
                    orderID.value = order.id;
                    option.textContent = order.product_name;
                    productNameSelect.appendChild(option);
                });
                document.getElementById('product-name').style.display = 'block';
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }


    function updateAmount(select) {
        var selectedOption = select.options[select.selectedIndex];
        var amount = selectedOption.getAttribute('data-amount');
        document.getElementById("amount").value = amount || '';
    }

    function updateProductId(select) {
        var selectedOption = select.options[select.selectedIndex];
        var product_id = selectedOption.getAttribute('data-id');
        document.getElementById('product_id').value = product_id || '';
    }

    document.getElementById('users').addEventListener('change', function() {
        var selectElement = this;
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        if (selectedOption.value !== '') {
            selectElement.removeAttribute('required');
        } else {
            selectElement.setAttribute('required', 'required');
        }
    });

    $(document).ready(function() {
        $('#product_name').change(function() {
            var selectedOption = $(this).val();
            $('#order_id').val(selectedOption);
            console.log(selectedOption);
        });
    });

    $(document).ready(function() {
        $('#transaction_type').change(function() {
            var selectedOption = $(this).val();
            if (selectedOption === 'system') {
                $('#system_transaction_fields').show();
                $('#walk_in_transaction_fields').hide();

                document.getElementById('products').required = false;
                document.getElementById('services').required = false;
                document.getElementById('qty').required = false;
                document.getElementById('amount').required = false;
                document.getElementById('purchased-date').required = false;

                document.getElementById('product_name').required = true;
                document.getElementById('users').required = true;

                document.getElementById('products').style.display = 'none';
                document.getElementById('quantity').style.display = 'none';
                document.getElementById('services').style.display = 'none';

                document.getElementById('product_name').style.display = 'block';
                document.getElementById('users').style.display = 'block';
            } else if (selectedOption === 'walk_in') {
                $('#system_transaction_fields').hide();
                $('#walk_in_transaction_fields').show();
                $('#types').val("product");

                document.getElementById('products').required = true;
                document.getElementById('services').required = true;
                document.getElementById('qty').required = true;
                document.getElementById('amount').required = true;
                document.getElementById('purchased-date').required = true;

                document.getElementById('product_name').required = false;
                document.getElementById('users').required = false;

                document.getElementById('products').style.display = 'block';
                document.getElementById('quantity').style.display = 'block';

                document.getElementById('product_name').style.display = 'none';
                document.getElementById('users').style.display = 'none';
                document.getElementById('types').addEventListener('change', function() {
                    var selectedOption = this.value;
                    if (selectedOption === 'product') {
                        document.getElementById('products').required = true;
                        document.getElementById('qty').required = true;
                        document.getElementById('services').required = false;
                    } else if (selectedOption === 'service') {
                        document.getElementById('products').required = false;
                        document.getElementById('qty').required = false;
                        document.getElementById('services').required = true;
                    } else {
                        document.getElementById('products').required = false;
                        document.getElementById('services').required = false;
                    }
                });

                var previousQtyValue = "";
                document.getElementById('types').addEventListener('change', function() {
                    var selectedOption = this.value;
                    if (selectedOption === 'product') {
                        document.getElementById('products').style.display = 'block';
                        document.getElementById('quantity').style.display = 'block';
                        document.getElementById('services').style.display = 'none';
                        if (previousQtyValue !== "") {
                            $("#qty").val(previousQtyValue);
                        } else {
                            $("#qty").val("1");
                        }
                    } else if (selectedOption === 'service') {
                        document.getElementById('products').style.display = 'none';
                        document.getElementById('quantity').style.display = 'none';
                        document.getElementById('services').style.display = 'block';
                        previousQtyValue = $("#qty").val();
                        $("#qty").val("");
                    } else {
                        document.getElementById('products').style.display = 'none';
                        document.getElementById('quantity').style.display = 'none';
                        document.getElementById('services').style.display = 'none';
                        $("#qty").val("");
                    }
                });
            }
        });
    });

    $(function() {
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();

        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;

        $('#purchased-date').attr('max', maxDate);

        $('#purchased-date').on('input', function() {
            var selectedDate = $(this).val();

            if (selectedDate > maxDate) {
                $(this).val(maxDate);
            }
        });

    });

    document.getElementById('qty').addEventListener('input', function(event) {
        let inputValue = event.target.value;
        let numericValue = inputValue.replace(/\D/g, '');
        event.target.value = numericValue;
    });

    document.getElementById('amount').addEventListener('input', function(event) {
        let inputValue = event.target.value;
        let numericValue = inputValue.replace(/\D/g, '');
        event.target.value = numericValue;
    });

    var options = {
        series: [22],
        chart: {
            type: 'radialBar',
            offsetY: -30,
            sparkline: {
                enabled: true
            }
        },
        plotOptions: {
            radialBar: {
                startAngle: -90,
                endAngle: 90,
                track: {
                    background: "#adc7ff",
                    strokeWidth: '100%',
                    margin: 5, // margin is in pixels
                },
                dataLabels: {
                    name: {
                        show: true,
                    },
                    value: {
                        offsetY: -40,
                        fontSize: '15px'
                    }
                }
            }
        },
        grid: {
            padding: {
                top: -10,
                bottom: 20
            }
        },
        fill: {
            type: 'solid',
        },
        labels: ['Progress'],
    };

    var chart = new ApexCharts(document.querySelector("#radial-chart"), options);
    chart.render();

    var options = {
        series: [{
            name: 'Products',
            data: [{{ implode(',', $totalSalesProducts) }}]
        }, {
            name: 'Services',
            data: [{{ implode(',', $totalSalesServices) }}]
        }],
        chart: {
            height: 350,
            type: 'area'
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth'
        },
        xaxis: {
            type: 'category',
            categories: ["January", "February", "March", "April", "May", "June", "July", "August", "September",
                "October", "November", "December"
            ]
        },
        tooltip: {
            x: {
                format: 'dd/MM/yy HH:mm'
            },
        },
    };

    var chart = new ApexCharts(document.querySelector("#spline-chart"), options);
    chart.render();
</script>
