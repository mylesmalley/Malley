<?php

namespace App\Models;

use \App\Models\BaseModel;

/**
 * App\Models\Render
 *
 * @property int $id
 * @property int $blueprint_id
 * @property int $template_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool|null $production_drawing
 * @property bool|null $sales_drawing
 * @property-read \App\Models\Blueprint|null $blueprint
 * @property-read \App\Models\Template|null $template
 * @method static \Illuminate\Database\Eloquent\Builder|Render newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Render newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Render query()
 * @method static \Illuminate\Database\Eloquent\Builder|Render whereBlueprintId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Render whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Render whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Render whereProductionDrawing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Render whereSalesDrawing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Render whereTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Render whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Render extends BaseModel
{
	protected $fillable = [
		"blueprint_id",
		"template_id",
		"sales_drawing",
		"production_drawing",
	];

  //  protected $dateFormat = "Y-m-d H:i:s.u";


    public function template()
    {
    	return $this->hasOne('App\Models\Template');
    }

    public function blueprint()
    {
    	return $this->hasOne('App\Models\Blueprint');
    }
}
