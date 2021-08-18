<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LightPod
 *
 * @package App\Models
 */
class LightPod extends Model
{
	/**
	 * @var string
	 */
    protected $table = 'light_pods';
	
	/**\
	 * @var array
	 */
    protected $fillable = [
    	'blueprint_id',
	    'data',
	    'instructions',
    ];
	
	/**
	 * @var bool
	 */
    public $timestamps = false;
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function blueprint()
    {
    	return $this->belongsTo('App\Models\Blueprint');
    }
}
