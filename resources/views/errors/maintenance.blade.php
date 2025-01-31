<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('images/64x64.png') }}" rel="icon">
    <link href="{{ asset('images/180x180.png') }}" rel="apple-touch-icon">
    <link rel="shortcut icon" href="{{asset('images/64x64.png')}}" />

    <link rel="stylesheet" href="{{asset('css/hope-ui.css')}}">
    <link rel="stylesheet" href="{{asset('css/customizer.css')}}">

</head>
<div class="container-fluid p-0">
    <div class="iq-maintenance text-center"> 
        <img src="{{asset('images/error/01.png')}}" class="img-fluid mb-4" alt="">            
        <div class="maintenance-bottom text-white pb-0">
            <div class="bg-primary" style="background: transparent; height: 320px;">
                <div class="gradient-bottom">
                    <div class="bottom-text general-zindex">
                        <h1 class="mb-2 text-white">Hang on! We are under maintenance</h1>
                        <p>We will be back in</p>
                        <ul id="countdown" class="countdown d-flex justify-content-center align-items-center list-inline">
                            <li>
                                <span id="days"></span> Days
                            </li>
                            <li>
                                <span id="hours"></span> Hours
                            </li>
                            <li>
                                <span id="minutes"></span> Minutes
                            </li>
                            <li>
                                <span id="seconds"></span> Seconds
                            </li>
                        </ul>
                    </div>
                    <div class="c xl-circle">
                        <div class="c lg-circle">
                            <div class="c md-circle">
                            <div class="c sm-circle">
                                <div class="c xs-circle"></div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>            
    </div>
</div>

<script>
    var targetDate = new Date('April 11, 2024 09:00:00').getTime();

    var x = setInterval(function() {

        var now = new Date().getTime();

        var distance = targetDate - now;

        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("days").innerHTML = days;
        document.getElementById("hours").innerHTML = hours;
        document.getElementById("minutes").innerHTML = minutes;
        document.getElementById("seconds").innerHTML = seconds;

        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "EXPIRED";
        }
    }, 1000);
</script>
