<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta content="Your Swift Computer Repair Service" name="description">
<meta content="" name="keywords">
<meta property="og:title" content="{{ env('APP_NAME') }}">
<meta property="og:description" content="Your Swift Computer Repair Service">
<meta property="og:image" content="{{ asset('images/180x180.png') }}">
<meta property="og:url" content="http://quickiefixtech.online">
<meta property="og:type" content="website">
<meta property="og:locale" content="en_US">

<!-- Favicons -->
<link href="{{ asset('images/64x64.png') }}" rel="icon">
<link href="{{ asset('images/180x180.png') }}" rel="apple-touch-icon">
<link rel="shortcut icon" href="{{asset('images/64x64.png')}}" />

<link rel="stylesheet" href="{{asset('css/animate.css')}}">
<link rel="stylesheet" href="{{asset('css/libs.min.css')}}">
<link rel="stylesheet" href="{{asset('css/hope-ui.css')}}">
<link rel="stylesheet" href="{{asset('css/custom.css')}}">
<link rel="stylesheet" href="{{asset('css/dark.css')}}">
<link rel="stylesheet" href="{{asset('css/rtl.css')}}">
<link rel="stylesheet" href="{{asset('css/customizer.css')}}">

<!-- Fullcalender CSS -->
<link rel='stylesheet' href="{{asset('vendor/fullcalendar/core/main.css')}}" />
<link rel='stylesheet' href="{{asset('vendor/fullcalendar/daygrid/main.css')}}" />
<link rel='stylesheet' href="{{asset('vendor/fullcalendar/timegrid/main.css')}}" />
<link rel='stylesheet' href="{{asset('vendor/fullcalendar/list/main.css')}}" />
<link rel="stylesheet" href="{{asset('vendor/Leaflet/leaflet.css')}}" />
<link rel="stylesheet" href="{{asset('vendor/vanillajs-datepicker/dist/css/datepicker.min.css')}}" />

<link rel="stylesheet" href="{{asset('vendor/aos/dist/aos.css')}}" />

<style>
    th.hide-search input{
       display: none;
    }
 </style>
