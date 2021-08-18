<?php

namespace App\Models;

use App\Models\BaseModel;

class FormElement extends BaseModel
{
	protected $table = "form_elements";

	protected $fillable = [
		'label',
		'type',
        'form_id',
		'option_id_requirement',
        'indent',
		'position',
	];

	protected $dates = [
		'created_at',
		'updated_at',
	];


	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function form()
	{
		return $this->belongsTo( 'App\Models\Form' );
	}


	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function items()
	{
		return $this->hasMany( 'App\Models\FormElementItem' );
	}


	public function rule()
	{
		return $this->hasOne('App\Models\FormElementRule', 'form_element_id');
	}


	/**
	 * @return array
	 */
	public function affectedOptions(): array
	{
		$options = [];
		$items = $this->items;
		foreach ($items as $item)
		{
			$options[] = $item->option->option_name;
		}
		return $options;
	}


	/**
	 * @return string
	 */
	public function getAffectedOptionsJSONAttribute(): string
	{
		return '["'. implode('","', $this->affectedOptions() ).'"]';
	}



	/**
	 * @return string
	 */
	public function route(): string
	{
		//return '/basevan/' . $this->base_van_id . '/forms/' . $this->id;
	}
}
