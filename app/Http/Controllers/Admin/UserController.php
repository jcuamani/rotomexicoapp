<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    
    

    
    public function index()
    {       
        //dd('index');     
        if (request()->ajax()) {

            $data = User::with('roles')->get();
            $data->makeHidden('id'); // Ocultar el campo 'id' si no es necesario en la vista
            //dd($data);    
            return Datatables::of($data)
                    ->addIndexColumn()
                    /*
                    ->addColumn('roles1', function ($data) {
                        return $data->roles->pluck('name'); // 🔁 array de strings
                    })
                        */
                    ->addColumn('action', function($row)
                    {
                        
                        //if(request()->user()->can('menu.edit') || request()->user()->can('menu.delete') || request()->user()->can('menu.view'))
                        if(request()->user()->canany(['user.edit','user.delete','user.view']))
                        {
                            $frm = '<div class="edit-delete-action">';
                                if(request()->user()->can('user.view'))
                                {
                                    $frm .= '<a title="'.trans('application_lang.app_menus_lbl_btn_actions_view').'" class="me-2 edit-icon  p-2" href="'.secure_route('admin.users.show', ['user' => encrypt_param($row['id'])]).'">';
                                        $frm .= '<i data-feather="eye" class="feather-eye"></i>';
                                    $frm .= '</a>';
                                }
                                if(request()->user()->can('user.edit'))
                                {
                                    $frm .= '<a title="'.trans('application_lang.app_menus_lbl_btn_actions_edit').'" class="me-2 p-2 "  href="'.secure_route('admin.users.addEdit',['id' => encrypt_param($row['id'])]).'" >';
                                        $frm .= '<i data-feather="edit" class="feather-edit"></i>';
                                    $frm .= '</a>';
                                }
                                if(request()->user()->can('user.delete'))
                                {
                                    $frm .= '<div class="p-2">';
                                        $frm .= '<form action="'.secure_route('admin.users.destroy', ['id' => $row['id']],'POST').'" method="POST">';
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
                    //->rawColumns(['action', 'roles1'])
                    ->rawColumns(['action'])
                    ->make(true);
        } 
        return view('admin.users.index');

    }

    public function CreateEdit($id)
    {

        try 
        {

            $id = decrypt_param($id);
            $reg = User::where('id', $id)->with('roles')->first();
            $roles = Role::all();

            return view('admin.users.create', compact('reg', 'roles'));

        } catch (\Exception $e) {
            
            return redirect()->route('admin.users.index')->withErrors(__(trans('application_lang.app_lbl_error_reg_not_exist')));

        }
    }

    public function show($id)
    {
        try
        {
            $id = decrypt_param($id);
            $regshow = User::where('id', $id)->with('roles')->first();
            $roles = Role::all();

            return view('admin.users.show', compact('regshow', 'roles'));
         
        } catch (\Exception $e) {
            
            return redirect()->route('admin.users.index')->withErrors(__(trans('application_lang.app_lbl_error_reg_not_exist')));

        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  UserRequest  $request
     * @param  CreateUser  $createUser
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        try 
        {

        
            $status =  $request->input('status') ? 1 : 0;        
            $request->merge(['status' =>$status]);
            
            //creamos el usuario
            $UserNew =  User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            
            $roles = $request->roles ?? [];
            $UserNew->assignRole($roles);
            //dd($createUser);
            //creamos el nombre de la imagen, poniendo el id del usuario creado
            $imageNameOnly = $UserNew->id.'.jpg';
            
            if($request->file('image') != null){
                //subimos la imagen
                if (!Storage::disk("imgperfil")->exists($imageNameOnly)) 
                {
                    Storage::disk('imgperfil')->put($imageNameOnly, fopen($request->file('image'), 'r+'));
                }
            }
            return redirect()->route('admin.users.index')
                        ->with('success', __(trans('application_lang.app_lbl_action_created_correct')));
        
        } catch (\Exception $e) {
            
            return redirect()->back()->withErrors(__(trans('application_lang.app_lbl_error_create')));

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, $id)
    {
        try 
        {

            //dd($id);
            $user= User::findOrFail($id);
            
            $user->status =  $request->input('status') ? 1 : 0;
            
            if($request->password){

                $user->password = Hash::make($request->password);

            } else {
                //si no se ha cambiado la contraseña, mantenemos la actual
                $user->password = $user->password;
            }
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'status' => $user->status,
                'password' => $user->password,
            ]);
            
            $roles = $request->roles ?? [];
            $user->syncRoles($roles);

            $imageNameOnly = $user->id.'.jpg';

            if($request->file('image') != null){
                
                //si tiene imagen la eliminamos
                if (Storage::disk("imgperfil")->exists($imageNameOnly)) 
                {
                    Storage::disk('imgperfil')->delete($imageNameOnly);
                }
                //subimos la nueva imagen
                if (!Storage::disk("imgperfil")->exists($imageNameOnly)) 
                {
                    Storage::disk('imgperfil')->put($imageNameOnly, fopen($request->file('image'), 'r+'));
                }
            }
            return redirect()->route('admin.users.index')
                            ->with('success', __(trans('application_lang.app_lbl_action_update_correct')));
        
        } catch (\Throwable $e) {
            //return back()->withErrors('Error: no se ha podido actualizar el registro.: '.$e->getMessage());
            return back()->withErrors(__(trans('application_lang.app_lbl_error_update')));
        }
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try
        {

            User::findOrFail($id)->delete();            

            return redirect()->route('admin.users.index')
                        ->with('success', __(trans('application_lang.app_lbl_action_delete_correct')));
        
        } catch (\Throwable $e) {
            return back()->withErrors(__(trans('application_lang.app_lbl_error_delete')));
        }

    }
}
