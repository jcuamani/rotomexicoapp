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
                        {{__("application_lang.application_client")}}</h4>
                    <h6></h6>
                </div>
            </div>
            <ul class="table-top-head">
                <li class="me-2">
                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i class="ti ti-chevron-up"></i></a>
                </li>
            </ul>
            <div class="page-btn mt-0">
                    <a href="{{secure_route('customer.customer.customer.index')}}" class="btn btn-secondary"><i data-feather="arrow-left" class="me-2"></i>{{__("application_lang.app_menus_lbl_btn_actions_back_to")}} {{__("application_lang.application_clients")}}</a>
            </div>
        </div>
        <!-- /add -->
        <form method="POST" action="{{ !empty($reg) ? secure_route('customer.customer.customer.update', ['id' => $reg->id],'PUT','\App\Http\Requests\CustomerRequest') : secure_route('customer.customer.customer.store',[],'POST','\App\Http\Requests\CustomerRequest') }}" class="needs-validation" novalidate id="form_add_role" autocomplete="off">
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
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                                            <label for="name">{{__("application_lang.app_menus_lbl_tb_col_name")}}</label>
                                            <input id="name" class="form-control" type="text" name="name" value="{{ old('name', $reg->name ?? '') }}" required autocomplete="off">                                                                                            
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                                            <label for="email">{{__("application_lang.app_menus_lbl_tb_col_email")}}</label>
                                            <input id="email" class="form-control" autocomplete="off"
                                            type="email"
                                            name="email"
                                            value="{{ old('email', $reg->email ?? '') }}"
                                            required/>                                    
                                        </div>
                                        
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                                            <label for="password">{{__("application_lang.app_menus_lbl_tb_col_pass")}}</label>
                                            <input id="password" class="form-control" autocomplete="new-password"
                                            type="password"
                                            name="password"
                                                @if(empty($reg)) required @endif />
                                            
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                                            <label for="password_confirmation">{{__("application_lang.app_menus_lbl_tb_col_pass_confirm")}}</label>
                                            <input id="password_confirmation" class="form-control" autocomplete="off"
                                            type="password"
                                            name="password_confirmation"
                                            @if(empty($reg)) required @endif />
                                            
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">                                    
                                            <div class="checkbox">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="estatus" name="estatus" value="1" {{ old('estatus', $reg->estatus ?? 1) ? 'checked="checked"' : '' }}>
                                                    <label for="estatus" class="custom-control-label">{{__("application_lang.app_menus_lbl_tb_col_enabled")}}</label>
                                                </div>
                                            </div>                                                               
                                            
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">                                    
                                            <div class="checkbox">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="aproved" name="aproved" value="1" {{ old('aproved', $reg->aproved ?? 1) ? 'checked="checked"' : '' }}>
                                                    <label for="aproved" class="custom-control-label">{{__("application_lang.app_lbl_approved")}}</label>
                                                </div>
                                            </div>                                                               
                                            
                                        </div>
                                    </div>
                                    
                                    
                                </div>        
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border mb-4">
                        <h2 class="accordion-header" id="headingTwo">
                            <div class="accordion-button bg-white" data-bs-toggle="collapse" data-bs-target="#collapseTwo"  aria-controls="collapseTwo">
                                <div class="d-flex align-items-center justify-content-between flex-fill">
                                    <h5 class="d-inline-flex align-items-center"><i class="ti ti-jump-rope text-primary me-2"></i><span>{{__("application_lang.app_lbl_account_type")}}</span></h5>
                                </div>
                            </div>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body border-top">
                                <div class="new-employee-field">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                                            <label for="weight">{{__("application_lang.app_lbl_account_type")}}</label>
                                            <select name="idshopaccounttype" id="idshopaccounttype" class="form-control select2 form-select">
                                                @foreach ($accountTypes as $option)
                                                @if(!empty($reg))
                                                        <option value="{{ $option->id }}" @selected(old('idshopaccounttype ', $reg->idshopaccounttype) == $option->id )>
                                                            {!! $option->clave !!} - {!! $option->descr !!}
                                                        </option>
                                                    @else
                                                        <option value="{{ $option->id }}" @selected(old('idshopaccounttype ') == $option->id )>
                                                            {!! $option->clave !!} - {!! $option->descr !!}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row" id="account_role">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                                            <span class="text-bold">{{__("application_lang.app_lbl_account_role")}}</span>
                                            
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="account_role" value="1"
                                                    id="account_role1" disabled {{ old('account_role', $reg->account_role ?? '1')==1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    {{__("application_lang.application_account_regular")}}
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="account_role" value="2"
                                                    id="account_role2" disabled {{ old('account_role', $reg->account_role ?? '') ==2 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    {{__("application_lang.application_account_manager")}}
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="account_role" value="3"
                                                    id="account_role3" disabled {{ old('account_role', $reg->account_role ?? '')==3 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexRadioDefault3">
                                                    {{__("application_lang.application_account_subaccount")}}
                                                </label>
                                            </div>
                                        </div>
                                    
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                                            <span class="text-bold">{{__("application_lang.app_lbl_account_relation")}}</span>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="ono_to_one_account_relation" value="1"
                                                    id="ono_to_one_account_relation1" {{ old('ono_to_one_account_relation', $reg->ono_to_one_account_relation ?? '1')==1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    {{__("application_lang.application_account_relation_one_one")}}
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="ono_to_one_account_relation" value="0"
                                                    id="ono_to_one_account_relation2" {{ old('ono_to_one_account_relation', $reg->ono_to_one_account_relation ?? '')==0 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    {{__("application_lang.application_account_relation_one_multi")}}
                                                </label>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="row" id="representation_behaviour">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                                            <span class="text-bold">{{__("application_lang.app_lbl_representation_behaviour")}}</span>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="linked_customers" value="1"
                                                    id="linked_customers1" {{ old('linked_customers', $reg->linked_customers ?? '1')==1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    {{__("application_lang.app_lbl_representation_behaviour_linked")}}
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="linked_customers" value="0"
                                                    id="linked_customers2" {{ old('linked_customers', $reg->linked_customers ?? '')==0 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    {{__("application_lang.app_lbl_representation_behaviour_all")}}
                                                </label>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="row" id="busqueda">

                                    </div>
                                    <div class="row" id="representation_behaviour">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" value="1"
                                                id="can_order_products" {{ old('can_order_products', $reg->can_order_products ?? '1')==1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="can_order_products">{{__("application_lang.application_can_order_products")}}</label>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" value="1"
                                                id="can_see_prices" {{ old('can_see_prices', $reg->can_see_prices ?? '1')==1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="can_see_prices">{{__("application_lang.application_can_see_prices")}}</label>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" value="1"
                                                id="can_see_stock" {{ old('can_see_stock', $reg->can_see_stock ?? '1')==1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="can_see_stock">{{__("application_lang.application_can_see_stock")}}</label>
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