<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Models\ShopAccountType;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {

            $data = Customer::all();
            $data->makeHidden('id'); // Ocultar el campo 'id' si no es necesario en la vista
            //dd($data);    
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row)
                    {
                        
                        //if(request()->user()->can('menu.edit') || request()->user()->can('menu.delete') || request()->user()->can('menu.view'))
                        if(request()->user()->canany(['customer_customer_customer.edit','customer_customer_customer.delete','customer_customer_customer.view']))
                        {
                            $frm = '<div class="edit-delete-action">';
                                if(request()->user()->can('customer_customer_customer.view'))
                                {
                                    $frm .= '<a title="'.trans('application_lang.app_menus_lbl_btn_actions_view').'" class="me-2 edit-icon  p-2" href="'.secure_route('customer.customer.customer.show', ['shopaccounttype' => encrypt_param($row['id'])]).'">';
                                        $frm .= '<i data-feather="eye" class="feather-eye"></i>';
                                    $frm .= '</a>';
                                }
                                if(request()->user()->can('customer_customer_customer.edit'))
                                {
                                    $frm .= '<a title="'.trans('application_lang.app_menus_lbl_btn_actions_edit').'" class="me-2 p-2 " href="'.secure_route('customer.customer.customer.addEdit',['id' => encrypt_param($row['id'])]).'" >';
                                        $frm .= '<i data-feather="edit" class="feather-edit"></i>';
                                    $frm .= '</a>';
                                }
                                if(request()->user()->can('customer_customer_customer.delete'))
                                {
                                    $frm .= '<div class="p-2">';
                                        $frm .= '<form action="'.secure_route('customer.customer.customer.destroy', ['id' => $row['id']],'POST').'" method="POST">';
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

        return view('customer.customer.customer.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

     public function CreateEdit($id)
    {

        try {
        
            $id = decrypt_param($id);
            $reg = Customer::where('id', $id)->first();
            $accountTypes = ShopAccountType::where('estatus',1)->get();   

            return view('customer.customer.customer.create', compact('reg','accountTypes'));
        
        } catch (\Exception $e) {
            
            return redirect()->route('customer.customer.customer.index')->withErrors(__(trans('application_lang.app_lbl_error_reg_not_exist')));

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShopAccountTypeRequest $request)
    {
        try 
        {
            // Crear el rol           
            $estatus =  $request->input('estatus') ? 1 : 0;        
            $request->merge(['estatus' =>$estatus]);

            Customer::create($request->all());           
            return redirect()->route('customer.customer.customer.index')->with('success', __(trans('application_lang.app_lbl_action_created_correct')));
        } catch (\Exception $e) {
            
            return redirect()->back()->withErrors(__(trans('application_lang.app_lbl_error_create')). ' ' . $e->getMessage())
                                     ->withInput();

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
            $regshow = Customer::where('id', $id)->first();
            
            return view('customer.customer.customer.show', compact('regshow'));

        } catch (\Exception $e) {
            
            return redirect()->route('customer.customer.customer.index')->withErrors(__(trans('application_lang.app_lbl_error_reg_not_exist')));

        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShopAccountTypeRequest $request, $id)
    {
        try 
        {
            //$id = decrypt_param($id);
            $estatus =  $request->input('estatus') ? 1 : 0;        
            $request->merge(['estatus' =>$estatus]);
            $regedit = Customer::findOrFail($id);                   
            $regedit->update($request->all());
            
            return redirect()->route('customer.customer.customer.index')
                        ->with('success', __(trans('application_lang.app_lbl_action_update_correct')));
        
        } catch (\Throwable $e) {
            
            return back()->withErrors(__(trans('application_lang.app_lbl_error_update')))
                ->withInput();
        }
              

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try 
        {
            Customer::findOrFail($id)->delete();
            return redirect()->route('customer.customer.customer.index')
            ->with('success', __(trans('application_lang.app_lbl_action_delete_correct')));

        } catch (\Throwable $e) {
            return back()->withErrors(__(trans('application_lang.app_lbl_error_delete')));
        }
    }
}
