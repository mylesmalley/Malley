<?php

namespace App\Models;

use \App\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\Payroll
 *
 * @property int $id
 * @property int $staff_id
 * @property string $start
 * @property string $end
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $elapsed
 * @property bool $locked
 * @property bool $approved
 * @property int|null $error
 * @property bool $on_shift
 * @property bool $group_start
 * @property bool $group_end
 * @property-read mixed $date
 * @property-read \App\Models\Staff $staff
 * @method static \Illuminate\Database\Eloquent\Builder|Payroll newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payroll newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payroll query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payroll whereApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payroll whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payroll whereElapsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payroll whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payroll whereError($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payroll whereGroupEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payroll whereGroupStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payroll whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payroll whereLocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payroll whereOnShift($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payroll whereStaffId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payroll whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payroll whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Payroll extends BaseModel
{
	/**
	 * @var string
	 */
    protected string  $table = "payroll";


	/**
	 * @var array
	 */
    protected $fillable= [
    	'staff_id',
	    'start',
	    'end',
	    'elapsed',
	    'locked',
	    'approved',
	    'error',

	    'on_shift', // bool if the person is on shift when clocked in

	    'group_start',
	    'group_end',
    ];

	/**
	 * @var array
	 */
	protected $dates = [
		'created_at',
		'updated_at',
		'start',
		'end',
	];


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


	/**
	 * @return string
	 */
	public function getDateFormat()
	{
		return 'Y-m-d H:i:s.u0';
	}


	/**
	 * @param $value
	 * @return mixed
	 */
	public function setStartAttribute( $value = null )
	{
		if ($value)
		{
			return $this->attributes[ 'start' ] = $value;

		}
		return $this->attributes[ 'start' ] = now(); // $value->format( 'Y-m-d H:i:s.u' );
	}


	/**
	 * @param $value
	 */
	public function setEndAttribute( $value )
	{
		$this->attributes[ 'end' ] = ( $value ) ? $value : null;
	}


	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function staff()
	{
		return $this->belongsTo( 'App\Models\Staff' );
	}


	/**
	 * @return float
	 */
	public function elapsedTime(): float
	{
		$start =  Carbon::createFromFormat('Y-m-d H:i:s.u0', $this->attributes['start'] );
		$end = ( $this->attributes['end'] ) ? Carbon::createFromFormat('Y-m-d H:i:s.u0', $this->attributes['end'] ) : Carbon::now();

		return  $start->diffInSeconds ( $end );
	}

	/**
	 * @return string
	 */
	public function getElapsedAttribute()
	{
		return number_format( $this->elapsedTime() / 3600, 1 );
	}

	/**
	 * @return bool
	 */
	public function finish()
	{
		$this->attributes['end'] = Carbon::now()->format('Y-m-d H:i:s.u0');
		$this->attributes['elapsed'] = $this->elapsedTime();
		$this->save();
		return $this->splitTimesByShift();

	}


	/**
	 * @return bool
	 */
	public function restart()
	{
		$this->attributes['end'] = null;
		$this->attributes['elapsed'] = jobnull;
		return $this->save();
	}





	/**
	 * @return string
	 */
	public function getStartAttribute()
	{
		return $this->start()->format( "g:i A" );
	}


	public function start(  )
	{
		return Carbon::createFromFormat('Y-m-d H:i:s.u0', $this->attributes['start'] )
			->setTimezone('America/Moncton');
	}


	/**
	 * @return string
	 */
	public function getEndAttribute(): string
	{
		return ($this->end()) ? $this->end()->format( "g:i A" ) : "Ongoing";
	}

	public function end(  )
	{
		if ( $this->attributes['end'] )
		{
			return Carbon::createFromFormat('Y-m-d H:i:s.u0', $this->getOriginal('end') )
				->setTimezone('America/Moncton');
		}
		return null;
	}


	public function getDateAttribute(   )
	{
		$tmp = $this->start()->copy();
		return $tmp->startOfDay();
	//	return $this->start()->startOfDay();
	}


	/**
	 * @param Carbon $date
	 * @param Staff $staff
	 * @return bool
	 */
	public static function regroupTimesOnDay( Carbon $date, Staff $staff )
	{

		$records = Payroll::whereDay('start', $date)
						->where('staff_id', $staff->id )
						->orderBy('start','ASC')
						->get();


		for( $i = 0; $i < count($records ); $i++ )
		{
			$data = $records[ $i ];

			if (  isset($records[$i + 1] ) && ($records[$i]->end === $records[$i + 1]->start ) )
			{
				$data->group_end = 0;
			} else {
				$data->group_end = 1;
			}

			if ( isset($records[$i - 1] ) && ($records[$i - 1]->end === $records[$i]->start ))
			{
				$data->group_start = 0;
			} else {
				$data->group_start = 1;
			}


			if ( $i === 0 )
			{
				$data->group_start = 1;
			}

			if ( $i === count($records) -1)
			{
				$data->group_end = 1;

			}

			$data->save();
		}

		return true;
	}


	/**
	 * Returns all of the payroll records for a given staff member on a given date
	 *
	 * @param Staff $staff
	 * @param Carbon $date
	 * @return mixed
	 */
	public static function payrollRecordsForStaffOnDay( Staff $staff, Carbon $date )
	{
		$date = $date->startOfDay();

		return Payroll::where('staff_id', $staff->id )
			->whereDate( 'start', $date )
			->orderBy( 'start', 'ASC' )
			->with( 'staff' )
			->get();
	}


	/**
	 * Groups the payroll records for a day based on actual start and stop times of records
	 *
	 * @param Staff $staff
	 * @param Carbon $date
	 * @return array
	 */
	public static function groupedPayrollRecordsForStaffOnDay( Staff $staff, Carbon $date )
	{
		$records = Payroll::payrollRecordsForStaffOnDay( $staff, $date );

		$groups = [];

		foreach( $records as $rec )
		{
			// single row group
			if ($rec->group_start && $rec->group_end)
			{
				$groups[] = [$rec];
			}

			// start of a group
			if ($rec->group_start && !$rec->group_end)
			{
				$groups[] = [$rec];
			}

			// end of a group
			if (!$rec->group_start && $rec->group_end)
			{
				array_push( $groups[ count($groups)-1], $rec );
			}

			// middle of a group
			if (!$rec->group_start && !$rec->group_end)
			{
				array_push( $groups[ count($groups)-1], $rec );
			}

		}

		return $groups;
	}





	/**
	 * @return bool
	 * @throws \Exception
	 */
	public function splitTimesByShift()
	{
		//$start = $this->start();
		//return $this->start();

		$start =  $this->start()->copy()->setTimezone("UTC");

		//eturn $start;

		$end = $this->end()->copy();


		$splits = [];

		// save the start time
		$splits[] = $start->copy();


		$shift = $this->staff->shiftTimes( $start->copy() );

		// loup through teh shift times for the day and return the oens that overlap
		foreach ($shift as $shf)
		{
			if ($shf->isBetween($start, $end , false ))
			{
				$splits[] = $shf;
			}
		}
		// append the end time
		$splits[] =  $end->setTimezone('UTC');
		//dd( $splits);

		// return false if the record doesnt' need splitting
	//	if ( count($splits) <= 2) return false;

		$times = [];

		// loop through all o f the stored times and create records for each
		for ( $i = 0; $i < count($splits) -1; $i++) {
			$times[] = [ $splits[ $i ], $splits[ $i + 1 ] ];
			$rec = new Payroll();
			$rec->staff_id = $this->staff_id;

			$rec->attributes[ 'start' ] = $splits[ $i ]->copy()->setTimezone( 'UTC' )->format( 'Y-m-d H:i:s.u0' );
			$rec->attributes[ 'end' ] = $splits[ $i + 1 ]->copy()->setTimezone( 'UTC' )->format( 'Y-m-d H:i:s.u0' );


			$rec->updateOnShift();


			$rec->save();

		}

		$this->regroupTimesOnDay( $this->date, $this->staff );

		$this->delete();

		return true;
	}


	/**
	 * determines if a time is on shift or not and updates accordingly
	 */
	public function updateOnShift()
	{
		$time = Carbon::createFromFormat('Y-m-d H:i:s.u0', $this->attributes['start'], "UTC");

		$this->attributes['on_shift'] = $this->staff->isOnShift( $time );
		$this->attributes['approved'] = ($this->attributes['on_shift']) ? true : false;
		$this->save();

	}



}
