<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FunnelStatus
 *
 * @property int $id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Opportunity[] $opportunities
 * @property-read int|null $opportunities_count
 * @method static \Illuminate\Database\Eloquent\Builder|FunnelStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FunnelStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FunnelStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|FunnelStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FunnelStatus whereName($value)
 * @mixin \Eloquent
 */
class FunnelStatus extends Model
{
	/**
	 * @var bool
	 */
	public $timestaps = false;
	
	/**
	 * @var string
	 */
    protected string  $table = "funnel_statuses";
	
	/**
	 * @var array
	 */
    protected array $fillable= [
    	'name',
    ];
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
    public function opportunities()
    {
    	return $this->hasMany('App\Models\Opportunity', 'funnel_status_id');
    }
}
