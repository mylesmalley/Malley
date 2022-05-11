<?php

namespace Modules\BodyguardBOM\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements HasMedia
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

    /**
     * @return BelongsToMany
     */
    public function parts(): BelongsToMany
    {
        return $this->belongsToMany(
            Part::class,
            'bg_category_parts',
            'bg_category_id',

            'bg_part_id',

        );
    }




}
