<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Folder extends BaseModel implements HasMedia
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
    protected $table = 'folders';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
    ];
}
