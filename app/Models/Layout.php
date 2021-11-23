<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


/**
 * App\Models\Layout
 *
 * @property int $id
 * @property int $base_van_id
 * @property bool $visibility
 * @property string $name
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Option[] $associatedOptions
 * @property-read int|null $associated_options_count
 * @property-read mixed $platform
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\App\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\LayoutOption[] $options
 * @property-read int|null $options_count
 * @property-read \Kalnoy\Nestedset\Collection|\App\Models\Question[] $questions
 * @property-read int|null $questions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Layout newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Layout newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Layout query()
 * @method static \Illuminate\Database\Eloquent\Builder|Layout whereBaseVanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Layout whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Layout whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Layout whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Layout whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Layout whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Layout whereVisibility($value)
 * @mixin \Eloquent
 */
class Layout extends BaseModel implements HasMedia
{
    use InteractsWithMedia;

	protected string  $table = 'layouts';

	protected $fillable= [
		'base_van_id',
		'visibility',
		'name',
		'notes',
	];

    public function platform()
    {
        return \App\Models\BaseVan::find( $this->base_van_id );
    }

    public function getPlatformAttribute()
    {
        return $this->platform();
    }

    public function options()
    {
    	return $this->hasMany('App\Models\LayoutOption');
    }


    public function associatedOptions()
    {
        return $this->belongsToMany('App\Models\Option',
            'layout_options')
            ->orderBy('option_name');

    }


    public function duplicate()
    {
    	$new = $this->replicate();
    	$new->name = $new->name.' copy';
    	$new->save();

    	foreach ($this->options as $option)
	    {
	    	$opt = $option->replicate();
	    	$opt->layout_id = $new->id;
	    	$opt->save();
	    }

	    return $new;
    }


    /**
     * returns a formatted list of options avaible to this particular base van platform
     * @return spits out an array
     */
    public function availableOptions(): array
    {
        $results = [];

        // db query to get available options
        $options = DB::table('options')
            ->where( 'base_van_id', $this->base_van_id )
            ->select(['id','option_name','option_description'])
            ->get();

        // formatting
        foreach ($options as $v)
        {
            $results[$v->id] = "{$v->option_name} - {$v->option_description}";
        }

        return $results;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany('App\Models\Question' );
    }
}
