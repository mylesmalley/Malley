<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayoutOption extends BaseModel
{
    protected $table = 'layout_options';

	protected $fillable = [
		'layout_id',
		'option_id',
		'x_pos',
		'y_pos',
		'qty',
	];


    public function layout()
    {
    	return $this->belongsTo('App\Models\Layout');
    }

    public function option()
    {
    	return $this->belongsTo('App\Models\Option');
    }


}
