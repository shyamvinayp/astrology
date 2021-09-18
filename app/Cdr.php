<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Cdr extends Authenticatable
{
    use Notifiable;


    protected $table = 'tbl_cdr';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];


}
