<?php

namespace App\Models;

use \App\Models\BaseModel;
use Illuminate\Support\Facades\DB;
use Image;
use Storage;
use Cache;


class Drawing extends BaseModel
{
    protected string $table = "drawings";

    protected array $fillable = [
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
