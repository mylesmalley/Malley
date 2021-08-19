<?php
/**
 * Created by PhpStorm.
 * User: MMalley
 * Date: 2018-08-20
 * Time: 12:20 PM
 */

namespace App\Models;
use App\Models\BaseModel;


/**
 * App\Models\FormElementItem
 *
 * @property int $id
 * @property int $form_element_id
 * @property int|null $option_id
 * @property int|null $media_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $position
 * @property-read \App\Models\FormElement $formElement
 * @property-read \App\Models\Media|null $media
 * @property-read \App\Models\Option|null $option
 * @method static \Illuminate\Database\Eloquent\Builder|FormElementItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FormElementItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FormElementItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|FormElementItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormElementItem whereFormElementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormElementItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormElementItem whereMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormElementItem whereOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormElementItem wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormElementItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FormElementItem extends BaseModel
{
	/**
	 * @var string
	 */
	protected $table = "form_element_items";
	
	/**
	 * @var array
	 */
	protected $fillable = [
		'option_id',
		'media_id',
		'form_element_id',
		'position',
	];
	
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function formElement()
	{
		return $this->belongsTo('App\Models\FormElement');
	}
	
	
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
	public function media()
	{
		return $this->belongsTo('App\Models\Media');
	}
	
	
	/**
	 * @return string
	 */
	public function route(): string
	{
		//return '/basevan/' . $this->base_van_id . '/forms/' . $this->id;
	}
}