<x-app-layout :assets="$assets ?? []">
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    @guest
        <script>
            window.location = "{{ route('dashboard') }}";
        </script>
    @else
        @auth
            @if(auth()->user()->hasRole('admin'))
                <div class="container-fluid" style="min-height: calc(100vh - 72px);">
                    <h2 class="text-center p-5">Reviews</h2>
                        <div class="container">
                            @isset($reviewsQuery)
                                @if ($reviewsQuery->count() > 0)
                                    @foreach ($reviewsQuery as $review)
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row row-cols-3 w-100">
                                                    <!-- Review 1 -->
                                                    <div class="d-flex justify-content-end col-auto ps-5 pe-0">
                                                        @if (!empty($review->user->profile_picture))
                                                            <img src="{{ route('profile_picture', ['filename' => $review->user->profile_picture]) }}" class="img-thumbnail img-fluid"
                                                            style="width: 100px; height:100px;">
                                                        @else
                                                            <img src="{{ asset('images/avatars/01.png') }}" class="img-thumbnail img-fluid" style="width: 100px; height:100px;">
                                                        @endif
                                                    </div>
                                                    <div class="col-6 col-xxl-6 col-xl-6 col-lg-4 col-md-4 col-sm-3">
                                                        <h5 class="mt-1">{{ $review->user->full_name }}</h5>
                                                        <p class="mb-0">Customer</p>
                                                        @for ($i = 0; $i < 5; $i++)
                                                            @if ($i < $review->stars)
                                                                <span class="cust-rating" style="color: gold;">&#9733;</span>
                                                            @else
                                                                <span class="cust-rating">&#9733;</span>
                                                            @endif
                                                        @endfor
                                                        <div class="customlabel1 rounded">
                                                            <p class="mb-0" style="text-transform: capitalize;">{{ $review->rating_type }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-xxl-6 col-xl-6 col-lg-4 col-md-4 col-sm-3"></div>
                                                </div>
                                                <div class="container pt-4">
                                                    {{ $review->comments ?? 'Customer did not put any comments' }}
                                                </div>
                                                
                                                <a id="reply-button-{{ $review->id }}" class="mt-3 mx-3 btn btn-outline-primary reply-button">Reply 
                                                    <span class="icon">
                                                        <svg height="16px" id="Layer_1" style="enable-background:new 0 0 16 16;" version="1.1"
                                                            viewBox="0 0 16 20" width="16px" xml:space="preserve" color="blue"
                                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <path
                                                                d="M7,5V3c0-0.515-0.435-1-1-1C5.484,2,5.258,2.344,5,2.586L0.578,7C0.227,7.359,0,7.547,0,8s0.227,0.641,0.578,1L5,13.414  C5.258,13.656,5.484,14,6,14c0.565,0,1-0.485,1-1v-2h2c1.9,0.075,4.368,0.524,5,2.227C14.203,13.773,14.625,14,15,14  c0.563,0,1-0.438,1-1C16,7.083,12.084,5,7,5z" />
                                                        </svg>
                                                    </span>
                                                </a>
                                                <div d="reply-text-{{ $review->id }}" class="card mt-3 reply-card" style="display: none;">
                                                    <div class="card-body">
                                                        <form action="" method="post">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="id" value="{{ $review->id }}">
                                                            <textarea id="replies" name="replies" class="form-control" rows="3" placeholder="Write your reply here..." required></textarea>
                                                            <div class="mt-3">
                                                                <button id="cancel" type="button" class="btn btn-outline-secondary cancel">Cancel</button>
                                                                <button type="submit" id="submit-btn" class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-12 d-flex justify-content-center">
                                            <div class="pagination-container" style="overflow-x: auto;">
                                                {{ $reviewsQuery->links() }}
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row mt-4">
                                        <div class="col-12 text-center">
                                            <p>No reviews to reply available.</p>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="row mt-4">
                                    <div class="col-12 text-center">
                                        <p>No reviews to reply available.</p>
                                    </div>
                                </div>
                            @endisset
                        </div>
                </div>
            @else
                <script>
                    window.location = "{{ route('dashboard') }}";
                </script>
            @endif
        @endauth 
    @endguest
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

        .customlabel1 {
            background: #eaffea;
            color: #175727;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
            width: 5.5rem;
            margin-top: 0.1rem;
        }

        .customlabel2 {
            background: #ffeaea;
            color: #571717;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
            width: 5.5rem;
            margin-top: 0.1rem;
        }

        .icon path {
            fill: var(--bs-primary);
        }

        .btn:hover .icon path {
            fill: white;
        }

        @media (max-width:487px) {
            .col-6 {
                width: 100% !important;
                text-align: center;
            }

            .ps-5 {
                padding-left: 0% !important;
            }

            .justify-content-end {
                justify-content: center !important;
                width: 100% !important;
            }

            .row .row-cols-3 {
                display: flex;
                justify-content: center !important;
            }

            .w-100 {
                width: 100% !important;
                padding-left: 2rem;
            }

            .container .comment1 {
                text-align: center;
            }
        }
    </style>

<script>
    window.onload = function(event) {
        Swal.close();
    };

    window.addEventListener('pagehide', function(event) {
        Swal.close();
    });
    
    $(document).ready(function() {
        $('.reply-button').click(function() {
            $('.reply-button').hide();

            $(this).next('.card').show();
        });

        $('.cancel').click(function() {
            $(this).closest('.card').hide();
            $('.reply-button').show();
        });
    });


    $(document).ready(function() {
        $('form').submit(function(event) {
            event.preventDefault();

            var formData = $(this).serialize();

            Swal.fire({
                title: 'Processing...',
                text: "Please wait.",
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });
            $.ajax({
                url: "{{ route('reviews.update') }}",
                type: "PATCH",
                data: formData,
                success: function(response) {
                    Swal.close();

                    console.log(response);
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message
                    });

                    window.location.href = response.redirect;
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    Swal.close();

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: "An error occurred while adding reply."
                    });
                }
            });
        });
    });

    function checkAuthenticatedUser() {
        if ({{ auth()->guest() ? 'true' : 'false' }}) {
            window.location = "{{ route('dashboard') }}";
        }
    }
    
    checkAuthenticatedUser();
</script>

</x-app-layout>
