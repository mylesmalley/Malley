<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;


class Option extends BaseModel implements HasMedia
{
    use InteractsWithMedia;

    /**
     * @noinspection
     * @var string
     */
    protected $table = "options";

    /**
     * @var string[]
     * @noinspection
     */
    protected $fillable = [
        "option_name",
        "option_description",
        "option_short_description",
        "option_positive_requirements",
        "option_negative_requirements",
        "base_van_id",
        "option_syspro_phantom",
        "option_price_tier_1",
        "option_price_tier_2",
        "option_price_tier_3",
	    "option_price_base_offset", // OLS

	    "option_price_dealer_offset",
	    "option_price_msrp_offset",


        "option_labour_qty",
        "option_labour_cost",
        "option_value",
        'option_long_lead_time',
        'option_show_on_quote',
        'option_light_component',
        'option_location',
        'option_locked',
        'fingerprint',
        'image_path',

        // boolean flags added 2018 04 23
        'nbems',
        'validated',

	    // flag to determine if an option is only used for blueprint use, not for the index
	    'blueprint_only',


	    // note fields
	    'engineering_notes',
	    'drawing_notes',
	    'blueprint_notes',

        // retired flag
        'retired',


        'no_components', // added 2020-08-27
        'obsolete',
        'has_pricing', // 2020-11-09 bit



        'revisionable', // boolean if the option should allow for revision creation
        'revision', // revision number, higher is newer
        'user_id', // added an author

        'show_on_templates', // 2020-11-27
        'show_on_forms', // 2020-12-03
    ];


    /**
     *
     */
    protected static function booted()
    {

        static::saving(function ($option) {
            $option->setAttribute('fingerprint', $option->fingerprintString()  );

        });
    }

    public function getFullNameAttribute()
    {
        if ( Auth::user()->id === 3)
        {
            return $this->attributes['option_name'] . "r". $this->attributes['revision'];
        }
        return $this->attributes['option_name'];

    }


    /**
     * @return BelongsToMany
     */
    public function templates(): BelongsToMany
    {
    	return $this->belongsToMany(
    		'App\Models\Template',
		    'template_options');
    }


	/**
	 * returns all related rules for this option
	 *
	 * @return HasMany
	 */
    public function rules(): HasMany
    {
    	return $this->hasMany("App\Models\OptionRule");
    }


	/**
	 * returns all rules that reference this option - inverse of Rules function
	 *
	 * @return HasMany
	 */
    public function relatedRules(): HasMany
    {
	    return $this->hasMany("App\Models\OptionRule", 'related_option_id' );
    }


    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

	/**
	 * @return array
	 */
    public function explodeName(): array
    {
        return explode('-', $this->attributes['option_name']);
    }


	/**
	 * @return HasMany
	 */
    public function formElementItems(): HasMany
    {
    	return $this->hasMany('App\Models\FormElementItem');
    }


	/**
	 * @return string
	 */
    public function getNamePrefixAttribute(): string
    {
    	$name = $this->explodeName();

	    if (count($name) == 3)
	    {
		    return $name[0];
	    }
	    // return the nothing if it doesn't conform to XXX-X000-000
	    return "";

    }


	/**
	 * @return string
	 */
	public function getNameIdentifierAttribute(): string
	{
		$name = $this->explodeName();
		if (count($name) == 3)
		{
			return $name[1];
		}
		// return the full name if it doesn't conform to XXX-X000-000
		return $name[0];

	}


	/**
	 * @return string
	 */
	public function getNameRevisionAttribute(): string
	{
		$name = $this->explodeName();
		if (count($name) == 3)
		{
			return $name[2];
		}

		// return the nothing if it doesn't conform to XXX-X000-000
		return "";
	}


	/**
	 * @return HasMany
	 */
	public function components(): HasMany
    {
        return $this->hasMany('App\Models\Component')
	        ->orderBy('component_stock_code','ASC');
    }

    /**
     * @return bool
     */
    public function getHasComponentsAttribute(): bool
    {
        if ( $this->attributes['no_components'] ) return true;
        return (bool)$this->components()->count();
    }

    /**
     * returns the BomStructure components for the syspro phantom number
     * @return array
     */
    public function sysproComponents(): array
    {
        $result = DB::connection('syspro')
                ->table('BomStructure')
                ->select(['ParentPart','Component','QtyPer'])
                ->where('ParentPart', $this->attributes['option_syspro_phantom'])
                ->get();

        // normalize syspro results
        $normalized = [];

        foreach ($result as $r)
        {
            $normalized[ trim($r->Component) ] = (float) $r->QtyPer;
        }
        return $normalized;
    }


	/**
	 * @return array
	 */
    public function indexComponents(): array
    {
        $components = $this->components;
        $normalized = [];

        foreach ($components as $r)
        {
            $normalized[ trim($r->component_stock_code) ] = (float) $r->component_material_qty;
        }

        return $normalized;
    }


    /**
     * uniqueMergedComponents
     * returns the component list from the option index and syspro DB, merges and removes duplicates.
     * @return array of unique components
     */
    public function uniqueMergedComponents(): array
    {
        $index = array_keys($this->indexComponents());
        $syspro = array_keys($this->sysproComponents());
        return array_unique( array_merge( $index, $syspro ) );
    }




    public function totalCost(): float
    {
        // components
        $components = $this->components;//->get();
        $totalCost = 0;
        foreach ($components as $component)
        {
            $totalCost += $component->totalCost;
        }

        // add in labour
        $totalCost += ($this->attributes['option_labour_qty'] * $this->attributes['option_labour_cost']);

        return number_format($totalCost,2,'.','');
    }


    public function setOptionNameAttribute( $value )
    {
        $this->attributes['option_name'] = strtoupper( str_replace(' ', '_', $value ) );
    }

    public function setOptionDescriptionAttribute( $value )
    {
        $this->attributes['option_description'] = strtoupper( $value );
    }


    /**
     * @return BelongsTo
     */
    public function base_van(): BelongsTo
    {
        return $this->belongsTo("\App\Models\BaseVan");
    }


    /**
     * @return BelongsTo
     */
    public function platform(): BelongsTo
    {
        return $this->base_van();
    }


    /**
     * @param BaseVan $baseVan
     * @param array $option_names
     * @return Collection
     */
    public static function formData( BaseVan $baseVan, array $option_names ): Collection
    {
    	// makes a short form of option name available
	    // use X000 instead of XXX-X000-000 if rev is 0
	    foreach ($option_names as &$value) {
	    	if (substr_count($value, '-') !== 2)
		    {
		    	$value = $baseVan->option_prefix.'-'.$value.'-001';
		    }
	    }
	    unset($value);

        return DB::table("options")
                    ->select(['id','option_name','option_description','option_short_description','option_long_lead_time','option_value'])
                    ->where( 'base_van_id', $baseVan->id )
                    ->whereIn('option_name', $option_names )
                    ->orderBy('option_value','desc')
                    ->get();
    }


    /**
     * @return string
     */
    public function getPriceTier1Attribute(): string
    {
        return number_format($this->attributes['option_price_tier_1'],2,'.','');
    }


    /**
     * @return string
     */
    public function getPriceTier2Attribute(): string
    {
        return number_format($this->attributes['option_price_tier_2'],2,'.','');
    }


    /**
     * @return string
     */
    public function getPriceTier3Attribute(): string
    {
        return number_format($this->attributes['option_price_tier_3'],2,'.','');
    }



	/**
	 * @return string
	 */
    public function fingerprintString(): string
    {
        return $this->attributes['option_name'] ?? '' .
            $this->attributes['option_description'] .
            $this->attributes['option_syspro_phantom'] .
            $this->attributes['option_price_tier_3'] .
            $this->attributes['option_price_tier_2'] .
            $this->attributes['option_price_tier_1'] .
            $this->attributes['option_long_lead_time'];
    }


    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Tag', 'option_tags');
    }





    /**
	 * @param $path
	 */
    public function setImagePathAttribute( $path )
    {
        $this->attributes['image_path'] = trim( $path, ' /' );
    }

	/**
	 * @return null|string
	 */
    public function imagePath(): ?string
    {
        if ($this->attributes['image_path'])
        {
            return "https://blueprint.malleyindustries.com/assets/".$this->attributes['image_path'];
        }
        return null;
    }

    /**
     * @return mixed
     */
    public function getNextIDAttribute(): mixed
    {

	   $a = Option::query()
		   ->where([
               [ 'base_van_id', '=', $this->base_van_id],
               [ 'obsolete', '=', false]
           ])
         //  ->andWhere('obsolete','=',false)

           ->orderBy('option_name')
		   ->pluck('id')
		   ->toArray();

	    $pos = array_search($this->id, $a);

	    return (array_key_exists($pos + 1,  $a)) ? $a[$pos + 1]: null;


    }


	/**
	 * @return null or int
	 */
    public function getPreviousIDAttribute()
    {
	    $a = Option::query()
            ->where([
                [ 'base_van_id', '=', $this->base_van_id],
                [ 'obsolete', '=', false]
            ])
		    ->orderBy('option_name')
		    ->pluck('id')
		    ->toArray();

	    $pos = array_search($this->id, $a);

	    return (array_key_exists($pos-1,  $a)) ? $a[$pos - 1] : null ;

    }


    /**
     * @return bool
     */
	public function importComponentsFromSyspro( ): bool
    {
		if (!$this->option_syspro_phantom) return false;

		DB::table('components')
			->where('component_part_category','!=','N')
			->where('option_id', $this->id)
			->delete();

		$syspro = DB::connection('syspro')
			->table('BomStructure')
			->where('ParentPart', $this->option_syspro_phantom)
			->leftJoin('InvMaster', 'BomStructure.Component', '=', 'InvMaster.StockCode')
			->get();

        if (!$syspro->count() ) return false;


		foreach($syspro as $sys)
		{
			$component = new Component([
				'option_id'                 =>  $this->id,
				'component_sub_assembly'    =>  'MF1',
				'component_stock_code'      =>  trim( $sys->Component ),
				'component_description'     =>  trim( $sys->Description ),
				'component_long_description'=>  trim( $sys->LongDesc ),
				'component_part_category'   => trim( $sys->PartCategory ),
				'component_material_qty'    => (float) trim( $sys->QtyPer ),
				'component_material_cost'   => (float) $sys->MaterialCost,

				'component_unit_of_measure' => trim( $sys->CostUom ),
				'component_revision'       => 0,
				'component_item_code'       => '',
				'component_where_built_location' => '',
				'component_install_area'    => '',
				'component_notes'           => '',
			]);

			$component->save();
		}

		return true;
	}




	/**
	 * @param float $exchange
	 * @return float
	 */
	public function MSRPPrice( float $exchange = 1 ): float
	{
		return ( $this->attributes['option_price_tier_3'] - $this->attributes['option_price_msrp_offset'] ) * $exchange;
	}

	/**
	 * @param float $exchange
	 * @return float
	 */
	public function DealerPrice( float $exchange = 1 ): float
	{
		return ( $this->attributes['option_price_tier_2'] - $this->attributes['option_price_dealer_offset'] ) * $exchange;
	}


    /**
     * @param $query
     * @param $keyword
     * @return mixed
     */
    public function scopeSearchByKeyword($query, $keyword): mixed
    {
        if ($keyword) {

            $keyword = strtoupper( $keyword );

            $query->where(function ($query) use ($keyword) {
                $query->select(['id', 'option_name', 'option_description','option_syspro_phantom'])
                    ->where('option_name', 'like', "%$keyword%")
                    ->orWhere('option_description', 'like', "%$keyword%")
                    ->orWhere('option_syspro_phantom', 'like', "%$keyword%");
            });
        }
        return $query->limit(10);
    }


    /**
     * @return HasMany
     */
    public function configurations(): HasMany
    {
        return $this->hasMany('App\Models\Configuration');
    }


    /**
     * @param bool $status
     * @return bool
     */
    public function retire( bool $status = true ): bool
    {
        // don't continue if this option is used on forms currently
        if ( $this->formElementItems()->count() > 0 ) return false;
        $this->attributes['retired'] = $status;
        $this->save();

        // update any configurations that mention it
        $this->configurations()->update([ 'retired' => $status ]);
        return true;
    }


    /**
     * @return Collection
     */
    public function errors(): Collection
    {
        $errors = [];
        // is the option on any forms?
        if ( $this->attributes['obsolete'] && $this->attributes['obsolete'] === true )
        {
            $errors['obsolete'] = 'Option Marked as obsolete';
        }


        // is the option on any forms?
        if (  ($this->attributes['show_on_forms'] != false) && ! $this->formElementItems->count() )
        {
            $errors['noforms'] = 'Not used on any forms';
        }

        // is the option on any forms?
        if (  $this->attributes['show_on_templates']
            &&  !$this->templates->count() )
        {
            $errors['notemplate'] = 'Not used on any drawing package templates.';
        }


        // does the option have components if it should?
        if ( !$this->attributes['no_components'] && $this->components->count() == 0 )
        {
            $errors['nocomponents'] = 'Option is missing components and they are expected.';
        }


        // does the option have a syspro phantom
        if ( ! $this->attributes['option_syspro_phantom'] &&  !$this->attributes['no_components'] )
        {
            $errors['nosyspro'] = 'Option is missing a syspro phantom and is expecting to have one.';
        }

        // does the option have pricing set?
        if (  $this->attributes['has_pricing'] && (
                $this->attributes['option_price_tier_2'] == 0 || $this->attributes['option_price_tier_3'] == 0
            )  )
        {
            $errors['nopricing'] = 'No pricing is set for Dealers or MSRP.';
        }


        // does the option have pricing set?
        if ( !$this->attributes['option_show_on_quote'] &&
            ( $this->DealerPrice() > 0 || $this->MSRPPrice() > 0) )
        {
            $errors['notonquote'] = 'Option has pricing but will not appear on quotes!';
        }


        return collect($errors);
    }


    /**
     * @return Collection
     */
    public function revisions(): Collection
    {
        return Option::where('option_name', $this->attributes['option_name'] )
            ->orderBy('revision','DESC')
            ->get();
    }


    /**
     * @return HasOne
     * used this to fix eager loading n+1 queries
     */
    public function componentCount(): HasOne
    {
        return $this->hasOne('App\Models\Component')
            ->selectRaw('option_id, count(*) as aggregate')
            ->groupBy('option_id');
    }


    /**
     * @return int
     */
    public function getComponentCountAttribute(): int
    {

        $related = $this->getRelation('componentCount');

        // then return the count directly
        return ($related) ? (int) $related->aggregate : 0;
    }

}
