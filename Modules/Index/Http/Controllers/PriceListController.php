<?php

namespace Modules\Index\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaseVan;
use App\Models\Option;


class PriceListController extends Controller
{
	protected $markups = [
		"A" => [.4, .5],
		"B" => [0.5, 0.65],
		"C" => [0.15, 0.35],
		"D" => [0.1, 0.2],
		"E" => [0.4, 0.5],
		"L" => [60, 90],
	];

	public function pricelist( BaseVan $basevan )
	{
		$options = Option::query()
				->where('base_van_id', $basevan->id )
				->where('blueprint_only', false)
				->where('show_on_pricelist', true)
				->orderBy('option_name','ASC')
				->get();

		return view( 'sales.pricelist', ['basevan'=>$basevan, 'options'=>$options] );
	}



	public function priceListWithoutOffset( BaseVan $basevan )
	{


		$options = Option::query()
			->where('base_van_id', $basevan->id )
			->where('blueprint_only', false)
			->orderBy('option_name','ASC')
			->with('components')
			->get();

		return view( 'sales.priceWithOffset', [
				'basevan'=>$basevan,
				'markups'=>$this->markups,
				'options'=>$options
		] );
	}

	public function optionPricingForm( BaseVan $basevan, Option $option )
	{
		return view('index::sales.optionPricing',[
			'basevan'=>$basevan,
			'markups'=>$this->markups,
			'option'=>$option
		]);
	}

	public function savePricing( BaseVan $basevan, Option $option, Request $request )
	{
		$request->validate([
			"option_price_tier_1"    => 'required|numeric',
			"option_price_tier_2"    => 'required|numeric',
			"option_price_tier_3"    =>  'required|numeric',
			"option_price_dealer_offset"    =>  'required|numeric',
			"option_price_msrp_offset"    =>  'required|numeric',
		]);

		$option->update( $request->only([
			"option_price_tier_1",
			"option_price_tier_2",
			"option_price_tier_3",
			"option_price_dealer_offset",
			'option_price_msrp_offset',
		]));

		return redirect("/sales/{$option->base_van_id}/option/{$option->nextID}/pricing");

		//return $this->priceListWithoutOffset( $basevan );
	}
}
