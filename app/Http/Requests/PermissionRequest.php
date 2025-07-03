<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class PermissionRequest extends FormRequest
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
                    'name' => ['required','string', 'max:100','unique:permissions,name'],                    
                    
                ];
            }
            case "PUT":
            {   
                $id = decrypt_param($this->route()->parameters()['data'])['params']['id'] ?? null;
                
                return [
                    //
                    'name' => ['required','string', 'max:100',Rule::unique('permissions','name')->ignore($id)],                                        
                ];

            }
        }
    }
}
