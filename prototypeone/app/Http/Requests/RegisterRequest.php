<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest {

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
		// Basic validation rules
		$validationRules = array(
			'username'	=>	'required|max:32|unique:users,username',
			'name'		=>	'required|max:255',
			'email'		=>	'email|max:255',
			'password'	=>	'required|max:60' );
		// Make separate rules for each account type
		if (!strcmp($this->request->get('usertype'), "Professional")) {
			// Validation rules for professional
			array_push($validationRules, array(
					'title' => 'max:255', 
					'about' => 'max:255'
				)
			);
		} else if (!strcmp($this->request->get('usertype'), "Supplier")) {
			// Validation rules for supplier
			array_push($validationRules, array(
					'street_number'			=> 	'max:255',
					'street_name'			=>	'max:255',
					'suburb'				=>	'max:255',
					'state'					=>	'max:255',
					'post_code'				=>	'max:255',
					'work_phone_number'		=>	'max:255',
					'mobile_phone_number'	=>	'max:255'
				)
			);
		}
		return $validationRules;
	}

}
