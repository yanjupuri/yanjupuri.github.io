<x-app-layout :assets="$assets ?? []">
    <section id="services" class="container-fluid p-3 p-md-5" style="min-height: calc(100vh - 72px);">
        <div class="card2 border-1 border-primary">
            <div class="row row-cols-2">
                <div class="col-12 col-xl-9 col-lg-6">
                    <div class="container-fluid h-100">
                        <h3 class="mt-3 mb-5 text-center text-md-start" style="color:gray; font-weight: 100;">OFFERS /
                            <span style="color: #242423; font-weight:700; opacity: 1;">SERVICES</span>
                        </h3>
                    </div>
                </div>
                <div class="col-12 col-xl-3 col-lg-6">
                    <div class="contianer-fluid h-100 mx-5 mx-xl-0">
                        <form class="mt-3 mb-5 w-100 d-flex justify-content-center justify-content-xl-end"
                            id="searchForm" action="{{ route('services') }}" method="GET">
                            <div class="form-group has-search">
                                <span class="fa fa-search form-control-feedback"></span>
                                <input type="search" class="form-control border-2 rounded-start" placeholder="Search Service" name="search"
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
            <div class="container-fluid px-2 px-md-3">
                @isset($services)
                    <div class="d-flex justify-content-center ">
                        <div class="px-3 pb-5 mb-1 w-100">
                            @foreach ($services->chunk(4) as $chunk)
                                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                                    @foreach ($chunk as $service)
                                        <div
                                            class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3 mb-4 {{ !$service->isAvailable ? 'not-available' : '' }}">
                                            <div class="card border border-primary shadow-lg h-100 service-parent">
                                                <div class="card-body border-bottom border-primary services-link"
                                                    data-service-id="{{ $service->id }}"
                                                    data-service-title="{{ $service->title }}">
                                                    <center>
                                                        <img src="{{ asset('storage/services_images/' . $service->image) }}"
                                                            alt="Service Image" class="img-fluid2 rounded"
                                                            style="height: 190px;">
                                                    </center>
                                                    <h6 class="card-title text-center mt-4">{{ $service->title }}</h6>
                                                    <p class="px-3 mt-2" style="text-align: justify !important;">
                                                        {{ Str::limit($service->description, 100) }}</p>
                                                </div>
                                                <h5 class="text-center p-3">₱{{ formatRevenue($service->price) }}</h5>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Paginate the services -->
                    <div class="row mt-4">
                        <div class="col-12 d-flex justify-content-center">
                            <div class="pagination-container" style="overflow-x: auto;">
                                {{ $services->appends(['search' => $query])->links() }}
                            </div>
                        </div>
                    </div>
                @endisset
            </div>
        </div>
    </section>

    <div class="modal fade" id="service_details_modal" tabindex="-1" role="dialog"
        aria-labelledby="serviceDetailsModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceDetailsModal">Service Details</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Service details will be displayed here -->
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @if (Auth::guest() || Auth::user()->hasRole('user'))
                        <button type="button" class="btn btn-primary" id="availButton">Avail Service</button>
                    @endif
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

        .img-fluid2 {
            max-width: 100%;
            height: auto;
            max-width: 100%;
            height: auto;
            padding: 10px;
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

        .button {
            background: #004065FF;
            border-color: none;
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

        .not-available .card {
            opacity: 0.5;
            pointer-events: none;
        }

        .not-available .card:hover {
            box-shadow: none;
        }

        .not-available .card::before {
            content: 'SERVICE UNAVAILABLE';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, 70%);
            background-color: red;
            color: white;
            padding: 10px;
            font-size: 15px;
            font-weight: bold;
            text-align: center;
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
            var serviceLinks = document.querySelectorAll(".services-link");
            serviceLinks.forEach(function(link) {
                link.addEventListener("click", function(event) {
                    event.preventDefault();
                    var serviceId = this.dataset.serviceId;
                    var serviceTitle = this.dataset.serviceTitle;
                    const parentDiv = this.closest('.col-12');

                    $.ajax({
                        type: "GET",
                        url: "{{ route('services.show') }}?service_id=" + serviceId,
                        dataType: "json",
                        success: function(response) {

                            // Display the product details in a modal
                            $('#service_details_modal .modal-body').html(response.view);
                            $('#service_details_modal').modal('show');

                            $('#service_details_modal').off('click').on('click',
                                '#availButton',
                                function(event) {
                                    event.preventDefault();
                                    var loginModal = new bootstrap.Modal($(
                                        '#loginModal')[0]);

                                    if ({{ auth()->guest() ? 'true' : 'false' }}) {
                                        event.preventDefault();
                                        $('#service_details_modal').modal('hide');
                                        loginModal.show();
                                    } else {
                                        Swal.fire({
                                            title: `Are you sure you want to avail ${serviceTitle} service?`,
                                            icon: 'question',
                                            showCancelButton: true,
                                            confirmButtonText: 'Yes',
                                            cancelButtonText: 'No'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                html2canvas(parentDiv).then(
                                                    canvas => {
                                                        // Convert canvas to a Blob
                                                        canvas.toBlob(
                                                            blob => {
                                                                $('#service_details_modal')
                                                                    .modal(
                                                                        'hide'
                                                                    );
                                                                // Send the image data to imgbb.com API
                                                                uploadImageToImgbb
                                                                    (blob,
                                                                        serviceTitle
                                                                    );
                                                            },
                                                            'image/jpeg'
                                                        );
                                                    });
                                            } else {
                                                console.log(
                                                    'Operation cancelled'
                                                );
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

            // with expiry
            // https://api.imgbb.com/1/upload?expiration=600&key=789c907aac131f84e2fb54e40deb27a3
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
                        $crisp.push(["do", "message:send", ["text", "I want to avail '" + productTitle +
                            "' service, please."
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
