<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Model\User;

class Challenge extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'image_url', 'program_id', 'is_active', 'created_by', 'second_prize', 'third_prize'
    ];

    protected $casts = [
        'is_active' => 'bool',
    ];

    public function winners()
    {
        return $this->belongsToMany(User::class, 'winner_challenge', 'challenge_id', 'winner_id');
    }
}
