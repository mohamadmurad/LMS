<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- CSS here -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/slicknav.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/progressbar_barfiller.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/gijgo.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/animated-headline.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/front.css')}}">

    <link rel="stylesheet" href="{{ asset('assets/css/toastr.css') }}">

</head>
<body>

@include('frontend.header')
<main>
    {{ $slot }}
</main>

@include('frontend.footer')


<!--   Core JS Files   -->
<script src=" {{asset('assets/js/jquery.min.js')}}"></script>
<script src=" {{asset('assets/js/fancybox.umd.js')}}"></script>
<script src=" {{asset('assets/js/core/popper.min.js')}}"></script>
<script src=" {{asset('assets/js/toastr.js')}}"></script>
<!-- JS here -->
<script src="{{asset('assets/front/js/vendor/modernizr-3.5.0.min.js')}}"></script>
<!-- Jquery, Popper, Bootstrap -->
<script src="{{asset('assets/front/js/vendor/jquery-1.12.4.min.js')}}"></script>
<script src="{{asset('assets/front/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
<!-- Jquery Mobile Menu -->
<script src="{{asset('assets/front/js/jquery.slicknav.min.js')}}"></script>

<!-- Jquery Slick , Owl-Carousel Plugins -->
<script src="{{asset('assets/front/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/front/js/slick.min.js')}}"></script>
<!-- One Page, Animated-HeadLin -->
<script src="{{asset('assets/front/js/wow.min.js')}}"></script>
<script src="{{asset('assets/front/js/animated.headline.js')}}"></script>
<script src="{{asset('assets/front/js/jquery.magnific-popup.js')}}"></script>

<!-- Date Picker -->
<script src="{{asset('assets/front/js/gijgo.min.js')}}"></script>
<!-- Nice-select, sticky -->
<script src="{{asset('assets/front/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('assets/front/js/jquery.sticky.js')}}"></script>
<!-- Progress -->
<script src="{{asset('assets/front/js/jquery.barfiller.js')}}"></script>

<!-- counter , waypoint,Hover Direction -->
<script src="{{asset('assets/front/js/jquery.counterup.min.js')}}"></script>
<script src="{{asset('assets/front/js/waypoints.min.js')}}"></script>
<script src="{{asset('assets/front/js/jquery.countdown.min.js')}}"></script>
<script src="{{asset('assets/front/js/hover-direction-snake.min.js')}}"></script>

<!-- contact js -->
<script src="{{asset('assets/front/js/contact.js')}}"></script>
<script src="{{asset('assets/front/js/jquery.form.js')}}"></script>
<script src="{{asset('assets/front/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/front/js/mail-script.js')}}"></script>
<script src="{{asset('assets/front/js/jquery.ajaxchimp.min.js')}}"></script>

<!-- Jquery Plugins, main Jquery -->
<script src="{{asset('assets/front/js/plugins.js')}}"></script>
<script src="{{asset('assets/front/js/main.js')}}"></script>

<script>


    $(document).ready(function () {
        toastr.options.timeOut = 10000;
        @if (Session::has('error'))
        toastr.error('{{ Session::get('error') }}');
        @endif
        @if(Session::has('success'))
        toastr.success('{{ Session::get('success') }}');
        @endif
        @if(Session::has('info'))
        toastr.info('{{ Session::get('info') }}');
        @endif

        @if(Session::has('points'))
        @foreach(Session::get('points') as $p)
        toastr.info('{{ $p }}');
        @endforeach

        @endif
    });

</script>
@yield('scripts')
</body>
</html>
