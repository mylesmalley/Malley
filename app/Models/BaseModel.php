<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


/**
 * App\Models\BaseModel
 *
 * @property-write mixed $created_at
 * @property-write mixed $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel query()
 * @mixin \Eloquent
 */
class BaseModel extends Model 
{

    protected $dates = [
        'created_at',
        'updated_at',
    ];

	/**
	 * Get the format for database stored dates.
	 *
	 * @return string
	 */
	public function getDateFormat()
	{
	    return 'Y-m-d H:i:s.u0';
	}

	/**
	 * Convert a DateTime to a storable string.
	 *
	 * @param  \DateTime|int  $value
	 * @return string
	 */
	public function fromDateTime($value)
	{
		//dd ($value);
	    return $value ;
	}
	
	/**
	 * @param $value
	 * @return mixed
	 */
	public function setUpdatedAtAttribute( $value )
	{
	//	dd ( $value );
		// dd($value->format('Y-m-d H:i:s.u')  );
		return $this->attributes['updated_at'] = $value->format('Y-m-d H:i:s.u');
	}
	
	/**
	 * @param $value
	 * @return mixed
	 */
	public function setCreatedAtAttribute( $value )
	{
		return $this->attributes['created_at'] = $value->format('Y-m-d H:i:s.u');
	}




}
