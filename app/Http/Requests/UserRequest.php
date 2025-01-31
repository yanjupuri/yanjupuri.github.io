<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class UserRequest extends FormRequest
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
        $method = strtolower($this->method());
        $user_id = $this->route()->user;

        $rules = [];
        switch ($method) {
            case 'post':
                $rules = [
                    'username' => 'unique:users',
                    'password' => 'required|confirmed|min:8',
                    'email' => 'required|max:191|email|unique:users',
                    'phone_number' => 'size:11|unique:users',
                ];
                break;
            // case 'patch':
            //     $rules = [
            //         'password' => 'required|min:8'
            //     ];
            //     break;

        }

        return $rules;
    }

    public function messages()
    {
        return [
            'username.unique' => 'You cannot have more than one account.',
            'password.required' => 'The password field is required.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password.min' => 'The password must be at least 8 characters.',
            'email.required' => 'The email field is required.',
            'email.max' => 'The email must not be greater than 191 characters.',
            'email.email' => 'The email must be a valid email address.',
            'phone_number.size' => 'The phone number must be exactly 11 characters long.',
            'phone_number.unique' => 'The phone number has already been taken.'
        ];
    }

     /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator){
        $data = [
            'status' => true,
            'message' => $validator->errors()->first(),
            'all_message' =>  $validator->errors()
        ];

        if ($this->ajax()) {
            throw new HttpResponseException(response()->json($data,422));
        } else {
            throw new HttpResponseException(redirect()->back()->withInput()->with('errors', $validator->errors()));
        }
    }


}
