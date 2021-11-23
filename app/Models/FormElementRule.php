<?php
/**
 * Created by PhpStorm.
 * User: MMalley
 * Date: 2018-08-20
 * Time: 12:20 PM
 */

namespace App\Models;
use App\Models\BaseModel;


/**
 * App\Models\FormElementRule
 *
 * @property int $id
 * @property int $form_element_id
 * @property string|null $options
 * @property string $operator
 * @property-read \App\Models\FormElement $formElement
 * @property-write mixed $created_at
 * @property-write mixed $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FormElementRule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FormElementRule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FormElementRule query()
 * @method static \Illuminate\Database\Eloquent\Builder|FormElementRule whereFormElementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormElementRule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormElementRule whereOperator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormElementRule whereOptions($value)
 * @mixin \Eloquent
 */
class FormElementRule extends BaseModel
{
	/**
	 * @var string
	 */
    protected string  $table = 'form_element_rules';

	/**
	 * @var array
	 */
    protected array $fillable=
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
    public bool $timestamps= false;

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
