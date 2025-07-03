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
                        {{__("application_lang.app_menus_lbl_menu_usuarios")}}</h4>
                    <h6></h6>
                </div>
            </div>
            <ul class="table-top-head">
                <li class="me-2">
                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i class="ti ti-chevron-up"></i></a>
                </li>
            </ul>
            <div class="page-btn mt-0">
                    <a href="{{route('admin.users.index')}}" class="btn btn-secondary"><i data-feather="arrow-left" class="me-2"></i>{{__("application_lang.app_menus_lbl_btn_actions_back_to")}} {{__("application_lang.app_menus_lbl_menu_usuarios")}}</a>
            </div>
        </div>
        <!-- /add -->
        <form method="POST" action="{{ !empty($reg) ? secure_route('admin.users.update', ['id' => $reg->id],'PUT','\App\Http\Requests\UserRequest') : secure_route('admin.users.store',[],'POST','\App\Http\Requests\UserRequest') }}" class="needs-validation" novalidate id="form_add_role" enctype="multipart/form-data">
                @csrf
                @if(!empty($reg)) @method('PUT') @endif
                
                @if(count($errors) > 0)
                    @foreach( $errors->all() as $message )
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="fas fa-xmark"></i></button>                    
                    </div>
                @endforeach
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
                                        <div class="col-lg-3 col-md-3 col-sm-12 mb-3">
                                            <label for="name">{{__("application_lang.app_menus_lbl_tb_col_image")}}</label>
                                            <input type="file" class="dropify"  data-height="200"  id="image" name="image" 
                                            data-default-file="{{ !empty($reg) ? asset('build/img/avatar/'.$reg->id.'.jpg') : '' }}"
                                            />
                                            
                                        </div>
                                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 mb-3">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">
                                                    <label for="name">{{__("application_lang.app_menus_lbl_tb_col_name")}}</label>
                                                    <input id="name" class="form-control"
                                                    type="text"
                                                    name="name"
                                                    value="{{ old('name', $reg->name ?? '') }}" required/>                                    
                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">
                                                    <label for="email">{{__("application_lang.app_menus_lbl_tb_col_email")}}</label>
                                                    <input id="email" class="form-control" autocomplete="off"
                                                    type="email"
                                                    name="email"
                                                    value="{{ old('email', $reg->email ?? '') }}"
                                                    required/>                                    
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                                                    <label for="password">{{__("application_lang.app_menus_lbl_tb_col_pass")}}</label>
                                                    <input id="password" class="form-control" autocomplete="off"
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
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">                                    
                                                    <div class="checkbox">
                                                        <div class="custom-checkbox custom-control">
                                                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="status" name="status" value="1" {{ old('status', $reg->email ?? 1) ? 'checked="checked"' : '' }}>
                                                            <label for="status" class="custom-control-label">{{__("application_lang.app_menus_lbl_tb_col_enabled")}}</label>
                                                        </div>
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
                                    <h5 class="d-inline-flex align-items-center"><i class="ti ti-jump-rope text-primary me-2"></i><span>{{__("application_lang.app_menus_lbl_tb_col_roles")}}</span></h5>
                                </div>
                            </div>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body border-top">
                                <div class="new-employee-field">
                                    <div class="form-row">
                                        <table class="table table-bordered" id="permissionsMatrix">
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
                                                        <td>                                                            
                                                            <b>{{ $role->name }}</b>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="roles[]" value="{{ $role->name }}"  {{ !empty($reg) ? ($reg->roles->contains($role) ? 'checked' : '') : '' }}>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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