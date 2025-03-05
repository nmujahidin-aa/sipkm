<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Belmawa extends Model
{
    protected $table = 'belmawas';
    protected $fillable = [
        'user_id',
        'username',
        'password',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
