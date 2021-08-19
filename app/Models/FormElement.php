<?php

namespace App\Models;

use App\Models\BaseModel;

/**
 * App\Models\FormElement
 *
 * @property int $id
 * @property int $form_id
 * @property string $type
 * @property string|null $label
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $position
 * @property string|null $option_id_requirement
 * @property int|null $indent
 * @property string|null $comments
 * @property-read \App\Models\Form $form
 * @property-read string $affected_options_j_s_o_n
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FormElementItem[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\FormElementRule|null $rule
 * @method static \Illuminate\Database\Eloquent\Builder|FormElement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FormElement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FormElement query()
 * @method static \Illuminate\Database\Eloquent\Builder|FormElement whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormElement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormElement whereFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormElement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormElement whereIndent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormElement whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormElement whereOptionIdRequirement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormElement wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormElement whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormElement whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
