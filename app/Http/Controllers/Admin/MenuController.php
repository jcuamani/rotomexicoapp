<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        if (request()->ajax()) {

            $menus = Menu::all(); // Get all menus
            $menus->makeHidden('id');
            $menu= (new Menu)->toTree(0, null, false, null); // Convert to tree structure
            $data=array();
            // Create an array with the menu items
            $data=(new Menu)->CreateArrayMenu($data, $menu,$menus);
            //dd($data);    
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row)
                    {
                        
                        //if(request()->user()->can('menu.edit') || request()->user()->can('menu.delete') || request()->user()->can('menu.view'))
                        if(request()->user()->canany(['menu.edit','menu.delete','menu.view']))
                        {
                            $frm = '<div class="edit-delete-action">';
                                if(request()->user()->can('menu.view'))
                                {
                                    $frm .= '<a title="'.trans('application_lang.app_menus_lbl_btn_actions_view').'" class="me-2 edit-icon  p-2" href="'.secure_route('admin.menus.show', ['menu' => encrypt_param($row['id'])],'GET','request','admin.menus.index' ).'">';
                                        $frm .= '<i data-feather="eye" class="feather-eye"></i>';
                                    $frm .= '</a>';
                                }
                                if(request()->user()->can('menu.edit'))
                                {
                                    $frm .= '<a title="'.trans('application_lang.app_menus_lbl_btn_actions_edit').'" class="me-2 p-2 ButonEdit"  data-init-reg="'.encrypt_param($row['id']).'" href="#" >';
                                        $frm .= '<i data-feather="edit" class="feather-edit"></i>';
                                    $frm .= '</a>';
                                }
                                if(request()->user()->can('menu.delete'))
                                {
                                    $frm .= '<div class="p-2">';
                                        $frm .= '<form action="'.secure_route('admin.menus.destroy', ['id' => $row['id']],'POST').'" method="POST">';
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

        return view('admin.menus.index');
    }

    

    public function CreateModalAddMenu($id)
    {
        $id = decrypt_param($id);
        $menu = Menu::where('id', '=',$id)->first();
        $permissions =Permission::all(); 
        //$parent_options = Menu::All();
        $parent_options = Menu::selectOptions(0,null,false,null);
        
        return view('admin.menus.modal_add',compact('menu', 'permissions','parent_options'));
    }

  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try
        {

            $enabled =  $request->input('enabled') ? 1 : 0;           
            $request->merge(['enabled' =>$enabled]);

            Menu::create($request->all());
            return redirect()->route('admin.menus.index')
            ->with('success', __(trans('application_lang.app_lbl_action_created_correct')));
        } catch (\Exception $e) {
            
            return redirect()->back()->withErrors(__(trans('application_lang.app_lbl_error_create')));

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       try
       {

            $id = decrypt_param($id);
            $regshow = Menu::leftJoin('menus as padre', 'padre.id', '=', 'menus.parent_id')
                ->select('menus.*','padre.title as padre' )
                ->where('menus.id', '=', $id)
                ->first();           
            
            if(!empty($regshow)){
                
                return view('admin.menus.show', compact('regshow'));
            } else {

                return redirect()->route('admin.menus.index')->withErrors(trans('application_lang.app_lbl_error_reg_not_exist'));

            }

        } catch (\Exception $e) {
            
            return redirect()->route('admin.menus.index')->withErrors(__(trans('application_lang.app_lbl_error_reg_not_exist')));

        }
    }

    
    public function showReorder()
    {
        
        try {
    
            $regshow = Menu::whereNull('parent_id')->with('children')->orderBy('order')->get();   
            //dd($regshow)     ;
            if(!empty($regshow)){
                
                return view('admin.menus.showReorder', compact('regshow'));
            } else {

                //return view('admin.menus.index')->withErrors(trans('application_lang.app_lbl_error_reg_not_exist'));
                return redirect()->route('admin.menus.index')->withErrors(trans('application_lang.app_lbl_error_reg_not_exist'));

            }
        } catch (\Exception $e) {
            return redirect()->route('admin.menus.index')->withErrors(trans('application_lang.app_lbl_error_reg_not_exist'). ' ' . $e->getMessage());
        }
    }

    public function reorder(Request $request)
    {
        $this->updateMenuTree($request->tree);

        return response()->json(['message' => 'Orden y jerarquía guardados correctamente']);
    }

    protected function updateMenuTree(array $items, $parentId = null)
    {
        foreach ($items as $index => $item) {
            \App\Models\Menu::where('id', $item['id'])->update([
                'parent_id' => $parentId,
                'order' => $index + 1
            ]);

            if (!empty($item['children'])) {
                $this->updateMenuTree($item['children'], $item['id']);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try
        {

            $enabled =  $request->input('enabled') ? 1 : 0;   
            $request->merge(['enabled' =>$enabled]);

            $regedit = Menu::findOrFail($id);        
            $regedit->update($request->all());

            return redirect()->route('admin.menus.index')
            ->with('success', __(trans('application_lang.app_lbl_action_update_correct')));

        } catch (\Exception $e) {
            
            return redirect()->back()->withErrors(__(trans('application_lang.app_lbl_error_update')));

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try 
        {
            Menu::findOrFail($id)->delete();

            return redirect()->route('admin.menus.index')
            ->with('success', __(trans('application_lang.app_lbl_action_delete_correct')));

        } catch (\Exception $e) {
            
            return redirect()->route('admin.menus.index')->withErrors(__(trans('application_lang.app_lbl_error_delete')));

        }
    }
}
