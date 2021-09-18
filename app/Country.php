<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
    public $timestamps = false;

    protected static function getcountryList() {
        $countries = self::select('country_id', 'country_name')->get()->toArray();
        $data = [];
        foreach($countries as $key => $value){
            $data[$value['country_id']] = $value['country_name'];

        }
        return $data;
    }

}
