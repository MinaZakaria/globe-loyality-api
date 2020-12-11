<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ChallengeSubmittion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'points', 'image_url', 'user_id', 'challenge_id', 'status_id', 'comment'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }

    public function challenge()
    {
        return $this->belongsTo('App\Model\Challenge');
    }
}
