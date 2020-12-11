<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'image_url', 'program_id', 'is_active', 'created_by'
    ];

    protected $casts = [
        'is_active' => 'bool',
    ];
}
