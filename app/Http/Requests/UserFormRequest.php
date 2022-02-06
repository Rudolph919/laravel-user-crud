<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'id_number' => ['required', 'digits:13'],
            'mobile_number' => ['required', 'digits:10'],
            'date_of_birth' => ['required'],
            'language' => ['required'],
            'interests' => ['required', 'array', 'min:1'],
        ];

        if ($this->getMethod() == 'POST') {
            $rules += ['password' => 'required', 'string', 'min:8', 'confirmed'];
            $rules += ['email' => 'required', 'string', 'email', 'max:255', 'unique:users'];
        }

        return $rules;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     */
    public function messages()
    {
        return [
            'name.required' => 'Required field. Please enter a name',
            'surname.required' => 'Required field. Please enter a surname.',
            'id_number.required' => 'Required field. Please enter an ID Number.',
            'mobile_number.required' => 'Required field. Please enter a mobile number.',
            'date_of_birth.required' => 'Required field. Please enter a date of birth.',
            'email.required' => 'Required field. Please enter an email address.',
            'language.required' => 'Required field. Please select a language.',
            'interests.required' => 'Required field. Please select an interest',
            'password.required' => 'Required field. Please enter a password.',
            'id_number.digits' => 'ID Number should be 13 digits/numerical characters',
            'mobile_number.digits' => 'Mobile Number should be 10 digits/numerical characters',
            'name.max' => 'Maximum allowed characters for the name field is 255',
            'surname.max' => 'Maximum allowed characters for the name field is 255',
            'email.unique' => 'A user with this email address has already been captured on the application',
            'email.email' => 'The email address entered is not a valid email address',
            'interests.min' => 'At least one interest needs to be selected. It is a required field',
            'password.min' => 'Password needs to be at least 8 characters long',
            'password.confirm' => 'Password and password confirmation does not match',
            'date_of_birth.date_format' => 'Must be a valid date',
        ];
    }
}
