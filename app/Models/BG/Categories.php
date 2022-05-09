<?php

namespace App\Models\BG;

use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
//use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Categories implements HasMedia
{
    use NodeTrait;
    use InteractsWithMedia;

    public $timestamps = false;

    protected $table = 'bg_categories';

    protected $fillable = [
        'name',
        'parent_id',
        '_rgt',
        '_lft',
        'id',
    ];




}
