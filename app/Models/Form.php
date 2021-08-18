<?php

namespace App\Models;

use App\Models\BaseModel;

/**
 * @mixin \Eloquent
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Form extends BaseModel
{
	/**
	 * @var string
	 */
	protected $table = "forms";

	/**
	 * @var array
	 */
	protected $fillable = [
		'name',
		'visibility',
        'base_van_id',
		'order',
		'standard_blueprint_form', // a column that determins if a form should include the regular saving functionality. if false, return the sub view as is
	];

	/**
	 * @var array
	 */
	protected $dates = [
		'created_at',
		'updated_at',
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function platform()
	{
		return $this->belongsTo('App\Models\BaseVan');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function elements()
	{
		return $this->hasMany('App\Models\FormElement');
	}

	/**
	 * @return string
	 */
	public function route(): string
	{
		return '/basevan/' . $this->base_van_id . '/forms/' . $this->id;
	}


    public function basevan()
    {
        return $this->belongsTo('App\Models\BaseVan', 'base_van_id', 'id' );
    }
}
