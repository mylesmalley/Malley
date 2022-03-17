<?php

namespace App\Models;

class MediaTag extends BaseModel
{
    protected $table = 'media_tags';

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
