<?php
/**
 * Created by PhpStorm.
 * User: MMalley
 * Date: 2018-08-20
 * Time: 12:20 PM
 */

namespace App\Models;
use App\Models\BaseModel;


class FormElementRule extends BaseModel
{
	/**
	 * @var string
	 */
    protected $table = 'form_element_rules';

	/**
	 * @var array
	 */
    protected $fillable =
    [
        'form_element_id',
	    'options',
	    'operator',
    ];


//	/**
//	 * @return string
//	 */
//    public function getOptionsAttribute(): string
//    {
//    	return str_replace('"',"'",$this->attributes['options'] );
//    }
//

	/**
	 * @var bool
	 */
    public $timestamps = false;

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function formElement()
    {
    	return $this->belongsTo('App\Models\FormElement');
    }


	/**
	 * @return mixed
	 */
    public function getOptions()
    {
        $options = json_decode( $this->options );
        return \App\Models\Option::whereIn('option_name', $options)
            ->where('obsolete', false)
            ->orderBy('revision')
	        ->get()
	        ->pluck('option_name','id');

    }



    /**
     * @return mixed
     */
    public function ruleOptions()
    {
        $options = json_decode( $this->options );
        return \App\Models\Option::whereIn('option_name', $options)
            ->where('obsolete', false)
            ->orderBy('revision')
            ->get();

    }




}
