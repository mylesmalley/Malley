<?php

namespace App\Models;

use \App\Models\BaseModel;

class Contact extends BaseModel
{
	protected $fillable = [
		"name",
		"contact_type",
		"company",
		"title",
		"name_token",
		"address_1",
		"address_2",
		"city",
		"province",
		"country",
		"postal_code",
		"phone",
		"cell",
		"fax",
		"email",
	];

//     protected $dates = [
//         'created_at',
//         'updated_at',
//     ];

//     protected $dateFormat = "Y-m-d H:i:s.u";
// s

	public function getIdentifierAttribute(): string
	{
		return $this->attributes['name'] ?? $this->attributes['company'];
	}


    public function vehicles()
    {
    	return $this->belongsToMany('App\Models\Vehicle','vehicle_contact');
    }

    public function getContactTypeAttribute()
    {
    	return ucwords(str_replace('_', ' ', $this->attributes['contact_type']));
    }

    public function getNumbersAttribute()
    {
    	return implode(', ' , $this->vehicles()->pluck('malley_number')->toArray() );
    }

}
