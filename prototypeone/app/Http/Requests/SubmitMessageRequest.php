<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitMessageRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{	
		/*check that user is either on panel or is 
		the user that submitted the case*/
		return true; // No need to authorize yet.
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'message_text' => 'required'
		];
	}
	
}