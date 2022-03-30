<?php

namespace Modules\Vehicles\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;


class VehicleLocationEmail extends Mailable
{
	use SerializesModels;

	public string $email;
    public Collection $matches;


    /**
     * @param string $email
     * @param Collection $matches
     */
	public function __construct( string $email, Collection $matches )
	{
        $this->email = $email;
        $this->matches = $matches;
	}

    /**
     * @return VehicleLocationEmail
     */
	public function build(  ): VehicleLocationEmail
	{


		return $this
            ->subject("Vehicle Location Report")
			->view('vehicles::mail.vehicle_location_report',[
			    'matches' => $this->matches,
            ]);
	}
}
