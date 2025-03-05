<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    protected $fillable = [
        'is_registration_open',
        'is_proposal_submission_open',
        'proposal_submission_year'
    ];
    public $timestamps = true;
}
