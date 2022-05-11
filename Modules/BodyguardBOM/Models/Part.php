<?php

namespace Modules\BodyguardBOM\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Model;

class Part extends Model implements HasMedia
{
    use InteractsWithMedia;

    public $timestamps = false;

    protected $table = 'bg_parts';

    protected $fillable = [
        'id',
        'part_number',
        'description',
    ];


    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            Category::class,
            'bg_category_parts',
            'bg_part_id',
            'bg_category_id',
        );
    }

}
