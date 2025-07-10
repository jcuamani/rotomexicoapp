<?php $page = 'product-list'; ?>
@extends('layouts.mainlayout')
@section('content')

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4 class="fw-bold">{{__("application_lang.app_menus_lbl_menus")}}</h4>
                    <h6>{{__("application_lang.app_menus_lbl_btn_actions_manage")}} {{__("application_lang.app_lbl_yours")}} {{__("application_lang.app_menus_lbl_menus")}}</h6>
                </div>
            </div>
            <ul class="table-top-head">
                <li>
                    <a id="btnExportPDF" data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img src="{{URL::asset('build/img/icons/pdf.svg')}}" alt="img"></a>
                </li>
                <li>
                    <a id="btnExportExcel" data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img src="{{URL::asset('build/img/icons/excel.svg')}}" alt="img"></a>
                </li>
                
                <li>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh" id="DataTableRefresh">
                        <i class="ti ti-refresh Refresh"></i>
                        
                    </a>
                    <div class="spinner-border text-primary" role="status" id="DataTableLoading" style="display: none;">
                                <span class="sr-only">Loading...</span>
                    </div>
                </li>
                <li>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i class="ti ti-chevron-up"></i></a>
                </li>
            </ul>
            <div class="page-btn">
                @can('menu.create')
                    <a href="" data-init-reg="{{ encrypt_param(0) }}" class="btn btn-primary ButonAdd_Menu">
                        <i class="ti ti-circle-plus me-1"></i>
                        {{__("application_lang.app_menus_lbl_menus_admin_add")}}
                    </a>

                @endcan 

                
            </div>	   
            <div class="page-btn">
                @canany(['menu.create','menu.edit'])
                    <a href="{{ secure_route('admin.menus.showreorder') }}" class="btn btn-primary">
                        <i class="ti ti-circle-plus me-1"></i>
                        {{__("application_lang.application_change")}} {{__("application_lang.application_order")}}
                    </a>

                @endcanany

            </div>	            
        </div>
        
        <!-- /product list -->
        <div class="card">
            <div class="toast-container position-fixed top-0 end-0 p-3">
                @if($errors->any())
                        
                    <div id="dangerToast" class="toast colored-toast bg-danger-transparent" role="alert"
                        aria-live="assertive" aria-atomic="true">
                        <div class="toast-header bg-danger text-fixed-white">
                            <strong class="me-auto">{{__("application_lang.app_lbl_error")}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast"
                                aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            <ul>
                                @foreach( $errors->all() as $message )
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    
                @endif    
                @if (Session::has('success'))
                    
                    <div id="successToast" class="toast colored-toast bg-success-transparent" role="alert"
                        aria-live="assertive" aria-atomic="true">
                        <div class="toast-header bg-success text-fixed-white">
                            <strong class="me-auto">{{__("application_lang.app_menus_lbl_btn_actions_correct")}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast"
                                aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            {{ Session::get('success') }}
                            
                        </div>
                    </div>

                @endif  
            </div>
            <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">                
                <div class="search-set">
                    <div class="search-input">
                        <span class="btn-searchset"><i class="ti ti-search fs-14 feather-search"></i></span>
                    </div>
                </div>
                
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table datatable" id="dt_Menu">
                        <thead class="thead-light">
                            <tr>                                
                                <th>{{__("application_lang.app_menus_lbl_tb_col_name")}} </th>
                                <th>{{__("application_lang.app_menus_lbl_tb_col_enabled")}}</th>
                                <th class="no-sort text-center">{{__("application_lang.app_menus_lbl_tb_col_actions")}}</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /product list -->
    </div>
    
</div>
@endsection
@section('localscripts')
<script>  

@if (Session::has('success'))
        const successtoast = document.getElementById('successToast')
        const toast = new bootstrap.Toast(successtoast)
        toast.show()
    @endif 
    @if($errors->any())
        const dangertoasterror = document.getElementById('dangerToast')
        const toast = new bootstrap.Toast(dangertoasterror)
        toast.show()        
    @endif  
    
</script>  
@endsection
