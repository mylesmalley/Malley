<?php

namespace App\Models;

use \App\Models\BaseModel;

/**
 * App\Models\Element
 *
 * @property int $id
 * @property string|null $created_at1
 * @property string|null $updated_at1
 * @property string $type
 * @property string|null $label
 * @property string|null $options
 * @property \App\Models\Sheet $sheet
 * @property int $position
 * @property int $width
 * @property int $height
 * @property string|null $requirement
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $clean_label
 * @property-read mixed $options_formatted
 * @property-read mixed $raw_options
 * @method static \Illuminate\Database\Eloquent\Builder|Element newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Element newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Element query()
 * @method static \Illuminate\Database\Eloquent\Builder|Element whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Element whereCreatedAt1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Element whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Element whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Element whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Element whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Element wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Element whereRequirement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Element whereSheet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Element whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Element whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Element whereUpdatedAt1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Element whereWidth($value)
 * @mixin \Eloquent
 */
class Element extends BaseModel
{
	protected array $fillable= [
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


