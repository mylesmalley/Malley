<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \App\Models\Opportunity;
use \Carbon\Carbon;
/**
 * App\Models\MonthlyBudget
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $month
 * @property int $budget_ambulance
 * @property int $budget_mobility
 * @property int $budget_commercial
 * @property int $budget_plastics
 * @property int $budget_refurbished
 * @property int $budget_other
 * @property float $usd_exchange_rate
 * @property-read int $total_budget
 * @method static \Illuminate\Database\Eloquent\Builder|MonthlyBudget newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MonthlyBudget newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MonthlyBudget query()
 * @method static \Illuminate\Database\Eloquent\Builder|MonthlyBudget whereBudgetAmbulance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonthlyBudget whereBudgetCommercial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonthlyBudget whereBudgetMobility($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonthlyBudget whereBudgetOther($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonthlyBudget whereBudgetPlastics($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonthlyBudget whereBudgetRefurbished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonthlyBudget whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonthlyBudget whereMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonthlyBudget whereUsdExchangeRate($value)
 * @mixin \Eloquent
 */
class MonthlyBudget extends Model
{
	/**
	 * @var array
	 */
	protected $fillable= [
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
	protected string  $table = "monthly_budgets";
	
	/**
	 * @var bool
	 */
	public $timestamps= false;
	
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
