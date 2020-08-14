<?php

namespace App\Http\Requests\Backend\Auth\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateUserRequest.
 */
class UpdateUserRequest extends FormRequest
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
        $rules = [
            'email' => ['required', 'email'],
            'first_name' => ['required'],
            'last_name' => ['required'],
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
