<?php

namespace App\Models;

use App\Models\BaseModel;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * Class WarrantyClaim
 * @package App\Programs\WarrantyClaim\Models
 */
class WarrantyClaim extends BaseModel implements HasMedia
{
    use InteractsWithMedia;


    protected $table = "warranty_claims";

    protected $fillable = [
    	'first_name',
	    'last_name',
	    'email',
	    'phone',
	    'organization',
	    'make',
	    'model',
	    'year',
	    'mileage',
	    'vin',
	    'date',
	    'issue',
	    'pin',

        'notes' // added 2020-10-16
    ];

	/**
	 * @param string $vin
	 * @return string
	 */
    public function setVinAttribute( string $vin )
    {
    	return $this->attributes['vin'] = strtoupper( $vin );
    }


    public function vehicle()
    {
        return $this->belongsTo('App\Models\Vehicle',
            'vin',
            'vin');
    }
}
