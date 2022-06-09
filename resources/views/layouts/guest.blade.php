<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/nucleo-svg.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/argon-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="guest-body">

<main class="main-content  mt-0">
    <section>
        <div class="page-header min-vh-100">
            <div class="container">
                <div class="row justify-content-start">
                    <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column  mx-lg-0 mx-auto">
                        {{ $slot }}

                    </div>

                </div>
            </div>
        </div>
    </section>
</main>
<!--   Core JS Files   -->
<script src=" {{asset('assets/js/jquery.min.js')}}"></script>
<script src=" {{asset('assets/js/core/popper.min.js')}}"></script>
<script src=" {{asset('assets/js/core/bootstrap.min.js')}}"></script>
<script src=" {{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
<script src=" {{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
<script src=" {{asset('assets/js/plugins/chartjs.min.js')}}"></script>
<script src=" {{asset('assets/js/moment.min.js')}}"></script>
<script src=" {{asset('assets/js/daterangepicker.js')}}"></script>
<script src=" {{asset('assets/js/toastr.js')}}"></script>


<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset('assets/js/argon-dashboard.min.js?v=2.0.1')}}"></script>

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
    });

</script>

</body>
</html>
