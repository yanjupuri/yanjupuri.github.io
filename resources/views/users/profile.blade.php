<x-app-layout :assets="$assets ?? []">
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css" integrity="sha512-hvNR0F/e2J7zPPfLC9auFe3/SE0yG4aJCOd/qxew74NN7eyiSKjr7xJJMu1Jy2wf7FXITpWS1E/RY8yzuXN7VA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <style>
        .cursor-pointer:hover {
            cursor: pointer;
        }

        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999; 
        }

        #croppingContainer {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 10000;
        }

        @media(max-width: 600px) {
            #croppingContainer {
                width: 100%;
            }

            #image {
                max-width: 100%;
                width: 400px;
                height: auto;
            }
        }

        @media (max-width: 768px) {
            #croppingContainer {
                width: 100%;
            }

            #image {
                max-width: 100%;
                width: 400px;
                height: auto;
            }
        }
    </style>
    <section class="container-fluid" style="min-height: calc(100vh - 72px);">
        <div class="container-fluid">
            <form method="POST" action="{{ route('users.update') }}" enctype="multipart/form-data"
                onsubmit="showLoading('Updating profile...')">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mt-5">
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center justify-content-between">
                                    <div class="d-flex flex-wrap align-items-center">
                                        <div class="profile-img position-relative me-3 mb-3 mb-lg-0">
                                            <br><br><br>
                                            <label for="picture" class="d-block cursor-pointer"
                                                style="cursor: pointer;">
                                                <input type="file" id="picture" name="picture" accept="image/*"
                                                    style="display: none;" onchange="checkImageCount(); previewProfilePicture(event);">
                                                <!-- Profile Picture Preview -->
                                                <img id="picture_preview" src="{{ Auth::user()->profile_picture ? route('profile_picture', ['filename' => Auth::user()->profile_picture]) : asset('images/avatars/01.png') }}" alt="User-Profile" class="theme-color-default-img img-fluid rounded-pill avatar-100">
                                            </label>
                                        </div>
                                        <div class="d-flex flex-wrap align-items-center mb-3 mb-sm-0">
                                            <h4 class="me-2 h4">{{ $data->full_name ?? 'Austin Robertson' }}</h4>
                                            <span class="text-capitalize"> -
                                                {{ str_replace('_', ' ', auth()->user()->roles->first()->name) ?? 'Marketing Administrator' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xxl-4 d-flex align-items-stretch">
                                        <!-- Left side: Feed -->
                                        @hasrole('admin|employee')
                                            <div class="card w-100">
                                                <div class="card-body">
                                                    <!-- Add your feed content here -->
                                                    <h5 class="card-title">
                                                        @if(auth()->user()->hasRole('admin'))
                                                            Admin details
                                                        @else
                                                            Employee details
                                                        @endif
                                                    </h5>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <!-- Left column -->
                                                            <div class="mb-3">
                                                                <label for="company" class="form-label">Company:</label>
                                                                <input type="text" class="form-control" id="company"
                                                                    name="company" value="{{ env('APP_NAME') }}" disabled>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="titles" class="form-label">Titles:</label>
                                                                <textarea type="text" class="form-control" id="titles" name="titles" rows="11">{{ optional(auth()->user()->userProfile)->titles ?? '' }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <!-- Right column -->
                                                            <div class="mb-3">
                                                                <label for="description"
                                                                    class="form-label">Description:</label>
                                                                <textarea type="text" class="form-control" id="description" name="description" rows="15">{{ optional(auth()->user()->userProfile)->description ?? '' }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endhasrole
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xxl-4 d-flex align-items-stretch">
                                        <!-- Middle: Profile -->
                                        <div class="card">
                                            <div class="card-body">
                                                <!-- Add your profile content here -->
                                                <h5 class="card-title">Profile</h5>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <!-- Left column -->
                                                        <div class="mb-3">
                                                            <label for="full_name" class="form-label">Full name:</label>
                                                            <input type="text" class="form-control" id="name"
                                                                name="name" value="{{ auth()->user()->full_name }}"
                                                                disabled>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label">Email:</label>
                                                            <input type="email" class="form-control" id="email"
                                                                name="email" value="{{ auth()->user()->email }}"
                                                                disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <!-- Right column -->
                                                        <div class="mb-3">
                                                            <label for="phone_number" class="form-label">Phone
                                                                number:</label>
                                                            <input type="text" class="form-control" id="admin_phone_number" name="phone_number" value="{{ auth()->user()->phone_number }}" maxlength="11" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="new_password" class="form-label">New
                                                                password:</label>
                                                            <div class="input-group">
                                                                <input id="admin_password" type="password"
                                                                    placeholder="********" name="new_password"
                                                                    autocomplete="off" class="form-control">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text toggle-password"
                                                                        id="togglePasswordAdmin">
                                                                        <svg id="eyeIconAdmin"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            height="24" viewBox="0 -960 960 960"
                                                                            width="24">
                                                                            <path
                                                                                d="M25.8,13.4c-5.8-7.3-14-12.5-23.2-12.5c-11.6,0-21,9.4-21,21s9.4,21,21,21c9.3,0,17.4-5.2,23.2-12.5 c0.6-0.8,0.6-2.1,0-2.9L25.8,13.4z M11.9,24c0-2.3,1.9-4.1,4.1-4.1s4.1,1.9,4.1,4.1s-1.9,4.1-4.1,4.1C13.8,28.1,11.9,26.3,11.9,24z M8,24 c0-3.7,3-6.8,6.8-6.8c3.7,0,6.8,3,6.8,6.8c0,3.7-3,6.8-6.8,6.8C11,30.8,8,27.7,8,24z" />
                                                                            <circle cx="24" cy="24"
                                                                                r="2" />
                                                                        </svg>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" id="save-changes" class="btn btn-primary">Save
                                                    Changes</button>
                                            </div>
                                            <br>
                                        </div>
                                    </div>

                                    <div class="col-lg col-md col-sm col-xxl-4 d-flex align-items-stretch">
                                        <!-- Right side: Activity Log -->
                                        <div class="card w-100">
                                            <div class="card-body">
                                                <!-- Add your activity log content here -->
                                                <h5 class="card-title">Activity Log</h5>
                                                <p class="card-text">Content for the activity log goes here.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="overlay" style="display: none;">
                    <div id="croppingContainer">
                        <div id="croppingView">
                            <img id="image">
                        </div>
                        <br>
                        <center>
                            <button id="cropBtn" type="button" class="btn btn-primary">Crop</button>
                            <button id="cancelBtn" type="button" class="btn btn-secondary">Cancel</button>
                        </center>
                    </div>
                </div>
                <input type="hidden" id="cropped_image" name="cropped_image">
            </form>
        </div>

        @include('partials.components.share-offcanvas')
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js" integrity="sha512-9KkIqdfN7ipEW6B6k+Aq20PV31bjODg4AA52W+tYtAE0jE0kMx49bjJ3FgvS56wzmyfMUHbQ4Km2b7l9+Y/+Eg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var cropper;
        function previewProfilePicture(event) {
            var pictureValue = $("#picture").val();
            console.log(pictureValue);
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = new Image();
                    img.onload = function() {
                        var canvas = document.createElement('canvas');
                        var ctx = canvas.getContext('2d');
                        canvas.width = 537;
                        canvas.height = 547;
                        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

                        var imageData = canvas.toDataURL();
                        document.getElementById('image').src = imageData;

                        if (cropper) {
                            $("#picture").val('');
                            cropper.destroy();
                        }
                        var image = document.getElementById('image');
                        cropper = new Cropper(image, {
                            aspectRatio: 1 / 1,
                            viewMode: 3,
                            movable: true,
                            zoomable: false,
                            rotatable: false,
                            scalable: false,
                            dragMode: 'none',
                        });

                        document.getElementById('overlay').style.display = 'block';

                        document.getElementById('cropBtn').addEventListener('click', function() {
                            console.log(pictureValue);
                            if (cropper) {
                                var croppedImage = cropper.getCroppedCanvas().toDataURL("image/png");
                                
                                document.getElementById('picture_preview').src = croppedImage;
                                document.getElementById('cropped_image').value = croppedImage;
                                document.getElementById('overlay').style.display = 'none';
                            } else {
                                console.error('Cropper object is not initialized');
                            }
                        });

                        document.getElementById('cancelBtn').addEventListener('click', function() {
                            if (cropper) {
                                cropper.destroy();
                            }
                            document.getElementById('overlay').style.display = 'none';
                            $('input[type="file"]').val('');
                        });
                    }
                    img.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const togglePassword = document.querySelector("#togglePasswordAdmin");
            const password = document.querySelector("#admin_password");
            const eyeIcon = document.querySelector("#eyeIconAdmin");

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

        function checkImageCount() {
            var input = document.getElementById('picture');
            var maxSize = 3 * 1024 * 1024; // 3MB in bytes
                

            if (input.files.length > 1) {
                Swal.fire({
                    title: 'Maximum of one image allowed.',
                    icon: 'error',
                    confirmButtonText: 'OK',
                });
                input.value = '';
            }

            for (var i = 0; i < input.files.length; i++) {
                if (input.files[i].size > maxSize) {
                    Swal.fire({
                        title: 'File size should not exceed 3MB.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                    });

                    input.value = '';
                    return; // Exit the function
                }
            }
        }

        window.onload = function(event) {
            Swal.close();
        };

        window.addEventListener('pagehide', function(event) {
            Swal.close();
        });
    </script>
</x-app-layout>
