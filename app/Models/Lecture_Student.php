<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lecture_Student extends Model
{
    use HasFactory;

    protected $table ='lecture_student';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lecture_id',
        'subject_id',
        'student_id',
        'status',
        'note',
        'date'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'student_id' => 'integer',
        'lecture_id' => 'integer',
        'subject_id' => 'integer',

    ];

}
