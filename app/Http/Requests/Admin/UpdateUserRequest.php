<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'email' => ['required', 'email:filter', Rule::unique('users')->ignore($this->user->id)],
            'telephone_number' => ['required', 'regex:/^0[0-9]{9,10}\z/', Rule::unique('users')->ignore($this->user->id)],
            'password' => ['required', 'min:8'],
            'prescribed' => ['required', 'numeric', 'between:1,5', 'decimal:0,1'],
            'position_id' => ['required', 'integer'],
        ];
    }
}
