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
            'day_of_week' => ['required', 'string', 'max:100'],
            'subject_class_room_group_teacher_id' => ['required', 'integer', 'exists:subject_class_room_group_teachers,id'],
        ];
    }
}
