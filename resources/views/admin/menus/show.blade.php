<?php $page = 'product-details'; ?>
@extends('layouts.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__("application_lang.app_menus_lbl_menus")}} {{__("application_lang.app_menus_lbl_btn_actions_det")}}</h4>
                <h6></h6>
            </div>
            <div class="page-btn mt-0">
                    <a href="{{route('admin.menus.index')}}" class="btn btn-secondary"><i data-feather="arrow-left" class="me-2"></i>{{__("application_lang.app_menus_lbl_btn_actions_back_to")}} {{__("application_lang.app_menus_lbl_menus")}}</a>
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
                                    <h6>{{$regshow->title}}</h6>
                                </li>
                                <li>
                                    <h4>{{__("application_lang.app_lbl_route")}}</h4>
                                    <h6>{{$regshow->route}}</h6>
                                </li>
                                <li>
                                    <h4>{{__("application_lang.app_lbl_actions_confirm_Link")}}</h4>
                                    <h6>{{$regshow->url}}</h6>
                                </li>
                                <li>
                                    <h4>{{__("application_lang.app_lbl_icon")}}</h4>
                                    <h6><i class="{{$regshow->icon}} fs-16 me-2"></i></h6>
                                </li>
                                <li>
                                    <h4>{{__("application_lang.application_permissions")}}</h4>
                                    <h6>{{$regshow->permission}}</h6>
                                </li>
                                <li>
                                    <h4>{{__("application_lang.app_menus_lbl_tb_col_parent_id")}}</h4>
                                    <h6>{{$regshow->padre}}</h6>
                                </li>
                                <li>
                                    <h4>{{__("application_lang.app_menus_lbl_tb_col_weight")}}</h4>
                                    <h6>{{$regshow->order}}</h6>
                                </li>
                                <li>
                                    <h4>{{__("application_lang.app_lbl_status")}}</h4>
                                    @php
                                    $txtestatus2= trans('application_lang.app_menus_lbl_tb_col_disabled');
                                    $classbtnstatus2 = "btn-warning";
                                    if($regshow['enabled']==1){
                                        $txtestatus2= trans('application_lang.app_menus_lbl_tb_col_enabled');
                                        $classbtnstatus2 ="btn-success";
                                    } 
                                    @endphp
                                    <h6>{{__($txtestatus2)}}</h6>
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
