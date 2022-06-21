<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style layout-menu-fixed " dir="ltr"
    data-theme="theme-default" data-assets-path="{{ asset('') }}public/template/assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta content="{{ config('app.name') }}" name="description">
    <meta content="{{ config('app.name') }}" name="keywords">

    @hasSection('title')
        <title>@yield('title')&nbsp;|&nbsp;{{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif

    <!-- Canonical SEO -->
    <link rel="canonical" href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('') }}public/template/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('') }}public/template/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('') }}public/template/assets/vendor/css/core.css"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('') }}public/template/assets/vendor/css/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('') }}public/template/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet"
        href="{{ asset('') }}public/template/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="{{ asset('') }}public/template/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- DataTable Bootstrap 5 -->
    <link rel="stylesheet" href="{{ asset('') }}public/assets/vendors/dataTables/dataTables.bootstrap5.min.css" />

    <!-- Select2 Bootstrap 5 -->
    <link rel="stylesheet" href="{{ asset('') }}public/assets/vendors/select2/select2.min.css" />
    <link rel="stylesheet" href="{{ asset('') }}public/assets/vendors/select2/select2-bootstrap.min.css" />

    <!-- Sweetalert -->
    <link rel="stylesheet" href="{{ asset('') }}public/assets/vendors/sweetalert/dist/sweetalert2.css" />

    <!-- Helpers -->
    <script src="{{ asset('') }}public/template/assets/vendor/js/helpers.js"></script>
    <script src="{{ asset('') }}public/template/assets/js/config.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async="async" src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'GA_MEASUREMENT_ID');
    </script>

    @stack('css')
</head>

<body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  ">
        <div class="layout-container">

            <!-- Menu -->
            @include('layouts.app.menu')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">

                <!-- Navbar -->
                @include('layouts.app.navbar')
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    @yield('content')
                    <!-- / Content -->

                    <!-- Footer -->
                    @include('layouts.app.footer')
                    <!-- / Footer -->


                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('') }}public/template/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('') }}public/template/assets/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('') }}public/template/assets/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('') }}public/template/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="{{ asset('') }}public/template/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('') }}public/template/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="{{ asset('') }}public/template/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="{{ asset('') }}public/template/assets/js/dashboards-analytics.js"></script>

    <!-- Page JS -->
    <script src="{{ asset('') }}public/assets/vendors/jQuery/jquery-3.5.1.js"></script>
    <script src="{{ asset('') }}public/assets/vendors/dataTables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('') }}public/assets/vendors/dataTables/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('') }}public/assets/vendors/select2/select2.min.js"></script>
    <script src="{{ asset('') }}public/assets/vendors/sweetalert/dist/sweetalert2.js"></script>
    <script src="{{ asset('') }}public/assets/vendors/chartjs/chart.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    @stack('js')

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

</body>

</html>
