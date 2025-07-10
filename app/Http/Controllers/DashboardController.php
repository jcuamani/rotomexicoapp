<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if(Auth::check()){

            //Pasamos los datos 
            return view('dashboard');
        }
        return redirect("login")->withError(trans('application_lang.application_login_required'));
    }
}
