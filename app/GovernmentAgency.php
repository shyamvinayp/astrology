<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GovernmentAgency extends Model
{
    protected $table = 'government_agencies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agency_name', 'contact_name', 'contact_email', 'contact_phone', 'email_report_scam',
    ];

}
