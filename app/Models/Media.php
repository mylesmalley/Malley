<?php

namespace App\Models;

use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

use Dreamonkey\CloudFrontUrlSigner\Facades\CloudFrontUrlSigner;

/**
 * App\Models\Media
 *
 * @property int $id
 * @property int $model_id
 * @property string $collection_name
 * @property string $name
 * @property string $file_name
 * @property string|null $mime_type
 * @property string $disk
 * @property int $size
 * @property array $manipulations
 * @property array $custom_properties
 * @property int|null $order_column
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $model_type
 * @property int|null $base_van_id
 * @property string|null $option_name
 * @property array|null $responsive_images
 * @property array|null $generated_conversions
 * @property string|null $uuid
 * @property string|null $conversions_disk
 * @property-read string $data_u_r_i
 * @property-read string $extension
 * @property-read string $human_readable_size
 * @property-read string $type
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $model
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read int|null $tags_count
 * @method static \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|static[] all($columns = ['*'])
 * @method static \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Media newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Media newQuery()
 * @method static Builder|Media ordered()
 * @method static \Illuminate\Database\Eloquent\Builder|Media query()
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereBaseVanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCollectionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereConversionsDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCustomProperties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereGeneratedConversions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereManipulations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereOptionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereOrderColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereResponsiveImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUuid($value)
 * @mixin \Eloquent
 */
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
