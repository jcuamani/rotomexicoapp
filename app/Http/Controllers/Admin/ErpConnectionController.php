<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ErpConnectionRequest;
use App\Models\ErpConnection;
use Illuminate\Support\Facades\Crypt;
use App\Services\BusinessCentralService;

class ErpConnectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return redirect()->route('admin.erpconnection.addEdit',0);
    }
    public function CreateEdit($id)
    {

        try {
        
            
            $reg = ErpConnection::first();
            return view('admin.erpconnection.create', compact('reg'));
        
        } catch (\Exception $e) {
            
            return redirect()->route('admin.erpconnection.index')->withErrors(__(trans('application_lang.app_lbl_error_reg_not_exist')));

        }
    }

    public function probarConexion(BusinessCentralService $bc)
    {
        //dd('llego a test conecction');
        $reg = ErpConnection::first();

        try {
            
            
            $conexion = $bc->probarConexion();     
            //dd('llego a test conecction');       
            return redirect()->back()->with('success', __(trans('application_lang.app_lbl_action_erp_concction_correct')));;        
            //return response()->json($customers);

        } catch (\Exception $e) {

            //dd('llego a test conecction');
            return redirect()->back()->withErrors(__(trans('application_lang.app_lbl_action_erp_concction_error')).$e->getmessage());
            //return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ErpConnectionRequest $request)
    {
        try
        {

            $estatus =  $request->input('estatus') ? 1 : 0;           
            $request->merge(['estatus' =>$estatus]);
            $request->merge(['client_secret' =>Crypt::encryptString($request->client_secret)]);
        
            ErpConnection::create($request->all());

            return redirect()->route('admin.erpconnection.index')
            ->with('success', __(trans('application_lang.app_lbl_action_created_correct')));
        } catch (\Exception $e) {
            
            return redirect()->back()->withErrors(__(trans('application_lang.app_lbl_error_create')))->withInputs();

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(ErpConnectionRequest $request, string $id)
    {
        try
        {

            $regedit = ErpConnection::findOrFail($id);        

            $estatus =  $request->input('estatus') ? 1 : 0;           
            $request->merge(['estatus' =>$estatus]);
            
            if($request->client_secret != '************'){

                $request->merge(['client_secret' =>Crypt::encryptString($request->client_secret)]);
            } else {

                $request->merge(['client_secret' =>$regedit->client_secret]);
                
            }        
            
            $regedit->update($request->all());

            return redirect()->route('admin.erpconnection.index')
            ->with('success', __(trans('application_lang.app_lbl_action_update_correct')));

        } catch (\Exception $e) {
            
            return redirect()->back()->withErrors(__(trans('application_lang.app_lbl_error_update').$e->getmessage()));

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
