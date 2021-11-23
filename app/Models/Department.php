<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Department
 *
 * @property int $id
 * @property string $name
 * @property string $colour
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Opportunity[] $opportunities
 * @property-read int|null $opportunities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Department newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Department newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Department query()
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereColour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereName($value)
 * @mixin \Eloquent
 */
class Department extends Model
{
	/**
	 * @var string
	 */
	protected $table = "departments";

	/**
	 * @var array
	 */
	protected $fillable = [
		"id",
		'name',
	];

	/**
	 * @return HasMany
	 */
	public function users(): HasMany
	{
		return $this->hasMany('App\Models\User');
	}

	/**
	 * @return HasMany
	 */
	public function opportunities(): HasMany
	{
		return $this->hasMany('App\Models\Opportunity');
	}
}
