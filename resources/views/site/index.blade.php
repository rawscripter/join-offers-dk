<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<head>
    <meta charset="utf-8"/>
    <title>Join Offers | Welcome to our shop</title>
    <meta name="description" content="Updates and statistics">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dosis&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/fontawesome.min.css')}}">
    {{--    <link rel="stylesheet" href="{{asset('frontend/assets/css/animate.min.css')}}">--}}
    <link rel="stylesheet" href="{{asset('frontend/assets/css/default.css')}}">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/responsive.css')}}">
</head>
<body>
<div id="app">
    <app-site-home></app-site-home>
</div>
</body>

<script src="{{asset('js/app.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
<script src="{{asset('frontend/assets/js/Popper.js')}}"></script>
<script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/wow.min.js')}}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{asset('frontend/assets/js/zoom-image.js')}}"></script>
<script src="{{asset('frontend/assets/js/product_view_main.js')}}"></script>
<script src="{{asset('frontend/assets/js/owl.carousel.js')}}"></script>
<script src="{{asset('frontend/assets/js/main.js')}}"></script>

<script src="{{asset('js/zoom.js')}}"></script>
<script src="https://test.checkout.dibspayment.eu/v1/checkout.js?v=1"></script>
<script !src="">
    new WOW().init();

</script>

</html>
