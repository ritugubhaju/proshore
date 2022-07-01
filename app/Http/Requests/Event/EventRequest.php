<?php

namespace App\Http\Requests\Event;

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
        $rules = [
            'title'=>'required|string',
            'start_date'=>'required',
            'end_date'=>'required|after_or_equal:start_date'
        ];

        return $rules;
    }

    public function data(){


        $inputs=[
            'title' => $this->get('title'),
            'description'=> $this->get('description'),
            'start_date' => $this->get('start_date'),
            'end_date' => $this->get('end_date'),
        ];

        return $inputs;
    }
}
