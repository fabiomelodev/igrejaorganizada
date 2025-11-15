<?php

namespace App\Models;

use App\Models\ModelBase;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Member extends ModelBase
{
    protected $casts = [
        'date' => 'datetime',
        'status' => 'boolean'
    ];

    public function lessons(): BelongsToMany
    {
        return $this->belongsToMany(Lesson::class, 'lesson_students', 'member_id', 'lesson_id');
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }
}
