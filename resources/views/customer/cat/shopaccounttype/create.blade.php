<?php $page = 'add_rol'; ?>
@extends('layouts.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4>
                        {{ !empty($reg) ? __("application_lang.app_menus_lbl_btn_actions_edit") : __("application_lang.app_menus_lbl_btn_actions_create") }}                    
                        {{__("application_lang.application_shop_account_types")}}</h4>
                    <h6></h6>
                </div>
            </div>
            <ul class="table-top-head">
                <li class="me-2">
                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i class="ti ti-chevron-up"></i></a>
                </li>
            </ul>
            <div class="page-btn mt-0">
                    <a href="{{secure_route('customer.cat.shopaccounttype.index')}}" class="btn btn-secondary"><i data-feather="arrow-left" class="me-2"></i>{{__("application_lang.app_menus_lbl_btn_actions_back_to")}} {{__("application_lang.application_shop_account_types")}}</a>
            </div>
        </div>
        <!-- /add -->
        <form method="POST" action="{{ !empty($reg) ? secure_route('customer.cat.shopaccounttype.update', ['id' => $reg->id],'PUT','\App\Http\Requests\ShopAccountTypeRequest') : secure_route('customer.cat.shopaccounttype.store',[],'POST','\App\Http\Requests\ShopAccountTypeRequest') }}" class="needs-validation" novalidate id="form_add_role">
                @csrf
                @if(!empty($reg)) @method('PUT') @endif
                
                @if(count($errors) > 0)
                    <div class="alert alert-solid-danger alert-dismissible fade show">
                        @foreach( $errors->all() as $message )    
                            <span>{{ $message }}</span>
                        @endforeach
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                class="fas fa-xmark"></i></button>
                    </div>                    
                @endif
                <div class="accordions-items-seperate" id="accordionExample">
                    <div class="accordion-item border mb-4">
                        <h2 class="accordion-header" id="headingOne">
                            <div class="accordion-button bg-white" data-bs-toggle="collapse" data-bs-target="#collapseOne"  aria-controls="collapseOne">
                                <div class="d-flex align-items-center justify-content-between flex-fill">
                                    <h5 class="d-inline-flex align-items-center"><i class="ti ti-layout-grid text-primary me-2"></i><span>{{__("application_lang.application_general_info")}}</span></h5>
                                </div>
                            </div>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body border-top">
                                <div class="new-employee-field">
                                    <div class="form-row">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                                            <label for="clave">{{__("application_lang.app_menus_lbl_tb_col_code")}}</label>
                                            <input id="clave" class="form-control" type="text" name="clave" max="10" value="{{ old('clave', $reg->clave ?? '') }}" required>                                                
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                                            <label for="descr">{{__("application_lang.application_description")}}</label>
                                            <input id="descr" class="form-control" type="text" name="descr" max="200" value="{{ old('descr', $reg->descr ?? '') }}" required>                                                
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                                            <div class="checkbox">
                                                <div class="custom-checkbox custom-control">
                                                    @if(!empty($reg))
                                                        <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="estatus" 
                                                        name="estatus" value="1" {{ old('estatus', $reg->estatus) ? 'checked="checked"' : '' }}>
                                                    @else
                                                        <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="estatus" 
                                                        name="estatus" value="1" {{ old('estatus') ? 'checked="checked"' : 'checked="checked"' }}>
                                                    @endif
                                                    <label for="enabled" class="custom-control-label">{{__("application_lang.app_menus_lbl_tb_col_enabled")}}</label>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>        
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <div class="text-end mb-3">
                    
                    <button type="submit" class="btn btn-primary">
                        {{ !empty($reg) ? __("application_lang.app_menus_lbl_btn_actions_update") : __("application_lang.app_menus_lbl_btn_actions_save") }}          
                    </button>
                </div>                                                             
                                        
            </form>
            
        <!-- /add -->
    </div>
</div> 

@endsection

@section('localscripts')
    <script type="text/javascript">    
        'use strict';

                
        $(document).ready(function() {
            $('.needs-validation').submit(function(event) {
            // Obtén el formulario actual
            var form = this;

            // Verifica si el formulario es válido
            if (form.checkValidity() === false) {
                event.preventDefault(); // Evita el envío del formulario
                event.stopPropagation(); // Detiene la propagación del evento
            }

            $(this).addClass('was-validated'); // Muestra los mensajes de validación
            });
        });

                
    </script>
    @endsection