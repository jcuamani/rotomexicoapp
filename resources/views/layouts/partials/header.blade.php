	
@if(!Route::is(['pos','pos-2','pos-3','pos-4','pos-5']))
<div class="header">
    <div class="main-header text-center">
        <!-- Logo -->
        <div class="header-left active">
            <a href="{{url('index')}}" class="logo logo-normal">
                <img src="{{URL::asset('build/img/logoRortoSmall.png')}}" alt="Img">
            </a>
            <a href="{{url('index')}}" class="logo logo-white">
                <img src="{{URL::asset('build/img/logoRortoSmall.png')}}" alt="Img">
            </a>
            <a href="{{url('index')}}" class="logo-small">
                <img src="{{URL::asset('build/img/logoRortoSmall.png')}}" alt="Img">
            </a>
        </div>
        <!-- /Logo -->
        <a id="mobile_btn" class="mobile_btn" href="#sidebar">
            <span class="bar-icon">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </a>

        <!-- Header Menu -->
        <ul class="nav user-menu" style="float: right;">
       
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
            

            <li class="nav-item nav-item-box">
                <a href="javascript:void(0);" id="btnFullscreen">
                    <i class="ti ti-maximize"></i>
                </a>
            </li>
            
            <li class="nav-item dropdown has-arrow main-drop profile-nav">
                <a href="javascript:void(0);" class="nav-link userset" data-bs-toggle="dropdown">
                    <span class="user-info p-0">
                        <span class="user-letter">
                            @if (Storage::disk("imgperfil")->exists(auth()->user()->id.'.jpg'))
                                <img src="{{URL::asset('build/img/avatar/'.auth()->user()->id.'.jpg')}}" alt="Img" class="img-fluid rounded-circle">
                            @else
                                <img src="{{URL::asset('build/img/profiles/avator1.jpg')}}" alt="Img" class="img-fluid rounded-circle" >
                            @endif
                            
                        </span>
                    </span>
                </a>
                <div class="dropdown-menu menu-drop-user">
                    <div class="profileset d-flex align-items-center">
                        <span class="user-img me-2">
                            @if(auth()->user()!= null)
                                @if (Storage::disk("imgperfil")->exists(auth()->user()->id.'.jpg'))
                                    <img src="{{URL::asset('build/img/avatar/'.auth()->user()->id.'.jpg')}}" alt="Img" class="img-fluid rounded-circle">
                                @else
                                    <img src="{{ asset('build/img/profiles/default.jpg') }}" alt="Img" class="img-fluid rounded-circle">
                                @endif
                            @endif
                        </span>
                        <div>
                            <h6 class="fw-medium">
                                @if(auth()->user()!= null)
									{{ auth()->user()->name }}
								@endif
                            </h6>
                            <p></p>
                        </div>
                    </div>
                    <a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="ti ti-user-circle me-2"></i>{{__("application_lang.app_lbl_profile")}}</a>
                    <hr class="my-2">
                    <a class="dropdown-item logout pb-0" href="{{ route('signout') }}"><i class="ti ti-logout me-2"></i>{{__("application_lang.application_logout")}}</a>
                </div>
            </li>
        </ul>
        <!-- /Header Menu -->

        <!-- Mobile Menu -->
        <div class="dropdown mobile-user-menu">
            <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('profile.edit') }}">{{__("application_lang.app_lbl_profile")}}</a>
                <a class="dropdown-item" href="{{ route('signout') }}">{{__("application_lang.application_logout")}}</a>
            </div>
        </div>
        <!-- /Mobile Menu -->
    </div>
</div>
@endif

    	
 