<?php

namespace App\Models;

use App\Models\BaseModel;

class TemplateOption extends BaseModel
{
    protected $fillable = [
    	'option_id',
	    'template_id',
    ];
	
	public $timestamps = false;

	public $table = "template_options";
	
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function template()
    {
    	return $this->belongsTo('App\Models\Template');
    }
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
    public function option()
    {
    	return $this->hasOne('App\Models\Option');
    }
}
