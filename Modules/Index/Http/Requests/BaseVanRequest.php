<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseVanRequest extends FormRequest
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
            'visibility'=>'required|boolean',
        ];



        switch($this->method())
        {
            case 'POST':
            {
                $post = [
               //     "name"  => 'required|max:30',
                    "name" => "required|max:30|unique:base_vans,name",
                ];
                return array_merge($shared, $post);
            }
            case 'PATCH':
            {
                $patch = [
                    "id"  => 'required',
                    "name"  => 'required|max:30',
                ];
                return array_merge($shared, $patch);
            }
            default:
                break;
        }

    }
}
