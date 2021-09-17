<?php

namespace Modules\Blueprint\Http\Livewire\Form;

use App\Models\Configuration;
use App\Models\FormElement;
use App\Models\Media;
use Exception;
use Illuminate\Support\Collection;
use Livewire\Component;
use App\Models\Blueprint;
use Illuminate\View\View;


class Image extends Component
{

    public FormElement $element;
    public Collection $media;
    public int $height;
    public int $width;


    /**
     * @param Blueprint $blueprint
     * @param FormElement $element
     */
    public function mount( Blueprint $blueprint, FormElement $element )
    {
        $this->element = $element;

        // grab the form element's options
        $options = $element->items->pluck('media_id', 'position');

        $this->media = Media::whereIn('id', $options)->get();

        if ( $this->media )
        {
            try {
                $sizes = getimagesize( $this->media->first()->cdnUrl() );

                $this->width = $sizes[0];
                $this->height = $sizes[1];
            }
            catch ( Exception $e )
            {
                dd( $e );
            }
        }

    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('blueprint::form.components.images');
    }
}