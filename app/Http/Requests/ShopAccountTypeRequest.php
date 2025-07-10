<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class ShopAccounttypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

     /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        
        switch ($this->method()) {

            case "POST": {
                return [
                    'clave' => ['required','string', 'max:10','unique:c_shopaccounttype,clave'],                    
                    'descr' => ['required','string', 'max:200','unique:c_shopaccounttype,descr'],                    
                    'estatus' => 'boolean',
                    
                ];
            }
            case "PUT":
            {        
                //dd('Ruta simulada:', [$this->route()]);        
                ///dd('Param role:', decrypt_param($this->route()->parameters()['data']));

                $id = decrypt_param($this->route()->parameters()['data'])['params']['id'] ?? null;                
                //dd($id);
                return [
                    //
                    'clave' => ['required','string', 'max:10',Rule::unique('c_shopaccounttype','clave')->ignore($id)],      
                    'descr' => ['required','string', 'max:200',Rule::unique('c_shopaccounttype','descr')->ignore($id)],      
                    'estatus' => ['boolean']
                ];

            }
        }
    }
}
