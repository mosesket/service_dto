<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class CreateStaffRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // one advantage of FormRequest is that only authorised users can use it... to return true
        // return false;
        // return Auth::check();
        // User::Auth('admin')// Gate::user('can_create');
        return true;
    }

    /**
     * Handle a failed authorization attempt.
     *
     * @throws HttpResponseException
     */
    public function failedAuthorization()
    {
        throw new HttpResponseException(response()->json([
            'status' => 403,
            'message' => 'User are not authorized to perform action.',
        ]));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'department' => 'required',
            'public_2k' => 'integer|required',
            'private_2billion' => 'integer|required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'pls :attribute is required',
            'email.required' => 'user :attribute is required',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'full name',
            'email' => 'email address',
            'public_2k' => 'shared public_2k in Dto',
            'private_2billion' => 'hidden private_2billion in Dto',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 422,
            'message' => 'Validation failed.',
            // 'error' => $validator->errors()->first(),
            'errors' => $validator->errors(),
        ]));
    }
}
