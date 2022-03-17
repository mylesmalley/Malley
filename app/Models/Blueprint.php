<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Blueprint extends BaseModel implements HasMedia
{
    use InteractsWithMedia;
    use Searchable;

    /**
     * @var string
     */
    protected $table = 'blueprints';

    /**
     * @var string[]
     */
    protected $fillable = [
        //  "number", <- deprecated because blueprints are designs, not vehicles
        'name',
        'description',
        'base_van_id',
        'user_id',

        'customer_name',
        'customer_address_1',
        'customer_address_2',
        'customer_address_3',
        'customer_city',
        'customer_province',
        'customer_country',
        'customer_postalcode',
        'customer_phone',
        'customer_fax',
        'customer_website',
        'customer_logo',
        'customer_email',

        'status',

        // Notes
        'notes',

        // currency and exchange
        'exchange_rate',
        'currency',
        'terms',

        'is_locked',
        'layout_id',
        'has_custom_layout',
        'custom_layout',

        'quotes_visible',
        'renders_visible',

        'quote_number',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'notes' => 'array',
        'is_locked' => 'bool',
        'has_custom_layout' => 'bool',
    ];

    /**
     * @var array|string[]
     */
    protected array $statuses = [
        0 => 'In Development',
        5 => 'Released to Production',
        10 => 'Completed',
        20 => 'Cancelled / Dead',
    ];

    /**
     * Returns the url to the blueprint
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return '/blueprint/'.enc($this->id);
    }

    /**
     * @return BelongsTo
     */
    public function layout(): BelongsTo
    {
        return $this->belongsTo('App\Models\Layout');
    }

    /**
     * @return HasOne
     */
    public function lightPods(): HasOne
    {
        return $this->hasOne('App\Models\LightPod');
    }

    /**
     * @return mixed|string
     */
    public function getStatusAttribute(): mixed
    {
        return $this->statuses[$this->attributes['status']];
    }

    /**
     * @return mixed
     */
    public function getStatusIdAttribute(): mixed
    {
        return $this->attributes['status'];
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo("\App\Models\User");
    }

    /**
     * @return BelongsTo
     */
    public function platform(): BelongsTo
    {
        return $this->belongsTo('\App\Models\BaseVan', 'base_van_id');
    }

    /**
     * @return HasMany
     */
    public function configuration(): HasMany
    {
        return $this->hasMany("\App\Models\Configuration")
            ->orderBy('name');
    }

    /**
     * @return HasMany
     */
    public function custom_layouts(): HasMany
    {
        return $this->hasMany(CustomLayout::class);
    }

    /**
     * returns the eager loaded relations useful for searching with MeiliSearch
     * @param $query
     * @return mixed
     */
    protected function makeAllSearchableUsing($query): mixed
    {
        return $query->with([
            'platform' => function ($query) {
                $query->select('id', 'name');
            },
            'user' => function ($query) {
                $query
                    ->with('company')
                    ->select('id', 'first_name', 'last_name', 'company_id');
            },
        ]
        );
    }

    /**
     * @return array
     */
    public function toSearchableArray(): array
    {
        return [
            'id' => $this->attributes['id'],
            'encoded' => enc($this->attributes['id']),
            'name' => $this->attributes['name'],
            'description' => $this->attributes['description'],
            'platform' => $this->platform->name,
            'user_name' => $this->user->first_name.' '.$this->user->last_name,
            'dealer' => $this->user->company->name,

        ];
    }

    /**
     * @param array $selected
     * @return Collection
     */
    public function configs(array $selected = []): Collection
    {
        $query = DB::table('configurations')
            ->where('blueprint_id', $this->id)
            ->select(['id', 'description', 'name', 'value', 'quantity', 'price_tier_2', 'price_tier_3']);

        if (count($selected)) {
            $query->whereIn('name', $selected);
        }

        return $query->get();
    }

    /**
     * @param array $requested
     * @return Collection
     */
    public function filterConfigs(array $requested = []): Collection
    {
        foreach ($requested as &$value) {
            if (substr_count($value, '-') !== 2) {
                $value = $this->platform->option_prefix.'-'.$value.'-001';
            }
        }
        unset($value);

        return $this->configuration()->whereIn('name', $requested)->get();
    }

    /**
     * @param array $selected
     * @return string
     */
    public function jsonConfigs(array $selected = []): string
    {
        $configs = $this->configs($selected);

        $formatted = '{';
        $temp = [];

        foreach ($configs as $config) {
            $price2 = $this->id * round($config->price_tier_2 * $config->quantity);
            $price3 = $this->id * round($config->price_tier_2 * $config->quantity);
            $temp[] = "'{$config->name}':[{$config->id},{$config->value},{$config->quantity},{$price2},{$price3}]";
        }
        $formatted .= implode(",\r\n", $temp);
        $formatted .= '}';

        return $formatted;
    }

    /**
     * Takes teh configuration of the blueprint and returns a json-formatted string for use with blueprint
     * forms. ('option-name':[config-id, on-or-off, quantity, dealer-price, msrp-price])
     * prices are rounded to nearest dollar and then multiplied by the blueprint id to hide them better.
     *
     * @return string
     */
    public function configurationForForms(): string
    {
        $configs = $this->configuration()
                    ->select(['id', 'description', 'name', 'value', 'quantity', 'price_tier_2', 'price_tier_3'])
                    ->where('obsolete', false)
                    ->get();

        $formatted = [];

        foreach ($configs as $config) {
            $price2 = $this->id * round($config->price_tier_2 * $config->quantity);
            $price3 = $this->id * round($config->price_tier_3 * $config->quantity);
            $formatted[] = "'{$config->name}':[{$config->id},{$config->value},{$config->quantity},{$price2},{$price3}]";
        }

        return '{'.implode(',', $formatted).'}';
    }

    /**
     * returns the default configurations for the van
     * @return Collection
     */
    public function defaultConfigs()
    {
        return DB::table('options')
            ->where('base_van_id', $this->base_van_id)
            ->select(['name', 'value'])
            ->get();
    }

    /**
     * @return string
     */
    public function jsonDefaultConfigs(): string
    {
        $configs = $this->defaultConfigs();

        $formatted = '{';
        $temp = [];
        foreach ($configs as $config) {
            $temp[] = "{$config->name}:{$config->value}";
        }
        $formatted .= implode(',', $temp);
        $formatted .= '}';

        return $formatted;
    }

    /**
     * validates a blueprint's options vs configurations for currency
     * @return array
     */
    public function validate(): array
    {
        // spits out an array with option name as key and fingerprint as value
        $options = Option::query()
            ->where('base_van_id', $this->attributes['base_van_id'])
            ->select(['option_name', 'fingerprint'])
            ->get();
        $options = $options->pluck('fingerprint', 'option_name');
        $options = $options->toArray();

        // spits out an array with option name as key and fingerprint as value
        $configs = Configuration::query()
            ->where('blueprint_id', $this->attributes['id'])
            ->where('value', 1)
            ->select(['name', 'fingerprint'])
            ->get();

        $configs = $configs->pluck('fingerprint', 'name');
        $configs = $configs->toArray();

        $failedMatch = [];

        // run through each configuration item.
        foreach ($configs as $k => $v) {
            // only check options thare are pre-defined
            if (array_key_exists($k, $options)) {
                // if the configuration fingerpritn doesn' match the option, add it
                if ($v !== $options[$k]) {
                    $failedMatch[$k] = $v;
                }
            }
        }

        // return the elements that don't have matching fingerprints.
        return $failedMatch;
    }

    /**
     * updates an blueprint configuration to have all of the latest config options
     * @return bool
     */
    public function upgrade(): bool
    {
        if (! $this->is_locked) {
            //$this->resetRenderTemplates();

            // create an array of each option with the option name as key.
            $options = Option::query()
                ->where('base_van_id', $this->attributes['base_van_id'])
                ->pluck('option_name')
                ->toArray();

            $configs = $this->configuration->pluck('name')->toArray();
            $missing = array_diff($options, $configs);

            $newEntries = Option::query()
                            ->whereIn('option_name', $missing)
                            ->where('base_van_id', $this->attributes['base_van_id'])
                ->where('obsolete', false)

                ->with('components')
                            ->get();

            // skip the rest of the function if no new entries are needed.
            if (count($newEntries) === 0) {
                return true;
            }

            // list of option properties to clone
            $map = [
                'name' => 'option_name',
                'description' => 'option_description',
                'positive_requirements' => 'option_positive_requirements',
                'negative_requirements' => 'option_negative_requirements',
                'syspro_phantom' => 'option_syspro_phantom',
                'price_tier_1' => 'option_price_tier_1',
                'price_tier_2' => 'option_price_tier_2',
                'price_tier_3' => 'option_price_tier_3',
                'price_base_offset' => 'option_price_base_offset', // OLD

                'price_dealer_offset' => 'option_price_dealer_offset',
                'price_msrp_offset' => 'option_price_msrp_offset',

                'value' => 'option_value',
                'long_lead_time' => 'option_long_lead_time',
                'show_on_quote' => 'option_show_on_quote',
                'light_component' => 'option_light_component',
                'location' => 'option_location',
                'locked' => 'option_locked',
                'fingerprint' => 'fingerprint',
            ];

            $insertArray = [];

            foreach ($newEntries as $o) {
                $c = [];

                $c['blueprint_id'] = $this->id;
                foreach ($map as $k => $v) {
                    $c[$k] = $o->$v;
                }

                $c['option_id'] = $o->id;

                // roll up current cost of option component
                $c['cost'] = $o->totalCost();
                $insertArray[] = $c;
                //  $this->configuration()->save($c);
            }

            // $insert = DB::table('configurations')->insert($insertArray);

            $totalInsertRows = array_chunk($insertArray, 50);
            foreach ($totalInsertRows as $chunk) {
                DB::table('configurations')->insert($chunk);
            }
        }

        return true;
    }

    /**
     * toggles whether a blueprint and it's children are locked or not
     * @param  bool $state [description]
     * @return [type]        [description]
     */
    public function lockState(bool $state): bool
    {
        // sete lock state of the blueprint
        $this->attributes['is_locked'] = $state;
        $this->save();

        // set lock state of all of it's associated configuration options
        $this->configuration()->update(['locked' => $state]);

        return $state;
    }

    /**
     * lock a blueprint
     * @return bool
     */
    public function lockBlueprint(): bool
    {
        $this->lockState(true);

        return true;
    }

    /**
     * unlock a blueprint
     * @return bool
     */
    public function unlockBlueprint(): bool
    {
        $this->lockState(false);

        return false;
    }

    /**
     * @return string
     */
    public function awsRenderUrl(): string
    {
        return 'https://blueprint.malleyindustries.com/B-'.$this->attributes['id'];
    }

    /**
     * @return HasManyThrough
     */
    public function imageElements(): HasManyThrough
    {
        return $this->hasManyThrough('App\Models\Element', 'App\Models\Sheet', 'base_van_id', 'sheet', 'base_van_id')
            ->where('type', 'images');
    }

    /**
     * @return HasMany
     */
    public function log(): HasMany
    {
        return $this->hasMany('\App\Models\BlueprintLog');
    }

    /**
     * @return Collection
     */
    public function longLeadTimeItems(): Collection
    {
        $db = DB::table('configurations')
            ->where('blueprint_id', $this->id)
            ->where('long_lead_time', true)
            ->where('value', true)
            ->get();

        return $db;
    }

    /**
     * @return array
     */
    public function sysproOutput(): array
    {
        $configurations = DB::table('configurations')
            ->where('blueprint_id', $this->id)
            ->where('value', 1)
            ->get();

        $list = [];
        $counter = 0;
        foreach ($configurations as $config) {
            if ($config->syspro_phantom) {
                if (array_key_exists($config->syspro_phantom, $list)) {
                    $list[$config->syspro_phantom] += 1;
                } else {
                    $list[$config->syspro_phantom] = $config->quantity;
                }
                $counter++;
            }
        }

        return $list;
    }

    /**
     * returns the options that are active for the blueprint
     * @return array
     */
    public function getSelectedAttribute(): array
    {
        // TRANSFORM THE CONFIGURATION OBJECTS INTO AN ARRAY FOR EASIER HANDLING
        $configs = DB::table('configurations')
            ->select(['name', 'description', 'option_id'])
            ->where('value', 1)
            ->where('name', 'NOT LIKE', 'L%')
            ->where('blueprint_id', $this->id)
            ->get()
            ->toArray();

        $key = array_column($configs, 'name');

        // MAKE THE KEY OF THE ARRAY THE NAME OF THE OPTION FOR EASIER SEARCHING
        return array_combine($key, $configs);
    }

    /**
     * @return array
     */
    public function getDrawingsAttribute(): array
    {
        $configs = DB::table('drawings')
            ->where('base_van_id', $this->base_van_id)
            ->select(['name', 'id'])
            ->get()
            ->toArray();

        $key = array_column($configs, 'name');

        // MAKE THE KEY OF THE ARRAY THE NAME OF THE OPTION FOR EASIER SEARCHING
        return array_combine($key, $configs);
    }

    /**
     * @param $input
     * @return bool
     */
    public function setCurrencyAttribute(string $input): bool
    {
        $this->attributes['currency'] = strtoupper($input);

        return true;
    }

    //	/**
    //	 * @return float
    //	 */
    //	public function getExchangeRateAttribute(): float
    //	{
    //		return number_format($this->attributes['exchange_rate'],3);
    //	}
//
//
    //	/**
    //	 * @param float $value
    //	 * @return float
    //	 */
    //	public function setExchangeRateAttribute( float $value ): float
    //	{
    //		$this->attributes['exchange_rate'] = number_format( $value, 3);
    //		return $this->attributes['exchange_rate'];
    //	}

    /**
     * @return HasMany
     */
    public function vehicles()
    {
        return $this->hasMany('\App\Models\Vehicle');
    }

    /**
     * @param $query
     * @param $keyword
     * @return mixed
     */
    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword) {
            $query->where(function ($query) use ($keyword) {
                // if keyword starts with B- search without it
                $keyword = str_replace('B-', '', $keyword);
                $query->select(['id', 'name', 'description'])
                    ->where('name', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%")
                    ->orWhere('id', 'like', "%{$keyword}%")
                    ->orWhereHas('user.company', function ($q) use ($keyword) {
                        $q->where('name', 'like', "%{$keyword}%");
                    });
            });
        }

        return $query->limit(10);
    }

    /**
     * returns all render references
     * @return HasMany
     */
    public function renders()
    {
        return $this->hasMany('App\Models\Render');
    }

    /**
     * Deletes attached render templates and replaces with the most current version
     * every time a non-locked blueprint is loaded.
     */
    public function resetRenderTemplates()
    {
        $this->renders()->delete();

        $templates = $this->platform->templates;

        foreach ($templates as $template) {
            $render = new Render([
                'template_id' => $template->id,
                'blueprint_id' => $this->attributes['id'],
            ]);
            $render->sales_drawing = ($template->sales_drawing) ? true : false;
            $render->production_drawing = ($template->production_drawing) ? true : false;
            $render->save();
        }

        return $this->renders();
    }

    /**
     *  Grabs the blueprint's renders to get associated ids for templates
     * tehn returns the template references for later processing
     * @return Template or null if none
     *
     *
     * @param bool $production
     * @return mixed
     */
    public function activeTemplates($production = false)
    {
        if ($production) {
            $template_ids = $this->renders()
                ->where('sales_drawing', '=', false)
                ->pluck('template_id')
                ->toArray();
        } else {
            $template_ids = $this->renders()
                ->where('production_drawing', '=', false)
                ->pluck('template_id')
                ->toArray();
        }

        return Template::find($template_ids);
    }

    public function activeOptions(): array
    {
        $res = Configuration::query()
            ->where('value', 1)
            ->where('name', 'NOT LIKE', 'L%')
            ->where('blueprint_id', $this->id)
            ->select(['description', 'name', 'id', 'option_id', 'quantity'])
            ->get();

        return $res->keyBy('name')
            ->toArray();
    }

    /**
     * @return Collection
     */
    public function activeOptionIDs(): Collection
    {
        return Configuration::where('value', 1)
            //->where('name', 'NOT LIKE', 'L%')
            ->where('blueprint_id', $this->id)
            ->pluck('option_id');
    }

    public function activeDrawingIDs()
    {
        return Media::where('model_type', 'App\Models\Option')
            ->where('collection_name', 'drawings')
            ->whereIn('model_id', $this->activeOptionIDs())
            ->pluck('id');
    }

    /**
     * returns a simple collection of the option names used for this blueprint
     *
     * @return Collection
     */
    public function activeOptionNames(): Collection
    {
        return Configuration::where('value', 1)
            ->where('blueprint_id', $this->attributes['id'])
            ->pluck('name');
    }

    /**
     * @return Layout
     */
    public function createLayoutFromBlueprint(): Layout
    {
        $active = $this->activeOptions();

        $layout = new Layout([
            'name' => $this->name,
            'base_van_id' => $this->base_van_id,
            'notes' => 'Generated from Blueprint B-'.$this->attributes['id'].'. '.$this->attributes['description'],
        ]);

        $layout->save();

        $layoutOptions = [];
        foreach ($active as $a) {
            $layoutOptions[] = new LayoutOption([
                'option_id' => $a['option_id'],
                'qty' => $a['quantity'],
            ]);
        }

        $layout->options()->saveMany($layoutOptions);

        return $layout;
    }

    /**
     * @return $this
     */
    public function createFromLayout()
    {
        $layout = Layout::find($this->layout_id);

        foreach ($layout->options as $l) {
            DB::table('configurations')
                ->where('blueprint_id', $this->id)
                ->where('option_id', $l->option_id)
                ->update([
                    'value'=>1,
                    'quantity'=> (int) $l->qty,
                ]);
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function checkConfigurationAgainstRules(): Collection
    {
        $optionIds = DB::table('configurations')
            ->where('blueprint_id', $this->id)
            ->where('value', true)
            ->pluck('option_id')
            ->toArray();

        $rules = OptionRule::query()
            ->whereIn('option_id', $optionIds)
        //    ->with('option','relatedOption')
            ->get();

        return $rules;
    }
}
