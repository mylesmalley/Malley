<?php

namespace App\Models;

use \App\Models\BaseModel;

class Element extends BaseModel
{
	protected $fillable = [
		'sheet',
		'label',
		'type',
		'options',
        'width',
        'height',
        'requirement',
        'position',
	];
    // protected $dates = [
    //     'created_at',
    //     'updated_at',
    // ];

    // protected $dateFormat = "Y-m-d H:i:s.u";

	/**
	 * 
	 */
    public function sheet()
    {
    	return $this->belongsTo('\App\Models\Sheet','id','form');
    }



    public function setOptionsAttribute( $input )
    {
        $options = explode(PHP_EOL, $input);
        $options = array_map("trim",$options);
        $str = implode(',', $options);
    	$this->attributes['options'] = strtoupper($str);
    }

    public function getOptionsAttribute()
    {
    	$str = str_replace(',', PHP_EOL, $this->attributes['options']);
    	return $str;
    }


    

    public function getRawOptionsAttribute()
    {
        return $this->attributes['options'];
    }




    public function getOptionsFormattedAttribute()
    {
        $str = str_replace(',', "<br />", $this->attributes['options']);
        return $str;
    }

    public function friendlyOptions()
    {
        $str = str_replace('<br />', PHP_EOL, $this->attributes['options']);
        return $str;
    }

    public function csvOptions()
    {
    	//$str = str_replace(',', PHP_EOL, $this->attributes['options']);
    	return $this->attributes['options'];
    }


    public function getCleanLabelAttribute()
    {
        $string = str_replace(' ', '-', $this->attributes['label']); 
        // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); 
        // Removes special chars.

        $string = preg_replace('/-+/', '-', $string); 

        return strtolower($string);

    }




}


