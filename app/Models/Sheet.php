<?php

namespace App\Models;

use \App\Models\BaseModel;
use App\Models\Elements;
use Illuminate\Support\Facades\DB;



/**
 * App\Models\Sheet
 *
 * @property int $id
 * @property string $name
 * @property string|null $special_instructions
 * @property int $base_van_id
 * @property bool $visibility
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $special
 * @property-read \App\Models\BaseVan $base_van
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Element[] $components
 * @property-read int|null $components_count
 * @method static \Illuminate\Database\Eloquent\Builder|Sheet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sheet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sheet query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sheet whereBaseVanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sheet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sheet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sheet whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sheet whereSpecial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sheet whereSpecialInstructions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sheet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sheet whereVisibility($value)
 * @mixin \Eloquent
 */
class Sheet extends BaseModel
{

    protected string  $table = "sheets";

    protected array $fillable= [
    	"name",
    	"special_instructions",
    	"prerequisite",
	    "base_van_id",
	    "special", // form should not use regular blueprint option handling
        'visibility',
    ];

	/**
	 * @return mixed
	 */
    public function components()
    {
    	return $this->hasMany('\App\Models\Element');
    }

	/**
	 * @return mixed
	 */
    public function base_van()
    {
        return $this->belongsTo("\App\Models\BaseVan");
    }

    public function platform()
    {
    	return $this->base_van();
    }

	/**
	 * @return mixed
	 */
    public function elements()
    {
        $elements = DB::table('elements')
                        ->where('sheet', $this->id )
                        ->get();

        return $elements;
    }

	/**
	 * @return string
	 */
    public function elementOptions()
    {
        $elements = $this->elements();

        $options = [];

        foreach ($elements as $element)
        {
            if ($element->type == 'selection')
            {
                $options = array_merge($options, explode(',', $element->options));
            }
        }

        // format as javascript object
        $formatted = "['".implode("','", $options)."']";

        return $formatted;
    }





}
