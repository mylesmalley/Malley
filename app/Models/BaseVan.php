<?php

namespace App\Models;

use \App\Models\BaseModel;
use \App\Models\Template;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


/**
 * App\Models\BaseVan
 *
 * @property int $id
 * @property string $name
 * @property bool $visibility
 * @property string|null $thumbnail
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $option_prefix
 * @property string $categories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Drawing[] $drawings
 * @property-read int|null $drawings_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Element[] $elements
 * @property-read int|null $elements_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Form[] $forms
 * @property-read int|null $forms_count
 * @property-read mixed $thumbnail_image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Layout[] $layouts
 * @property-read int|null $layouts_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\App\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Option[] $options
 * @property-read int|null $options_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Sheet[] $sheets
 * @property-read int|null $sheets_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Template[] $templates
 * @property-read int|null $templates_count
 * @method static \Illuminate\Database\Eloquent\Builder|BaseVan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseVan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseVan query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseVan whereCategories($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseVan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseVan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseVan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseVan whereOptionPrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseVan whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseVan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseVan whereVisibility($value)
 * @mixin \Eloquent
 */
class BaseVan extends BaseModel implements HasMedia
{
    use InteractsWithMedia;

	/**
	 * database table
	 * @var string
	 */
	protected $table = "base_vans";


	/**
	 * mass assignable form fields
	 * @var array
	 */
	protected $fillable = [
		"name",
		"option_prefix",
        "visibility",
        "thumbnail",
		"categories",
    ];

	protected $casts = [
		'thumbnail' => "string",
	//	'categories' => 'array',
	];

    protected $dates = [
        'created_at',
        'updated_at',
    ];


	/**
	 * @return mixed
	 */
    public function images()
    {
    	return $this->elements->whereIn('type', ['images','floorLayout']);
    }



	public function options()
	{
		return $this->hasMany("\App\Models\Option")
					->orderBy('option_name','ASC');
	}

	public function sheets()
	{
		return $this->hasMany('\App\Models\Sheet');
	}

	public function drawings()
	{
		return $this->hasMany('\App\Models\Drawing');
	}


    /**
     * @return HasManyThrough
     */
	public function drawingElements(): HasManyThrough
	{
		return $this->hasManyThrough('\App\Models\FormElement',
            '\App\Models\Form',
            'base_van_id',
            'form_id',
            'id')
            ->where('type', 'images');
	}





	public function templates()
	{
		return $this->hasMany(
			'App\Models\Template',
			'base_van',
			'id')
			->orderBy('order','ASC');
	}


	public function layouts()
	{
		return $this->hasMany( 'App\Models\Layout' );
	}

	public static function layoutMenu( bool $withBlank = true ):array
	{
		$output = [];

		//
		if ($withBlank)
		{
			$output['None'][null] = "None";
		}

		$all = BaseVan::with('layouts')->get();

		foreach ( $all as $item )
		{
			$layouts = $item->layouts;
			foreach( $layouts as $layout )
			{
				$output[ $item->name ][ $layout->id ] = $layout->name;
			}
		}
		return $output;
	}


	public function getThumbnailImageAttribute( )
	{
		return "<img alt='thumbnail' src='".$this->attributes['thumbnail']."' width='100' height='100'  />";
	}

	public function thumbnailImage( $width = 100 )
	{
		return "<img alt='thumbnail' src='".$this->attributes['thumbnail']."' width='{$width}' height='{$width}'  />";
	}

	/**
	 * @return string
	 */
	public function getOptionPrefixAttribute()
	{
		return ($this->attributes['option_prefix']) ? $this->attributes['option_prefix'] : 'AAA';
	}


	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function forms()
	{
		return $this->hasMany('App\Models\Form')
			->orderBy('order','ASC');
	}
}
