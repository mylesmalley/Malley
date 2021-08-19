<?php

namespace App\Models;

use App\Models\BaseModel;

/**
 * App\Models\Form
 *
 * @mixin \Eloquent
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property int $id
 * @property int $base_van_id
 * @property string $name
 * @property bool $visibility
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $order
 * @property bool $standard_blueprint_form
 * @property string $form_type
 * @property-read \App\Models\BaseVan $basevan
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FormElement[] $elements
 * @property-read int|null $elements_count
 * @property-read \App\Models\BaseVan $platform
 * @method static \Illuminate\Database\Eloquent\Builder|Form newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Form newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Form query()
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereBaseVanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereFormType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereStandardBlueprintForm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereVisibility($value)
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
