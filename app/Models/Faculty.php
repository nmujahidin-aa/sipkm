<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $table = 'faculties';
    protected $fillable = [
        'name',
        'short_name',
        'color',
    ];

    public function studyPrograms()
    {
        return $this->hasMany(StudyProgram::class);
    }

    public function theme() {
        if (in_array($this->short_name, ['FT', 'FIS', 'FPsi', 'FV'])) {
            return 'light';
        } else {
            return 'dark';
        }
    }
}
