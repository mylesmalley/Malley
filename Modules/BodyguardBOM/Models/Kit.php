<?php

namespace Modules\BodyguardBOM\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Model;

class Kit extends Model implements HasMedia
{
    use InteractsWithMedia;

    public $timestamps = false;

    protected $table = 'bg_kits';

    protected $fillable = [
        'id',
        'part_number',
        'description',
        'chassis',
        'roof_height',
        'colour',
        'kit_code', // type of kit - liner, liner with e-track
        'category', // BGK / BGC
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
