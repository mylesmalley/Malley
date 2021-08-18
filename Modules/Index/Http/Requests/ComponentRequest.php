<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class ComponentRequest extends FormRequest
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
        //    'component_stock_code'=>'string|alpha_dash|max:30|nullable',
            'component_sub_assembly'=>'string|max:30|nullable',
            'component_description'=>'required|string|max:30',
            'component_long_description'=>'string|max:30|nullable',
            'component_part_category'=>'string|max:30|nullable',
            'component_material_qty'=>"numeric|nullable", 
            'component_material_cost'=>"numeric|nullable",
         //   'component_labour_qty'=>"numeric|nullable",
       //     'component_labour_cost'=>"numeric|nullable",
            "component_unit_of_measure"=>"string|max:10",
            'component_revision'=>"string|max:30|nullable",
            'component_item_code'=>"string|max:30|nullable",
            'component_where_built_location'=>"string|max:30|nullable",
            'component_install_area'=>"string|max:30|nullable",
	        'component_notes'=>"string|nullable",
	        'component_price_category'=>"string|max:1|required",
        ];



        switch($this->method())
        {
            case 'POST':
            {
                $post = [
                  "component_stock_code" => [
                        'required',
                        'string',
                        'alpha_dash',
                        Rule::unique('components')->where(function ($query){
                            return $query->where('option_id', $this->option_id );
                        })
                    ],
                ];
                return array_merge($shared, $post);
            }
            case 'PATCH':
            {
                $patch = [
                    "id"  => 'required',
                ];
                return array_merge($shared, $patch);
            }
            default:
                break;
        }

    }
}
