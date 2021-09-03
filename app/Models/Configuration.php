<?php

namespace App\Models;
//
//use \App\Models\BaseModel;
//use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;


/**
 * App\Models\Configuration
 *
 * @property int $id
 * @property int $blueprint_id
 * @property string $name
 * @property string|null $description
 * @property int $base_van_id
 * @property string|null $syspro_phantom
 * @property string $cost
 * @property float $price_tier_1
 * @property float $price_tier_2
 * @property float $price_tier_3
 * @property bool $value
 * @property string|null $positive_requirements
 * @property string|null $negative_requirements
 * @property bool $long_lead_time
 * @property bool $show_on_quote
 * @property bool $light_component
 * @property bool $locked
 * @property int $location
 * @property int|null $option_id
 * @property string|null $fingerprint
 * @property int $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property float $price_base_offset
 * @property float $price_dealer_offset
 * @property float $price_msrp_offset
 * @property string|null $notes
 * @property bool $retired
 * @property int|null $revision
 * @property bool|null $obsolete
 * @property-read \App\Models\Blueprint $blueprint
 * @property-read bool $is_current
 * @property-read \App\Models\Option|null $option
 * @method static Builder|Configuration newModelQuery()
 * @method static Builder|Configuration newQuery()
 * @method static Builder|Configuration query()
 * @method static Builder|Configuration whereBaseVanId($value)
 * @method static Builder|Configuration whereBlueprintId($value)
 * @method static Builder|Configuration whereCost($value)
 * @method static Builder|Configuration whereCreatedAt($value)
 * @method static Builder|Configuration whereDescription($value)
 * @method static Builder|Configuration whereFingerprint($value)
 * @method static Builder|Configuration whereId($value)
 * @method static Builder|Configuration whereLightComponent($value)
 * @method static Builder|Configuration whereLocation($value)
 * @method static Builder|Configuration whereLocked($value)
 * @method static Builder|Configuration whereLongLeadTime($value)
 * @method static Builder|Configuration whereName($value)
 * @method static Builder|Configuration whereNegativeRequirements($value)
 * @method static Builder|Configuration whereNotes($value)
 * @method static Builder|Configuration whereObsolete($value)
 * @method static Builder|Configuration whereOptionId($value)
 * @method static Builder|Configuration wherePositiveRequirements($value)
 * @method static Builder|Configuration wherePriceBaseOffset($value)
 * @method static Builder|Configuration wherePriceDealerOffset($value)
 * @method static Builder|Configuration wherePriceMsrpOffset($value)
 * @method static Builder|Configuration wherePriceTier1($value)
 * @method static Builder|Configuration wherePriceTier2($value)
 * @method static Builder|Configuration wherePriceTier3($value)
 * @method static Builder|Configuration whereQuantity($value)
 * @method static Builder|Configuration whereRetired($value)
 * @method static Builder|Configuration whereRevision($value)
 * @method static Builder|Configuration whereShowOnQuote($value)
 * @method static Builder|Configuration whereSysproPhantom($value)
 * @method static Builder|Configuration whereUpdatedAt($value)
 * @method static Builder|Configuration whereValue($value)
 * @mixin \Eloquent
 */
class Configuration extends BaseModel
{

	/**
	 * @var string
	 */
    protected $table = "configurations";

	/**
	 * @var array
	 */
	protected $fillable = [
	    "blueprint_id",
		"name",
		"description",
		"positive_requirements",
		"negative_requirements",
		"base_van_id",
		"syspro_phantom",
	   	"cost",
	   	"price_tier_1",
	    "price_tier_2",
	   	"price_tier_3",
		"price_base_offset", // OLD

		"price_dealer_offset",
		"price_msrp_offset",

	   	"value",
	   	'long_lead_time',
	   	'show_on_quote',
	   	'light_component',
	   	'location',
	   	'locked',
	   	'option_id',
	   	'fingerprint',


        'quantity',

		'notes',

        // comes from if the parent option is retired or not
        'retired',
        'revision',
        'obsolete',

        'lock_pricing', // 2021-09-01 bool, 1 can't be changed with rev, 0, normal behaviour
	];


    /**
     *
     */
    protected static function booted()
    {
        static::saving(function ($configuration) {
            $configuration->setAttribute('fingerprint',  $configuration->fingerprintString()  );
        });
    }



    /**
	 * if the option isn't selected, return 0 regardless. If the option is on, return the quantity
	 * @return int
	 */
	public function physicalQuantity(): int
	{
		if ( $this->value ) return $this->quantity;
		return 0;
	}


	/**
	 * @return int
	 */
	public function increaseQuantity(): int
	{
		if ( $this->attributes['value'] == 0)
		{
			$this->attributes['quantity'] = 1;
			$this->attributes['value'] = 1;
			return 1;
		}

		$this->attributes['quantity'] += 1;
		return $this->attributes['quantity'];
	}

	/**
	 * @return int
	 */
	public function decreaseQuantity(): int
	{
		if ( $this->attributes['quantity'] == 1)
		{
			$this->attributes['value'] = 0;
			return 1;
		}

		$this->attributes['quantity'] -= 1;
		return $this->attributes['quantity'] - 1;
	}


	/**
	 * @return string
	 */
	public function friendlyValue()
	{
		return ($this->attributes['value']) ? 'Yes' : 'No';
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function blueprint()
	{
		return $this->belongsTo("\App\Models\Blueprint");
	}


	/**
	 * @param $value
	 */
    public function setNameAttribute( $value )
    {
    	$prohibited = [' ','_','.',',',"'",'"','&','(',')','$','#','@','*','!','=','+','%','--'];
        $this->attributes['name'] = strtoupper( str_replace( $prohibited , '-', $value ) );
    }


	/**
	 * @param $value
	 */
    public function setDescriptionAttribute( $value )
    {
        $this->attributes['description'] = strtoupper( $value );
    }


	/**
	 * @return string
	 */
    public function fingerprintString()
    {


        $string = $this->name .
            $this->description .
            $this->syspro_phantom .

            round($this->price_tier_3) .
                round( $this->price_tier_2) .
                    round($this->price_tier_1) .
            $this->long_lead_time;


        return $string;
    }


    /**
     * @return bool
     */
    public function getIsCurrentAttribute(): bool
    {
        return ($this->fingerprint === $this->option->fingerprint ) ? true : false;
    }


    /**
     * @return int
     */
	public function getQuantityAttribute(): int
	{
		//return ($this->attributes['quantity'] != null) ? $this->attributes['quantity'] : 1;

        return $this->attributes['quantity'] ?? 1;
	}


	/**
	 * @return string
	 */
	public function getCostAttribute()
	{
		return number_format( (float) $this->attributes['cost'], 2, '.', '');
	}


	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function option()
	{
		return $this->belongsTo('App\Models\Option');
	}


	/**
	 * @param float $exchange
	 * @return float
	 */
	public function MSRPPrice( float $exchange = 1 ): float
	{
        return ( $this->attributes['price_tier_3'] - $this->attributes['price_msrp_offset'] ) * $exchange;

//        return number_format(
//		    ( $this->attributes['price_tier_3'] - $this->attributes['price_msrp_offset'] ) * $exchange,
//            2, '.', '');
	}

	/**
	 * @param float $exchange
	 * @return float
	 */
	public function DealerPrice( float $exchange = 1 ): float
	{
		return ( $this->attributes['price_tier_2'] - $this->attributes['price_dealer_offset'] ) * $exchange;

//        return number_format(
//            ( $this->attributes['price_tier_2'] - $this->attributes['price_msrp_offset'] ) * $exchange,
//            2, '.', '');
	}

	public function resetPrice()
	{
		$option = $this->option;
		$this->price_tier_2 = $option->option_price_tier_2;
		$this->price_tier_3 = $option->option_price_tier_3;
		$this->save();
	}

}
