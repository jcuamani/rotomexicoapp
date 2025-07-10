<?php $page = 'product-details'; ?>
@extends('layouts.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__("application_lang.app_menus_lbl_menu_usuarios")}} {{__("application_lang.app_menus_lbl_btn_actions_det")}}</h4>
                <h6></h6>
            </div>
            <div class="page-btn mt-0">
                    <a href="{{route('admin.users.index')}}" class="btn btn-secondary"><i data-feather="arrow-left" class="me-2"></i>{{__("application_lang.app_menus_lbl_btn_actions_back_to")}} {{__("application_lang.app_menus_lbl_menu_usuarios")}}</a>
            </div>
        </div>
        <!-- /detail -->
         <div class="row">
            <div class="col-xl-3">
            </div>                
            <div class="col-xl-6 theiaStickySidebar">
                    <div class="card rounded-0 border-0">
                        <div class="card-header rounded-0 bg-primary d-flex align-items-center">
                            <span class="avatar avatar-xl avatar-rounded flex-shrink-0 border border-white border-3 me-3">
                                <img src="{{URL::asset('build/img/avatar/'.$regshow->id.'.jpg')}}" alt="Img">
                            </span>
                            @php
                                use Carbon\Carbon;
                                $last_login_at = Carbon::parse($regshow->last_login_at);
                                $created_at = Carbon::parse($regshow->created_at);
                                $updated_at = Carbon::parse($regshow->updated_at);
                            @endphp
                                
                            <h6 class="text-white mb-1">{{$regshow->name}}</h6>                                
                                @foreach($regshow->roles as $role)
                                    <span class="badge bg-purple-transparent text-purple">{{$role->name}}</span>                                    
                                @endforeach
                            </div>
                            <div >
                                 @can('user.edit')
                                <a href="{{ secure_route('admin.users.addEdit',['id' => encrypt_param($regshow['id'])]) }}" class="btn btn-white">{{__("application_lang.application_editProfile")}}</a>
                                @endcan
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="d-inline-flex align-items-center">
                                    <i class="ti ti-id me-2"></i>
                                    {{__("application_lang.app_menus_lbl_tb_col_code")}}
                                </span>
                                <p class="text-dark">{{$regshow->id}}</p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="d-inline-flex align-items-center">
                                    <i class="ti ti-star me-2"></i>
                                    {{__("application_lang.app_menus_lbl_tb_col_email")}}
                                </span>
                                <p class="text-dark">{{$regshow->email}}</p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="d-inline-flex align-items-center">
                                    <i class="ti ti-calendar-check me-2"></i>
                                    {{__("application_lang.app_lbl_created")}}
                                </span>
                                <p class="text-dark">{{$created_at->format('d-m-Y H:i')}}</p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="d-inline-flex align-items-center">
                                    <i class="ti ti-calendar-check me-2"></i>
                                    {{__("application_lang.app_lbl_updated")}}
                                </span>
                                <p class="text-dark">{{$updated_at->format('d-m-Y H:i')}}</p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="d-inline-flex align-items-center">
                                    <i class="ti ti-calendar-check me-2"></i>
                                    {{__("application_lang.app_lbl_last_login")}}
                                </span>
                                <p class="text-dark">{{$last_login_at->format('d-m-Y H:i')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <!-- 
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="bar-code-view">
                            <span>
                                <img src="{{URL::asset('build/img/icons/barcode.svg')}}" alt="{{$regshow->id}}" class="img-fluid">
                            </span>
                        </div>
                        <div class="productdetails">
                            <ul class="product-bar">
                                <li>
                                    <h4>{{__("application_lang.app_menus_lbl_tb_col_code")}}</h4>
                                    <h6>{{$regshow->id}}</h6>
                                </li>
                                <li>
                                    <h4>{{__("application_lang.app_menus_lbl_tb_col_name")}}</h4>
                                    <h6>{{$regshow->name}}</h6>
                                </li>
                                <li>
                                    <h4>{{__("application_lang.app_menus_lbl_tb_col_email")}}</h4>
                                    <h6>{{$regshow->email}}</h6>
                                </li>
                                <li>
                                    <h4>{{__("application_lang.app_lbl_created")}}</h4>
                                    <h6>{{$regshow->created_at}}</h6>
                                </li>
                                <li>
                                    <h4>{{__("application_lang.app_lbl_updated")}}</h4>
                                    <h6>{{$regshow->updated_at}}</h6>
                                </li> 
                                <li>
                                </li> 
                                    <br>
                                <li>
                                    <table class="table table-bordered">
                                        <thead>
                                            
                                            <tr>
                                                <th><b>{{__("application_lang.app_menus_lbl_tb_col_roles")}}</b></th>                                                    
                                                <th>
                                                    <span class=""><b>{{__("application_lang.application_assigned_lbl")}}</b><span>
                                                    
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($roles as $role)
                                                <tr>
                                                    <td>{{ $role->name }}</td>
                                                    <td class="text-center">
                                                        @if($regshow->roles->contains($role))
                                                            <span class="text-success fw-bold">✔</span>
                                                        @else
                                                            <span class="text-muted">—</span>
                                                        @endif
                                                    </td>
                                                    
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </li> 
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        -->
        <!-- /detail -->
    </div>
</div> 

@endsection
