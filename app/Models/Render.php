<?php

namespace App\Models;

use App\Models\BaseModel;

class Render extends BaseModel
{
    protected $fillable = [
        'blueprint_id',
        'template_id',
        'sales_drawing',
        'production_drawing',
    ];

    //  protected $dateFormat = "Y-m-d H:i:s.u";

    public function template()
    {
        return $this->hasOne(\App\Models\Template::class);
    }

    public function blueprint()
    {
        return $this->hasOne(\App\Models\Blueprint::class);
    }
}
