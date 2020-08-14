<?php

namespace App\Http\Requests\Backend\Auth\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;

/**
 * Class StoreUserRequest.
 */
class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =  [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'user_name' => ['required', Rule::unique('users', 'user_name')],
            'email' => ['required', 'email', Rule::unique('users')],
            'user_name' => ['required'],
            // 'password' => PasswordRules::register($this->email),
            'roles' => ['required', 'array'],
        ];

        if(in_array('sub_agent',request()->roles))
        {
          $additionalRules = [
            'agent_branch' =>  ['required'],
            'accessible_by' =>  ['required'],
          ];
          $rules = $rules+$additionalRules;
        }

        
        return $rules;
    }
}
