<?php

namespace App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'name' => "required|max:50",
            'start_date' => "date|date_format:Y-m-d|after_or_equal:".Carbon::now()->format('Y-m-d'),
            'end_date' => "date|date_format:Y-m-d|after_or_equal:start_date"
        ];
    }
}
