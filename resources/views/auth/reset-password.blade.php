<?php $page = 'password.reset'; ?>
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
                        <form method="POST" action="{{ route('password.store') }}">
                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                             @csrf
                            <div class="card">
                                <div class="card-body p-5">
                                    <div class="login-userheading">
                                        <h3>Reset password?</h3>
                                        <h4>Enter New Password & Confirm Password to get inside</h4>
                                    </div>
                                    <div class="mb-3">

                                        <label class="form-label">{{__('application_lang.application_login_lbl_email')}} <span class="text-danger"> *</span></label>
                                        <div class="input-group">
                                            <input type="email" id="email" name="email" required readonly value="{{ $request->email ?? old('email') }}" class="form-control border-end-0">
                                            <span class="input-group-text border-start-0">
                                                <i class="ti ti-mail"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">{{__('application_lang.application_login_lbl_new_pass')}} <span class="text-danger"> *</span></label>
                                        <div class="pass-group">
                                            <input type="password" id="password" name="password" required autocomplete="new-password" class="pass-inputs form-control">
                                            <span class="ti toggle-passwords ti-eye-off text-gray-9"></span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">{{__('application_lang.application_confirm_password')}} <span class="text-danger"> *</span></label>
                                        <div class="pass-group">
                                            <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"  class="pass-inputa form-control">
                                            <span class="ti toggle-passworda ti-eye-off text-gray-9"></span>
                                        </div>
                                    </div>
                                    <div class="form-login">
                                        <button type="submit" class="btn btn-login">{{__('application_lang.application_reset_password')}}</button>
                                    </div>
                                    <div class="form-setlogin or-text">
                                        <h4>{{__("application_lang.application_login_lbl_or")}}</h4>
                                    </div>
                                    <div class="signinform text-center mb-0">
                                        <h4>{{__('application_lang.application_go_to')}}<a href="{{ route('login') }}" class="hover-a"> {{__("application_lang.application_login")}} </a></h4>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                <p>Copyright &copy; 2025 Roto Frank Mexico</p>
            </div>
        </div>
    </div>
@endsection

