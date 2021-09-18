<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SofiaGateway extends Model
{
    protected $table = 'sofia_gateways';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sg_sofia_id', 'sg_gateway_name', 'param:proxy','param:realm', 'param:username', 'param:password','param:register','param:expiry_sec',
        'param:retry_sec','param:ping','param:from-domain','param:from-user','param:caller-id-in-from','param:register-transport','var:dtmf_type','tbl_connection_id','max_concurrent_call',
        'sg_created_on','sg_deleted_on','var:absolute_codec_string','sofia_gateway_port','sofia_gateway_status','sofia_gateway_prefix','tbl_user_id'
    ];

}
