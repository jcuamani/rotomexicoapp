<?php $page = 'login'; ?>
@extends('layouts.mainlayout')
@section('content')
    <!-- Header Menu -->
    <ul class="nav user-menu" style="margin-right: -90% !important;">
       <!-- Flag -->
        <li class="nav-item dropdown has-arrow flag-nav nav-item-box">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);"
                role="button">
                @if(app()->getLocale() == 'en')                    
                    <img src="{{URL::asset('build/img/flags/us-flag.svg')}}" alt="Language" class="img-fluid">
                @elseif(app()->getLocale() == 'es')
                    <img src="{{URL::asset('build/img/flags/mx.png')}}" alt="Language" class="img-fluid">
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('lang.switch', 'en') }}" class="dropdown-item">
                    <img src="{{URL::asset('build/img/flags/us-flag.svg')}}" alt="Img" height="16">{{__('application_lang.application_login_lbl_lang_en')}}
                </a>
                <a href="{{ route('lang.switch', 'es') }}" class="dropdown-item">
                    <img src="{{URL::asset('build/img/flags/mx.png')}}" alt="Img" height="16">{{__('application_lang.application_login_lbl_lang_es')}}
                </a>
            </div>
        </li>
        <!-- /Flag -->

    </ul>
    <!-- /Header Menu -->
    <div class="account-content">
        <div class="login-wrapper login-new">
            <div class="row w-100">
                <div class="col-lg-5 mx-auto">
                    <div class="login-content user-login">
                        <div class="login-logo">
                            <img src="{{URL::asset('build/img/logoRorto.png')}}" alt="img">
                            <a href="{{url('index')}}" class="login-logo logo-white">
                                <img src="{{URL::asset('build/img/logoRortoSmall.png')}}"  alt="Img">
                            </a>
                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            @if(count($errors) > 0)
                                @foreach( $errors->all() as $message )
                                <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button>
                                <span>{{ $message }}</span>
                                </div>
                                @endforeach
                            @endif
                            <div class="card">
                                <div class="card-body p-5">
                                    <div class="login-userheading">
                                        <h3>{{__("application_lang.application_login")}}</h3>
                                        <h4></h4>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">{{__('application_lang.application_login_lbl_email')}} <span class="text-danger"> *</span></label>
                                        <div class="input-group">
                                            <input type="text" id="email" name="email" value="" required class="form-control border-end-0">
                                            <span class="input-group-text border-start-0">
                                                <i class="ti ti-mail"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">{{__('application_lang.application_login_lbl_pass')}} <span class="text-danger"> *</span></label>
                                        <div class="pass-group">
                                            <input type="password" id="password" name="password" required autocomplete="off" class="pass-input form-control">
                                            <span class="ti toggle-password ti-eye-off text-gray-9"></span>
                                        </div>
                                    </div>
                                    <div class="form-login authentication-check">
                                        <div class="row">
                                            <div class="col-12 d-flex align-items-center justify-content-between">
                                                <div class="custom-control custom-checkbox">
                                                    <label class="checkboxs ps-4 mb-0 pb-0 line-height-1 fs-16 text-gray-6">
                                                        <input type="checkbox" class="form-control">
                                                        <span class="checkmarks"></span>{{__('application_lang.application_login_lbl_rememberme')}}
                                                    </label>
                                                </div>
                                                <div class="text-end">
                                                    <a class="text-orange fs-16 fw-medium" href="{{ route('forgot-password') }}">{{__('application_lang.application_login_lbl_forgotpass')}}</a>
                                                </div>
                                            </div>                                    
                                        </div>
                                    </div>
                                    
                                    <div class="form-login">
                                        <button type="submit" class="btn btn-primary w-100">{{__('application_lang.application_login')}} tt</button>
                                    </div>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="my-4 d-flex justify-content-center align-items-center copyright-text text-white">
                        <p>Copyright &copy; 2025 Roto Frank Mexico</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
