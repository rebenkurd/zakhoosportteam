<?php

namespace App\Http\Requests\Backend;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdatePollRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return  Auth::user()->is($this->poll->user) && $this->poll->status == 'pending';
    }

    public function prepareForValidation()
    {

        $this->merge([
            'start_at' => Carbon::parse($this->start_date . $this->start_time)->toDateTimeString(),
            'end_at' => Carbon::parse($this->end_date . $this->end_time)->toDateTimeString(),
        ]);

    }


    public function rules()
    {
        return [
            'category_id' => ['required', 'string'],
            'start_at' => ['required', 'date' ,'after_or_equal:now'],
            'end_at' => ['required', 'date' ,'after:start_at'],
            'options' => ['required', 'array', 'min:2']
        ];
    }
}
