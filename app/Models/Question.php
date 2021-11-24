<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;


class Question extends BaseModel
{
    use NodeTrait;
	
	public $timestamps= false;

	protected $fillable= [
		'question',
        'category',
		'layout_id',
		'visible',
	];

	public function layout()
	{
		return $this->belongsTo('\App\Models\Layout');
	}


}
