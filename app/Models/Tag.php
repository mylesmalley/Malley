<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Tag extends Model
{
    /**
     * @var string
     */
    protected $table = "tags";


    /**
     * @var array
     */
    protected $fillable = [
        'vin',
        'name',
    ];


    public $timestamps = false;

    protected function vehicles()
    {
        return $this->belongsToMany('App\Models\Vehicle',
            'vehicle_tags')->orderBy('malley_number');
    }




}
