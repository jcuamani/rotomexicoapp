<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
   
    public function rules(): array
    {
        switch ($this->method()) {

            case "POST": {
                return [
                    'name' => ['required', 'string', 'max:255','unique:users'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ];
            }
            case "PUT":
            {                
                
                $id = decrypt_param($this->route()->parameters()['data'])['params']['id'] ?? null;
                //dd($id);
                return [
                    'name' => ['required', 'string', 'max:255', Rule::unique('users','name')->ignore($id)],
                    'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users','email')->ignore($id)],
                    'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
                ];

            }
        }
    }
}
