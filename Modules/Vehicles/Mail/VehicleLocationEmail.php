<?php

namespace Modules\Vehicles\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;


class VehicleLocationEmail extends Mailable
{
	use SerializesModels;

	public string $email;
    public Collection $chassis;


    /**
     * @param string $email
     * @param Collection $chassis
     */
	public function __construct( string $email, Collection $chassis )
	{
        $this->email = $email;
        $this->chassis = $chassis;
	}

    /**
     * @return VehicleLocationEmail
     */
	public function build(  ): VehicleLocationEmail
	{


		return $this
            ->subject("Vehicle Location Report")
			->view('vehicles::mail.vehicle_location_report',[
			    'chassis' => $this->chassis,
            ]);
	}
}
