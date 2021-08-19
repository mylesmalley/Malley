<?php

namespace App\Models;

use \App\Models\BaseModel;

/**
 * App\Models\BlueprintLog
 *
 * @property int $id
 * @property string $type
 * @property string|null $message
 * @property int $user_id
 * @property int $blueprint_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Blueprint $blueprint
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|BlueprintLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlueprintLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlueprintLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|BlueprintLog whereBlueprintId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlueprintLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlueprintLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlueprintLog whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlueprintLog whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlueprintLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlueprintLog whereUserId($value)
 * @mixin \Eloquent
 */
class BlueprintLog extends BaseModel
{
    protected $table = "blueprint_logs";

    protected $fillable = [
    	"type",
    	"message",
    	"user_id",
    	"blueprint_id",
    ];


    public function blueprint()
    {
    	return $this->belongsTo('\App\Models\Blueprint');
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
