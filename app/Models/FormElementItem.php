<?php
/**
 * Created by PhpStorm.
 * User: MMalley
 * Date: 2018-08-20
 * Time: 12:20 PM
 */

namespace App\Models;
use App\Models\BaseModel;


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