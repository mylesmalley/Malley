<?php

namespace App\Models;
//
//use \App\Models\BaseModel;
//use Illuminate\Support\Facades\DB;



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
	public function getQuantityAttribute()
	{
		return ($this->attributes['quantity'] != null) ? $this->attributes['quantity'] : 1;
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
