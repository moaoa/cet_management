<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'subject',
        'class_room',
        'group',
        'teacher_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'subject'=> 'integer',
        'class_room' => 'integer',
        'group' => 'integer',
        'teacher_id' => 'integer',
        'start_time' => 'timestamp',
        'end_time' => 'timestamp',
    ];
    
    public function subject(): HasOne
    {
        return $this->hasOne(Subject::class);
    }

    public function teacher(): HasOne
    {
        return $this->hasOne(Teacher::class);
    }

    public function classRoom(): HasOne
    {
        return $this->hasOne(ClassRoom::class);
    }

    public function group(): HasOne
    {
        return $this->hasOne(Group::class);
    }

    
}
