<!DOCTYPE html>
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Styles -->
{{--    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('assets/css/nucleo-svg.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('assets/css/fancybox.css') }}">
{{--    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/argon-dashboard.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @livewireStyles
    @if(auth()->check())
        @php
            if(session('seen_notifications')==null)
                session(['seen_notifications'=>0]);
            $notifications=auth()->user()->notifications()->orderBy('created_at','DESC')->limit(50)->get();
            $unreadNotifications=auth()->user()->unreadNotifications()->count();
        @endphp
    @endif
</head>
<body class="g-sidenav-show   bg-gray-100">
<div class="min-height-300 bg-primary position-absolute w-100"></div>
@if(\Illuminate\Support\Facades\Auth::user()->hasRole('student'))
@else
    @include('layouts.aside')
@endif


<!-- Page Content -->
<main class="main-content position-relative border-radius-lg ">
    @include('layouts.nav')
    <div class="container-fluid py-4">

        {{ $slot }}


    </div>


</main>

<!--   Core JS Files   -->
<script src=" {{asset('assets/js/jquery.min.js')}}"></script>
<script src=" {{asset('assets/js/fancybox.umd.js')}}"></script>
<script src=" {{asset('assets/js/core/popper.min.js')}}"></script>
<script src=" {{asset('assets/js/core/bootstrap.min.js')}}"></script>
<script src=" {{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
<script src=" {{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
<script src=" {{asset('assets/js/plugins/chartjs.min.js')}}"></script>
<script src=" {{asset('assets/js/sweetalert2@11.js')}}"></script>
<script src=" {{asset('assets/js/moment.min.js')}}"></script>
<script src=" {{asset('assets/js/daterangepicker.js')}}"></script>
<script src=" {{asset('assets/js/toastr.js')}}"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset('assets/js/argon-dashboard.min.js?v=2.0.1')}}"></script>
{{--<script src="{{asset('js/index.bundle.min.js')}}"></script>--}}
@include('layouts.scripts')


<script>
    let birthdate = $('input[data-date="dirthdate"]');
    birthdate.daterangepicker({

        autoUpdateInput: false,
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        maxYear: parseInt(moment().format('YYYY'), 10)
    });
    birthdate.on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY'));
    });

    birthdate.on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });

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
    });



</script>


@yield('scripts')



@livewireScripts

</body>
</html>
