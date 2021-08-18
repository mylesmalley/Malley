<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class OptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $shared = [
        	"nameIdentifier"    => "required|string|max:7",
	        "nameRevision"  => "string|max:3",
	        "namePrefix"    => "string|max:3",
            "option_description"     => 'required|max:100',
            "option_short_description"  => 'max:25',
            "option_syspro_phantom" => 'nullable|alpha_dash|max:30', 
        //    "option_positive_requirements"=> 'nullable|string',
          //  "option_negative_requirements"=> 'nullable|string',
            "option_price_tier_1"    => 'numeric',
            "option_price_tier_2"    => 'required|numeric',
	        "option_price_tier_3"    =>  'required|numeric',
	        "option_price_dealer_offset"    =>  'numeric',
	        "option_price_msrp_offset"    =>  'numeric',
//	        "option_price_tier_1"    => 'required|numeric',
//	        "option_price_tier_2"    => 'required|numeric',
//	        "option_price_tier_3"    =>  'required|numeric',
//
            "option_labour_qty"    =>  'numeric',
            "option_labour_cost"    =>  'numeric',
            "option_value"           => 'required|boolean',
            "option_long_lead_time"    => 'required|boolean',
	        "option_show_on_quote"     => 'required|boolean',
	        "blueprint_only"     => 'required|boolean',
	        
	        // notes
	        "blueprint_notes" => "nullable|string|max:1000",
	        "engineering_notes" => "nullable|string|max:1000",
	        "drawing_notes" => "nullable|string|max:1000",
        ];





        switch($this->method())
        {
            case 'POST':
            {
                $post = [
                   "base_van_id"     => 'required|integer',
                    "option_name" => [
                        'required',
                        Rule::unique('options')->where(function ($query ){
                            return $query->where('base_van_id', $this->base_van_id );
                        })
                    ],


              //      'required|max:30|unique:options,option_name',
                ];
                return array_merge($shared, $post);
            }
            case 'PATCH':
            {
                $patch = [

                ];
                return array_merge($shared, $patch);
            }
            default:
                break;
        }
    }
}
