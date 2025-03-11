<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProposalReview extends Model
{
    protected $table = 'proposal_reviews';
    protected $fillable = [
        'proposal_id',
        'reviewer_id',
        'title',
        'status',
        'comment',
        'feedback',
        'file',
    ];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }
}
