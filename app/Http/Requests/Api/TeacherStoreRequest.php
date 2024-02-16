<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class TeacherStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required','string','max:255','unique:students'],
            'ref_number' => ['required', 'integer' ,'min:0','unique:students'],
            'password' => ['required','confirmed', Rules\Password::defaults()],
            'phone_number'=>['nullable','string','max:15'],
        ];
    }
}
