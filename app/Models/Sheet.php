<?php

namespace App\Models;

use \App\Models\BaseModel;
use App\Models\Elements;
use Illuminate\Support\Facades\DB;



class Sheet extends BaseModel
{

    protected $table = "sheets";

    protected $fillable = [
    	"name",
    	"special_instructions",
    	"prerequisite",
	    "base_van_id",
	    "special", // form should not use regular blueprint option handling
        'visibility',
    ];

	/**
	 * @return mixed
	 */
    public function components()
    {
    	return $this->hasMany('\App\Models\Element');
    }

	/**
	 * @return mixed
	 */
    public function base_van()
    {
        return $this->belongsTo("\App\Models\BaseVan");
    }

    public function platform()
    {
    	return $this->base_van();
    }

	/**
	 * @return mixed
	 */
    public function elements()
    {
        $elements = DB::table('elements')
                        ->where('sheet', $this->id )
                        ->get();

        return $elements;
    }

	/**
	 * @return string
	 */
    public function elementOptions()
    {
        $elements = $this->elements();

        $options = [];

        foreach ($elements as $element)
        {
            if ($element->type == 'selection')
            {
                $options = array_merge($options, explode(',', $element->options));
            }
        }

        // format as javascript object
        $formatted = "['".implode("','", $options)."']";

        return $formatted;
    }





}
