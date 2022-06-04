<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventsInvitedUsersRequest extends FormRequest
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
        return $rules = [
            'event_id' => "required",
            'email' =>"required"
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
            'event_id.required' => 'Event is required.',
            'email.required' => 'Email is required.'
        ];
    }

}
