<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \App\Models\Opportunity;
use \Carbon\Carbon;
class MonthlyBudget extends Model
{
	/**
	 * @var array
	 */
	protected $fillable = [
		"month",
		"budget_ambulance",
		"budget_mobility",
		"budget_commercial",
		"budget_plastics",
		"budget_refurbished",
		"budget_other",
		"usd_exchange_rate",
	];
	
	/**
	 * @var array
	 */
	protected $budgets = [
		"budget_ambulance",
		"budget_mobility",
		"budget_commercial",
		"budget_plastics",
		"budget_refurbished",
		"budget_other",
	];
	
	/**
	 * @var string
	 */
	protected $table = "monthly_budgets";
	
	/**
	 * @var bool
	 */
	public $timestamps = false;
	
	protected $casts = [
		'month' => 'date',
	];
	
	
	/**
	 * Gets the jobs with production completion dates within a given month.
	 *
	 * @return mixed
	 */
	public function jobs()
	{
		$date = new Carbon( $this->month );
		
		return Opportunity::where('funnel_status_id', 50)
				->whereMonth('production_completion_date', $date->month )
				->with('category')
				->orderBy('production_completion_date','ASC')
				->get();
	}
	
	/**
	 * @return int
	 */
	public function getTotalBudgetAttribute()
	{
		$tot = 0;
		foreach( $this->budgets as $budget )
		{
			$tot += $this->attributes[ $budget ];
		}
		return $tot;
	}
	
	
}
