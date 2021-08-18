<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LayoutOptionRequest extends FormRequest
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
            'layout_id'=>'integer|required',
            'x_pos'=>'numeric',
            'y_pos'=>'numeric',
            'qty'=>'numeric',
            'option_id'=>'integer|required',
        ];



        switch($this->method())
        {
            case 'POST':
            {
                $post = [
                  //  "name"  => 'required|max:50',
            //        "name" => "required|max:30;unique:layouts,name",
          //          'base_van_id' => 'integer|required',

                ];
                return array_merge($shared, $post);
            }
            case 'PATCH':
            {
                $patch = [
                    "id"  => 'required',
              //      "name"  => 'required|max:50',
                ];
                return array_merge($shared, $patch);
            }
            default:
                break;
        }

    }
}
