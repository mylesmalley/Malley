<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\LabourFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

/**
 * Class Labour
 *
 * @package App\Models
 * @method static find(mixed $input)
 * @method count()
 * @method static where(string $string, mixed $id)
 * @property int $id
 * @property string $job
 * @property int $user_id
 * @property int|null $department_id
 * @property bool $flagged
 * @property bool $posted
 * @property Carbon $start
 * @property Carbon|null $end
 * @property-read Department|null $department
 * @property-write mixed $created_at
 * @property-write mixed $updated_at
 * @property-read User $user
 * @method static LabourFactory factory(...$parameters)
 * @method static Builder|Labour newModelQuery()
 * @method static Builder|Labour newQuery()
 * @method static Builder|Labour query()
 * @method static Builder|Labour whereDepartmentId($value)
 * @method static Builder|Labour whereEnd($value)
 * @method static Builder|Labour whereFlagged($value)
 * @method static Builder|Labour whereId($value)
 * @method static Builder|Labour whereJob($value)
 * @method static Builder|Labour wherePosted($value)
 * @method static Builder|Labour whereStart($value)
 * @method static Builder|Labour whereUserId($value)
 * @mixin \Eloquent
 */
class Labour extends BaseModel
{
    use HasFactory;

	/**
	 * @var string
	 */
	protected string  $table = "labour";

    protected string $timezone = 'America/Moncton';
	/**
	 * @var array
	 */
	protected array $fillable= [
		'user_id',
		'job',
		'start',
		'end',
        'department_id',
        'flagged', // flagged for review
        'posted', // pushed to syspro?

	];


	public bool $timestamps= false;

//	/**
//	 * @var array
//	 */
//	protected $dates = [
//		'start',
//		'end',
//	];


    /**
     * conditions around certain model events
     */
    protected static function booted()
    {
        // when creating a new labour instance,
        static::creating(function ( Labour $labour ): bool {

            if ( Auth::user() && Auth::user()->can('labour_edit')) return true;

            // don't accept if an active labour record already exists.
            return ! $labour->user->hasActiveLabour;
        });
    }


    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class );
    }


    /**
     * @return Carbon
     */
	public function getStartAttribute(): Carbon
    {
        return Carbon::parse( $this->attributes['start']);
    }


    /**
     * @return Carbon|null
     */
    public function getEndAttribute(): Carbon|null
    {
        if ( $this->attributes['end'] )
        {
            return Carbon::parse( $this->attributes['end']);
        }
        else
        {
            return null;
        }

    }

    /**
     * @return bool
     */
    public function finish(): bool
    {
        if (!$this->attributes['end'])
        {
            $this->attributes['end'] = Carbon::now( $this->timezone )->toIso8601String();;
        }

        return $this->save();
    }


    /**
     * @return bool
     */
    public function toggleFlag(): bool
    {
        $this->attributes['flagged'] = !$this->attributes['flagged'];
        return $this->save();
    }


    /**
     * @return BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class );
    }

//
//	/**
//	 * @return string
//	 */
//	public function getDateFormat()
//	{
//		return 'Y-m-d H:i:s.u0';
//	}
//
//
//
//
//
//	/**
//	 * @param $value
//	 * @return mixed
//	 */
//	public function setStartAttribute( $value = null )
//	{
//		if ($value)
//		{
//			return $this->attributes[ 'start' ] = $value;
//
//		}
//		return $this->attributes[ 'start' ] = now(); // $value->format( 'Y-m-d H:i:s.u' );
//	}
//
//
//	/**
//	 * @param $value
//	 */
//	public function setEndAttribute( $value )
//	{
//		$this->attributes[ 'end' ] = ( $value ) ? $value : null;
//	}
//
//
//
//	public function user()
//	{
//		return $this->belongsTo( 'App\Models\User' )->select([
//			'id', 'first_name','last_name','work_centre',]);
//	}
//
//	/**
//	 * @return float
//	 */
//	public function elapsedTime(): float
//	{
//		$start =  Carbon::createFromTimeString('Y-m-d H:i:s.u0', $this->attributes['start'] );
//		$end = ( $this->attributes['end'] ) ? Carbon::createFromFormat('Y-m-d H:i:s.u0', $this->attributes['end'] ) : Carbon::now();
//		$conc = $this->attributes['concurrent'];
//
//		return ( $start->diffInSeconds ( $end )  ) / $conc;
//	}
//
//	/**
//	 * @return string
//	 */
//	public function getElapsedAttribute()
//	{
//		return number_format( $this->elapsedTime() / 3600, 1 );
//	}
//
//
//	/**
//	 * @return bool
//	 */
//	public function finish()
//	{
//		$this->attributes['end'] = Carbon::now()->format('Y-m-d H:i:s.u0');
//		$this->attributes['elapsed'] = $this->elapsedTime();
//		return $this->save();
//	}
//
//
//	/**
//	 * @return bool
//	 */
//	public function restart()
//	{
//		$this->attributes['end'] = null;
//		$this->attributes['elapsed'] = null;
//		return $this->save();
//	}
//
//
//	/**
//	 * @return string
//	 */
//	public function getStartAttribute()
//	{
////		return Carbon::createFromTimeString('Y-m-d H:i:s.00', $this->attributes['start'] )
////            ->setTimezone('America/Moncton')
////            ->format( "g:i A" );
//
//        return new Carbon( $this->attributes['start'], 'America/Moncton' ); //->format('g:i A');
//	}
//
//
//
//	/**
//	 * @return string
//	 */
//	public function getEndAttribute(): string
//	{
//		return ($this->end()) ? $this->end()->format( "g:i A" ) : "Ongoing";
//	}
//
//	public function end(  )
//	{
//		if ( $this->attributes['end'] )
//		{
//			return Carbon::createFromFormat('Y-m-d H:i:s.u0', $this->getOriginal('end') )
//				->setTimezone('America/Moncton');
//		}
//
//		return null;
//	}
//
//
//    /**
//     * @return string
//     */
//	public function getDateAttribute(): string
//	{
//		return $this->start()->format( "Y-m-d" );
//	}


}
