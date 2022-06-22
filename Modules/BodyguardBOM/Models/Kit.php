<?php

namespace Modules\BodyguardBOM\Models;

use Exception;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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


    /**
     * @return HasMany
     */
    public function components(): HasMany
    {
        return $this->hasMany(
            Component::class,
            'bg_kit_id',
            'id',
        );
    }



    /**
     * @return bool
     */
    public function create_phantom_in_syspro(): bool
    {
        try {

            DB::connection('syspro')
                ->update("EXEC dbo.spInsertPhantom
                        @StockCode = ?,
                        @Description = ?,
                        @LongDesc = ? ",
                [
                    $this->attributes['part_number'],
                    substr( $this->attributes['description'], 0, 100), // desc for short desc
                    substr( $this->attributes['description'], 0, 100), // desc for short desc
                ]);
        }
        catch (Exception $e)
        {
            Log::warning("Failed to insert phantom into syspro database kit id {$this->attributes['id']}");
            Log::waring($e);
            return false;
        }

        return true;
    }



//
//EXEC dbo.spInsertPhantomComponent @ParentPart = 'MI-FAM1565', @Component = '10-50000', @QtyPer = '0.57', @CreateSubJob = ‘Y’

}
