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

            Log::info("Created syspro phantom {$this->attributes['part_number']}");
        }
        catch (Exception $e)
        {
            Log::warning("Failed to insert components into syspro phantom {$this->attributes['part_number']}");
            Log::warning($e);
            return false;
        }

        return true;
    }


    /**
     * @return bool
     */
    public function clear_components_from_syspro_phantom(): bool
    {
        try {
            DB::connection('syspro')
                ->update("EXEC dbo.spBomStructClear
                    @ParentPart = ?",[
                    $this->attributes['part_number'],
                ]);

            Log::info("Cleared syspro phantom components on {$this->attributes['part_number']}");
            return true;
        }
        catch (Exception $e)
        {
            Log::warning("removed syspro components for phantom {$this->attributes['part_number']}");
            Log::warning($e);
            return false;
        }

    }


    /**
     * @return bool
     */
    public function push_components_to_syspro(): bool
    {
        try {
            $components = $this->components;

            foreach( $components as $component )
            {
                DB::connection('syspro')
                    ->update("EXEC dbo.spInsertPhantomComponent 
                        @ParentPart = ?, 
                        @Component = ?, 
                        @QtyPer = ?, 
                        @CreateSubJob = 'Y'",[
                        $this->attributes['part_number'],
                        $component->stock_code,
                        $component->quantity,
                    ]);


                Log::info("Added {$component->stock_code} to {$this->attributes['part_number']} in Syspro ");

            }

        }
        catch (Exception $e)
        {
            Log::warning("removed syspro components for phantom {$this->attributes['part_number']}");
            Log::warning($e);
            return false;
        }

        return true;
    }


}
