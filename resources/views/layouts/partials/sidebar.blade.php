@if (! Route::is(['pos','pos-2','pos-3','pos-4','pos-5']))
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
                <!-- Logo -->
                <div class="sidebar-logo active">
                        <a href="{{url('index')}}" class="logo logo-normal">
                                <img src="{{URL::asset('build/img/logoRortoSmall.png')}}" alt="Img">
                        </a>
                        <a href="{{url('index')}}" class="logo logo-white">
                                <img src="{{URL::asset('build/img/logoRortoSmall.png')}}" alt="Img">
                        </a>
                        <a href="{{url('index')}}" class="logo-small">
                                <img src="{{URL::asset('build/img/logoRortoSmall.png')}}" alt="Img">
                        </a>
                        <a id="toggle_btn" href="javascript:void(0);">
                                <i data-feather="chevrons-left" class="feather-16"></i>
                        </a>
                </div>
                <!-- /Logo -->
                
                <div class="sidebar-inner slimscroll">
                        
                        <div id="sidebar-menu" class="sidebar-menu">                                
                                <ul>
                                        @include('components.menu')
                                        
                                </ul>
                                                        
                                
                        </div>
                </div>
        </div>
        <!-- /Sidebar -->
@endif
