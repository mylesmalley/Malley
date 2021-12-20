<?php

namespace Modules\Vehicles\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class ChassisHereEmail extends Mailable
{
	use SerializesModels;

	public string $email;
    public array $chassis;


    /**
     * @param string $email
     * @param array $chassis
     */
	public function __construct( string $email, array $chassis )
	{
        $this->email = $email;
        $this->chassis = $chassis;
	}

    /**
     * @return ChassisHereEmail
     */
	public function build(  ): ChassisHereEmail
	{


		return $this
            ->subject("Chassis at Malley's Today")
			->view('vehicles::mail.chassis_here_email',[
			    'chassis' => $this->chassis,
            ]);
	}
}
