<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class RolRequest extends FormRequest
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
                    'name' => ['required','string', 'max:100','unique:roles,name'],                    
                    'permissions' => 'nullable|array',
                    'permissions.*' => 'string|exists:permissions,name'
                    
                ];
            }
            case "PUT":
            {        
                //dd('Ruta simulada:', [$this->route()]);        
                ///dd('Param role:', decrypt_param($this->route()->parameters()['data']));

                $id = decrypt_param($this->route()->parameters()['data'])['params']['rol'] ?? null;
                //dd($id);
                return [
                    //
                    'name' => ['required','string', 'max:100',Rule::unique('roles','name')->ignore($id)],      
                    'permissions' => 'nullable|array',
                    'permissions.*' => 'string|exists:permissions,name'                                  
                ];

            }
        }
    }
}
