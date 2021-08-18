<?php

namespace App\Models;


class OptionTag extends BaseModel
{

    protected $table = "option_tags";

    public $timestamps = false;

    protected $fillable = [
    	'option_id',
	    'id',
	    'tag_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function options( )
    {
    	return $this->hasManyThrough('App\Models\Option', 'option_tags' );
    }
}
