<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{
    protected $table = 'study_programs';
    protected $fillable = [
        'name',
        'short_name',
        'faculty_id',
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

}
