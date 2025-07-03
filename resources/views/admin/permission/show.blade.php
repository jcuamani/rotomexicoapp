<?php $page = 'product-details'; ?>
@extends('layouts.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__("application_lang.app_lbl_permissions")}} {{__("application_lang.app_menus_lbl_btn_actions_det")}}</h4>
                <h6></h6>
            </div>
            <div class="page-btn mt-0">
                    <a href="{{route('admin.permission.index')}}" class="btn btn-secondary"><i data-feather="arrow-left" class="me-2"></i>{{__("application_lang.app_menus_lbl_btn_actions_back_to")}} {{__("application_lang.app_lbl_permissions")}}</a>
            </div>
        </div>
        <!-- /add -->
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="bar-code-view">
                            <span>{{__("application_lang.app_menus_lbl_tb_col_code")}}: {{$regshow->id}}</span>
                        </div>
                        <div class="productdetails">
                            <ul class="product-bar">
                                <li>
                                    <h4>{{__("application_lang.app_menus_lbl_tb_col_name")}}</h4>
                                    <h6>{{$regshow->name}}</h6>
                                </li>
                                <li>
                                    <h4>{{__("application_lang.app_menus_lbl_guard_name")}}</h4>
                                    <h6>{{$regshow->guard_name}}</h6>
                                </li>
                                <li>
                                    <h4>{{__("application_lang.app_lbl_created")}}</h4>
                                    <h6>{{$regshow->created_at}}</h6>
                                </li>
                                <li>
                                    <h4>{{__("application_lang.app_lbl_updated")}}</h4>
                                    <h6>{{$regshow->updated_at}}</h6>
                                </li> 
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
            
        <!-- /add -->
    </div>
</div> 

@endsection
