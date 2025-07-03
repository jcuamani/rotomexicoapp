<?php $page = 'product-details'; ?>
@extends('layouts.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__("application_lang.app_menus_lbl_menus")}} {{__("application_lang.application_order")}}</h4>
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
                        <div class="">
                            <ul id="menu-list" class="list-group col nested-sortable">
                                @foreach($regshow as $menu)
                                    @include('admin.menus.partials.item', ['menu' => $menu,'menu' => $menu, 'level' => 1])
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <button id="saveOrder" class="btn btn-primary mt-2">{{__("application_lang.app_menus_lbl_btn_actions_update")}} {{__("application_lang.application_order")}}</button>
                </div>
            </div>
            
        </div>
            
        <!-- /add -->
    </div>
</div> 

@endsection
