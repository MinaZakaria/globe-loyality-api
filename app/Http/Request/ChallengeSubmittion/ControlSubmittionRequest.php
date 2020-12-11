<?php

namespace App\Http\Request\ChallengeSubmittion;

use App\Http\Request\ApplicationRequest;

use Illuminate\Support\Facades\Auth;

class ControlSubmittionRequest extends ApplicationRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
        // $currentUser = Auth::user();
        // return $currentUser->is_admin;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'comment' => 'nullable|string|max:255'
    ];
  }
}
