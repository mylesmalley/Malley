<?php

namespace App\Models;

use \App\Models\BaseModel;
use Illuminate\Support\Facades\DB;
use Image;
use Storage;
use Cache;

/**
 * App\Models\Drawing
 *
 * @property int $id
 * @property string $name
 * @property int $base_van
 * @property string $path
 * @property string $raw_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $height
 * @property-read mixed $thumbnail_url
 * @property-read mixed $url
 * @property-read mixed $width
 * @property-read \App\Models\BaseVan $platform
 * @method static \Illuminate\Database\Eloquent\Builder|Drawing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Drawing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Drawing query()
 * @method static \Illuminate\Database\Eloquent\Builder|Drawing whereBaseVan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Drawing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Drawing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Drawing whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Drawing wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Drawing whereRawPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Drawing whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Drawing extends BaseModel
{
    protected $table = "drawings";

    protected $fillable = [
    	'name',
    	'path',
    	'base_van',
    ];
    // protected $dates = [
    //     'created_at',
    //     'updated_at',
    // ];

    // protected $dateFormat = "Y-m-d H:i:s.u";

    public function platform()
    {
    	return $this->belongsTo('\App\Models\BaseVan');
    }

//    public function setNameAttribute( $value )
//    {
//        return $this->attributes['name'] = strtoupper( $value );
//    }

    public function getNameAttribute()
    {
        return strtoupper($this->attributes['name']);
    }


    public function getUrlAttribute()
    {
        return url('/drawing/'.$this->id );
    }




    public function getThumbnailUrlAttribute()
    {
        return url('/drawing/'.$this->id.'/thumbnail' );
    }


    public function getHeightAttribute()
    {
        $path = $this->path;
        $height = Cache::remember("drawing-{$this->id}-height", 14400, function () use ($path) {
            $contents = Storage::disk('drawings')
                            ->get( $path);
            return Image::make( $contents )->height();
        });
        return $height;
    }

    public function getWidthAttribute()
    {
        $path = $this->path;
        $width = Cache::remember("drawing-{$this->id}-width", 14400, function () use ($path) {
            $contents = Storage::disk('drawings')
                            ->get( $path );
            return Image::make( $contents )->width();
        });
        return $width;
    }

}
