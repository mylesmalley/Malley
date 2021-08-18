<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Opportunity extends Model
{
	/**
	 * @var string
	 */
	protected $table = "opportunities";

	/**
	 * @return string
	 */
	public function getDateFormat()
	{
		return 'Y-m-d H:i:s.u0';
	}


	/**
	 * @var array
	 */
	protected $fillable = [
		"description",
		"customer",
		"user_id",
		"company_id",
		"base_van_id",
		"blueprint_id",
		"funnel_status_id",
		"syspro_job_number",
		"created_at",
		"updated_at",
		"salesperson_number",
		"value",
		"chance_of_success",
		"labour_hours",
		"quantity",
		"paid",
		"currency",
		"chassis_order_date",
		"chassis_arrival_date",
		"material_needed_date",
		"material_order_date",
		"production_start_date",
		"production_completion_date",
		"shipping_date",
		"expected_win_date",
		"production_priority",
		"department_id",
	];

	/**
	 * @var array
	 */
	protected $casts = [
		"chassis_order_date" => "date",
		"chassis_arrival_date" => "date",
		"material_needed_date" => "date",
		"material_order_date" => "date",
		"production_start_date" => "date",
		"production_completion_date" => "date",
		"shipping_date" => "date",
		"expected_win_date" => "date",
	];

	/**
	 * @var array
	 */
	public static $mpsDates = [
		"chassis_order_date",
		"chassis_arrival_date",
		"material_needed_date",
		"material_order_date",
		"production_start_date",
		"production_completion_date",
		"shipping_date",
		"expected_win_date",
	];


	/**
	 * @return array
	 */
	public function dates(): array
	{
		$output = [];
		for ( $i = 0; $i < count( self::$mpsDates ); $i++  )
		{
			if ( $this->attributes[ self::$mpsDates[$i] ] )
			{
				$output[ strtotime( $this->attributes[ self::$mpsDates[$i] ] ) + $i ] = [
					"date",
					$this->attributes[ self::$mpsDates[$i] ],
					ucwords( str_replace('_',' ', self::$mpsDates[$i]) )
				];
			}
		}
		ksort( $output );
		return $output;
	}


	/**
	 * @return BelongsTo
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo( 'App\Models\User', 'user_id' );
	}

	/**
	 * @return BelongsTo
	 */
	public function status(): BelongsTo
	{
		return $this->belongsTo( 'App\Models\FunnelStatus', 'funnel_status_id' );
	}

	/**
	 * @return BelongsTo
	 */
	public function blueprint(): BelongsTo
	{
		return $this->belongsTo( 'App\Models\Blueprint', 'blueprint_id' );
	}

	/**
	 * @return BelongsTo
	 */
	public function category(): BelongsTo
	{
		return $this->belongsTo( 'App\Models\BaseVan', 'base_van_id' );
	}

	/**
	 * @return BelongsTo
	 */
	public function dealer(): BelongsTo
	{
		return $this->belongsTo('App\Models\Company', 'company_id');
	}

	/**
	 * @return BelongsTo
	 */
	public function department(): BelongsTo
	{
		return $this->belongsTo('App\Models\Department');
	}


	/**
	 * @return HasMany
	 */
	public function notes(): HasMany
	{
		return $this->hasMany('App\Models\OpportunityNote')
			->orderBy('created_at','DESC');
	}


	/**
	 * @return array
	 */
	public static function dateColumns() : array
	{
		return self::$mpsDates;
	}


	/**
	 * @return array
	 */
	private function colour(): array
	{
		$red = ( $this->id * 315 ) % 255;
		$green = ( $this->id * 558 ) % 255;
		$blue = ( $this->id * 292 ) % 255;
		$intensity = (($red*0.299 + $green*0.587 + $blue*0.114) > 186) ? false : true;

		return [$red, $green, $blue, $intensity];
	}


	/**
	 * @return string
	 */
	public function backgroundColour(): string
	{
		$parts = $this->colour();
		return "rgb({$parts[0]}, {$parts[1]}, {$parts[2]})";
	}


	/**
	 * @return string
	 */
	public function textColour(): string
	{
		$text = $this->colour();
		return ( $text[3] ) ? "#ffffff" : "#000000";
	}

}
