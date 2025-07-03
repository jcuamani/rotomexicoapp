<?php $page = 'forgot-password'; ?>
@extends('layouts.mainlayout')
@section('content')
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
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="card">
                                <div class="card-body p-5">
                                    <div class="login-userheading">
                                        <h3>{{__('application_lang.application_reset_password')}}</h3>
                                        <h4>{{__('application_lang.application_forgot_password_det')}}</h4>
                                    </div>
                                    @if (session('status'))
											<div class="alert alert-success" role="alert">
												{{ session('status') }}
											</div>
										@endif
                                    <div class="mb-3">

                                        <label class="form-label">{{__('application_lang.application_login_lbl_email')}} <span class="text-danger"> *</span></label>
                                        <div class="input-group">
                                            <input type="email" id="email" name="email" required value="" class="form-control border-end-0">
                                            <span class="input-group-text border-start-0">
                                                <i class="ti ti-mail"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-login">
                                        <button type="submit" class="btn btn-login">{{__('application_lang.application_reset_password')}}</button>
                                    </div>
                                    <div class="form-setlogin or-text">
                                        <h4>{{__("application_lang.application_login_lbl_or")}}</h4>
                                    </div>
                                    <div class="signinform text-center">
                                        <h4>{{__('application_lang.application_go_to')}}<a href="{{ route('login') }}" class="hover-a"> {{__("application_lang.application_login")}} </a></h4>
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