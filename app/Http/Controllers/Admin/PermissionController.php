<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\PermissionRequest;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{
    public function index()
    {
        //$permissions = Permission::all();
        if (request()->ajax()) {

            $data = Permission::all();
            $data->makeHidden('id');
            //dd($data);    
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row)
                    {
                        
                        //if(request()->user()->can('menu.edit') || request()->user()->can('menu.delete') || request()->user()->can('menu.view'))
                        if(request()->user()->canany(['permission.edit','permission.delete','permission.view']))
                        {
                            $frm = '<div class="edit-delete-action">';
                                if(request()->user()->can('permission.view'))
                                { 
                                    $frm .= '<a title="'.trans('application_lang.app_menus_lbl_btn_actions_view').'" class="me-2 edit-icon  p-2" href="'.secure_route('admin.permission.show', ['permission' => encrypt_param($row['id'])]).'">';
                                        $frm .= '<i data-feather="eye" class="feather-eye"></i>';
                                    $frm .= '</a>';
                                }
                                if(request()->user()->can('permission.edit'))
                                {
                                    $frm .= '<a title="'.trans('application_lang.app_menus_lbl_btn_actions_edit').'" class="me-2 p-2 ButonEdit_Permission"  data-init-reg="'.encrypt_param($row['id']).'" href="#" >';
                                        $frm .= '<i data-feather="edit" class="feather-edit"></i>';
                                    $frm .= '</a>';
                                }
                                if(request()->user()->can('permission.delete'))
                                {
                                    $frm .= '<div class="p-2">';
                                        $frm .= '<form action="'.secure_route('admin.permission.destroy', ['id' => $row['id']],'POST').'" method="POST">';
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
        return view('admin.permission.index');
    }
    public function CreateModalAddPermission($id)
    {
        
        $id = decrypt_param($id);
        $reg = Permission::where('id', '=',$id)->first();
        
        return view('admin.permission.modal_add',compact('reg'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        try {
        
            $id = decrypt_param($id);

            $regshow = Permission::where('id', $id)->first();

            if(!empty($regshow)){
                
                return view('admin.permission.show', compact('regshow'));
            } else {

                return redirect()->route('admin.permission.index')->withErrors(trans('application_lang.app_lbl_error_reg_not_exist'));

            }
        } catch (\Exception $e) {
            
            return redirect()->route('admin.permission.index')->withErrors(__(trans('application_lang.app_lbl_error_reg_not_exist')));

        }

        
    }

    
    public function store(PermissionRequest $request)
    {
        try {    

            $allgroup =  $request->input('createallgroup') ? true : false;
            $nameInitial = $request->input('name');
            if($allgroup) //vamos a generar los permisos de acceso, ver, crear, editar y eliminar
            {
                
                $request->merge(['name' => $nameInitial.'.access']);
                Permission::create($request->all());

                $request->merge(['name' => $nameInitial.'.view']);
                Permission::create($request->all());

                $request->merge(['name' => $nameInitial.'.create']);
                Permission::create($request->all());

                $request->merge(['name' => $nameInitial.'.edit']);
                Permission::create($request->all());

                $request->merge(['name' => $nameInitial.'.delete']);
                Permission::create($request->all());
                            

            } else {
                
                Permission::create($request->all());    
            }
        
            
            return redirect()->route('admin.permission.index')->with('success', __(trans('application_lang.app_lbl_action_created_correct')));

        } catch (\Exception $e) {
            
            return redirect()->back()->withErrors(__(trans('application_lang.app_lbl_error_create')));

        }
    }

    
    public function update(PermissionRequest $request, $id)
    {
        try{
            $permission = Permission::findOrFail($id);
            $permission->update(['name' => $request->name]);

            return redirect()->route('admin.permission.index')->with('success', __(trans('application_lang.app_lbl_action_update_correct')));

        } catch (\Exception $e) {
            
            return redirect()->back()->withErrors(__(trans('application_lang.app_lbl_error_update')));

        }
    }

    public function destroy(string $id)
    {
        try{

            Permission::findOrFail($id)->delete();
            return redirect()->route('admin.permission.index')
            ->with('success', __(trans('application_lang.app_lbl_action_delete_correct')));

        } catch (\Exception $e) {
            
            return redirect()->route('admin.permission.index')->withErrors(__(trans('application_lang.app_lbl_error_delete')));

        }

    }
}
