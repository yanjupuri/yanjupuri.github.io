<x-app-layout :assets="$assets ?? []">
    <div class="container-fluid p-3 p-md-5" style="min-height: calc(100vh - 72px);">
        <div class="container">
            <div class="title">
                <h4 class="lexend-font-style font-weight-bolder text-center">MEET THE TEAM</h4>
            </div>
        </div>
        <div class="container-fluid p-5">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 ">
                @isset($users)
                    @foreach ($users as $user)
                        <div class="col col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3 d-flex align-items-stretch px-2">
                            <div class="card shadow-lg w-100">
                                <div class="card-body p-5 team-details" data-user-id="{{ $user->id }}">
                                    <div class="d-flex justify-content-center pt-4">
                                        @if ($user->profile_picture)
                                            <img id="profile_picture_preview"
                                                src="{{ route('profile_picture', ['filename' => $user->profile_picture]) }}"
                                                alt="User-Profile" class="rounded" style="width: 190px; height:190px;">
                                        @else
                                            <img id="profile_picture_preview" src="{{ asset('images/avatars/01.png') }}"
                                                alt="User-Profile" class="rounded" style="width: 200px; height:200px;">
                                        @endif
                                    </div>
                                    <h5 class="title text-center manrope-font-style pt-3">{{ $user->full_name }}</h5>
                                    <h6 class="title text-center manrope-font-style pt-3" style="color: #15ABFFFF">
                                        {{ $user->userProfile->titles ?? '' }}</h6>
                                    @if (!empty($user->userProfile->description))
                                        <h6 class="title text-center p-3" style="text-align: justify !important;">
                                            {{ Str::limit($user->userProfile->description, 100) ?? '' }}</h6>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endisset
            </div>
        </div>
    </div>

    <div class="modal fade" id="user_details_modal" tabindex="-1" role="dialog" aria-labelledby="userDetailsModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userDetailsModal">User Details</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- User details will be displayed here -->
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).on('click', '.team-details', function() {
            var userId = $(this).data('user-id');

            $.ajax({
                type: "GET",
                url: "{{ route('team.show') }}?user_id=" + userId,
                dataType: "json",
                success: function(response) {

                    $('#user_details_modal .modal-body').html(response.view);
                    $('#user_details_modal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    Swal.fire(error, '', 'error');
                }
            });
        });

        window.onload = function(event) {
            Swal.close();
        };

        window.addEventListener('pagehide', function(event) {
            Swal.close();
        });
    </script>

    <style>
        .card:hover {
            background-color: var(--bs-primary-tint-20);
            cursor: pointer !important;
        }

        .custom-img {
            width: 18.75rem !important;
            height: 18.75rem !important;
        }
    </style>
</x-app-layout>
