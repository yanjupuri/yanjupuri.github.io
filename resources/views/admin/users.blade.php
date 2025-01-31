<x-app-layout :assets="$assets ?? []">
    @guest
        <script>
            window.location = "{{ route('dashboard') }}";
        </script>
    @else
        @auth
            @if(auth()->user()->hasRole('admin'))
                <section class="container-fluid px-5" style="min-height: calc(100vh - 72px);">
                    <div class="container-fluid px-5">
                        <div class="card mt-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="container-fluid p-5">
                                            <h3 class="lexend-font-style custom-pt">USERS</h3>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="container-fluid p-5">
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#addUserModal">
                                                    Add User
                                                    <span>
                                                        <svg class="icon-32" width="20" viewBox="0 0 24 26" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12.0001 8.32739V15.6537" stroke="currentColor"
                                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                            </path>
                                                            <path d="M15.6668 11.9904H8.3335" stroke="currentColor"
                                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
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
                                    <table class="table table-hover rounded shadow" data-toggle="data-table">
                                        <thead class="table-primary">
                                            <tr>
                                                <th class="col-1" data-orderable="false">Full name</th>
                                                <th class="col-1" data-orderable="false">Email</th>
                                                <th class="col-1" data-orderable="false">Phone number</th>
                                                <th class="col-1" data-orderable="false">Role</th>
                                                <th class="col-1" data-orderable="false">Status</th>
                                                <th class="col-1 text-center" data-orderable="false">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @isset($users)
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td>
                                                            {{ $user->full_name }}
                                                        </td>
                                                        <td>
                                                            {{ Str::limit($user->email, 5) }}.com
                                                        </td>
                                                        <td>{{ $user->phone_number }}</td>
                                                        <td>
                                                            {{ $user->roles->first()->name }}
                                                        </td>
                                                        <td>
                                                            {{ $status[$user->id] }}
                                                        </td>
                                                        <td class="col">
                                                            <div class="row d-flex justify-content-center">
                                                                <div class="col-3 d-flex justify-content-center">
                                                                    <form method="POST" action="{{ route('users.delete', ['id' => $user->id]) }}"
                                                                        onsubmit="return confirmAndShowLoading(event, 'Are you sure you want to delete this user?')">
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

    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for adding new user -->
                    <form method="POST" action="{{ route('register') }}" data-toggle="validator"
                        onsubmit="showLoading('Creating account...')">
                        {{ csrf_field() }}
                        <div class="row">
                            <input type="hidden" name="role" value="employee">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input id="first_name" type="text" name="first_name"
                                        value="{{ old('first_name') }}" class="form-control" placeholder="First Name"
                                        required autofocus>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input id="last_name" type="text" name="last_name"
                                        value="{{ old('last_name') }}" class="form-control" placeholder="Last Name"
                                        required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input id="email" type="email" name="email"
                                        value="{{ env('IS_DEMO') ? 'admin@example.com' : old('email') }}"
                                        class="form-control" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input id="admin_phone_number" type="text" name="phone_number"
                                        value="{{ old('phone_number') }}" maxlength="11" class="form-control"
                                        placeholder="Phone Number" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <input id="signup-password-admin" type="password" placeholder="********"
                                            name="password" required autocomplete="off" class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text toggle-password"
                                                id="signupTogglePasswordAdmin">
                                                <svg id="signupEyeIconAdmin" xmlns="http://www.w3.org/2000/svg"
                                                    height="24" viewBox="0 -960 960 960" width="24">
                                                    <path
                                                        d="M25.8,13.4c-5.8-7.3-14-12.5-23.2-12.5c-11.6,0-21,9.4-21,21s9.4,21,21,21c9.3,0,17.4-5.2,23.2-12.5 c0.6-0.8,0.6-2.1,0-2.9L25.8,13.4z M11.9,24c0-2.3,1.9-4.1,4.1-4.1s4.1,1.9,4.1,4.1s-1.9,4.1-4.1,4.1C13.8,28.1,11.9,26.3,11.9,24z M8,24 c0-3.7,3-6.8,6.8-6.8c3.7,0,6.8,3,6.8,6.8c0,3.7-3,6.8-6.8,6.8C11,30.8,8,27.7,8,24z" />
                                                    <circle cx="24" cy="24" r="2" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="confirm-password" class="form-label">Confirm Password</label>
                                    <div class="input-group">
                                        <input id="password_confirmation_admin" type="password"
                                            placeholder="********" name="password_confirmation" required
                                            autocomplete="off" class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text toggle-password"
                                                id="signupTogglePasswordConfirmationAdmin">
                                                <svg id="signupEyeIconConfirmationAdmin"
                                                    xmlns="http://www.w3.org/2000/svg" height="24"
                                                    viewBox="0 -960 960 960" width="24">
                                                    <path
                                                        d="M25.8,13.4c-5.8-7.3-14-12.5-23.2-12.5c-11.6,0-21,9.4-21,21s9.4,21,21,21c9.3,0,17.4-5.2,23.2-12.5 c0.6-0.8,0.6-2.1,0-2.9L25.8,13.4z M11.9,24c0-2.3,1.9-4.1,4.1-4.1s4.1,1.9,4.1,4.1s-1.9,4.1-4.1,4.1C13.8,28.1,11.9,26.3,11.9,24z M8,24 c0-3.7,3-6.8,6.8-6.8c3.7,0,6.8,3,6.8,6.8c0,3.7-3,6.8-6.8,6.8C11,30.8,8,27.7,8,24z" />
                                                    <circle cx="24" cy="24" r="2" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" id="submit-user"
                                class="btn btn-primary">{{ __('Submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
        html,body{
            height: 100%;
            width:100%;
            padding: 0;
            margin:0;
            overflow-x: hidden;
        }
        label{
            text-align: center;
        }
        th {
            color: white;
            background-color: #004065FF;
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
            .p-5 {
                padding: 0 !important;
            }

            .px-5 {
                padding-left: 0.5rem !important;
                padding-right: 0.5rem !important;
            }
            .custom-pt{
                padding-top: 0.5rem !important;
            }
        }
    </style>

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
                        title: "Removing account...",
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


        document.addEventListener("DOMContentLoaded", function() {
            const togglePassword = document.querySelector("#signupTogglePasswordAdmin");
            const password = document.querySelector("#signup-password-admin");
            const eyeIcon = document.querySelector("#signupEyeIconAdmin");

            password.setAttribute("type", "password");
            eyeIcon.innerHTML =
                `<path d="M644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z"/>`;

            togglePassword.addEventListener("click", function() {
                const type = password.getAttribute("type") === "password" ? "text" : "password";
                password.setAttribute("type", type);

                if (type === "password") {
                    eyeIcon.innerHTML =
                        `<path d="M644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z"/>`;
                } else {
                    eyeIcon.innerHTML =
                        `<path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/>`;
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const togglePassword = document.querySelector("#signupTogglePasswordConfirmationAdmin");
            const password = document.querySelector("#password_confirmation_admin");
            const eyeIcon = document.querySelector("#signupEyeIconConfirmationAdmin");

            password.setAttribute("type", "password");
            eyeIcon.innerHTML =
                `<path d="M644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z"/>`;

            togglePassword.addEventListener("click", function() {
                const type = password.getAttribute("type") === "password" ? "text" : "password";
                password.setAttribute("type", type);

                if (type === "password") {
                    eyeIcon.innerHTML =
                        `<path d="M644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z"/>`;
                } else {
                    eyeIcon.innerHTML =
                        `<path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/>`;
                }
            });
        });

        document.getElementById('admin_phone_number').addEventListener('input', function(event) {
            let inputValue = event.target.value;
            let numericValue = inputValue.replace(/\D/g, '');
            event.target.value = numericValue;
        });

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
    </script>
</x-app-layout>
