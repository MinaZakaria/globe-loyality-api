<?php

namespace App\Http\Request\Challenge;

use App\Http\Request\ApplicationRequest;

class CreateChallengeRequest extends ApplicationRequest
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
            'name'=>'required|max:55|unique:challenges',
            'description'=>'required',
            'program_id'=>'required|int|min:1',
            'image'=>'nullable',
            'first_prize'=>'int|min:0',
            'second_prize'=>'int|min:0',
            'third_prize'=>'int|min:0',
        ];
    }
}
