<?php

namespace App\Models;

use App\Models\BaseModel;

/**
 * App\Models\TemplateOption
 *
 * @property int $id
 * @property int $template_id
 * @property int $option_id
 * @property-read \App\Models\Option|null $option
 * @property-write mixed $created_at
 * @property-write mixed $updated_at
 * @property-read \App\Models\Template $template
 * @method static \Illuminate\Database\Eloquent\Builder|TemplateOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TemplateOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TemplateOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|TemplateOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemplateOption whereOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemplateOption whereTemplateId($value)
 * @mixin \Eloquent
 */
class TemplateOption extends BaseModel
{
    protected array $fillable= [
    	'option_id',
	    'template_id',
    ];
	
	public bool $timestamps= false;

	public $table = "template_options";
	
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function template()
    {
    	return $this->belongsTo('App\Models\Template');
    }
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
    public function option()
    {
    	return $this->hasOne('App\Models\Option');
    }
}
