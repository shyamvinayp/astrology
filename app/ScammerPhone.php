<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ScammerPhone extends Model
{
    use Notifiable;

    protected $table = 'scammer_phones';

    /**
     * @var string[]
     */
    protected $fillable = [
        'phone_number', 'scam_type','call_date', 'notes', 'status', 'scam_verified', 'recording_verification'
    ];

	public static function getrandomNumber($limit = 16){
        $code = '';
        for($i = 0; $i < $limit; $i++) { $code .= mt_rand(0, 9); }
        return $code;
    }

}
