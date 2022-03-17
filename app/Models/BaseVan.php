<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Template;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class BaseVan extends BaseModel implements HasMedia
{
    use InteractsWithMedia;

    /**
     * database table
     * @var string
     */
    protected $table = 'base_vans';

    /**
     * mass assignable form fields
     * @var array
     */
    protected $fillable = [
        'name',
        'option_prefix',
        'visibility',
        'thumbnail',
        'categories',
    ];

    protected $casts = [
        'thumbnail' => 'string',
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
        return $this->elements->whereIn('type', ['images', 'floorLayout']);
    }

    public function options()
    {
        return $this->hasMany(\App\Models\Option::class)
                    ->orderBy('option_name', 'ASC');
    }

    public function sheets()
    {
        return $this->hasMany(\App\Models\Sheet::class);
    }

    public function drawings()
    {
        return $this->hasMany(\App\Models\Drawing::class);
    }

    /**
     * @return HasManyThrough
     */
    public function drawingElements(): HasManyThrough
    {
        return $this->hasManyThrough(\App\Models\FormElement::class,
            \App\Models\Form::class,
            'base_van_id',
            'form_id',
            'id')
            ->where('type', 'images');
    }

    public function templates()
    {
        return $this->hasMany(
            \App\Models\Template::class,
            'base_van',
            'id')
            ->orderBy('order', 'ASC');
    }

    public function layouts()
    {
        return $this->hasMany(\App\Models\Layout::class);
    }

    public static function layoutMenu(bool $withBlank = true):array
    {
        $output = [];

        //
        if ($withBlank) {
            $output['None'][null] = 'None';
        }

        $all = self::with('layouts')->get();

        foreach ($all as $item) {
            $layouts = $item->layouts;
            foreach ($layouts as $layout) {
                $output[$item->name][$layout->id] = $layout->name;
            }
        }

        return $output;
    }

    public function getThumbnailImageAttribute()
    {
        return "<img alt='thumbnail' src='".$this->attributes['thumbnail']."' width='100' height='100'  />";
    }

    public function thumbnailImage($width = 100)
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
        return $this->hasMany(\App\Models\Form::class)
            ->orderBy('order', 'ASC');
    }
}
