<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Layout extends BaseModel implements HasMedia
{
    use InteractsWithMedia;

	protected $table = 'layouts';

	protected $fillable = [
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
