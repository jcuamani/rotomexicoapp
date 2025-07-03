<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\RolRequest;
use Yajra\DataTables\DataTables;

class RolController extends Controller
{

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        
        if (request()->ajax()) {

            $data = Role::all();
            $data->makeHidden('id'); // Ocultar el campo 'id' si no es necesario en la vista
            //dd($data);    
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row)
                    {
                        
                        //if(request()->user()->can('menu.edit') || request()->user()->can('menu.delete') || request()->user()->can('menu.view'))
                        if(request()->user()->canany(['role.edit','role.delete','role.view']))
                        {
                            $frm = '<div class="edit-delete-action">';
                                if(request()->user()->can('role.view'))
                                {
                                    $frm .= '<a title="'.trans('application_lang.app_menus_lbl_btn_actions_view').'" class="me-2 edit-icon  p-2" href="'.secure_route('admin.rol.show', ['rol' => encrypt_param($row['id'])]).'">';
                                        $frm .= '<i data-feather="eye" class="feather-eye"></i>';
                                    $frm .= '</a>';
                                }
                                if(request()->user()->can('role.edit'))
                                {
                                    $frm .= '<a title="'.trans('application_lang.app_menus_lbl_btn_actions_edit').'" class="me-2 p-2 " href="'.secure_route('admin.rol.addEdit',['id' => encrypt_param($row['id'])]).'" >';
                                        $frm .= '<i data-feather="edit" class="feather-edit"></i>';
                                    $frm .= '</a>';
                                }
                                if(request()->user()->can('role.delete'))
                                {
                                    $frm .= '<div class="p-2">';
                                        $frm .= '<form action="'.secure_route('admin.rol.destroy', ['id' => $row['id']],'POST').'" method="POST">';
                                            $frm .= '<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">';
                                                $frm .='<input type="hidden" name="_token" value="'.csrf_token().'">';
                                                $frm .= '<input type="hidden" name="_method" value="DELETE">';
                                                $frm .=  '<button title="'.trans('application_lang.app_menus_lbl_btn_actions_delete').'" class="p-2 btn btn-light" onclick="return confirm(\''.trans('application_lang.app_lbl_actions_confirm_delete').'\')">
                                                    <i data-feather="trash-2" class="feather-trash-2"></i></button>';
                                            $frm .= '</div>';
                                        $frm .= '</form>';
                                    $frm .= '</div>';
                                }

                            $frm .= '</div>';
                            
                        }   else {

                            $frm = '';

                        }       
                        return $frm;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        } 
        return view('admin.rol.index');

    }

    
    public function show($id)
    {

        try
        {
            $id = decrypt_param($id);
            $regshow = Role::where('id', $id)->first();
            $permissions = $regshow->permissions; // Solo los asignados

            // Agrupar permisos como en el resto del sistema
            $modules = [];
            $actions = [];

            foreach ($permissions as $permission) {
                if (!str_contains($permission->name, '.')) continue;

                [$module, $action] = explode('.', $permission->name);

                $modules[$module][$action] = $permission->name;

                if (!in_array($action, $actions)) {
                    $actions[] = $action;
                }
            }

            sort($actions);
            ksort($modules);

            return view('admin.rol.show', compact('regshow', 'modules', 'actions'));

        } catch (\Exception $e) {
            
            return redirect()->route('admin.permission.index')->withErrors(__(trans('application_lang.app_lbl_error_reg_not_exist')));

        }
    }

    public function CreateEdit($id)
    {

        try {
        
            $id = decrypt_param($id);
            $reg = Role::where('id', $id)->first();
            $rolePermissions = []; // ✅ permisos ya asignados
            
            if (!empty($reg)) {

                $rolePermissions = $reg->permissions->pluck('name')->toArray(); // ✅ permisos ya asignados

            }
            $permissions = Permission::all();

            $actions = [];
            $modules = [];        
            
            foreach ($permissions as $permission) {
                
                if (!str_contains($permission->name, '.')) continue;
                [$module, $action] = explode('.', $permission->name);
                $modules[$module][$action] = $permission->name;
                if (!in_array($action, $actions)) {
                    $actions[] = $action;
                }
            }
            sort($actions);
            ksort($modules);

            //dd($actions);
            return view('admin.rol.create', compact('reg', 'permissions','modules', 'actions', 'rolePermissions'));
        
        } catch (\Exception $e) {
            
            return redirect()->route('admin.rol.index')->withErrors(__(trans('application_lang.app_lbl_error_reg_not_exist')));

        }
    }
    

    public function store(RolRequest $request)
    {
        try 
        {
            // Crear el rol
            $role = Role::create(['name' => $request->name]);
            // Asignar permisos seleccionados (si los hay)
            if ($request->filled('permissions')) 
            {
                $role->syncPermissions($request->input('permissions'));
            }

            return redirect()->route('admin.rol.index')->with('success', __(trans('application_lang.app_lbl_action_created_correct')));
        } catch (\Exception $e) {
            
            return redirect()->back()->withErrors(__(trans('application_lang.app_lbl_error_create')));

        }
    }

    

    public function update(RolRequest $request, $rol)
    {
        //dd($rol);
        

        try 
        {
            //$id = decrypt_param($id);
            $regedit = Role::findOrFail($rol);        
            if ($regedit->name === 'superadmin' && auth()->user()->id !== 1) {
                return redirect()->route('admin.rol.index')
                ->withErrors('Error: No puedes modificar el rol superadmin.: ');                
            }
        
            $regedit->update(['name' => $request->name]);
            $regedit->syncPermissions($request->input('permissions', []));
        
        } catch (\Throwable $e) {
            //return back()->withErrors('Error: no se ha podido actualizar el registro.: '.$e->getMessage());
            return back()->withErrors(__(trans('application_lang.app_lbl_error_update')));
        }
              

        return redirect()->route('admin.rol.index')
                        ->with('success', __(trans('application_lang.app_lbl_action_update_correct')));
    }

    public function destroy($id)
    {
         try 
        {
            Role::findOrFail($id)->delete();
            return redirect()->route('admin.rol.index')
            ->with('success', __(trans('application_lang.app_lbl_action_delete_correct')));

        } catch (\Throwable $e) {
            return back()->withErrors(__(trans('application_lang.app_lbl_error_delete')));
        }
    }
}
