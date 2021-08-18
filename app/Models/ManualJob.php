<?php

namespace App\Models;

use App\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class ManualJob extends BaseModel
{
	/**
	 * @var string
	 */
	protected $table = "manual_jobs";

	/**
	 * @var array
	 */
	protected $fillable = [
		'id',
		'job',
		'description',
		'available_from',
		'available_until',
	];

	/**
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * @param string $string
	 * @return mixed
	 */
	public function setJobAttribute( string $string )
	{
		$this->attributes[ 'job' ] = strtoupper( $string );
		return $this->attributes[ 'job' ];
	}

	public static function search( string $string )
	{
		return DB::table('manual_jobs')
			->select(['job AS Job','description AS JobDescription'])
			->where('job','like',"{$string}%")
			->whereDate('available_from','<=', today() )
			->whereDate('available_until','>=', today() )
			->get();
	}

	public function getAvailableFromAttribute()
	{
		return Carbon::createFromFormat("Y-m-d H:i:s.u0", $this->attributes['available_from'] )->format('Y-m-d');
	}

	public function getAvailableUntilAttribute()
	{
		return Carbon::createFromFormat("Y-m-d H:i:s.u0", $this->attributes['available_until'])->format('Y-m-d');
	}

}
