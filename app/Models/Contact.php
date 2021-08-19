<?php

namespace App\Models;

use \App\Models\BaseModel;

/**
 * App\Models\Contact
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $title
 * @property string $company
 * @property string $contact_type
 * @property string $name_token
 * @property string|null $address_1
 * @property string|null $address_2
 * @property string|null $city
 * @property string|null $province
 * @property string|null $country
 * @property string|null $postal_code
 * @property string|null $phone
 * @property string|null $cell
 * @property string|null $fax
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $identifier
 * @property-read mixed $numbers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Vehicle[] $vehicles
 * @property-read int|null $vehicles_count
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCell($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereContactType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereFax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereNameToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
