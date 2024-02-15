<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lecture extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start_time',
        'end_time',
        'day_of_week',
        'subject_class_room_group_teacher_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'start_time' => 'timestamp',
        'end_time' => 'timestamp',
        'subject_class_room_group_teacher_id' => 'integer',
    ];

    public function subjectClassRoomGroupTeacher(): BelongsTo
    {
        return $this->belongsTo(SubjectClassRoomGroupTeacher::class);
    }
}
