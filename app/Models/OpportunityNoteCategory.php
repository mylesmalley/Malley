<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\HasMany;

class OpportunityNoteCategory extends Model
{
	/**
	 * @var string
	 */
	protected $table = "opportunity_note_categories";
	
	/**
	 * @var array
	 */
	protected $fillable = [
		"category",
		'badge_style',
	];
	
	/**
	 * @return HasMany
	 */
	public function notes(): HasMany
	{
		return $this->hasMany('App\Models\OpportunityNote');
	}
}
