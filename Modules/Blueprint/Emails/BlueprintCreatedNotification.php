<?php

namespace Modules\Blueprint\Emails;

use App\Models\Blueprint;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Spatie\MediaLibrary\MediaCollections\Models\Media;



class BlueprintCreatedNotification extends Mailable
{
    use Queueable, SerializesModels;


    protected Blueprint $blueprint;

    /**
     * Create a new message instance.
     *
     * @param Blueprint $blueprint
     */
    public function __construct( Blueprint $blueprint )
    {
        $this->blueprint = $blueprint;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this
            ->from('blueprint@blueprint.malleyindustries.com')
            ->subject("{$this->blueprint->user->first_name} from {$this->blueprint->user->company->name} has created a new Blueprint")
            ->view('blueprint::blueprint.email.newBlueprintCreatedNotification', ['blueprint'=> $this->blueprint]);
    }
}
