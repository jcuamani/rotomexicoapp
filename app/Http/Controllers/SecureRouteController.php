<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
use Illuminate\Routing\RouteCollection;
use Illuminate\Routing\Route as LaravelRoute;
/**
 * Controlador para manejar rutas seguras.
 * Este controlador se encarga de procesar las rutas encriptadas y redirigir o ejecutar acciones según el método HTTP.
 */
class SecureRouteController extends Controller
{
    public function handle($data, Request $request)
    {
        $rutaError = '';
        
        try {
            $payload = Crypt::decrypt(urldecode($data));

            // Validar que el payload contenga los datos necesarios
            if (isset($payload['expires_at']) && now()->timestamp > $payload['expires_at']) {
                abort(403, 'Enlace expirado');
            }
            
            $route = $payload['route'];
            $params = $payload['params'] ?? [];
            $tiporequest = $payload['tiporequest'] ?? 'request';
            $rutaError = $payload['rutaError'] ?? null;
            
            if (!$request->isMethod('get')) 
            {     

                //$requestTest = new \App\Http\Requests\RolRequest;

                //if (new $tiporequest instanceof \Illuminate\Foundation\Http\FormRequest) {
                    //dd( "Sí, extiende de FormRequest.");
                //}

                //dd($params, $tiporequest, is_subclass_of($tiporequest, \Illuminate\Foundation\Http\FormRequest::class));
                 // ✅ Si $tiporequest es una clase válida de FormRequest
                 /*
                if (is_string($tiporequest) && is_subclass_of($tiporequest, \Illuminate\Foundation\Http\FormRequest::class)) {

                    
                    $formRequest = new $tiporequest;                    
                    
       
                    // Inicializar con los datos originales
                    $formRequest->setMethod($request->getMethod());
                    $formRequest->initialize(
                        $request->query->all(),
                        $request->request->all(),
                        [], 
                        $request->cookies->all(), 
                        $request->files->all(),
                        $request->server->all(), 
                        $request->getContent()
                    );

                    
                    // Simular la ruta para el FormRequest (para que funcione $this->route())
                    
                    $formRequest->setRouteResolver(function () use ($params) {
                        $fakeRoute = new LaravelRoute('PUT', '', []);
                        foreach ($params as $key => $value) {
                            $fakeRoute->setParameter($key, $value);
                        }
                        return $fakeRoute;
                    });
                    
                    
                    $formRequest->setContainer(app()); // ✅ Agrega esta línea
                    
                    //$formRequest->validateResolved();  // ✅ Ya no fallará
                    //dd($formRequest);
                    $request = $formRequest;

                }
                */
                

                //dd(Route::getRoutes()->getByName($route)->getAction('controller'),array_merge($params, [$tiporequest => $request]));
                // ✅ Ejecutar el controlador con el request y parámetros
            
                return app()->call(
                    Route::getRoutes()->getByName($route)->getAction('controller'),
                    array_merge($params, [$tiporequest => $request])
                );
            }

            
            
            // Redireccionar si es GET
            return redirect()->route($route, $params);
            
         } catch (\Exception $e) {
            
            return $rutaError
                ? redirect()->route($rutaError)->withErrors($e->getMessage())
                : redirect()->back()->withErrors($e->getMessage() . ' (sin ruta de error definida)');
            
            //abort(403, 'Ruta inválida o vencida');
            //return redirect()->back()->withErrors($e->getMessage());
                //->withInput()
                //->with('rutaError', $rutaError);
        }
    }
}
