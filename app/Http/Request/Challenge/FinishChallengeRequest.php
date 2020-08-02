<?php

namespace App\Http\Request\Challenge;

use App\Http\Request\ApplicationRequest;

use Illuminate\Support\Facades\Auth;

class FinishChallengeRequest extends ApplicationRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $currentUser = Auth::user();
        return $currentUser->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
