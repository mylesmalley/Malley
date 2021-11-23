<?php

namespace App\Models;


/**
 * App\Models\MediaTag
 *
 * @property int $id
 * @property int $media_id
 * @property int $tag_id
 * @property-write mixed $created_at
 * @property-write mixed $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|MediaTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MediaTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MediaTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|MediaTag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaTag whereMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaTag whereTagId($value)
 * @mixin \Eloquent
 */
class MediaTag extends BaseModel
{

    protected $table = "media_tags";

    public $timestamps = false;

    protected $fillable = [
    	'media_id',
	    'id',
	    'tag_id',
    ];

//    /**
//     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
//     */
//    public function options( )
//    {
//    	return $this->hasManyThrough('App\Models\Option', 'option_tags' );
//    }
}
