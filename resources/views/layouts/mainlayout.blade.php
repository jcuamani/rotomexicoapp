<!DOCTYPE html>
@if (!Route::is(['layout-horizontal','layout-detached','layout-modern','layout-two-column','layout-hovered','layout-boxed','layout-rtl','layout-dark']))
<html lang="en">
@endif
@if (Route::is(['layout-horizontal']))
<html lang="en" data-layout="horizontal">
@endif
@if (Route::is(['layout-detached']))
<html lang="en" data-layout="detached">
@endif
@if (Route::is(['layout-modern']))
<html lang="en" data-layout="modern">
@endif
@if (Route::is(['layout-two-column']))
<html lang="en" data-layout="twocolumn">
@endif
@if (Route::is(['layout-hovered']))
<html lang="en" data-layout="layout-hovered">
@endif
@if (Route::is(['layout-boxed']))
<html lang="en" data-layout="default" data-width="box">
@endif
@if (Route::is(['layout-rtl']))
<html lang="en" data-layout-mode="light_mode">
@endif
@if (Route::is(['layout-dark']))
<html lang="en" data-theme="dark">
@endif
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Herrajes para puertas y ventanas | Roto Frank México">
    <meta name="keywords"
        content="">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Herrajes para puertas y ventanas | Roto Frank México</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('/build/img/roto-favicon-32x32.jpg')}}" sizes="32x32">
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('/build/img/roto-favicon-192x192.jpg')}}" sizes="192x192">
    <link rel="apple-touch-icon" type="image/x-icon" href="{{ URL::asset('/build/img/roto-favicon-180x180.jpg')}}" sizes="32x32">

    @include('layouts.partials.head')
</head>


@if (!Route::is(['under-maintenance', 'coming-soon', 'error-404', 'error-500','two-step-verification-3','two-step-verification-2','two-step-verification','email-verification-3','email-verification-2','email-verification','reset-password-3','reset-password-2','reset-password','forgot-password-3','forgot-password-2','forgot-password','register-3','register-2','register','signin-3','signin-2','signin','success','success-2','success-3','layout-horizontal',
'layout-hovered','layout-boxed','layout-rtl','pos','pos-2','pos-3','pos-4','pos-5','login','password.reset']))

    <body>
@endif
@if (Route::is(['layout-horizontal']))
<body class="menu-horizontal">
@endif
@if (Route::is(['layout-hovered']))
<body class="mini-sidebar expand-menu">
@endif
@if (Route::is(['layout-boxed']))
<body class="mini-sidebar layout-box-mode">
@endif
@if (Route::is(['layout-rtl']))
<body class="layout-mode-rtl">
@endif

@if (Route::is(['under-maintenance', 'coming-soon', 'error-404', 'error-500']))

    <body class="error-page">
@endif
@if (Route::is(['two-step-verification','email-verification','reset-password','forgot-password','register-2','register','signin','success']))

    <body class="account-page">
@endif

@if(Route::is(['two-step-verification-3','two-step-verification-2','success-2','success-3','signin-3','signin-2','reset-password-3','reset-password-2','forgot-password-3','forgot-password-2','email-verification-3','email-verification-2','register-3','login','password.reset']))
    <body class="account-page bg-white">
@endif

@if(Route::is(['lock-screen']))
    <img src="{{URL::asset('build/img/bg/lock-screen-bg.png')}}" alt="bg" class="lock-screen-bg position-absolute img-fluid d-sm-none d-md-none d-lg-flex">
@endif

@if(Route::is(['pos','pos-2','pos-3','pos-4','pos-5']))
<body class="pos-page">
@endif
@component('components.loader')
@endcomponent
<!-- Main Wrapper -->
@if (!Route::is(['lock-screen','pos','pos-3','pos-4','pos-5']))
    <div class="main-wrapper">
@endif
@if (Route::is(['lock-screen']))
    <div class="main-wrapper login-body">
@endif
@if (Route::is(['pos']))

<div class="main-wrapper pos-five">
@endif
@if (Route::is(['pos-3']))
<div class="main-wrapper pos-two">
@endif
@if (Route::is(['pos-4']))
<div class="main-wrapper pos-three">
@endif
@if (Route::is(['pos-5']))
<div class="main-wrapper pos-three pos-four">
 @endif
@if (!Route::is(['under-maintenance', 'coming-soon','error-404','error-500','two-step-verification-3','two-step-verification-2','two-step-verification','email-verification-3','email-verification-2','email-verification','reset-password-3','reset-password-2','reset-password','forgot-password-3','forgot-password-2','forgot-password','register-3','register-2','register','signin-3','signin-2','signin','success','success-2','success-3','lock-screen','login','password.reset']))
    @include('layouts.partials.header')
@endif
@if (!Route::is(['under-maintenance', 'coming-soon','error-404','error-500','two-step-verification-3','two-step-verification-2','two-step-verification','email-verification-3','email-verification-2','email-verification','reset-password-3','reset-password-2','reset-password','forgot-password-3','forgot-password-2','forgot-password','register-3','register-2','register','signin-3','signin-2','signin','success','success-2','success-3','lock-screen','login','password.reset']))
    @include('layouts.partials.sidebar')
    @include('layouts.partials.collapsed-sidebar')
    @include('layouts.partials.horizontal-sidebar')
@endif
@yield('content')

@if (!Route::is(['under-maintenance', 'coming-soon','error-404','error-500','two-step-verification-3','two-step-verification-2','two-step-verification','email-verification-3','email-verification-2','email-verification','reset-password-3','reset-password-2','reset-password','forgot-password-3','forgot-password-2','forgot-password','register-3','register-2','register','signin-3','signin-2','signin','success','success-2','success-3','lock-screen','login','password.reset']))
    <div class="page-wrapper">
        <div class="footer d-sm-flex align-items-center justify-content-between border-top bg-white p-3">
            <p class="mb-0 text-gray-9">2025 &copy;. Roto Frank Mexico {{__("application_lang.app_lbl_all_right_reserved")}}</p>
            <p>Designed &amp; Developed by <a href="javascript:void(0);" class="text-primary">Dreams</a></p>
        </div>
    </div>
@endif
</div>
<!-- /Main Wrapper -->

@component('components.modalpopup')
@endcomponent
@include('layouts.partials.footer-scripts')
@yield('localscripts')
</body>

</html>
