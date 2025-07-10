<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class ErpConnectionRequest extends FormRequest
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
                    'connection_type' => 'required|max:150',
                    'scope_url' => 'required|url|max:255',
                    'webservice_url' => 'required|url|max:255',
                    'access_token_url' => 'required|url|max:255',
                    'clientid' => 'required|max:100',
                    'client_secret' => 'required|max:512',
                    'connection_timeout' => 'required|integer|min:60',
                    'estatus' => 'boolean',
                    
                ];
            }
            case "PUT":
            {        
                return [
                   
                    'connection_type' => 'required|max:150',
                    'scope_url' => 'required|url|max:255',
                    'webservice_url' => 'required|url|max:255',
                    'access_token_url' => 'required|url|max:255',
                    'clientid' => 'required|max:100',
                    'client_secret' => 'required|max:512',
                    'connection_timeout' => 'required|integer|min:60',
                    'estatus' => 'boolean',
                ];

            }
        }
    }
}
