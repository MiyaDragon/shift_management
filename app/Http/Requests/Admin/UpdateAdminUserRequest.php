<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdminUserRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email:filter', Rule::unique('admin_users')->ignore($this->admin_user->id)],
            'telephone_number' => ['required', 'regex:/^0[0-9]{9,10}\z/'],
            'password' => ['required', 'min:8']
        ];
    }
}
