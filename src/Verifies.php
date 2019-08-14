<?php

namespace Urmis\Verifies;

use Illuminate\Database\Eloquent\Model;

class Verifies extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'secret', 'code', 'via', 'receiver', 'for', 'data', 'verified', 'tries', 'max_tries',
        'expires_in', 'exception_code', 'exception',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
    ];
}
