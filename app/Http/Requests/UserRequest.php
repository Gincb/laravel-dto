<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:30|string',
            'email' => 'required|min:3|max:50|string',
        ];
    }

    public function getUserName(): string
    {
        return $this->input('name');
    }

    public function getUserEmail(): string
    {
        return $this->input('email');
    }
}
