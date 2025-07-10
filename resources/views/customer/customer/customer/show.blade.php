<?php $page = 'product-details'; ?>
@extends('layouts.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__("application_lang.application_shop_account_type")}} {{__("application_lang.app_menus_lbl_btn_actions_det")}}</h4>
                <h6></h6>
            </div>
            <div class="page-btn mt-0">
                    <a href="{{secure_route('customer.cat.shopaccounttype.index')}}" class="btn btn-secondary"><i data-feather="arrow-left" class="me-2"></i>{{__("application_lang.app_menus_lbl_btn_actions_back_to")}} {{__("application_lang.application_shop_account_types")}}</a>
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
                                    <h4>{{__("application_lang.application_description")}}</h4>
                                    <h6>{{$regshow->descr}}</h6>
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
                                    <h4>{{__("application_lang.app_lbl_status")}}</h4>
                                    @php
                                    $txtestatus2= trans('application_lang.app_menus_lbl_tb_col_disabled');
                                    $classbtnstatus2 = "d-inline-flex align-items-center p-1 pe-2 rounded-1 text-white bg-danger fs-10";
                                    if($regshow->estatus ==1 || $regshow->estatus == true) {
                                        $txtestatus2= trans('application_lang.app_menus_lbl_tb_col_enabled');
                                        $classbtnstatus2 ="d-inline-flex align-items-center p-1 pe-2 rounded-1 text-white bg-success fs-10";
                                    } 
                                    @endphp
                                    <h6>
                                        <span class="{{$classbtnstatus2}}">{{$txtestatus2}}</span>
                                    </h6>
                                        
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
