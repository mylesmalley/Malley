<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class Staff extends Authenticatable
{
	use Notifiable;
	
	protected $table = "staff";
	
	protected $username = 'username';
	
	protected $fillable = [
		'first_name',
		'last_name',
		'username',
		'password',
		'login_route',
		'work_centre',
		'enabled',
		'group',
		'pin',

		'day_0_start',
		'lunch_0_start',
		'lunch_0_end',
		'day_0_end',
		
		'day_1_start',
		'lunch_1_start',
		'lunch_1_end',
		'day_1_end',
		
		'day_2_start',
		'lunch_2_start',
		'lunch_2_end',
		'day_2_end',
		
		'day_3_start',
		'lunch_3_start',
		'lunch_3_end',
		'day_3_end',
		
		'day_4_start',
		'lunch_4_start',
		'lunch_4_end',
		'day_4_end',
		
		'day_5_start',
		'lunch_5_start',
		'lunch_5_end',
		'day_5_end',
		
		'day_6_start',
		'lunch_6_start',
		'lunch_6_end',
		'day_6_end',
		
		// total number of concurrent work orders they can use. default is 1
		'max_concurrent_jobs',
		
		// datetime2(7) fields used to help with payroll reports
		"started_employment",
		"ended_employment",
	];
	
	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
	];
	
	
	protected $dates = [
		'created_at',
		'updated_at',
	];
	
	
	/**
	 * Get the format for database stored dates.
	 *
	 * @return string
	 */
	public function getDateFormat()
	{
		return 'Y-m-d H:i:s.u0';
	}
	
	/**
	 * Convert a DateTime to a storable string.
	 *
	 * @param  \DateTime|int $value
	 * @return string
	 */
	public function fromDateTime( $value )
	{
		return $value;
	}
	
	
	public function getWorkCentreAttribute()
	{
		switch ($this->attributes['work_centre'])
		{
			case "A": return "Assembly";
			case "M": return "MetalFab";
			case "P": return "Plastics";
			case "E": return "Electrical";
			default: return "Other";
		}
	}
	
	
	
	/**
	 * @param $value
	 * @return mixed
	 */
	public function setUpdatedAtAttribute( $value )
	{
		return $this->attributes[ 'updated_at' ] = $value->format( 'Y-m-d H:i:s.u' );
	}
	
	/**
	 * @param $value
	 * @return mixed
	 */
	public function setCreatedAtAttribute( $value )
	{
		return $this->attributes[ 'created_at' ] = $value->format( 'Y-m-d H:i:s.u' );
	}
	
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function labour()
	{
		return $this->hasMany( 'App\Models\Labour' );
	}
	
	
	public function day( Carbon $date )
	{
		
		$items = $this->labour()
			->whereDate( 'start', '>=', $date )
			->whereDate( 'end', '<=', $date )
			->get();
		
		
		$store = $date;
		$store->setTimezone('America/Moncton');
		$dayOfWeek = $store->dayOfWeek;
		
		$startTime = "day_{$dayOfWeek}_start";
		$endTime = "day_{$dayOfWeek}_end";
		
		$dayStart = explode(":", $this->$startTime);
		$dayEnd = explode(":", $this->$endTime);
		
		$localStart = Carbon::create($store->year, $store->month, $store->day, $dayStart[0], $dayStart[1], $dayStart[0], 'America/Moncton' );
		$localEnd = Carbon::create($store->year, $store->month, $store->day, $dayEnd[0], $dayEnd[1], $dayEnd[0], 'America/Moncton' );
		
		$shift = [
			"type" => "background",
			"content" => "Shift",
			"start" => $localStart->toIso8601String(),
			"end" => $localEnd->toIso8601String()
		];
		
		$items->push($shift);
		
		return (object) [
			'items' => $items,

			'range_start' => $date->addHours(6)->setTimezone('America/Moncton')->toIso8601String(),
			'range_end' => $date->addHours( 13 )->setTimezone('America/Moncton')->toIso8601String(),
		];
	}
	
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function payroll()
	{
		return $this->hasMany('App\Models\Payroll');
	}
	
	
	/**
	 *
	 */
	public function toggleAccountStatus()
	{
		$this->enabled = !$this->enabled;
		$this->save();
	}
	
	
	/**
	 * @return bool|\Illuminate\Database\Eloquent\Collection
	 */
	public function active()
	{
		$active = $this->labour()->where('end',null)->get();
		if ($active->count() > 0)
		{
			return $active;
		}
		return false;
	}
	
	
	/**
	 * @return bool|\Illuminate\Database\Eloquent\Collection
	 */
	public function payrollClockStatus()
	{
		$active = $this->payroll()
			->where('end',null)
			->first();
		
		if ( $active )
		{
			return $active;
		}
		return false;
	}
	
	/**
	 * @return string
	 */
	public function getEndedEmploymentAttribute()
	{
		return $this->attributes['ended_employment'] ?? Carbon::today()->addYear(25)->format('Y-m-d H:i:s.u0');
	}
	
	
	/**
	 * @return $this
	 */
	public function activeLabour()
	{
		return $this->hasMany('App\Models\Labour')->where('end', null);
	}
	
	/**
	 * @return $this
	 */
	public function activePayroll()
	{
		return $this->hasOne('App\Models\Payroll')->where('end', null);
	}
	
	
	
//	/**
//	 * @param Carbon $now
//	 */
//	public function getOnShiftAttribute( )
//	{
//		$now = Carbon::now()->setTimezone('America/Moncton');
//
//		$dayOfWeek = $now->dayOfWeek;
//
//		$startTime = "day_{$dayOfWeek}_start";
//		$endTime = "day_{$dayOfWeek}_end";
//
//		$dayStart = explode(":", $this->$startTime);
//		$dayEnd = explode(":", $this->$endTime);
//
//		$localStart = Carbon::create($now->year, $now->month, $now->day, $dayStart[0], $dayStart[1], $dayStart[2], 'America/Moncton' );
//		$localEnd = Carbon::create($now->year, $now->month, $now->day, $dayEnd[0], $dayEnd[1], $dayEnd[2], 'America/Moncton' );
//
////		return [
////			$localStart,
////			$localEnd,
////		];
////
//		return $now->between($localStart, $localEnd);
//	}
	
	
	/**
	 * determines if a staff member is on shift when they clock in or for a given time.
	 *
	 * @param Carbon|null $date
	 * @return bool
	 */
	public function isOnShift( Carbon $date = null )
	{
		$day = $date ?? Carbon::now();
		
		$shift = $this->shiftTimes( $day->copy() );
		
		if (count($shift) === 4)
		{
			if ($day->copy()->addMinute(1)->between($shift[0], $shift[1], false) )
			{
				return true;
			}
			if ($day->copy()->addMinute(1)->between($shift[2], $shift[3], false) )
			{
				return true;
			}
		}
		
		if (count($shift) === 2)
		{
			return ($day->copy()->addMinute(1)->between($shift[0], $shift[1]) ) ? true : false;
		}
		
		return false;

	}
	
	
	
	/**
	 * @param Carbon $date
	 * @return array
	 */
	public function shiftTimes( Carbon $date = null ): array
	{
		if ($date)
		{
			$day = $date->setTimezone('America/Moncton')->startOfDay();
		}
		else
		{
			$day = Carbon::now()->setTimezone('America/Moncton')->startOfDay();
		}
		
		$dayOfWeek = $day->dayOfWeek;
		
		$dayStart = "day_{$dayOfWeek}_start";
		$lunchStart = "lunch_{$dayOfWeek}_start";
		$lunchEnd = "lunch_{$dayOfWeek}_end";
		$dayEnd = "day_{$dayOfWeek}_end";
		
		$ds = explode(":", $this->$dayStart);
		$ls = explode(":", $this->$lunchStart);
		$le = explode(":", $this->$lunchEnd);
		$de = explode(":", $this->$dayEnd);
		
		
		
		
		// ignore morning shift
		if ($this->$dayStart === $this->$lunchStart )
		{
			return [
				$day->copy()->addHour($le[0])->addMinute($le[1])->setTimezone('UTC'),
				$day->copy()->addHour($de[0])->addMinute($de[1])->setTimezone('UTC'),
			];
		};
		
		// ignore afternoon shift
		if ( $this->$lunchEnd === $this->$dayEnd )
		{
			return [
				$day->copy()->addHour($ds[0])->addMinute($ds[1])->setTimezone('UTC'),
				$day->copy()->addHour($ls[0])->addMinute($ls[1])->setTimezone('UTC'),
			];
		};
		
		// no shift today
		if ( $this->$lunchEnd === $this->$dayEnd && $this->$dayStart === $this->$lunchStart )
		{
			return [ ];
		};
		
		// don't ignore eitehr shift.
		return [
			$day->copy()->addHour($ds[0])->addMinute($ds[1])->setTimezone('UTC'),
			$day->copy()->addHour($ls[0])->addMinute($ls[1])->setTimezone('UTC'),
			$day->copy()->addHour($le[0])->addMinute($le[1])->setTimezone('UTC'),
			$day->copy()->addHour($de[0])->addMinute($de[1])->setTimezone('UTC'),
		];
	}
	
	
	/**
	 * @return mixed
	 */
	private function activeIDs(  string $work_centre = null  )
	{
		$q = Staff::where('enabled', true)
			->whereIn('group', [1,2]); // group 1 is production staff
		
		if ($work_centre)
		{
			$q->where('work_centre', $work_centre);
		}
		
		return $q->orderBy('last_name')
			->pluck('id')
			->toArray();
	}
	
	/**
	 * @param string|null $work_centre
	 * @return mixed
	 */
	public static function firstAlphabeticalStaff( string $work_centre = null)
	{
		$q =  Staff::where('enabled', true)
			->whereIn('group', [1,2]); // group 1 is production staff
		if ($work_centre)
		{
			$q->where('work_centre', $work_centre);
		}
		
		return $q->orderBy('last_name')
			->first();
	}
	
	/**
	 * @param string|null $filter
	 * @return null
	 */
	public function nextID( string $filter = null )
	{
		$ids = $this->activeIDs( $filter );
		$pos = array_search($this->id, $ids);
		return (array_key_exists($pos + 1,  $ids)) ? $ids[$pos + 1]: null;
	}
	
	
	/**
	 * @param string|null $filter
	 * @return int
	 */
	public function previousID( string $filter = null )
	{
		$ids = $this->activeIDs( $filter );
		$pos = array_search($this->id, $ids);
		return (array_key_exists($pos-1,  $ids)) ? $ids[$pos - 1] : null ;
	}
	
	
	
	
	
}
