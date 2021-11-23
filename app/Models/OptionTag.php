<?php

namespace App\Models;


/**
 * App\Models\OptionTag
 *
 * @property int $id
 * @property int $option_id
 * @property int $tag_id
 * @property-write mixed $created_at
 * @property-write mixed $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OptionTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OptionTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OptionTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|OptionTag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OptionTag whereOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OptionTag whereTagId($value)
 * @mixin \Eloquent
 */
class OptionTag extends BaseModel
{

    protected string  $table = "option_tags";

    public $timestamps= false;

    protected $fillable= [
    	'option_id',
	    'id',
	    'tag_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function options( )
    {
    	return $this->hasManyThrough('App\Models\Option', 'option_tags' );
    }
}
