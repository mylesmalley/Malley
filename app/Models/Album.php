<?php

/*
 *
 *
 *
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Album extends BaseModel implements HasMedia
{
	use NodeTrait;
    use InteractsWithMedia;

	/**
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * @var string
	 */
	public $table = "albums";

	/**
	 * @var array
	 */
	protected $fillable = [
		'name',
		"public",
        'search_string'
	];

//	    public function setNameAttribute( string $name )
//    {
//        $this->attributes['name'] = $this->cleanName( $name );
//    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function photos()
	{
		return $this->hasMany('App\Models\Media');
	}


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function topphotos()
    {
        return $this->hasMany('App\Models\Media', 'model_id','id')->limit(6);
    }


//
//	private function cleanName( string $name ) : string
//	{
//		return str_replace([' ','_'],'-', $name );
//
//	}

	/**
	 * @return string
	 */
	public function mediaUrl(): string
	{
		return "https://blueprint.malleyindustries.com/media/" . $this->id;
	}


//	public function setFileNameAttribute( string $name )
//	{
//		$this->attributes['file_name'] = $this->cleanName( $name );
//	}
}
