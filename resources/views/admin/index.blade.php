<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<head>
    <meta charset="utf-8"/>
    <title>Admin | Dashboard</title>
    <meta name="description" content="Updates and statistics">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/pages/login/login-4.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/skins/header/base/light.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/skins/header/menu/light.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/skins/brand/dark.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/skins/aside/dark.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/skins/aside/raw-custom.css')}}" rel="stylesheet" type="text/css"/>

</head>
<body
    class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
<div id="app">
    <app-admin-home></app-admin-home>
</div>


<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('assets/js/raw-script.js')}}"></script>

<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/scripts.bundle.js')}}" type="text/javascript"></script>
<!--end::Global Theme Bundle -->

<!--begin::Page Vendors(used by this page) -->
<script src="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}" type="text/javascript"></script>
<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->
<script src="{{asset('assets/js/pages/dashboard.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/pages/custom/login/login-general.js')}}" type="text/javascript"></script>
<!--end::Page Scripts -->

</body>

</html>
