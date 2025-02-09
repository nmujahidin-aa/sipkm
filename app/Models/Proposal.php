<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $table = 'proposals';
    protected $fillable = [
        'title',
        'leader_id',
        'faculty_id',
        'status',
        'file',
        'team_name',
        'scheme',
        'created_at',
        'updated_at',
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function studyProgram()
    {
        return $this->belongsTo(StudyProgram::class);
    }

    public function members()
    {
        return $this->hasMany(Member::class)->where('role_in_team', 'member');
    }

    public function proposalMembers()
    {
        return $this->hasMany(Member::class);
    }
    public function advisor()
    {
        return $this->hasOne(Member::class)->where('role_in_team', 'advisor');
    }

    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }
}
