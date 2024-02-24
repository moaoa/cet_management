<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class Student extends Model
{
    use HasFactory ,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'ref_number',
        'password',
        'email',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'ref_number'=> 'integer',
    ];

    public function lectures(): HasMany
    {
        return $this->hasMany(Lecture::class);
    }
    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'subject_student');
    }
    public function groups():BelongsTo
    {
        return $this->belongsTo(Group::class ,'group_id');
    }
}
