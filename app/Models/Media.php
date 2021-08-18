<?php

namespace App\Models;

use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

use Dreamonkey\CloudFrontUrlSigner\Facades\CloudFrontUrlSigner;

class Media extends BaseMedia
{
	protected $dates = [
		'created_at',
		'updated_at',
	];

	/**
	 * Get the format for database stored dates.
	 *
	 * @return string
	 */
	public function getDateFormat()
	{
		return 'Y-m-d H:i:s.u0';
	}

	/**
	 * Convert a DateTime to a storable string.
	 *
	 * @param  \DateTime|int  $value
	 * @return string
	 */
	public function fromDateTime($value)
	{
		//dd ($value);
		return $value ;
	}

	public function setUpdatedAtAttribute( $value )
	{
		//	dd ( $value );
		// dd($value->format('Y-m-d H:i:s.u')  );
		return $this->attributes['updated_at'] = $value->format('Y-m-d H:i:s.u');
	}

	public function setCreatedAtAttribute( $value )
	{
		return $this->attributes['created_at'] = $value->format('Y-m-d H:i:s.u');
	}

    private function cleanName( string $name ) : string
    {
        return str_replace([' ','_'],'-', $name );

    }

    /**
     * @return string
     */
    public function mediaUrl(): string
    {
        return "https://blueprint.malleyindustries.com/media/" . $this->id;
    }

//    public function setNameAttribute( string $name )
//    {
//        $this->attributes['name'] = $this->cleanName( $name );
//    }


	public function getDataURIAttribute():string
	{
		if ($this->mime_type === "image/png" )
		{
			$file = file_get_contents( $this->getPath() );
			return "data:image/png;base64," . base64_encode($file);
		}
		return "error converting image";
	}


	public function option()
    {
//        if ($this->model_type === "App\Models\Option")
//        {
            return \App\Models\Option::where('id', $this->model_id)->first();

  //      }
    //    return null;
    }


    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'media_tags');
    }


	/**
	 * @param bool $thumb
	 * @param string $dir
	 * @return string
	 */
	public function awsURL( bool $thumb = true, string $dir = "Album"): string
	{
		if ($thumb)
		{
			return "https://blueprintv2.s3.amazonaws.com/{$dir}/{$this->model_id}/{$this->id}/c/{$this->name}-thumb.jpg";
		}
		return "https://blueprintv2.s3.amazonaws.com/{$dir}/{$this->model_id}/{$this->id}/{$this->file_name}";
	}


    /**
     * @param null $conversion
     * @return string
     */
	public function cdnURL( $conversion = null ): string
    {

//        return "";
        return ($conversion) ? CloudFrontUrlSigner::sign(
            'https://'.config('malley.distribution_name' ) .'/'. $this->getPath( $conversion )) :
            CloudFrontUrlSigner::sign(
                'https://'.config('malley.distribution_name' ) .'/' . $this->getPath());
    }
}
