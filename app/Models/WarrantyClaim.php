<?php

namespace App\Models;

use App\Models\BaseModel;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * Class WarrantyClaim
 *
 * @package App\Programs\WarrantyClaim\Models
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property string $email
 * @property string|null $organization
 * @property string $make
 * @property string $model
 * @property int $year
 * @property int $mileage
 * @property string $vin
 * @property string $date
 * @property string $issue
 * @property string $pin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $vehicle_id
 * @property string|null $notes
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\App\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \App\Models\Vehicle $vehicle
 * @method static \Illuminate\Database\Eloquent\Builder|WarrantyClaim newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WarrantyClaim newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WarrantyClaim query()
 * @method static \Illuminate\Database\Eloquent\Builder|WarrantyClaim whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarrantyClaim whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarrantyClaim whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarrantyClaim whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarrantyClaim whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarrantyClaim whereIssue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarrantyClaim whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarrantyClaim whereMake($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarrantyClaim whereMileage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarrantyClaim whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarrantyClaim whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarrantyClaim whereOrganization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarrantyClaim wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarrantyClaim wherePin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarrantyClaim whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarrantyClaim whereVehicleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarrantyClaim whereVin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarrantyClaim whereYear($value)
 * @mixin \Eloquent
 */
class WarrantyClaim extends BaseModel implements HasMedia
{
    use InteractsWithMedia;


    protected $table = "warranty_claims";

    protected $fillable = [
    	'first_name',
	    'last_name',
	    'email',
	    'phone',
	    'organization',
	    'make',
	    'model',
	    'year',
	    'mileage',
	    'vin',
	    'date',
	    'issue',
	    'pin',

        'notes' // added 2020-10-16
    ];

	/**
	 * @param string $vin
	 * @return string
	 */
    public function setVinAttribute( string $vin )
    {
    	return $this->attributes['vin'] = strtoupper( $vin );
    }


    public function vehicle()
    {
        return $this->belongsTo('App\Models\Vehicle',
            'vin',
            'vin');
    }
}
