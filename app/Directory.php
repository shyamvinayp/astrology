<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Directory extends Model
{
    protected $table = 'directory';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'domain_id', 'password','cache', 'tbl_user_id', 'directory_type','gateway_name','tbl_connection_id',
        'gateway_username','gateway_password','gateway_proxy','gateway_register','gateway_max_calls'
    ];

}
