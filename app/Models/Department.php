<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\HasMany;

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
