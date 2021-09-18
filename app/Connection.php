<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Connection extends Authenticatable
{
    use Notifiable;

    protected $table = 'tbl_connection';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tbl_sip_connection_name', 'tbl_user_id', 'tbl_sip_connection_id','tbl_status_type', 'tbl_connection_status', 'tbl_directory_id','tbl_ratecard_id',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'tbl_user_terms' => 'boolean',
    ];

	public static function getConnectionType(){
		return [
            '1' => 'Credentials',
            '2' => 'IP Address',
            '3' => 'URI',
            '4' => 'Forward',
        ];
	}

	public static function getUserStatus(){
		return [
            '1' => 'Active',
            '2' => 'Pending',
            '3' => 'Delete',
            '0' => 'Deactive',

        ];
	}

	public static function getIPSettings() {
        return [
            '1' => 'Tech Prefix',
        ];
    }

	public static function getrandomNumber($limit = 16){
        $code = '';
        for($i = 0; $i < $limit; $i++) { $code .= mt_rand(0, 9); }
        return $code;
    }

    /*public function directories() {
        return $this->hasOne(Directory::class, 'id', 'tbl_connection_id');
    }

    public function sofiaGateway() {
        return $this->hasMany(SofiaGateway::class, 'tbl_connection_id', 'id');
    }*/

    public function did()
    {
        return $this->hasOne(ScammerPhone::class);
    }

}
