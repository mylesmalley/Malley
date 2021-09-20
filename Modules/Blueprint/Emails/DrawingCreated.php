<?php

namespace Modules\Blueprint\Emails;

use App\Models\Blueprint;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Spatie\MediaLibrary\MediaCollections\Models\Media;



class DrawingCreated extends Mailable
{
    use Queueable, SerializesModels;


    protected Blueprint $blueprint;
    protected Media $media;

    /**
     * Create a new message instance.
     *
     * @param Blueprint $blueprint
//     * @param Media $media
     */
    public function __construct( Blueprint $blueprint, Media $media )
    {
        $this->blueprint = $blueprint;
        $this->media = $media;
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
            ->subject("Your Drawing for B-{$this->blueprint->id}")
            ->view('blueprint::drawing.email.drawing_created', ['blueprint'=> $this->blueprint])
            ->attachFromStorageDisk('s3', $this->media->getPath() );
    }
}
