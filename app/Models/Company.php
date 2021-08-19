<?php

namespace App\Models;

use \App\Models\BaseModel;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Company
 *
 * @property int $id
 * @property string $name
 * @property string|null $address_1
 * @property string|null $address_2
 * @property string|null $address_3
 * @property string|null $city
 * @property string|null $province
 * @property string|null $country
 * @property string|null $postalcode
 * @property string|null $phone
 * @property string|null $fax
 * @property string|null $website
 * @property string $logo
 * @property string|null $service_address_1
 * @property string|null $service_address_2
 * @property string|null $service_address_3
 * @property string|null $service_city
 * @property string|null $service_province
 * @property string|null $service_country
 * @property string|null $service_postalcode
 * @property string|null $service_phone
 * @property string|null $service_fax
 * @property string|null $service_manager
 * @property string|null $service_email
 * @property string|null $service_technicians
 * @property string|null $service_hours
 * @property string|null $service_emergency
 * @property string|null $service_capabilities
 * @property string|null $service_other
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\App\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\CompanyFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company query()
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereAddress3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereFax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company wherePostalcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereServiceAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereServiceAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereServiceAddress3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereServiceCapabilities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereServiceCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereServiceCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereServiceEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereServiceEmergency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereServiceFax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereServiceHours($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereServiceManager($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereServiceOther($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereServicePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereServicePostalcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereServiceProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereServiceTechnicians($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereWebsite($value)
 * @mixin \Eloquent
 */
class Company extends BaseModel implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;

    protected $fillable = [
    	"name",
    	"address_1",
    	"address_2",
    	"address_3",
    	"city",
    	"province",
    	"country",
    	"postalcode",
    	"phone",
    	"fax",
    	"website",
    	"logo",

        // service
            "service_address_1",
            "service_address_2",
            "service_address_3",
            "service_city",
            "service_province",
            "service_country",
            "service_postalcode",
            "service_phone",
            "service_fax",
            "service_manager",
            "service_email",
            "service_technicians",
            "service_hours",
            "service_emergency",
            "service_capabilities",
            "service_other",

    ];


    /**
     * @return array
     */
    public static function fullList(): array
    {
        return Company::pluck('name','id')->toArray();
    }

    public function users()
    {
    	return $this->hasMany('\App\Models\User');
    }


    public function getLogoAttribute(): string
    {
        // return the id of the dealer logo from the media library
//        if ($this->getMedia('logo')->first())
        if ($this->hasMedia('logo'))
        {
            return "/media/".$this->getMedia('logo')->first()->id;
        }
        // return the generic Dealer logo if no other logo is specified
        return "/media/1415";
    }

    /**
     * RETURNS A BASE-64 ENCODED LOGO IMAGE
     * @param int $width
     * @return string
     */
    public function logo( int $width=250 ): string
    {
        // return the id of the dealer logo from the media library
        if ($this->getMedia('logo')->first())
        {
            $path = $this->getMedia('logo')->first()->getPath();
        }
        else
        {
            $path = "/var/www/blueprint/storage/blueprintv2/Company/1/logo/dealer.png";
        }
        // return the generic Dealer logo if no other logo is specified

        $type = pathinfo( $path , PATHINFO_EXTENSION);
        $data = file_get_contents( $path );
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        return "<img width=\"". $width ."\" src=\"". $base64 ."\" /> ";


    }

}
