<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OptionRule extends Model
{
	
	/**
	 * @var string
	 */
    protected $table = 'option_rules';
	
	/**
	 * @var bool
	 */
    public $timestamps = false;
	
	/**
	 * @var array
	 */
    protected $fillable = [
        'option_id',
	    'rule_type',
	    'related_option_id'
    ];
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function option()
    {
    	return $this->belongsTo('App\Models\Option');
    }
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function relatedOption()
    {
	    return $this->belongsTo('App\Models\Option', 'related_option_id');
    }
	
	
	/**
	 * @return array
	 */
    public static function ruleTypes(): array
    {
    	return [
		    "" => "",
		    "MUST" => "Must be selected",
		//    "CAN" => "Can be selected",
		    "CANT" => "Can't be selected",
		    "ONEA" => "One from this group (A)",
		    "ONEB" => "One from this group (B)",
		    "ONEC" => "One from this group (C)",
	    ];
    }
}
