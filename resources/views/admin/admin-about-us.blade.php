<x-app-layout :assets="$assets ?? []">
    @guest
        <script>
            window.location = "{{ route('dashboard') }}";
        </script>
    @else
        @auth
            @if(auth()->user()->hasRole('admin'))
                <section class="container-fluid p-5" style="min-height: calc(100vh - 72px);">
                    <div class="container-fluid p-5">
                        <div class="card mt-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="container-fluid p-5">
                                            <h3 class="lexend-font-style">ABOUT US</h3>
                                        </div>
                                    </div>
                                    @if($abouts->isEmpty())
                                        <div class="col">
                                            <div class="container-fluid p-5">
                                                <div class="d-flex justify-content-end">
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#addAboutUsModal">
                                                        CREATE ABOUT US
                                                        <span>
                                                            <svg class="icon-32" width="20" viewBox="0 0 24 26" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M12.0001 8.32739V15.6537" stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M15.6668 11.9904H8.3335" stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"></path>
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
                                    @else
                                        <div class="col">
                                            <div class="container-fluid p-5 d-flex justify-content-end" style="color: red;">
                                                <p>About Us section already exists.</p>
                                            </div>
                                        </div>
                                        
                                    @endif                   
                                    
                                </div>
                                <div class="table-responsive px-3">
                                    <table class="table table-hover rounded shadow" data-toggle="data-table">
                                        <thead class="table-primary">
                                            <tr>
                                                <th class="col-2" data-orderable="false">Title</th>
                                                <th class="col-2" data-orderable="false">Header</th>
                                                <th class="col-2" data-orderable="false">Body</th>
                                                <th class="col-2" data-orderable="false">Footer</th>
                                                <th class="col-2" data-orderable="false">Image</th>
                                                <th class="col-1 text-center" data-orderable="false">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @isset($abouts)
                                                @foreach ($abouts as $about)
                                                    <tr>
                                                        <td>
                                                            {{ Str::limit($about->title, 20) }}
                                                        </td>
                                                        <td>
                                                            {{ Str::limit($about->header, 20) }}
                                                        </td>
                                                        <td>{{ Str::limit($about->body, 20) }}</td>
                                                        <td>{{ Str::limit($about->footer, 20) }}</td>
                                                        <td>
                                                            @if ($about->image)
                                                                {{-- <img style="max-width: 100px; max-height: 100px;" src="{{ asset('storage/about_images/' . $about->image) }}" alt="About Image" class="img-fluid"> --}}
                                                                <img style="max-width: 100px; max-height: 100px;" src="{{ route('about_image', ['filename' => $about->image]) }}" alt="About Image" class="img-fluid">
                                                            @else
                                                                No Image
                                                            @endif
                                                        </td>
                                                        <td class="col">
                                                            <div class="row d-flex justify-content-center">
                                                                <div class="col-3 d-flex justify-content-center">
                                                                    <button type="submit" class="btn" data-bs-toggle="tooltip"
                                                                        data-bs-placement="top" data-original-title="Edit" href="#"
                                                                        aria-label="Edit" data-bs-original-title="Edit"
                                                                        onclick="openEditModal('{{ $about->id }}')">
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
                                                                                <path d="M11.021 6.00098L16.4732 10.1881" stroke="currentColor"
                                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                                    stroke-linejoin="round">
                                                                                </path>
                                                                            </svg>
                                                                        </span>
                                                                    </button>
                                                                </div>
                                                                <div class="col-3 d-flex justify-content-center">
                                                                    <form method="POST" action="{{ route('admin.deleteaboutus', ['id' => $about->id]) }}"
                                                                        onsubmit="return confirmAndShowLoading(event, 'Are you sure you want to delete this about us?')">
                                                                        @csrf
                                                                        <button type="submit" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                                            <span>
                                                                                <svg class="icon-22 text-danger" width="22" viewBox="0 0 24 24" fill="none"
                                                                                    xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                                                                    <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                                    <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                                    <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
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
                    </div>
                </section>
            @else
                <script>
                    window.location = "{{ route('dashboard') }}";
                </script>
            @endif
        @endauth
    @endguest
    
    <div class="modal fade" id="addAboutUsModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add About Us</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for adding new aboutus -->
                    <form action="{{ route('admin.addaboutus') }}" method="POST" enctype="multipart/form-data" onsubmit="showLoading('Creating new about us...')">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <textarea class="form-control" id="about-title" name="title" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="header" class="form-label">Header</label>
                            <textarea class="form-control" id="about-header" name="header" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="body" class="form-label">Body</label>
                            <textarea class="form-control" id="about-body" name="body" rows="3" placeholder="To add multiple values, please make use of period (.) as a separator" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="footer" class="form-label">Footer</label>
                            <textarea class="form-control" id="about-footer" name="footer" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="picture" class="form-label">Picture</label>
                            <input type="file" class="form-control" id="picture" name="picture" accept="image/*" onchange="checkImageCount('picture')" required>
                            <div id="pictureHelp" class="form-text">Upload an image file with valid extensions (jpg,
                                jpeg, png, gif).</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL FOR EDIT PRODUCT --}}
    <div class="modal fade" id="editAboutUsModal" tabindex="-1" aria-labelledby="editAboutUsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAboutUsModalLabel">Edit About Us</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.updateabout') }}" method="POST" enctype="multipart/form-data" onsubmit="showLoading('Updating about us...')">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" id="id" name="id">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <textarea class="form-control" id="about-title" name="title" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="header" class="form-label">Header</label>
                            <textarea class="form-control" id="about-header" name="header" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="body" class="form-label">Body</label>
                            <textarea class="form-control" id="about-body" name="body" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="footer" class="form-label">Footer</label>
                            <textarea class="form-control" id="about-footer" name="footer" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="picture" class="form-label">Picture</label>
                            <input type="file" class="form-control" id="edit-picture" name="picture" accept="image/*" onchange="checkImageCount('edit-picture')">
                            <div id="pictureHelp" class="form-text">Upload an image file with valid extensions (jpg, jpeg, png, gif).</div>
                        </div>
                   
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <style>
        th{
            color: white;
            background-color: #004065FF !important;
        }

        .table thead th:before,
        .table thead th:after {
            display: none !important;
        }
    </style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
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
                    title: "Removing about us...",
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

    function openEditModal(aboutId) {
        $.ajax({
            url: "{{ route('admin.aboutdetails') }}",
            type: "GET",
            data: {
                id: aboutId
            },
            success: function(response) {
                $('#editAboutUsModal #id').val(response.id);
                $('#editAboutUsModal #about-title').val(response.title);
                $('#editAboutUsModal #about-header').val(response.header);
                $('#editAboutUsModal #about-body').val(response.body);
                $('#editAboutUsModal #about-footer').val(response.footer);

                $('#editAboutUsModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function checkAuthenticatedUser() {
        if ({{ auth()->guest() ? 'true' : 'false' }}) {
            window.location = "{{ route('dashboard') }}";
        }
    }
    
    checkAuthenticatedUser();

    window.onload = function(event) {
        Swal.close();
    };

    window.addEventListener('pagehide', function(event) {
        Swal.close();
    });

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

</script>
</x-app-layout>
