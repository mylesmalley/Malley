<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\OpportunityNoteCategory
 *
 * @property int $id
 * @property string $category
 * @property string|null $badge_style
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OpportunityNote[] $notes
 * @property-read int|null $notes_count
 * @method static \Illuminate\Database\Eloquent\Builder|OpportunityNoteCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OpportunityNoteCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OpportunityNoteCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|OpportunityNoteCategory whereBadgeStyle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpportunityNoteCategory whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpportunityNoteCategory whereId($value)
 * @mixin \Eloquent
 */
class OpportunityNoteCategory extends Model
{
	/**
	 * @var string
	 */
	protected string  $table = "opportunity_note_categories";
	
	/**
	 * @var array
	 */
	protected array $fillable= [
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
