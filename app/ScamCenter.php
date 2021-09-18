<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScamCenter extends Model
{
    protected $table = 'scam_centers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name', 'contact_name', 'address', 'country_id', 'city', 'state', 'zip', 'phone', 'email', 'skype', 'ip_address',
        'paypal_address', 'scam_type', 'media_ips', 'customer_reported_scam',
    ];

}
