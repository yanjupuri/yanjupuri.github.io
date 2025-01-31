<x-app-layout :assets="$assets ?? []">
    <div class="mb-5 pb-5">
        <div class="title">
            <div class="container">
                <h3 class="mt-5 manrope-font-style font-weight-bold">ABOUT US!</h3>
            </div>
        </div>
        <div class="container d-flex justify-content-center mt-2 px-5">
            <div class="row">
                @isset($abouts)
                    @foreach ($abouts as $about)
                        <div class="col custom-col pt-5 pb-5 px-2">
                            {{-- <img class="img-fluid rounded" src="{{ asset('storage/about_images/' . $about->image) }}" alt="About Image"> --}}

                            <img src="{{ route('about_image', ['filename' => $about->image]) }}" class="img-fluid rounded" alt="About Image">
                        </div>

                        <div class="col pt-5 pb-5 px-2">
                            <h3 class="lexend-font-style">{{ $about->title }}</h3>
                            <p class="pt-3 pe-5 text-black" style="text-align: justify;">{{ $about->header }}</p>
                            <p class="text-black pt-4">
                                @php
                                    if (!empty($about->body) && is_string($about->body)) {
                                        $sentences = explode('.', $about->body);
                                    } else {
                                        $sentences = [];
                                    }
                                @endphp

                                @foreach ($sentences as $key => $sentence)
                                    @if (!empty($sentence) || $key !== count($sentences) - 1)
                                        <span class="px-2" style="text-align: justify;">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="18px"
                                                height="18px" viewBox="0 0 256 256" xml:space="preserve">
                                                <defs>
                                                </defs>
                                                <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;"
                                                    transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                                    <path d=" M 89.328 2.625 L 89.328 2.625 c -1.701 -2.859 -5.728 -3.151 -7.824
                                        -0.568 L 46.532 45.173 c -0.856 1.055 -2.483 0.997 -3.262 -0.115 l -8.382 -11.97 c -2.852 -4.073
                                        -8.789 -4.335 -11.989 -0.531 l 0 0 c -2.207 2.624 -2.374 6.403 -0.408 9.211 l 17.157 24.502 c 2.088
                                        2.982 6.507 2.977 8.588 -0.011 l 4.925 -7.07 L 89.135 7.813 C 90.214 6.272 90.289 4.242 89.328 2.625
                                        z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #70A9C7FF; fill-rule: nonzero; opacity: 1;"
                                                        transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                                    <path
                                                        d="M 45 90 C 20.187 90 0 69.813 0 45 C 0 20.187 20.187 0 45 0 c 6.072 0 11.967 1.19 17.518 3.538 c 2.034 0.861 2.986 3.208 2.125 5.242 c -0.859 2.035 -3.207 2.987 -5.242 2.126 C 54.842 8.978 49.996 8 45 8 C 24.598 8 8 24.598 8 45 c 0 20.402 16.598 37 37 37 c 20.402 0 37 -16.598 37 -37 c 0 -3.248 -0.42 -6.469 -1.249 -9.573 c -0.57 -2.134 0.698 -4.327 2.832 -4.897 c 2.133 -0.571 4.326 0.698 4.896 2.833 C 89.488 37.14 90 41.055 90 45 C 90 69.813 69.813 90 45 90 z"
                                                        style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #70A9C7FF; fill-rule: nonzero; opacity: 1;"
                                                        transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                                </g>
                                            </svg>
                                        </span>{{ $sentence }}<br>
                                    @endif
                                @endforeach
                            </p>

                            <p class="pt-5 pe-5 me-2 text-black" style="text-align: justify;">{{ $about->footer }}</p>
                        </div>
                    @endforeach
                @endisset
            </div>
        </div>
    </div>
    <div class="shadow-lg d-flex justify-content-center p-3" style="background: #F3F8F9FF;">
        <div class="row m-5 p-5 w-100">
            <div class="col text-center">
                <h1 class="lexend-font-style">{{ $clients ?? 1 }}</h1>
                <h6>Clients</h6>
            </div>
            <div class="col text-center">
                <h1 class="lexend-font-style">{{ $projects ?? 0 }}</h1>
                <h6>Projects</h6>
            </div>
            <div class="col text-center">
                <h1 class="lexend-font-style">{{ $resolvedIssues ?? 0 }}</h1>
                <h6>Resolved Issues</h6>
            </div>
            <div class="col text-center">
                <h1 class="lexend-font-style">{{ $count ?? 1 }}</h1>
                <h6>Website Visitors</h6>
            </div>
        </div>
    </div>

    <div class="container mt-5" style="padding-top: 5%;">
        <h3 class="manrope-font-style">
            CONTACT US!
        </h3>
    </div>
    <div class="m-5 card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm px-5 text-center">
                    <div class="mt-5 card shadow-lg p-3 mb-5 border">
                        <div class="card-body">
                            <img class="img-fluid"src="https://static.wixstatic.com/media/cf1565_5491e108400e49aeb28adcd503b9dd2d.png/v1/fill/w_128,h_128,al_c,q_85,enc_auto/cf1565_5491e108400e49aeb28adcd503b9dd2d.png"
                                style="height:60px; width:60px;">
                            <p class="pt-3 manrope-font-style details" style="font-size: 30px;">Our Address</p>
                            <p class="p-1 manrope-font-style details" style="font-size: 20px;">BLDG. 12 UNIT 07 Aplaya
                                Compound, Rio Hondo,
                                Zamboanga City, 7000,
                                Philippines</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-xxl-7 text-center">
                            <div class="card shadow-lg p-3 mb-5 border">
                                <div class="card-body">
                                    <img class="img-fluid"src="https://static.wixstatic.com/media/cf1565_e1cbd3ef9ad949a2bc2542dc9cc7aa5c.png/v1/fill/w_128,h_128,al_c,q_85,enc_auto/cf1565_e1cbd3ef9ad949a2bc2542dc9cc7aa5c.png"
                                        style="height:60px; width:60px;">
                                    <p class="pt-3 manrope-font-style details">Email Us</p>
                                    <p class="p-1 manrope-font-style details" style="font-size: small;">
                                        support@quickiefixtech.online<br>quickiefixtech@gmail.com
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-xxl-5 text-center">
                            <div class="card shadow-lg p-3 mb-5 border">
                                <div class="card-body">
                                    <img class="img-fluid"src="https://static.wixstatic.com/media/cf1565_352c2a208e344eae9a9d74a7a50a6d05.png/v1/fill/w_128,h_128,al_c,q_85,enc_auto/cf1565_352c2a208e344eae9a9d74a7a50a6d05.png"
                                        style="height:60px; width:60px;">
                                    <p class="pt-3 manrope-font-style details" >Call Us
                                    </p>
                                    <p class="p-1 manrope-font-style details" style="font-size: small;">+63 926 453
                                        9945<br>+63 926 453 9945
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm px-5">
                    <div class="mt-5 me-5 card shadow-lg p-3 mb-5 border">
                        <div class="card-body p-5">
                            <form class="row g-3" action="{{ route('send_mail') }}" method="POST"
                                onsubmit="showLoading('Sending message...')">
                                @csrf
                                <div class="col-md-6" style="height: 60px;">
                                    <input type="text" class="form-control border-secondary"
                                        placeholder="Juan Dela Cruz" style="height: 60px;" name="name" required>
                                </div>
                                <div class="col-md-6" style="height: 60px;">
                                    <input type="email" class="form-control border-secondary"
                                        placeholder="abc@email.com" style="height: 60px;" name="email" required>
                                </div>
                                <div class="col-md-12" style="height: 60px;">
                                    <input type="text" class="form-control border-secondary"
                                        placeholder="Troubleshooting" style="height: 60px;" name="subject" required>
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control border-secondary rounded" name="message" cols="80" rows="10"
                                        placeholder="I need help with my..."></textarea>
                                </div>
                                <div class="pt-5 container d-flex justify-content-center text-center">
                                    <button class="btn btn-primary btn-lg" type="submit">Send message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d587.3064541790555!2d122.08523416939191!3d6.898499908694952!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sen!2sph!4v1710696221194!5m2!1sen!2sph"
        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <script>
        window.onload = function(event) {
            Swal.close();
        };

        window.addEventListener('pagehide', function(event) {
            Swal.close();
        });
    </script>
</x-app-layout>
<style>
    h1 {
        color: #70A9C7FF;
    }

    .details {
        font-size: 18px;
    }

    @media (max-width: 1200px) {
        .custom-col {
            display: flex;
            justify-content: center;
        }

        .col {
            flex: initial !important;
            padding-top: 2rem;

        }

        /* .row {
            display: initial;
            width: 100%;
        } */

        .col-md-6 {
            width: 100%;
        }
    }

    @media (max-width: 1476px) {
        .custom-col {
            display: flex;
            justify-content: center;
        }

        .col {
            flex: initial !important;
            padding-top: 2rem;

        }

        .details {
            font-size: 15px !important;
        }

        .col-md-6 {
            width: 100%;
        }

        .me-5 {
            margin-right: 0 !important;
        }
    }

    @media (max-width: 667px) {
        .p-5 {
            padding: 0 !important;
            padding-top: 2rem;
        }

        .px-5 {
            padding-right: 0 !important;
            padding-left: 0 !important;
        }

        .card-body {}

        .pb-5 {
            padding-left: 2rem !important;
            padding-right: 2rem !important;
        }

        .details {
            font-size: 12px !important;
        }
    }
</style>
