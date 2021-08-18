<?php

namespace App\Models;

use \App\Models\BaseModel;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
