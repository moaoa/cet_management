<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class LectureStoreRequest extends FormRequest
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
            'start_time' => ['required'],
            'end_time' => ['required'],
            'day_of_week' => ['required', 'integer', 'min:1','max:6'],
            'subject_id' =>['required', 'integer', 'exists:subjects,id'],
            'class_room_id'=>['required', 'integer', 'exists:class_rooms,id'],
            'group_id'=>['required', 'integer', 'exists:groups,id'],
            'teacher_id' => ['required', 'integer', 'exists:teachers,id'],
        ];
    }
}
