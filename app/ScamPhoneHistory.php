<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScamPhoneHistory extends Model
{
    protected $table = 'scam_phone_histories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'scam_phone_id', 'user_id', 'message'
    ];

}
