<x-app-layout :assets="$assets ?? []">
    <div class="container-fluid p-3 p-md-5" style="min-height: calc(100vh - 72px);">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        <p>Please enter your new password.</p>
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form method="POST" action="{{ route('password.update') }}" onsubmit="showLoading('Processing...')">
                            @csrf
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $request->email ?? old('email') }}" required autofocus readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input id="reset-password" type="password" placeholder="********" name="password" required autocomplete="off" class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text toggle-password" id="resetTogglePassword">
                                                <svg id="resetEyeIcon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                                                    <path d="M25.8,13.4c-5.8-7.3-14-12.5-23.2-12.5c-11.6,0-21,9.4-21,21s9.4,21,21,21c9.3,0,17.4-5.2,23.2-12.5 c0.6-0.8,0.6-2.1,0-2.9L25.8,13.4z M11.9,24c0-2.3,1.9-4.1,4.1-4.1s4.1,1.9,4.1,4.1s-1.9,4.1-4.1,4.1C13.8,28.1,11.9,26.3,11.9,24z M8,24 c0-3.7,3-6.8,6.8-6.8c3.7,0,6.8,3,6.8,6.8c0,3.7-3,6.8-6.8,6.8C11,30.8,8,27.7,8,24z"/><circle cx="24" cy="24" r="2"/>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input id="reset_password_confirmation" type="password" placeholder="********" name="password_confirmation" required autocomplete="off" class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text toggle-password" id="resetTogglePasswordConfirmation">
                                                <svg id="resetEyeIconConfirmation" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                                                    <path d="M25.8,13.4c-5.8-7.3-14-12.5-23.2-12.5c-11.6,0-21,9.4-21,21s9.4,21,21,21c9.3,0,17.4-5.2,23.2-12.5 c0.6-0.8,0.6-2.1,0-2.9L25.8,13.4z M11.9,24c0-2.3,1.9-4.1,4.1-4.1s4.1,1.9,4.1,4.1s-1.9,4.1-4.1,4.1C13.8,28.1,11.9,26.3,11.9,24z M8,24 c0-3.7,3-6.8,6.8-6.8c3.7,0,6.8,3,6.8,6.8c0,3.7-3,6.8-6.8,6.8C11,30.8,8,27.7,8,24z"/><circle cx="24" cy="24" r="2"/>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const togglePassword = document.querySelector("#resetTogglePassword");
            const password = document.querySelector("#reset-password");
            const eyeIcon = document.querySelector("#resetEyeIcon");

            password.setAttribute("type", "password");
            eyeIcon.innerHTML = `<path d="M644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z"/>`;

            togglePassword.addEventListener("click", function () {
                const type = password.getAttribute("type") === "password" ? "text" : "password";
                password.setAttribute("type", type);

                if (type === "password") {
                    eyeIcon.innerHTML = `<path d="M644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z"/>`;
                } else {
                    eyeIcon.innerHTML = `<path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/>`;
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
            const togglePassword = document.querySelector("#resetTogglePasswordConfirmation");
            const password = document.querySelector("#reset_password_confirmation");
            const eyeIcon = document.querySelector("#resetEyeIconConfirmation");

            password.setAttribute("type", "password");
            eyeIcon.innerHTML = `<path d="M644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z"/>`;

            togglePassword.addEventListener("click", function () {
                const type = password.getAttribute("type") === "password" ? "text" : "password";
                password.setAttribute("type", type);

                if (type === "password") {
                    eyeIcon.innerHTML = `<path d="M644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z"/>`;
                } else {
                    eyeIcon.innerHTML = `<path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/>`;
                }
            });
        });
    </script>
</x-app-layout>
