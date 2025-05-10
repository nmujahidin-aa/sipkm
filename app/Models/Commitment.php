<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commitment extends Model
{
    protected $fillable = [
        'proposal_id',
        'leader',
        'member_1',
        'member_2',
        'member_3',
        'member_4',
    ];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
