<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest {

	protected $redirect = 'register'; // Redirect back to form

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true; // No need to authorize. Making a new account
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'username'	=>	'required|max:32|unique:users,username',
			'name'		=>	'required|max:255',
			'email'		=>	'email|max:255',
			'password'	=>	'required|max:60'
		];
	}

}
