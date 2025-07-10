<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RolController;
use App\Http\Middleware\LanguageManager;
use App\Http\Controllers\SecureRouteController;
use App\Http\Controllers\Customer\ShopAccountTypeController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Admin\ErpConnectionController;

App::setLocale("es");
session()->put('locale', "es");

Route::get('lang/{lang}', function ($lang) {
    if (in_array($lang, ['en', 'es'])) {
        session(['locale' => $lang]);
    }
    return redirect()->back();
})->name('lang.switch');

/*
Route::get('/', function () {
    return view('welcome');
});
*/
/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth','verified'])->name('dashboard');
*/


Route::middleware([LanguageManager::class])->group(function () {

Route::get('/', function () {
    return auth()->check() ? redirect('/dashboard') : redirect('/login');
});

Route::middleware(['auth', 'can:permission.access'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('permission', PermissionController::class);    
    Route::get('permission/add/{id}', [PermissionController::class, 'CreateModalAddPermission'])->name('permission.modal.add');
    
});
Route::middleware(['auth', 'can:menu.access'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('menus', MenuController::class);
    Route::get('menus/add/{id}', [MenuController::class, 'CreateModalAddMenu'])->name('menus.modal.add');
    Route::get('menus/reorder/view', [MenuController::class, 'showReorder'])->name('menus.showreorder');
    Route::post('menus/reorder', [MenuController::class, 'reorder'])->name('menus.reorder');
});
Route::middleware(['auth', 'can:role.access'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('rol', RolController::class);
    Route::get('rol/addModal/{id}', [MenuController::class, 'CreateModalAddMenu'])->name('rol.modal.add');
    Route::get('rol/add/{id}', [RolController::class, 'CreateEdit'])->name('rol.addEdit');
});
Route::middleware(['auth', 'can:user.access'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
    Route::get('users/add/{id}', [UserController::class, 'CreateEdit'])->name('users.addEdit');
});

Route::middleware(['auth', 'can:erpconnection.access'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('erpconnection', ErpConnectionController::class);        
    Route::get('erpconnection/add/{id}', [ErpConnectionController::class, 'CreateEdit'])->name('erpconnection.addEdit');          
    Route::get('erpconnection/connection/testconnection', [ErpConnectionController::class, 'probarConexion'])->name('erpconnection.testconnection');          
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'verified'])->prefix('customer')->name('customer.')->group(function () {
    Route::prefix('cat')->name('cat.')->group(function () {
        Route::resource('shopaccounttype', ShopAccounttypeController::class);
        Route::get('shopaccounttype/add/{id}', [ShopAccounttypeController::class, 'CreateEdit'])->name('shopaccounttype.addEdit');        
    });  
    Route::prefix('customer')->name('customer.')->group(function () {
        
        Route::resource('customer', CustomerController::class);
        Route::get('customer/add/{id}', [CustomerController::class, 'CreateEdit'])->name('customer.addEdit');
    });    
});

//Route::get('/secure/{data}', [SecureRouteController::class, 'handle'])->name('secure.route');
Route::match(['GET', 'POST', 'PUT', 'PATCH', 'DELETE'], '/secure/{data}', [SecureRouteController::class, 'handle'])->name('secure.route');

//Route::get('/admin-panel', fn() => view('admin.panel'))->middleware(['auth', 'can:manage users']);



require __DIR__.'/auth.php';
});
