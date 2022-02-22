<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class FormElementItem extends BaseModel
{
	/**
	 * @var string
	 */
	protected $table = "form_element_items";
	
	/**
	 * @var array
	 */
	protected $fillable= [
		'option_id',
		'media_id',
		'form_element_id',
		'position',
	];
	
	
	/**
	 * @return BelongsTo
	 */
	public function formElement(): BelongsTo
	{
		return $this->belongsTo(FormElement::class);
	}


    /**
     * @param Blueprint $blueprint
     * @return Configuration
     */
	public function blueprintConfiguration( Blueprint $blueprint ):  Configuration
    {
        return Configuration::where('blueprint_id', '=', $blueprint->id )
            ->where('option_id', '=', $this->attributes['option_id'])
            ->first();
    }

	
	
	/**
	 * @return BelongsTo
	 */
	public function option(): BelongsTo
	{
		return $this->belongsTo(Option::class );
	}
	
	
	/**
	 * @return BelongsTo
	 */
	public function media(): BelongsTo
	{
		return $this->belongsTo(Media::class );
	}
	
	
	/**
	 * @return string
	 */
	public function route(): string
	{
		return '/basevan/' . $this->base_van_id . '/forms/' . $this->id;
	}
}