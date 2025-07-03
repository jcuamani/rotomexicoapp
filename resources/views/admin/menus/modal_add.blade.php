<div class="modal fade" id="form_add_modal" role="dialog" >
    <div class="modal-dialog modal-xl">
      <div class="modal-content" style="width:100%; height: 100%" >
        <div class="modal-header">
          <h4 class="modal-title">
            @if(!empty($menu))
                {{__("application_lang.app_menus_lbl_btn_actions_edit")}} 
            @else 
                {{__("application_lang.app_menus_lbl_btn_actions_create")}} 
            @endif
            {{__("application_lang.app_menus_lbl_menu")}}
            

          </h4>
          <button type="button" class="close close_modal" data-dismiss="modal" aria-label="Close" id="close_modal">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            
                <div style="max-height: calc(100vh - 200px);overflow-y: auto;">
                    <form method="POST" 
                     @if(!empty($menu))
                     
                        action="{{ secure_route('admin.menus.update', ['id' => $menu->id],'PUT','Request') }}" 
                        
                    @else                          
                        action="{{ secure_route('admin.menus.store',[],'POST','Request') }}" 
                    @endif
                    class="needs-validation" 
                    novalidate id="form_add_menu">
                        @csrf

                        @if(!empty($menu))
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
                                <label for="title">{{__("application_lang.app_menus_lbl_tb_col_name")}}</label>
                                <input id="title" class="form-control"
                                type="text"
                                name="title"
                                @if(!empty($menu))
                                    value="{{ old('title', $menu->title) }}"
                                @else
                                    value="{{ old('title') }}"
                                @endif
                                 required>
                                    
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                                <label for="route">{{__("application_lang.app_lbl_route")}}</label>
                                <input id="route" class="form-control"
                                type="text"
                                name="route"
                                @if(!empty($menu))
                                    value="{{ old('route', $menu->route) }}"
                                @else
                                    value="{{ old('route') }}"
                                @endif
                                 >
                                    
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                                <label for="url">{{__("application_lang.app_lbl_actions_confirm_Link")}}</label>
                                <input id="url" class="form-control"
                                type="text"
                                name="url"
                                @if(!empty($menu))
                                    value="{{ old('url',$menu->url) }}"
                                @else
                                    value="{{ old('url') }}"
                                @endif
                                required>
                                
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                                <label for="icon">{{__("application_lang.app_lbl_icon")}}</label>
                                <input id="icon" class="form-control"
                                type="text"
                                name="icon"
                                @if(!empty($menu))
                                    value="{{ old('icon', $menu->icon) }}"
                                @else
                                    value="{{ old('icon') }}"
                                @endif
                                required>
                                        
                            </div>
                        </div>
                        
                       <div class="form-row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                                <label for="weight">{{__("application_lang.application_permissions")}}</label>
                                <select name="permission" class="form-control select2 form-select">
                                    @foreach ($permissions as $reg)
                                        @if(!empty($menu))
                                            <option value="{{ $reg->name }}" @selected(old('permission', $menu->permission) == $reg->name)>
                                                {!! $reg->name !!}
                                            </option>
                                        @else
                                            <option value="{{ $reg->name }}" @selected(old('permission') == $reg->name)>
                                                {!! $reg->name !!}
                                            </option>
                                        @endif
                                    
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                                <label for="weight">{{__("application_lang.app_menus_lbl_tb_col_parent_id")}}</label>
                                <select name="parent_id" class="form-control select2 form-select">
                                    <option value=''>-ROOT-</option>                                    
                                    @foreach ($parent_options as $key => $name)
                                     @if(!empty($menu))
                                            <option value="{{ $key }}" @selected(old('parent_id', $menu->parent_id) == $key)>
                                                {!! $name !!}
                                            </option>
                                        @else
                                            <option value="{{ $key }}" @selected(old('parent_id') == $key)>
                                                {!! $name !!}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                                <label for="order">{{__("application_lang.app_menus_lbl_tb_col_weight")}}</label>
                                <input id="order" class="form-control"
                                type="number"
                                name="order"
                                @if(!empty($menu))
                                    value="{{ old('order', $menu->order) }}"
                                @else
                                    value="{{ old('order') }}"
                                @endif
                                
                                required>														
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="checkbox">
                                    <div class="custom-checkbox custom-control">
                                        @if(!empty($menu))
                                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="enabled" 
                                            name="enabled" value="1" {{ old('enabled', $menu->enabled) ? 'checked="checked"' : '' }}>
                                        @else
                                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="enabled" 
                                            name="enabled" value="1" {{ old('enabled') ? 'checked="checked"' : 'checked="checked"' }}>
                                        @endif
                                        <label for="enabled" class="custom-control-label">{{__("application_lang.app_menus_lbl_tb_col_enabled")}}</label>
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
                @if(!empty($menu))
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