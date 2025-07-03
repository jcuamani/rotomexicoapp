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
                        {{__("application_lang.app_menus_lbl_tb_col_roles")}}</h4>
                    <h6></h6>
                </div>
            </div>
            <ul class="table-top-head">
                <li class="me-2">
                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i class="ti ti-chevron-up"></i></a>
                </li>
            </ul>
            <div class="page-btn mt-0">
                    <a href="{{secure_route('admin.rol.index')}}" class="btn btn-secondary"><i data-feather="arrow-left" class="me-2"></i>{{__("application_lang.app_menus_lbl_btn_actions_back_to")}} {{__("application_lang.app_menus_lbl_tb_col_roles")}}</a>
            </div>
        </div>
        <!-- /add -->
        <form method="POST" action="{{ !empty($reg) ? secure_route('admin.rol.update', ['rol' => $reg->id],'PUT','\App\Http\Requests\RolRequest') : secure_route('admin.rol.store',[],'POST','\App\Http\Requests\RolRequest') }}" class="needs-validation" novalidate id="form_add_role">
                @csrf
                @if(!empty($reg)) @method('PUT') @endif
                
                @if(count($errors) > 0)
                    @foreach( $errors->all() as $message )
                    <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span>{{ $message }}</span>
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
                                    <div class="form-row">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                                            <label for="name">{{__("application_lang.app_menus_lbl_tb_col_name")}}</label>
                                            <input id="name" class="form-control" type="text" name="name" value="{{ old('name', $reg->name ?? '') }}" required>                                                
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                                            <label for="guard_name">{{__("application_lang.app_menus_lbl_guard_name")}}</label>
                                            <input id="guard_name" class="form-control" type="text" name="guard_name"  value="{{ old('guard_name', $reg->guard_name ?? '') }}" readonly>
                                                
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
                                    <h5 class="d-inline-flex align-items-center"><i class="ti ti-jump-rope text-primary me-2"></i><span>{{__("application_lang.app_lbl_permissions")}}</span></h5>
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
                                                    <th><b>Módulo</b></th>
                                                    @foreach($actions as $action)
                                                        <th>
                                                            <span class=""><b>{{ ucfirst($action) }} </b><span>
                                                            <span><input type="checkbox" class="select-column" data-action="{{ $action }}"><span>
                                                        </th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($modules as $module => $perms)
                                                    <tr>
                                                        <td>
                                                            
                                                            <input type="checkbox" class="select-row" data-module="{{ $module }}">
                                                            <b>{{ ucfirst($module) }} </b>
                                                        </td>
                                                        @foreach($actions as $action)
                                                            @php
                                                                $permName = $perms[$action] ?? null;
                                                                $isChecked = $permName && in_array($permName, $rolePermissions);
                                                            @endphp
                                                            <td class="text-center">
                                                                @if($permName)
                                                                    <input type="checkbox"
                                                                        name="permissions[]"
                                                                        class="checkbox-{{ $action }} checkbox-{{ $module }}"
                                                                        value="{{ $permName }}"
                                                                        {{ $isChecked ? 'checked' : '' }}>
                                                                @else
                                                                    <span class="text-muted">—</span>
                                                                @endif
                                                            </td>
                                                        @endforeach
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