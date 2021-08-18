<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class OpportunityLog extends Model
{
	/**
	 * @var string
	 */
	protected $table = "opportunity_logs";

	/**
	 * @var array
	 */
	protected $fillable = [
		'id',
		'user_id',
		'created_at',
		'updated_at',
		'field',
		'old_value',
		'opportunity_id',
		'new_value',
		'note',
	];



	/**
	 * @return string
	 */
	public function getDateFormat()
	{
		return 'Y-m-d H:i:s.u0';
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
	public function user(): BelongsTo
	{
		return $this->belongsTo('App\Models\User');
	}

}
