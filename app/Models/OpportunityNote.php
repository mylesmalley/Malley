<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OpportunityNote extends Model
{
	/**
	 * @var string
	 */
	protected $table = "opportunity_notes";

	/**
	 * @var array
	 */
	protected $fillable = [
		"opportunity_id",
		"user_id",
		"purchase_order",
		"note",
		"note_category_id",
		"created_at",
		"updated_at",
	];

	/**
	 * @return BelongsTo
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo('App\Models\User');
	}

	/**
	 * @return BelongsTo
	 */
	public function opportunity(): BelongsTo
	{
		return $this->belongsTo('App\Models\Opportunity');
	}

	/**
	 * @return BelongsTo
	 */
	public function category(): BelongsTo
	{
		return $this->belongsTo('App\Models\OpportunityNoteCategory','note_category_id');
	}

	/**
	 * @return string
	 */
	public function getDateFormat(): string
	{
		return 'Y-m-d H:i:s.u0';
	}

}
