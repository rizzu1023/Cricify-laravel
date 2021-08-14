<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
          content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
          content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{asset('assets/Admin/images/favicon.png')}}" type="image/x-icon">
    <title>Cricify</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
          rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/Admin/css/fontawesome.css')}}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/Admin/css/vendors/icofont.css')}}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/Admin/css/vendors/themify.css')}}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/Admin/css/vendors/flag-icon.css')}}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/Admin/css/vendors/feather-icon.css')}}">
    <!-- Plugins css start-->
{{--    <link rel="stylesheet" type="text/css" href="{{asset('assets/Admin/css/vendors/prism.css')}}">--}}
    <!-- Plugins css Ends-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/Admin/css/vendors/todo.css')}}">
    <!-- Bootstrap css-->

    <link rel="stylesheet" type="text/css" href="{{asset('assets/Admin/css/vendors/select2.css')}}">

{{--    <link rel="stylesheet" type="text/css" href="{{asset('assets/Admin/css/vendors/datatables.css')}}">--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('assets/Admin/css/vendors/owlcarousel.css')}}">--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('assets/Admin/css/vendors/rating.css')}}">--}}


    <!-- Bootstrap css-->
{{--    <link rel="stylesheet" type="text/css" href="{{asset('assets/Admin/css/vendors/chartist.css')}}">--}}
    <link rel="stylesheet" type="text/css"  href="{{asset('assets/Admin/css/vendors/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/Admin/css/vendors/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/Admin/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{asset('assets/Admin/css/color-1.css')}}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/Admin/css/responsive.css')}}">
    @yield('css')
</head>



<body>
<div class="tap-top"><i data-feather="chevrons-up"></i></div>
<div class="page-wrapper compact-wrapper" id="pageWrapper">

    <div class="page-body-wrapper horizontal-menu">


        @include('Admin.layouts.sidebar')
        @include('Admin.layouts.navbar')
        @yield('content')
{{--        @include('Admin.layouts.footer')--}}


        <script src="{{asset('assets/Admin/js/jquery-3.5.1.min.js')}}"></script>
        <!-- Bootstrap js-->
        <script src="{{asset('assets/Admin/js/bootstrap/popper.min.js')}}"></script>
        <script src="{{asset('assets/Admin/js/bootstrap/bootstrap.js')}}"></script>
        <!-- feather icon js-->
        <script src="{{asset('assets/Admin/js/icons/feather-icon/feather.min.js')}}"></script>
        <script src="{{asset('assets/Admin/js/icons/feather-icon/feather-icon.js')}}"></script>
        <!-- Sidebar jquery-->
        <script src="{{asset('assets/Admin/js/sidebar-menu.js')}}"></script>
        <script src="{{asset('assets/Admin/js/config.js')}}"></script>
        <!-- Plugins JS start-->
        <script src="{{asset('assets/Admin/js/prism/prism.min.js')}}"></script>
        <script src="{{asset('assets/Admin/js/clipboard/clipboard.min.js')}}"></script>
        <script src="{{asset('assets/Admin/js/custom-card/custom-card.js')}}"></script>
        <script src="{{asset('assets/Admin/js/modal-animated.js')}}"></script>
        <script src="{{asset('assets/Admin/js/animation/animate-custom.js')}}"></script>
        <script src="{{asset('assets/Admin/js/tooltip-init.js')}}"></script>
        <script src="{{asset('assets/Admin/js/todo/todo.js')}}"></script>

{{--        <script src="{{asset('assets/Admin/js/chart/chartist/chartistjs')}}"></script>--}}
{{--        <script src="{{asset('assets/Admin/js/chart/chartist/chartist-plugin-tooltipjs')}}"></script>--}}
        <!-- Plugins JS Ends-->

{{--        <script src="{{asset('assets/Admin/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>--}}
        {{--        <script src="{{asset('assets/Admin/js/datatable/datatables/datatable.custom.js')}}"></script>--}}
        {{--        <script src="{{asset('assets/Admin/js/rating/jquery.barrating.js')}}"></script>--}}
{{--        <script src="{{asset('assets/Admin/rating/rating-script.js')}}"></script>--}}
        {{--        <script src="{{asset('assets/Admin/js/owlcarousel/owl.carousel.js')}}"></script>--}}
        {{--        <script src="{{asset('assets/Admin/js/ecommerce.js')}}"></script>--}}
{{--        <script src="{{asset('assets/Admin/js/product-list-custom.js')}}"></script>--}}

        <script src="{{asset('assets/Admin/js/notify/bootstrap-notify.min.js')}}"></script>

        <script src="{{asset('assets/Admin/js/select2/select2.full.min.js')}}"></script>
        <script src="{{asset('assets/Admin/js/select2/select2-custom.js')}}"></script>
{{--        <script src="{{asset('assets/Admin/js/chart/apex-chart/apex-chartjs')}}"></script>--}}
{{--        <script src="{{asset('assets/Admin/js/chart/apex-chart/stock-pricesjs')}}"></script>--}}
{{--        <script src="{{asset('assets/Admin/js/prism/prism.minjs')}}"></script>--}}
{{--        <script src="{{asset('assets/Admin/js/counter/jquery.waypoints.minjs')}}"></script>--}}
{{--        <script src="{{asset('assets/Admin/js/counter/jquery.counterup.minjs')}}"></script>--}}
{{--        <script src="{{asset('assets/Admin/js/counter/counter-customjs')}}"></script>--}}
{{--        <script src="{{asset('assets/Admin/js/custom-card/custom-cardjs')}}"></script>--}}
{{--        <script src="{{asset('assets/Admin/js/owlcarousel/owl.carouseljs')}}"></script>--}}
{{--        <script src="{{asset('assets/Admin/js/dashboard/dashboard_2js')}}"></script>--}}

        <script src="{{asset('assets/Admin/js/contacts/custom.js')}}"></script>

        <!-- Theme js-->


        <script src="{{asset('assets/Admin/js/script.js')}}"></script>
        {{--        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.minjs')}}"></script>--}}

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <script src="{{asset('assets/Admin/js/animation/wow/wow.min.js')}}"> </script>

        <script>
            $('.refresh').on('click',function(){
                window.location.reload(true);
            });
        </script>
@yield('js')

</body>

</html>
