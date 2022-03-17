<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Blueprint;
use Illuminate\Support\Facades\DB;
use Purifier;

// use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Template
 *
 * @property int $id
 * @property int $page_id
 * @property int $base_van
 * @property bool $visibility
 * @property string $name
 * @property string $template
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $sales_drawing
 * @property bool $production_drawing
 * @property bool $pdf
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Option[] $options
 * @property-read int|null $options_count
 * @property-read \App\Models\BaseVan $platform
 * @method static \Illuminate\Database\Eloquent\Builder|Template newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Template newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Template query()
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereBaseVan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template wherePdf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereProductionDrawing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereSalesDrawing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereVisibility($value)
 * @mixin \Eloquent
 */
class Template extends BaseModel //implements Auditable
{
    // version handling
    //  use \OwenIt\Auditing\Auditable;

    /**
     * @var string
     */
    protected $table = 'templates';

    /**
     * @var array
     */
    protected $fillable = [
        'base_van',
        'name',
        'page_id',
        'visibility',
        'template',
        'order',
        'sales_drawing',
        'production_drawing',
        'pdf',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'visibility' => 'boolean',
    ];

    /**
     * @var array
     */
    private $selectedOptions = [];

    /**
     * @param array $options
     */
    public function setSelectedOptions(array $options)
    {
        $this->selectedOptions = $options;
    }

//    private $aws = "https:://www.aws.com/";
//
//    public function setAwsUrl( string $aws )
//    {
//        $this->aws = $aws;
//    }
//

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function options()
    {
        return $this->belongsToMany(
            "App\Models\Option",
            'template_options'
            );
    }

    /**
     * [platform description]
     * @return [type] [description]
     */
    public function platform()
    {
        return $this->belongsTo(
            '\App\Models\BaseVan',
            'base_van');
    }

//    public function setTemplateAttribute ( ?string $template  )
//    {
//        $this->attributes['template'] = Purifier::clean( $template );
//    }
//

    /**
     * returns a collection of options that match active configuration items in the blueprint
     *
     * @return mixed
     */
    public function optionsToShow()
    {
        $allBlueprintOptions = array_flip(array_keys($this->selectedOptions));

        $optionsToShow = $this->options->keyBy('option_name');

        return $optionsToShow->intersectByKeys($allBlueprintOptions);
    }

    /**
     * Takes a base van id and returns the most current templates for it
     * @param  int    $baseVan
     * @return Illuminate\Database\Eloquent\Collection
     */
//    public static function current( int $baseVan )
//    {
//        $ids = Template::select(DB::raw("page_id, MAX(id) as id"))
//            ->where('base_van', $baseVan )
//            ->groupBy('page_id')
//            ->pluck('id')
//            ->toArray();
//        return Template::find( $ids );
//    }

    /**
     * @param string $append
     * @return string
     */
    public function url(string $append = ''): string
    {
        return "/basevan/{$this->base_van}/templates/{$this->id}/{$append}";
    }

    //	/**
//	 * @return string
//	 */
//	public function getNameAttribute() : string
//	{
//		if ( $this->attributes['pdf'] )
//		{
//			return $this->attributes['name'] . ' *';
//		}
//		return $this->attributes['name'];
//	}
}
