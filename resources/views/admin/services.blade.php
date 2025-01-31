<x-app-layout :assets="$assets ?? []">
    @guest
        <script>
            window.location = "{{ route('dashboard') }}";
        </script>
    @else
        @auth
            @if(auth()->user()->hasRole('admin'))
                <section class="container-fluid px-md-5" style="min-height: calc(100vh - 72px);">
                    <div class="container-fluid px-0 px-md-5">
                        <div class="card mt-3 mt-md-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="container-fluid p-3">
                                            <h3 class="lexend-font-style">SERVICES</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="container-fluid p-3 d-flex justify-content-md-end">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#addProductModal">
                                                Add Service
                                                <span>
                                                    <svg class="icon-32" width="20" viewBox="0 0 24 26" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12.0001 8.32739V15.6537" stroke="currentColor" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                        </path>
                                                        <path d="M15.6668 11.9904H8.3335" stroke="currentColor" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                        </path>
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M16.6857 2H7.31429C4.04762 2 2 4.31208 2 7.58516V16.4148C2 19.6879 4.0381 22 7.31429 22H16.6857C19.9619 22 22 19.6879 22 16.4148V7.58516C22 4.31208 19.9619 2 16.6857 2Z"
                                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive px-3">
                                <table class="table table-hover rounded shadow custom-table" data-toggle="data-table">
                                    <thead class="table-primary">
                                        <tr>
                                            <th class="col-1" data-orderable="false">Service</th>
                                            <th class="col-2" data-orderable="false">Description</th>
                                            <th class="col-1" data-orderable="false">Pricing</th>
                                            <th class="col-2" data-orderable="false">Picture</th>
                                            <th class="col-1" data-orderable="false">Availability</th>
                                            <th class="col-1 text-center" data-orderable="false">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($services)
                                            @foreach ($services as $service)
                                                <tr>
                                                    <td>
                                                        {{ $service->title }}
                                                    </td>
                                                    <td>
                                                        {{ Str::limit($service->description, 20) }}
                                                    </td>
                                                    <td>{{ $service->price }}</td>
                                                    <td>
                                                        @if ($service->image)
                                                            {{-- <img style="max-width: 100px; max-height: 100px;" src="{{ asset('storage/services_images/' . $service->image) }}" alt="Service Image" class="img-fluid"> --}}
                                                            <img style="max-width: 100px; max-height: 100px;" src="{{ route('service_image', ['filename' => $service->image]) }}" alt="Service Image" class="img-fluid">
                                                        @else
                                                            No Image
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($service->isAvailable)
                                                            Available
                                                        @else
                                                            Not Available
                                                        @endif
                                                    </td>
                                                    <td class="col">
                                                        <div class="row d-flex justify-content-center">
                                                            <div class="col-3 d-flex justify-content-center">
                                                                <button type="button" class="btn" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top" data-original-title="Edit" href="#"
                                                                    aria-label="Edit" data-bs-original-title="Edit"
                                                                    onclick="openEditModal('{{ $service->id }}')">
                                                                    <span>
                                                                        <svg class="icon-22" width="22" viewBox="0 0 24 24"
                                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M13.7476 20.4428H21.0002" stroke="currentColor"
                                                                                stroke-width="1.5" stroke-linecap="round"
                                                                                stroke-linejoin="round">
                                                                            </path>
                                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                                d="M12.78 3.79479C13.5557 2.86779 14.95 2.73186 15.8962 3.49173C15.9485 3.53296 17.6295 4.83879 17.6295 4.83879C18.669 5.46719 18.992 6.80311 18.3494 7.82259C18.3153 7.87718 8.81195 19.7645 8.81195 19.7645C8.49578 20.1589 8.01583 20.3918 7.50291 20.3973L3.86353 20.443L3.04353 16.9723C2.92866 16.4843 3.04353 15.9718 3.3597 15.5773L12.78 3.79479Z"
                                                                                stroke="currentColor" stroke-width="1.5"
                                                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                                                            <path d="M11.021 6.00098L16.4732 10.1881"
                                                                                stroke="currentColor" stroke-width="1.5"
                                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                            </path>
                                                                        </svg>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                            <div class="col-3 d-flex justify-content-center">
                                                                <form method="POST"
                                                                    action="{{ route('services.delete', ['id' => $service->id]) }}"
                                                                    onsubmit="return confirmAndShowLoading(event, 'Are you sure you want to delete this service?')">
                                                                    @csrf
                                                                    <button type="submit" class="btn" data-bs-toggle="tooltip"
                                                                        data-bs-placement="top" title="Delete">
                                                                        <span>
                                                                            <svg class="icon-22 text-danger" width="22"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                stroke="currentColor">
                                                                                <path
                                                                                    d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826"
                                                                                    stroke="currentColor" stroke-width="1.5"
                                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                                </path>
                                                                                <path d="M20.708 6.23975H3.75" stroke="currentColor"
                                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                                    stroke-linejoin="round"></path>
                                                                                <path
                                                                                    d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973"
                                                                                    stroke="currentColor" stroke-width="1.5"
                                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                                </path>
                                                                            </svg>
                                                                        </span>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endisset
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            @else
                <script>
                    window.location = "{{ route('dashboard') }}";
                </script>
            @endif
        @endauth
    @endguest


    {{-- MODAL FOR ADD NEW SERVICE --}}
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for adding new service -->
                    <form action="{{ route('services.add') }}" method="POST" enctype="multipart/form-data"
                        onsubmit="showLoading('Creating new service...')">
                        @csrf
                        <div class="mb-3">
                            <label for="service-name" class="form-label">Service Name</label>
                            <input type="text" class="form-control" id="service-name" name="service_name" value="{{ old('service_name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="pricing" class="form-label">Pricing</label>
                            <input type="text" class="form-control" id="pricing" name="pricing" value="{{ old('pricing') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="picture" class="form-label">Picture</label>
                            <input type="file" class="form-control" id="picture" name="picture"
                                accept="image/*" onchange="checkImageCount('picture')" required>
                            <div id="pictureHelp" class="form-text">Upload an image file with valid extensions (jpg,
                                jpeg, png, gif).</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    {{-- MODAL FOR EDIT SERVICE --}}
    <div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editServiceModalLabel">Edit Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('services.update') }}" method="POST" enctype="multipart/form-data"
                        onsubmit="showLoading('Updating service...')">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" id="id" name="id">
                        <div class="mb-3">
                            <label for="service-name" class="form-label">Service Name</label>
                            <input type="text" class="form-control" id="service-name" name="service_name"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="pricing" class="form-label">Pricing</label>
                            <input type="text" class="form-control" id="edit-pricing" name="pricing" required>
                        </div>
                        <div class="mt-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="1">Available</option>
                                <option value="0">Not Available</option>
                            </select>
                        </div><br>
                        <div class="mb-3">
                            <label for="picture" class="form-label">Picture</label>
                            <input type="file" class="form-control" id="edit-picture" name="picture"
                                accept="image/*" onchange="checkImageCount('edit-picture')">
                            <div id="pictureHelp" class="form-text">Upload an image file with valid extensions (jpg,
                                jpeg, png, gif).</div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
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

        th {
            color: white;
            background-color: #004065FF !important;
        }

        .table thead th:before,
        .table thead th:after {
            display: none !important;
        }

        @media (max-width: 999px) {

            .py-md-5 {
                padding-top: 1rem !important;
                padding-bottom: 1rem !important;

            }

        }

        @media (max-width: 999px) {

            div.dataTables_wrapper div.dataTables_filter,
            .dataTables_length {
                text-align: center;
                padding-top: 1.5rem !important;
                padding-left: 0.5rem !important;
            }

            .justify-content-md-end,
            .lexend-font-style {
                justify-content: center !important;
                text-align: center;
            }
        }

        @media (max-width:767px) {
            div.dataTables_wrapper div.dataTables_filter input {
                width: 70%;
            }
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        window.onload = function(event) {
            Swal.close();
        };

        window.addEventListener('pagehide', function(event) {
            Swal.close();
        });
        
        function confirmAndShowLoading(event, message) {
            event.preventDefault();

            Swal.fire({
                title: "Confirm",
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Removing service...",
                        text: "Please wait.",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    event.target.submit();
                }
            });
        }

        function openEditModal(serviceId) {
            $.ajax({
                url: "{{ route('services.details') }}",
                type: "GET",
                data: {
                    id: serviceId
                },
                success: function(response) {
                    $('#editServiceModal #id').val(response.id);
                    $('#editServiceModal #service-name').val(response.title);
                    $('#editServiceModal #description').val(response.description);
                    $('#editServiceModal #edit-pricing').val(response.price);
                    $('#editServiceModal #status').val(response.isAvailable);

                    $('#editServiceModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        function restrictToNumericInput(elementId) {
            document.getElementById(elementId).addEventListener('input', function(event) {
                let inputValue = event.target.value;
                let numericValue = inputValue.replace(/\D/g, '');
                event.target.value = numericValue;
            });
        }

        restrictToNumericInput('pricing');
        restrictToNumericInput('edit-pricing');

        function checkAuthenticatedUser() {
            if ({{ auth()->guest() ? 'true' : 'false' }}) {
                window.location = "{{ route('dashboard') }}";
            }
        }

        function checkImageCount(elementId) {
            var input = document.getElementById(elementId);
            var maxSize = 5 * 1024 * 1024; // 5MB in bytes


            if (input.files.length > 2) {
                Swal.fire({
                    title: 'Maximum of two images allowed.',
                    icon: 'error',
                    confirmButtonText: 'OK',
                });
                input.value = '';
            }

            for (var i = 0; i < input.files.length; i++) {
                if (input.files[i].size > maxSize) {
                    Swal.fire({
                        title: 'File size should not exceed 5MB.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                    });

                    input.value = '';
                    return; // Exit the function
                }
            }
        }

        checkAuthenticatedUser();
    </script>
</x-app-layout>
