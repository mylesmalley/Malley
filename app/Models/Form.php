<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Form extends BaseModel
{
	/**
	 * @var string
	 */
	protected $table = "forms";

	/**
	 * @var array
	 */
	protected $fillable= [
		'name',
		'visibility',
        'base_van_id',
		'order',
		'standard_blueprint_form', // a column that decides if a
        // form should include the regular saving functionality. if false, return the sub view as is
	];

	/**
	 * @var array
	 */
	protected $dates = [
		'created_at',
		'updated_at',
	];

	/**
	 * @return BelongsTo
	 */
	public function platform(): BelongsTo
	{
		return $this->belongsTo('App\Models\BaseVan');
	}

	/**
	 * @return HasMany
	 */
	public function elements(): HasMany
	{
		return $this->hasMany('App\Models\FormElement')->orderBy('position','ASC');
	}

	/**
	 * @return string
	 */
	public function route(): string
	{
		return '/basevan/' . $this->base_van_id . '/forms/' . $this->id;
	}


    /**
     * @return BelongsTo
     */
    public function basevan(): BelongsTo
    {
        return $this->belongsTo('App\Models\BaseVan', 'base_van_id', 'id' );
    }
}
