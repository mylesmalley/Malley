<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FunnelStatus extends Model
{
	/**
	 * @var bool
	 */
	public $timestaps = false;
	
	/**
	 * @var string
	 */
    protected $table = "funnel_statuses";
	
	/**
	 * @var array
	 */
    protected $fillable = [
    	'name',
    ];
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
    public function opportunities()
    {
    	return $this->hasMany('App\Models\Opportunity', 'funnel_status_id');
    }
}
