<div id="crisp-chat" data-user-email="{{ auth()->check() ? auth()->user()->email : '' }}"
    data-user-name="{{ auth()->check() ? auth()->user()->full_name : '' }}"
    data-user-number="{{ auth()->check() ? auth()->user()->phone_number : '' }}"
    data-user-profile="{{ auth()->check() ? auth()->user()->profile_picture : '' }}" style="display: none !important;">
</div>
<script type="text/javascript">
    window.$crisp = [];
    window.CRISP_TOKEN_ID =
        '{{ auth()->check() ? (auth()->user()->token ? "'" . auth()->user()->token . "'" : 'null') : 'null' }}';
    window.CRISP_WEBSITE_ID = "31b94284-1da8-4d55-ae63-8741c0c7d08f";
    (function() {
        d = document;
        s = d.createElement("script");
        s.src = "https://client.crisp.chat/l.js";
        s.async = 1;
        d.getElementsByTagName("head")[0].appendChild(s);
    })();

    if ({{ auth()->guest() ? 'false' : 'true' }}) {
        var userEmail = document.getElementById('crisp-chat').getAttribute('data-user-email');
        var userName = document.getElementById('crisp-chat').getAttribute('data-user-name');
        var userNumber = document.getElementById('crisp-chat').getAttribute('data-user-number');
        var user_profile_picture = document.getElementById('crisp-chat').getAttribute('data-user-profile');
        var base_url = "https://quickiefixtech.online/public/storage/profile_pictures/";
        var full_user_profile_picture = base_url + user_profile_picture;

        $crisp.push(["set", "user:email", [userEmail]]);
        $crisp.push(["set", "user:nickname", [userName]]);
        $crisp.push(["set", "user:phone", [userNumber]]);
        $crisp.push(["set", "user:avatar", [full_user_profile_picture]]);
    } else {
        $crisp.push(["set", "user:nickname", ["Guest"]]);
        $crisp.push(["set", "user:avatar", ["https://quickiefixtech.online/public/images/avatars/01.png"]]);
    }
</script>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css"
        integrity="sha512-hvNR0F/e2J7zPPfLC9auFe3/SE0yG4aJCOd/qxew74NN7eyiSKjr7xJJMu1Jy2wf7FXITpWS1E/RY8yzuXN7VA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    .custom-text-color {
        color: #ffffff;
    }

    .custom-spacing {
        margin-left: 0.75rem;
        margin-right: 0.75rem;
        padding-left: 0.5rem;
        padding-right: 0.5rem;
    }

    @media (max-width: 791px) {
        .custom-spacing {
            margin-left: 0rem;
            margin-right: 0rem;
            padding-left: 0rem;
            padding-right: 0rem;

        }

        .navbar-custom-color a {
            font-size: 15pt;
        }
    }

    .custom-text-color:hover {
        color: #92aebd;
    }

    .button {
        padding: 0 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        line-height: 22px;
        font-weight: 700;
        color: #FFFFFFFF;
        background: #004065FF;
        opacity: 1;
        border: none;
        border-radius: 12px;
    }

    .button:hover {
        color: #FFFFFFFF;
        background: rgb(2, 28, 43);
    }

    .button:hover:active {
        color: #FFFFFFFF;
        background: rgb(2, 28, 43);
    }

    .button:disabled {
        opacity: 0.4;
    }

    .logo-img {
        width: auto;
        height: auto;
    }

    .cursor-pointer:hover {
        cursor: pointer;
    }

    .dots {
        background-color: #f8f9fa;
    }

    .notification-container {
        max-height: 300px;
        overflow-y: auto;
    }

    .no-hover {
        cursor: not-allowed;
        color: inherit !important;
        text-decoration: none !important;
    }

    .no-hover:hover {
        cursor: not-allowed;
        color: inherit !important;
        text-decoration: none !important;
    }

    .spin-animation {
        animation: spin 1s linear;
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    .navbar-collapse {
        transition: height 0.3s ease-in-out;
        height: auto;
    }

    .navbar-collapse.navbar-collapse-animation {
        height: auto;
    }

    .cus-width {
        width: 30rem !important;
    }

    .dropstart .dropdown-menu[data-bs-popper] {
        top: 100%;
        right: 1%;
        left: auto;
        margin-top: 0;
        margin-right: 0.125rem;
    }

    .align-items-center2 {
        align-items: center !important;
    }

    @media (max-width: 989px) {
        .dropstart .dropdown-menu[data-bs-popper] {
            right: auto !important;
            left: auto !important;
            top: 100% !important;
        }

        .dropdown-menu-end[data-bs-popper] {
            right: auto !important;
        }

        .align-items-center2 {

            align-items: start !important;
        }
    }

    .bell {
        transform-origin: center;
        transform-box: fill-box;
    }

    .bell.active {
        animation: transform 1s ease;
    }

    .disabled-link {
        color: var(--bs-primary-tint-40) !important;
    }

    @keyframes transform {
        30% {
            transform: rotate(30deg);
        }

        75% {
            transform: rotate(-30deg);
        }
    }

    #overlayUser {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
    }

    #croppingContainerUser {
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
        #croppingContainerUser {
            width: 100%;
        }

        #image-user {
            max-width: 100%;
            width: 400px;
            height: auto;
        }
    }

    @media (max-width: 768px) {
        #croppingContainerUser {
            width: 100%;
        }

        #image-user {
            max-width: 100%;
            width: 400px;
            height: auto;
        }
    }

    .logo {
        width: 50px;
        height: 50px;
    }

    @media (max-width: 441px) {
        .logo-title {
            display: none;
        }
    }
</style>

<?php
$currentRoute = Route::current()->getName();
?>
<nav class="nav navbar sticky-top navbar-expand-xl navbar-custom-color" style="height: 70px;">
    <div class="container-fluid">
        @if ($currentRoute != 'dashboard')
            <a href="{{ route('dashboard') }}" class="navbar-brand" onclick="showLoading('Loading...')">
                <img src="{{ asset('images/Logo.png') }}" alt="" class="img-fluid logo mx-2">
                <h4 class="logo-title lexend-font-style text-white">{{ env('APP_NAME') }}</h4>
            </a>
        @else
            <a href="#" class="navbar-brand disabled-link" style="cursor: not-allowed;">
                <img src="{{ asset('images/Logo.png') }}" alt="" class="img-fluid logo">
                <h4 class="logo-title lexend-font-style text-white">{{ env('APP_NAME') }}</h4>
            </a>
        @endif
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" style="color: var(--bs-primary-tint-20)">
                <svg class="icon-32" width="30" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M20.4023 13.58C20.76 13.77 21.036 14.07 21.2301 14.37C21.6083 14.99 21.5776 15.75 21.2097 16.42L20.4943 17.62C20.1162 18.26 19.411 18.66 18.6855 18.66C18.3278 18.66 17.9292 18.56 17.6022 18.36C17.3365 18.19 17.0299 18.13 16.7029 18.13C15.6911 18.13 14.8429 18.96 14.8122 19.95C14.8122 21.1 13.872 22 12.6968 22H11.3069C10.1215 22 9.18125 21.1 9.18125 19.95C9.16081 18.96 8.31259 18.13 7.30085 18.13C6.96361 18.13 6.65702 18.19 6.40153 18.36C6.0745 18.56 5.66572 18.66 5.31825 18.66C4.58245 18.66 3.87729 18.26 3.49917 17.62L2.79402 16.42C2.4159 15.77 2.39546 14.99 2.77358 14.37C2.93709 14.07 3.24368 13.77 3.59115 13.58C3.87729 13.44 4.06125 13.21 4.23498 12.94C4.74596 12.08 4.43937 10.95 3.57071 10.44C2.55897 9.87 2.23194 8.6 2.81446 7.61L3.49917 6.43C4.09191 5.44 5.35913 5.09 6.38109 5.67C7.27019 6.15 8.425 5.83 8.9462 4.98C9.10972 4.7 9.20169 4.4 9.18125 4.1C9.16081 3.71 9.27323 3.34 9.4674 3.04C9.84553 2.42 10.5302 2.02 11.2763 2H12.7172C13.4735 2 14.1582 2.42 14.5363 3.04C14.7203 3.34 14.8429 3.71 14.8122 4.1C14.7918 4.4 14.8838 4.7 15.0473 4.98C15.5685 5.83 16.7233 6.15 17.6226 5.67C18.6344 5.09 19.9118 5.44 20.4943 6.43L21.179 7.61C21.7718 8.6 21.4447 9.87 20.4228 10.44C19.5541 10.95 19.2475 12.08 19.7687 12.94C19.9322 13.21 20.1162 13.44 20.4023 13.58ZM9.10972 12.01C9.10972 13.58 10.4076 14.83 12.0121 14.83C13.6165 14.83 14.8838 13.58 14.8838 12.01C14.8838 10.44 13.6165 9.18 12.0121 9.18C10.4076 9.18 9.10972 10.44 9.10972 12.01Z"
                        fill="currentColor">
                    </path>
                </svg>
            </span>
        </button>

        <div class="collapse navbar-collapse navbar-custom-color rounded-bottom" id="navbarNavDropdown">
            <ul class="navbar-nav p-0 ms-auto list-unstyled d-flex align-items-center2" id="header-menu">
                @hasrole('admin')
                    <!-- Dashboard/Landing Page for admin users -->
                    <li class="nav-item p-2 ">
                        <a class="nav-link custom-text-color link-to-click {{ $currentRoute == 'adminDashboard' ? 'disabled-link' : '' }} {{ $currentRoute == 'adminDashboard' ? 'no-hover' : '' }}"
                            href="{{ route('adminDashboard') }}">Home
                        </a>
                    </li>
                @endhasrole
                @if (Auth::guest() || Auth::user()->hasRole('user|employee'))
                    <!-- Dashboard/Landing Page for users that are not admin -->
                    <li class="nav-item p-2 ">
                        <a class="nav-link custom-text-color link-to-click {{ $currentRoute == 'dashboard' ? 'disabled-link' : '' }} {{ $currentRoute == 'dashboard' ? 'no-hover' : '' }}"
                            href="{{ route('dashboard') }}">Home</a>
                    </li>
                @endif
                <li class="nav-item p-2">
                    <a class="nav-link custom-text-color link-to-click {{ $currentRoute == 'aboutUS' ? 'disabled-link' : '' }} {{ $currentRoute == 'aboutUS' ? 'no-hover' : '' }}"
                        href="{{ route('aboutUS') }}">About</a>
                </li>
                <li class="nav-item p-2 dropdown">
                    <a class="nav-link dropdown-toggle custom-text-color" href="#" id="navbarDropdownMenuLink"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">Offers</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li>
                            <a class="dropdown-item text-black link-to-click {{ $currentRoute == 'products' ? 'disabled-link' : '' }} {{ $currentRoute == 'products' ? 'no-hover' : '' }}"
                                href="{{ route('products') }}">Products
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-black link-to-click {{ $currentRoute == 'services' ? 'disabled-link' : '' }} {{ $currentRoute == 'services' ? 'no-hover' : '' }}"
                                href="{{ route('services') }}">
                                Services
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item p-2">
                    <a class="nav-link custom-text-color link-to-click {{ $currentRoute == 'team' ? 'disabled-link' : '' }} {{ $currentRoute == 'team' ? 'no-hover' : '' }}"
                        href="{{ route('team') }}">
                        Team
                    </a>
                </li>
                <li class="nav-item p-2">
                    <a class="nav-link custom-text-color link-to-click {{ $currentRoute == 'reviews' ? 'disabled-link' : '' }} {{ $currentRoute == 'reviews' ? 'no-hover' : '' }}"
                        href="{{ route('reviews') }}">
                        Reviews
                    </a>
                </li>
                @if (Auth::check())
                    @hasrole('admin')
                        <li class="nav-item  p-2 px-2 dropdown">
                            <a class="nav-link dropdown-toggle custom-text-color" href="#" id="navbarDropdownMenuLink"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">Admin</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li>
                                    <a class="dropdown-item text-black link-to-click {{ $currentRoute == 'admin.products' ? 'disabled-link' : '' }} {{ $currentRoute == 'admin.products' ? 'no-hover' : '' }}"
                                        href="{{ route('admin.products') }}">
                                        Products
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-black link-to-click {{ $currentRoute == 'admin.services' ? 'disabled-link' : '' }} {{ $currentRoute == 'admin.services' ? 'no-hover' : '' }}"
                                        href="{{ route('admin.services') }}">
                                        Services
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-black link-to-click {{ $currentRoute == 'admin.users' ? 'disabled-link' : '' }} {{ $currentRoute == 'admin.users' ? 'no-hover' : '' }}"
                                        href="{{ route('admin.users') }}">
                                        Users
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-black link-to-click {{ $currentRoute == 'admin.aboutus' ? 'disabled-link' : '' }} {{ $currentRoute == 'admin.aboutus' ? 'no-hover' : '' }}"
                                        href="{{ route('admin.aboutus') }}">
                                        About Us
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-black link-to-click {{ $currentRoute == 'admin.reviews' ? 'disabled-link' : '' }} {{ $currentRoute == 'admin.reviews' ? 'no-hover' : '' }}"
                                        href="{{ route('admin.reviews') }}">
                                        Reviews
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endhasrole
                    <li class="nav-item p-2 dropdown">
                        <a href="#" class="nav-link" id="notification-drop" data-bs-toggle="dropdown">
                            <svg width="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path class="bell"
                                    d="M19.7695 11.6453C19.039 10.7923 18.7071 10.0531 18.7071 8.79716V8.37013C18.7071 6.73354 18.3304 5.67907 17.5115 4.62459C16.2493 2.98699 14.1244 2 12.0442 2H11.9558C9.91935 2 7.86106 2.94167 6.577 4.5128C5.71333 5.58842 5.29293 6.68822 5.29293 8.37013V8.79716C5.29293 10.0531 4.98284 10.7923 4.23049 11.6453C3.67691 12.2738 3.5 13.0815 3.5 13.9557C3.5 14.8309 3.78723 15.6598 4.36367 16.3336C5.11602 17.1413 6.17846 17.6569 7.26375 17.7466C8.83505 17.9258 10.4063 17.9933 12.0005 17.9933C13.5937 17.9933 15.165 17.8805 16.7372 17.7466C17.8215 17.6569 18.884 17.1413 19.6363 16.3336C20.2118 15.6598 20.5 14.8309 20.5 13.9557C20.5 13.0815 20.3231 12.2738 19.7695 11.6453Z"
                                    fill="#fff"></path>
                                <path opacity="0.4"
                                    d="M14.0088 19.2283C13.5088 19.1215 10.4627 19.1215 9.96275 19.2283C9.53539 19.327 9.07324 19.5566 9.07324 20.0602C9.09809 20.5406 9.37935 20.9646 9.76895 21.2335L9.76795 21.2345C10.2718 21.6273 10.8632 21.877 11.4824 21.9667C11.8123 22.012 12.1482 22.01 12.4901 21.9667C13.1083 21.877 13.6997 21.6273 14.2036 21.2345L14.2026 21.2335C14.5922 20.9646 14.8734 20.5406 14.8983 20.0602C14.8983 19.5566 14.4361 19.327 14.0088 19.2283Z"
                                    fill="#fff"></path>
                            </svg>
                            <span class="bg-light dots"></span>
                        </a>
                        <div class="sub-drop dropdown-menu dropdown-menu-end p-0 rounded-5 cus-width"
                            aria-labelledby="notification-drop">
                            <div class="card shadow-none m-0">
                                <div class="card-header d-flex justify-content-between bg-primary py-3">
                                    <div class="header-title">
                                        <h6 class="mb-0 text-white">Notifications</h6>
                                    </div>
                                </div>
                                <div class="card-body p-3 notification-container">
                                    @forelse (Auth::user()->notifications as $notification)
                                        <a href="{{ $notification->getUrl() }}" class="iq-sub-card">
                                            <div class="d-flex align-items-center">
                                                <img class="avatar-40 rounded-pill bg-soft-primary p-1"
                                                    src="{{ asset('images/shapes/01.png') }}" alt="">
                                                <div class="ms-3 w-100">
                                                    {{-- <h6 class="mb-0">{{ $notification->user->full_name }}</h6> --}}
                                                    <p class="mb-0">
                                                        {{ $notification->getNotificationContentWithoutLink() }}
                                                    </p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <!-- Additional notification details here -->
                                                        <small
                                                            class="float-right font-size-12">{{ $notification->created_at->diffForHumans() }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @empty
                                        <div class="text-center p-3">
                                            <p>No notifications found.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </li>
                    @hasrole('user')
                        <li class="nav-item p-2">
                            <a class="nav-link text-white link-to-click {{ $currentRoute == 'cart' ? 'disabled-link' : '' }} {{ $currentRoute == 'cart' ? 'no-hover' : '' }}" href="{{ route('cart') }}">
                                <svg class="icon-32" width="32" viewBox="0 0 28 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.91064 20.5886C5.91064 19.7486 6.59064 19.0686 7.43064 19.0686C8.26064 19.0686 8.94064 19.7486 8.94064 20.5886C8.94064 21.4186 8.26064 22.0986 7.43064 22.0986C6.59064 22.0986 5.91064 21.4186 5.91064 20.5886ZM17.1606 20.5886C17.1606 19.7486 17.8406 19.0686 18.6806 19.0686C19.5106 19.0686 20.1906 19.7486 20.1906 20.5886C20.1906 21.4186 19.5106 22.0986 18.6806 22.0986C17.8406 22.0986 17.1606 21.4186 17.1606 20.5886Z"
                                        fill="currentColor"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M20.1907 6.34909C20.8007 6.34909 21.2007 6.55909 21.6007 7.01909C22.0007 7.47909 22.0707 8.13909 21.9807 8.73809L21.0307 15.2981C20.8507 16.5591 19.7707 17.4881 18.5007 17.4881H7.59074C6.26074 17.4881 5.16074 16.4681 5.05074 15.1491L4.13074 4.24809L2.62074 3.98809C2.22074 3.91809 1.94074 3.52809 2.01074 3.12809C2.08074 2.71809 2.47074 2.44809 2.88074 2.50809L5.26574 2.86809C5.60574 2.92909 5.85574 3.20809 5.88574 3.54809L6.07574 5.78809C6.10574 6.10909 6.36574 6.34909 6.68574 6.34909H20.1907ZM14.1307 11.5481H16.9007C17.3207 11.5481 17.6507 11.2081 17.6507 10.7981C17.6507 10.3781 17.3207 10.0481 16.9007 10.0481H14.1307C13.7107 10.0481 13.3807 10.3781 13.3807 10.7981C13.3807 11.2081 13.7107 11.5481 14.1307 11.5481Z"
                                        fill="currentColor"></path>
                                </svg>
                            </a>
                        </li>              
                    @endhasrole

                    <li class="nav-item p-2 dropstart" style="right: 0;">
                        <a class="nav-link py-0 d-flex align-items-center" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ Auth::user()->profile_picture ? route('profile_picture', ['filename' => Auth::user()->profile_picture]) : asset('images/avatars/01.png') }}"
                                alt="User-Profile" class="theme-color-default-img avatar avatar-50 avatar-rounded">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @hasrole('admin|employee')
                                <li>
                                    <a href="{{ route('users.show', auth()->id()) }}"
                                        class="dropdown-item link-to-click {{ $currentRoute == 'users.show' ? 'disabled-link' : '' }} {{ $currentRoute == 'users.show' ? 'no-hover' : '' }}">
                                        Profile
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#profileModal">Profile
                                    </a>
                                </li>
                            @endhasrole
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}"
                                    onsubmit="showLoading('Logging out...');">
                                    @csrf
                                    <a href="javascript:void(0)" id="logout" class="dropdown-item"
                                        onclick="event.preventDefault(); this.closest('form').submit(); resetSession();">{{ __('Log out') }}</a>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="custom-spacing p-2">
                        <a class="btn btn-primary rounded-pill" href="#" data-bs-toggle="modal"
                            data-bs-target="#loginModal">Sign in</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<section class="login-content">
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content mt-5">
                <div class="modal-header ">
                    <div class="container text-center">
                        <h5 class="modal-title" id="loginModalLabel">Sign In</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('login') }}" data-toggle="validator"
                        onsubmit="showLoading('Signing in...')">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                                        class="form-control" placeholder="admin@example.com" required autofocus>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <input id="password" type="password" placeholder="********" name="password"
                                            required autocomplete="off" class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text toggle-password" id="togglePassword">
                                                <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" height="24"
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
                            <div class="col-lg-6" style="width: 50%;">
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="customCheck1">
                                    <label class="form-check-label" for="customCheck1">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-lg-6" style="float: right; cursor: pointer; right: 0; width: 50%;">
                                <a href="#" style="color: #215979; float: right; cursor: pointer; right: 0;"
                                    data-bs-toggle="modal" data-bs-target="#resetPasswordModal">Forgot Password?</a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary"
                                id="sign-in">{{ __('Sign In') }}</button>
                        </div>
                        <p class="text-center my-3">or sign in with other accounts?</p>
                        <div class="d-flex justify-content-center">
                            <ul class="list-group list-group-horizontal list-group-flush">
                                <li class="list-group-item border-0 pb-0">
                                    <a href="#"><img src="{{ asset('images/brands/fb.svg') }}"
                                            alt="fb"></a>
                                </li>
                                <li class="list-group-item border-0 pb-0">
                                    <a href="#"><img src="{{ asset('images/brands/gm.svg') }}"
                                            alt="gm"></a>
                                </li>
                                <li class="list-group-item border-0 pb-0">
                                    <a href="#"><img src="{{ asset('images/brands/im.svg') }}"
                                            alt="im"></a>
                                </li>
                                <li class="list-group-item border-0 pb-0">
                                    <a href="#"><img src="{{ asset('images/brands/li.svg') }}"
                                            alt="li"></a>
                                </li>
                            </ul>
                        </div>
                        <p class="mt-3 text-center">
                            Don't have an account? <a href="#" data-bs-toggle="modal"
                                data-bs-target="#signupModal" class="text-underline" style="color: #215979">Click
                                here to sign up.</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Sign Up Modal -->
    <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signupModalLabel">Sign Up</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('register') }}" data-toggle="validator"
                        onsubmit="showLoading('Signing up...')">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input id="first_name" type="text" name="first_name"
                                        value="{{ old('first_name') }}" class="form-control"
                                        placeholder="First Name" required autofocus>
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
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input id="signup_email" type="email" name="email"
                                        value="{{ env('IS_DEMO') ? 'admin@example.com' : old('email') }}"
                                        class="form-control" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input id="phone_number" type="text" name="phone_number"
                                        value="{{ old('phone_number') }}" class="form-control"
                                        placeholder="Phone Number" maxlength="11" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <input id="signup-password" type="password" placeholder="********"
                                            name="password" required autocomplete="off" class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text toggle-password" id="signupTogglePassword">
                                                <svg id="signupEyeIcon" xmlns="http://www.w3.org/2000/svg"
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
                                        <input id="password_confirmation" type="password" placeholder="********"
                                            name="password_confirmation" required autocomplete="off"
                                            class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text toggle-password"
                                                id="signupTogglePasswordConfirmation">
                                                <svg id="signupEyeIconConfirmation" xmlns="http://www.w3.org/2000/svg"
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
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">{{ __('Sign Up') }}</button>
                        </div>
                        <p class="mt-3 text-center">
                            Already have an account? <a href="#" data-bs-toggle="modal"
                                data-bs-target="#loginModal" class="text-underline" style="color: #215979">Click here
                                to sign in.</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


@if (Auth::check())
    <!-- Profile Modal -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <h5 class="card-title">Profile Information</h5>
                        <div class="card mb-3">
                            <div class="card-body">
                                <form method="POST" action="{{ route('users.update') }}" data-toggle="validator"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="card-text">Name: {{ auth()->user()->full_name }}</p>
                                            <p class="card-text">Email: {{ auth()->user()->email }}</p>
                                            <p class="card-text">Phone: {{ auth()->user()->phone_number }}</p>
                                            <div class="form-group">
                                                <label for="password">New Password</label>
                                                <div class="input-group">
                                                    <input id="user_password" type="password" placeholder="********"
                                                        name="password" autocomplete="off" class="form-control">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text toggle-password"
                                                            id="togglePasswordUser">
                                                            <svg id="eyeIconUser" xmlns="http://www.w3.org/2000/svg"
                                                                height="24" viewBox="0 -960 960 960"
                                                                width="24">
                                                                <path
                                                                    d="M25.8,13.4c-5.8-7.3-14-12.5-23.2-12.5c-11.6,0-21,9.4-21,21s9.4,21,21,21c9.3,0,17.4-5.2,23.2-12.5 c0.6-0.8,0.6-2.1,0-2.9L25.8,13.4z M11.9,24c0-2.3,1.9-4.1,4.1-4.1s4.1,1.9,4.1,4.1s-1.9,4.1-4.1,4.1C13.8,28.1,11.9,26.3,11.9,24z M8,24 c0-3.7,3-6.8,6.8-6.8c3.7,0,6.8,3,6.8,6.8c0,3.7-3,6.8-6.8,6.8C11,30.8,8,27.7,8,24z" />
                                                                <circle cx="24" cy="24" r="2" />
                                                            </svg>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" id="save-changes" class="btn btn-primary">Save
                                                Changes</button>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group text-center">
                                                <label for="profile_picture" class="d-block cursor-pointer"
                                                    style="cursor: pointer;">
                                                    <input type="file" id="profile_picture" name="profile_picture"
                                                        accept="image/*" style="display: none;"
                                                        onchange="checkImageCount(); previewProfile(event);">
                                                    <img id="profile_picture_preview"
                                                        src="{{ Auth::user()->profile_picture ? route('profile_picture', ['filename' => Auth::user()->profile_picture]) : asset('images/avatars/01.png') }}"
                                                        alt="User-Profile"
                                                        class="theme-color-default-img avatar avatar-50 avatar-rounded">
                                                </label>
                                                <span>Tap to change</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="overlayUser" style="display: none;">
                                        <div id="croppingContainerUser">
                                            <div id="croppingViewUser">
                                                <img id="image-user">
                                            </div>
                                            <br>
                                            <center>
                                                <button id="cropBtnUser" type="button"
                                                    class="btn btn-primary">Crop</button>
                                                <button id="cancelBtnUser" type="button"
                                                    class="btn btn-secondary">Cancel</button>
                                            </center>
                                        </div>
                                    </div>
                                    <input type="hidden" id="cropped_image_user" name="cropped_image_user">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


{{-- Forgot Password Modal --}}
<div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetPasswordModalLabel">Reset Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Enter your email address and we'll send you an email with instructions to reset your password.</p>
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form action="{{ route('password.email') }}" method="POST"
                    onsubmit="showLoading('Resetting password...')">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="floating-label form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    aria-describedby="email" placeholder="abc@email.com">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Reset') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"
    integrity="sha512-9KkIqdfN7ipEW6B6k+Aq20PV31bjODg4AA52W+tYtAE0jE0kMx49bjJ3FgvS56wzmyfMUHbQ4Km2b7l9+Y/+Eg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var cropperUser;

    function previewProfile(event) {
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
                    document.getElementById('image-user').src = imageData;

                    if (cropperUser) {
                        $("#profile_picture").val('');
                        cropperUser.destroy();
                    }
                    var image = document.getElementById('image-user');
                    cropperUser = new Cropper(image, {
                        aspectRatio: 1 / 1,
                        viewMode: 3,
                        movable: true,
                        zoomable: false,
                        rotatable: false,
                        scalable: false,
                        dragMode: 'none',
                    });

                    document.getElementById('overlayUser').style.display = 'block';

                    document.getElementById('cropBtnUser').addEventListener('click', function() {
                        if (cropperUser) {
                            var croppedImage = cropperUser.getCroppedCanvas().toDataURL("image/png");

                            document.getElementById('profile_picture_preview').src = croppedImage;
                            document.getElementById('cropped_image_user').value = croppedImage;
                            document.getElementById('overlayUser').style.display = 'none';
                        } else {
                            console.error('Cropper object is not initialized');
                        }
                    });

                    document.getElementById('cancelBtnUser').addEventListener('click', function() {
                        if (cropperUser) {
                            cropperUser.destroy();
                        }
                        document.getElementById('overlayUser').style.display = 'none';
                        $('input[type="file"]').val('');
                    });
                }
                img.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function() {
        var loginModal = new bootstrap.Modal($('#loginModal')[0]);

        $('#signInLink').click(function(event) {
            event.preventDefault();
            loginModal.show();
        });

        $('.dropdown-item[href="{{ route('admin.products') }}"]').click(function(event) {
            if ({{ auth()->guest() ? 'true' : 'false' }}) {
                event.preventDefault();
                loginModal.show();
            }
        });

        $('.dropdown-item[href="{{ route('admin.services') }}"]').click(function(event) {
            if ({{ auth()->guest() ? 'true' : 'false' }}) {
                event.preventDefault();
                loginModal.show();
            }
        });
    });

    $(document).on('click', '#sign-in', function() {
        Swal.fire({
            title: "Logging in...",
            text: "Please wait.",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading();
            }
        });
    });

    $(document).on('click', '#logout', function() {
        Swal.fire({
            title: "Logging out...",
            text: "Please wait.",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading();
            }
        });
    });

    $(document).on('click', '#save-changes', function() {
        Swal.fire({
            title: "Saving your changes...",
            text: "Please wait.",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading();
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");
        const eyeIcon = document.querySelector("#eyeIcon");

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
        const togglePassword = document.querySelector("#signupTogglePassword");
        const password = document.querySelector("#signup-password");
        const eyeIcon = document.querySelector("#signupEyeIcon");

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
        const togglePassword = document.querySelector("#signupTogglePasswordConfirmation");
        const password = document.querySelector("#password_confirmation");
        const eyeIcon = document.querySelector("#signupEyeIconConfirmation");

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


    if ({{ auth()->guest() ? 'false' : 'true' }}) {
        document.addEventListener("DOMContentLoaded", function() {
            const togglePassword = document.querySelector("#togglePasswordUser");
            const password = document.querySelector("#user_password");
            const eyeIcon = document.querySelector("#eyeIconUser");

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
    }



    document.getElementById('phone_number').addEventListener('input', function(event) {
        let inputValue = event.target.value;
        let numericValue = inputValue.replace(/\D/g, '');
        event.target.value = numericValue;
    });

    document.addEventListener('click', function(event) {
        const target = event.target.closest('.link-to-click');
        if (target && !target.classList.contains('disabled-link')) {
            showLoading('Loading...');
        } else if (target && target.classList.contains('disabled-link')) {
            event.preventDefault();
        }
    });

    function checkImageCount() {
        var input = document.getElementById('profile_picture');
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
    document.querySelector('.navbar-toggler').addEventListener('click', function() {
        document.querySelector('.icon-32').classList.add('spin-animation');
        setTimeout(function() {
            document.querySelector('.icon-32').classList.remove('spin-animation');
        }, 1000); // Duration of the animation
    });
    document.querySelector('.icon-32').addEventListener('click', function() {
        var navbarCollapse = document.querySelector('.navbar-collapse');
        navbarCollapse.classList.toggle('navbar-collapse-animation');
    });

    document.getElementById('notification-drop').addEventListener('click', function() {
        var bell = document.querySelector('.bell');

        bell.classList.toggle('active');
    });

    window.onload = function(event) {
        Swal.close();
    };

    window.addEventListener('pagehide', function(event) {
        Swal.close();
    });
</script>
