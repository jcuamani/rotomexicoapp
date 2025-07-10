<?php $page = 'add_rol'; ?>
@extends('layouts.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4>
                        {{ !empty($reg) ? __("application_lang.app_menus_lbl_btn_actions_edit") : __("application_lang.app_menus_lbl_btn_actions_edit") }}                    
                        {{__("application_lang.application_label_erp_connection")}}</h4>
                    <h6></h6>
                </div>
            </div>
            <ul class="table-top-head">
                <li class="me-2">
                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i class="ti ti-chevron-up"></i></a>
                </li>
            </ul>
            <div class="page-btn mt-0">
                    
            </div>
        </div>
        <!-- /add -->
        <form method="POST" action="{{ !empty($reg) ? secure_route('admin.erpconnection.update', ['id' => $reg->id],'PUT','\App\Http\Requests\ErpConnectionRequest') : secure_route('admin.erpconnection.store',[],'POST','\App\Http\Requests\ErpConnectionRequest') }}" class="needs-validation" novalidate id="form_add_erpconnection" enctype="multipart/form-data" autocomplete="off">
                @csrf
                @if(!empty($reg)) @method('PUT') @endif
                
                
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
                                         
                                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 mb-3">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">
                                                    <label for="weight">{{__("application_lang.application_label_erp_connection_type")}}</label>
                                                    <select id="connection_type" name="connection_type" class="form-control select2 form-select">
                                                        <option value="DYNAMICS_365_FOR_FINANCIALS" @selected(old('connection_type', $reg->connection_type ?? '') == 'DYNAMICS_365_FOR_FINANCIALS')>Microsoft Dynamics 365 Business Central</option>
                                                        <option value="DYNAMICS_365_FOR_FINANCIALS_O_AUTH" @selected(old('connection_type', $reg->connection_type ?? '') == 'DYNAMICS_365_FOR_FINANCIALS_O_AUTH')>Microsoft Dynamics 365 Business Central (SOAP + OAuth)</option>
                                                        <option value="DYNAMICS_365_FOR_FINANCIALS_O_DATA_O_AUTH" @selected(old('connection_type', $reg->connection_type ?? '') == 'DYNAMICS_365_FOR_FINANCIALS_O_DATA_O_AUTH') {{$reg->connection_type ?? 'selected'}} >Microsoft Dynamics 365 Business Central (OData + OAuth)</option>
                                                        <option value="DYNAMICS_365_FOR_FINANCIALS_O_DATA_BASIC_AUTH" @selected(old('connection_type', $reg->connection_type ?? '') == 'DYNAMICS_365_FOR_FINANCIALS_O_DATA_BASIC_AUTH')>Microsoft Dynamics 365 Business Central (OData + Basic auth)</option>                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">
                                                    <label for="scope_url">{{__("application_lang.application_label_erp_connection_scope_url")}}</label>
                                                    <input id="scope_url" class="form-control" autocomplete="off"
                                                    type="text"
                                                    name="scope_url"
                                                    value="{{ old('scope_url', $reg->scope_url ?? '') }}" required/>                                    
                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">
                                                    <label for="webservice_url">{{__("application_lang.application_label_erp_connection_webservice_url")}}</label>
                                                    <input id="webservice_url" class="form-control" autocomplete="off"
                                                    type="text"
                                                    name="webservice_url"
                                                    value="{{ old('webservice_url', $reg->webservice_url ?? '') }}" required/>                                    
                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">
                                                    <label for="access_token_url">{{__("application_lang.application_label_erp_connection_access_token_url")}}</label>
                                                    <input id="access_token_url" class="form-control" autocomplete="off"
                                                    type="text"
                                                    name="access_token_url"
                                                    value="{{ old('access_token_url', $reg->access_token_url ?? '') }}"
                                                    required/>                                    
                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">
                                                    <label for="clientid">{{__("application_lang.application_label_erp_connection_client_id")}}</label>
                                                    <input id="clientid" class="form-control" autocomplete="off"
                                                    type="text"
                                                    name="clientid"
                                                    value="{{ old('clientid', $reg->clientid ?? '') }}"
                                                    required/>                                    
                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">
                                                    <label for="client_secret">{{__("application_lang.application_label_erp_connection_client_secret")}}</label>
                                                    <input id="client_secret" class="form-control" autocomplete="off"
                                                    type="password"
                                                    name="client_secret" 
                                                    value="{{ old('client_secret', '************') }}"
                                                    required/>
                                                    
                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">
                                                    <label for="extra_parameters">{{__("application_lang.application_label_erp_connection_extra_parameters")}}</label>
                                                    <input id="extra_parameters" class="form-control" autocomplete="off"
                                                    type="text"
                                                    name="extra_parameters"
                                                    value="{{ old('extra_parameters', $reg->extra_parameters ?? '') }}"
                                                    />
                                                    
                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">
                                                    <label for="connection_timeout">{{__("application_lang.application_label_erp_connection_timeout")}}</label>
                                                    <input id="connection_timeout" class="form-control" min="0"
                                                    type="number"
                                                    name="connection_timeout"
                                                    value="{{ old('connection_timeout', $reg->connection_timeout ?? '60') }}"
                                                    />
                                                    
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">                                    
                                                    <div class="checkbox">
                                                        <div class="custom-checkbox custom-control">
                                                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="status" name="status" value="1" {{ old('status', $reg->status ?? 1) ? 'checked="checked"' : '' }}>
                                                            <label for="status" class="custom-control-label">{{__("application_lang.app_menus_lbl_tb_col_enabled")}}</label>
                                                        </div>
                                                    </div>                                                               
                                                    
                                                </div>
                                            </div>                                    
                                        </div>
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-3">
                                            <a href="{{ secure_route('admin.erpconnection.testconnection') }}" class="btn btn-success ">
                                                <i class="ti ti-circle-plus me-1"></i>
                                                {{__("application_lang.app_lbl_action_erp_concction_test")}}
                                            </a>
                                            @if(count($errors) > 0)
                                                @foreach( $errors->all() as $message )
                                                    <div class="alert alert-danger alert-dismissible fade show">
                                                        {{ $message }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="fas fa-xmark"></i></button>                    
                                                    </div>
                                                @endforeach
                                            @endif
                                            @if (Session::has('success'))
                                                <div class="alert alert-success alert-dismissible fade show">
                                                    {{ Session::get('success') }}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="fas fa-xmark"></i></button>                    
                                                </div>                    
                                            @endif  
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