<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
class UserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $rules = [
            'first_name' => "required|max:50",
            'last_name' => "required|max:50",
            'email' => "required|email|unique:users",
            'gender'=>"required",
            'dob' => "date|date_format:Y-m-d|before_or_equal:".Carbon::now()->subYears(18)->format('Y-m-d'),
            'password' => 'required|confirmed',
        ];
    }

      /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'email.required' => 'Email is required.',
            'dob.required' => 'Date of birth is required.',
        ];
    }
}
