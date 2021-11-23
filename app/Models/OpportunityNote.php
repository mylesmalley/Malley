<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\OpportunityNote
 *
 * @property int $id
 * @property int $opportunity_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $note_category_id
 * @property string $note
 * @property string|null $purchase_order
 * @property-read \App\Models\OpportunityNoteCategory $category
 * @property-read \App\Models\Opportunity $opportunity
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|OpportunityNote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OpportunityNote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OpportunityNote query()
 * @method static \Illuminate\Database\Eloquent\Builder|OpportunityNote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpportunityNote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpportunityNote whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpportunityNote whereNoteCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpportunityNote whereOpportunityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpportunityNote wherePurchaseOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpportunityNote whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpportunityNote whereUserId($value)
 * @mixin \Eloquent
 */
class OpportunityNote extends Model
{
	/**
	 * @var string
	 */
	protected string  $table = "opportunity_notes";

	/**
	 * @var array
	 */
	protected array $fillable= [
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
