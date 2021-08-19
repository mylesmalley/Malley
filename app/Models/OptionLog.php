<?php

namespace App\Models;

use \App\Models\BaseModel;


/**
 * App\Models\OptionLog
 *
 * @property int $id
 * @property string $type
 * @property string|null $message
 * @property int $user_id
 * @property int $option_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Option $option
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|OptionLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OptionLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OptionLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|OptionLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OptionLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OptionLog whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OptionLog whereOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OptionLog whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OptionLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OptionLog whereUserId($value)
 * @mixin \Eloquent
 */
class OptionLog extends BaseModel
{
    protected $table = "option_logs";

    protected $fillable = [
    	"type",
    	"message",
    	"user_id",
    	"option_id",
    ];

    // protected $dateFormat = "Y-m-d H:i:s.u";

    public function option()
    {
    	return $this->belongsTo('\App\Models\Option');
    }


    public function user()
    {
    	return $this->belongsTo('\App\Models\User');
    }

    public function setTypeAttribute( $value )
    {
    	$this->attributes['type'] = strtoupper( $value );
    }
}
