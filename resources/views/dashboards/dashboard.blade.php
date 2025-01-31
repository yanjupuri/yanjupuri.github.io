<x-app-layout :assets="$assets ?? []">
    <script>
        @auth
            @if(auth()->user()->hasRole('admin'))
                window.location = "{{ route('adminDashboard') }}";
            @endif
        @endauth
        window.onload = function(event) {
            Swal.close();
        };

        window.addEventListener('pagehide', function(event) {
            Swal.close();
        });
    </script>
    
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <section id="hero" class="d-flex justify-cntent-center align-items-center" style="min-height: calc(100vh - 72px);">
        <div id="heroCarousel" class="container carousel carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

            <!-- Slide 1 -->
            <div class="carousel-item active">
                <div class="carousel-container">
                    <h2 class="animate__animated animate__fadeInDown">Welcome to <span
                            class="lexend-font-style">{{ env('APP_NAME') }}</span></h2>
                    <p class="animate__animated animate__fadeInUp">{{ env('APP_NAME') }} is your reliable partner for
                        swift and efficient computer repair solutions. With a team of experienced technicians, we're
                        committed to providing top-notch service tailored to your needs. Our dedication to excellence,
                        transparent pricing, and flexible service options make us the preferred choice for individuals
                        and businesses alike. Count on {{ env('APP_NAME') }} to resolve your computer issues promptly
                        and get you back on track.</p>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item">
                <div class="carousel-container">
                    <h2 class="animate__animated animate__fadeInDown">Efficient Tech Solutions</h2>
                    <p class="animate__animated animate__fadeInUp">Experience hassle-free tech support like never before
                        with {{ env('APP_NAME') }}. Whether it's troubleshooting software glitches or fixing hardware
                        issues, our expert technicians are here to provide efficient solutions tailored to your needs.
                        Say goodbye to frustrations and hello to smooth-running devices with {{ env('APP_NAME') }}!</p>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item">
                <div class="carousel-container">
                    <h2 class="animate__animated animate__fadeInDown">Transparent Pricing</h2>
                    <p class="animate__animated animate__fadeInUp">{{ env('APP_NAME') }} believes in transparency. They
                        never surprise their customers with hidden fees or unexpected charges. With
                        {{ env('APP_NAME') }}, customers can trust that their pricing is clear and upfront, ensuring
                        peace of mind throughout the service process.</p>
                </div>
            </div>

            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bx bx-chevron-left" aria-hidden="true"></span>
            </a>

            <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bx bx-chevron-right" aria-hidden="true"></span>
            </a>

        </div>
    </section>
</x-app-layout>
<style>
    html,
    body {
        height: 100%;
        width: 100%;
        padding: 0;
        margin: 0;
        overflow-x: hidden;
    }

    @media (min-width: 989px) {
        .navbar-custom-color {
            background-color: transparent;
        }
    }
</style>
