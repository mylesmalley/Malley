<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomLayout extends BaseModel
{

    public bool $timestamps = true;

    public string $table = "custom_layouts";

    public array $fillable = [
        "blueprint_id",
        "name",
        "layout",
    ];


    /**
     * @return BelongsTo
     */
    public function blueprint(): BelongsTo
    {
        return $this->belongsTo(Blueprint::class );
    }


}
