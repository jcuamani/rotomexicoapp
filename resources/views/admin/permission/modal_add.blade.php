<div class="modal fade" id="form_add_modal" role="dialog" >
    <div class="modal-dialog modal-xl">
      <div class="modal-content" style="width:100%; height: 100%" >
        <div class="modal-header">
          <h4 class="modal-title">
            @if(!empty($reg))
                {{__("application_lang.app_menus_lbl_btn_actions_edit")}} 
            @else 
                {{__("application_lang.app_menus_lbl_btn_actions_create")}} 
            @endif
            {{__("application_lang.app_lbl_permissions")}}
            

          </h4>
          <button type="button" class="close close_modal" data-dismiss="modal" aria-label="Close" id="close_modal">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            
                <div style="max-height: calc(100vh - 200px);overflow-y: auto;">
                    <form method="POST" 
                     @if(!empty($reg))
                        action="{{ secure_route('admin.permission.update', ['id' => $reg->id],'PUT','PermissionRequest') }}" 
                    @else  
                        action="{{ secure_route('admin.permission.store',[],'POST','PermissionRequest') }}" 
                    @endif
                    class="needs-validation" 
                    novalidate id="form_add_permission">
                        @csrf

                        @if(!empty($reg))
                            @method('PUT')
                        @endif
                        
                        @if(count($errors) > 0)
                            @foreach( $errors->all() as $message )
                            <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button>
                            <span>{{ $message }}</span>
                            </div>
                            @endforeach
                        @endif
                        <div class="form-row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                                <label for="name">{{__("application_lang.app_menus_lbl_tb_col_name")}}</label>
                                <input id="name" class="form-control"
                                type="text"
                                name="name"
                                @if(!empty($reg))
                                    value="{{ old('name', $reg->name) }}"
                                @else
                                    value="{{ old('name') }}"
                                @endif
                                 required>
                                    
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                                <label for="guard_name">{{__("application_lang.app_menus_lbl_guard_name")}}</label>
                                <input id="guard_name" class="form-control"
                                type="text"
                                name="guard_name"
                                @if(!empty($reg))
                                    value="{{ old('guard_name', $reg->guard_name) }}"
                                @else
                                    value="{{ old('guard_name') }}"
                                @endif
                                 readonly>
                                    
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="checkbox">
                                    <div class="custom-checkbox custom-control">
                                        @if(!empty($reg))
                                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="createallgroup" 
                                            name="createallgroup" value="1" {{ old('createallgroup') ? 'checked="checked"' : '' }} Disabled>
                                        @else
                                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="createallgroup" 
                                            name="createallgroup" value="1" {{ old('createallgroup') ? 'checked="checked"' : '' }}>
                                        @endif
                                        <label for="createallgroup" class="custom-control-label">{{__("application_lang.app_menus_lbl_tb_col_group_permissions")}}</label>
                                    </div>
                                </div>
                                
                            </div>
                        </div>                                                                   
                                                
                    </form>
                    
                </div>            
        </div>              
                        
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default close_modal" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary guardar_modal" data-dismiss="modal" data-toggle="modal" data-target="#modal-add-internal-respondent">
                @if(!empty($reg))
                    {{__("application_lang.app_menus_lbl_btn_actions_update")}}
                @else
                    {{__("application_lang.app_menus_lbl_btn_actions_save")}} 
                @endif
            </button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
     <!-- Sweet-alert js  -->
	<style>
        /*
    .modal-body{
        height: 100px;
        width: 100%;
        overflow-y: auto;
    }	
*/
    
</style>
  </div>
    <script type="text/javascript">    
            'use strict';

            $(".select2").select2({                
		    });  
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