<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use HasRoles;

    protected $guard_name = 'web';

    protected $fillable = [
        'first_name',
        'last_name',
        'company_id',
        //    'role',
        'email',
        'password',
        'is_administrator',
        'is_malley_staff',
        'is_enabled',
        'is_admin',
        'can_create_template',
        'can_create_quote',
        'can_upload_file',
        'can_delete_file',
        'can_edit_forms',
        'can_edit_options',
        'can_edit_purchase_requests',

        // email notifications
        'email_when_user_created',
        'email_when_blueprint_created',
        'email_when_warranty_registered',
        'email_when_quote_requested',

        'quote_permission_level',

        // access categories
        'ambulance_access',
        'plastics_access',
        'mobility_access',
        'blank_access', // hidden empty templates for admin

        // user-configurable options
        'show_blueprint_options',
        'show_question_tree',
        'show_option_pricing_in_index',
        'show_image_count_in_index',

        'show_sales_in_index', // whether or not index users can see sales forms etc

        'temp_data',

        // bool option to show or hide pricing from views
        'pricing_mode', // default is FALSE

        'demo_mode', // default is FALSE

        // department
        'department_id',

        // bug report / engineeirng task list
        'bug_report_assignable',
        'bug_report_editor',

        'index_show_obsolete_options',
        'index_show_blueprint_only_options',
        'index_show_id_column',
        'index_show_tags_column',
        'index_show_errors_column',
        'index_show_phantom_column',
        'index_show_pricing_columns',

        'preferences',
    ];

    protected $casts = [
        'is_administrator' => 'boolean',
        'is_malley_staff' => 'boolean',
        'is_enabled' => 'boolean',
        'is_admin' => 'boolean',
        'can_create_template' => 'boolean',
        'can_create_quote' => 'boolean',
        'can_upload_file' => 'boolean',
        'can_delete_file' => 'boolean',
        'can_edit_forms' => 'boolean',
        'can_edit_options' => 'boolean',
        'company_id' => 'integer',

        // access categories
        'ambulance_access' => 'boolean',
        'plastics_access' => 'boolean',
        'mobility_access' => 'boolean',
        'blank_access' => 'boolean',

        // user-configurable options
        'show_blueprint_options' => 'boolean',
        'show_question_tree' => 'boolean',

        'preferences' => 'array',
    ];

    /**
     * a collection of default values for preferences
     *
     * @return Collection
     */
    private function defaultPrefs(): Collection
    {
        $arr = [
            'hello' => 'world',
            'foo' => 'bar',
            'fizz' => 'buzz',
        ];

        return collect($arr);
    }

    /**
     * returns all preferences, merging in default ones as well
     *
     * @return Collection
     */
    public function getPrefs(): Collection
    {
        return $this->defaultPrefs()
            ->merge(collect(json_decode($this->attributes['preferences'])));
    }

    /**
     * get a specific preference
     *
     * @param string $key
     * @return mixed
     */
    public function getPref(string $key)
    {
        $userSettings = $this->getPrefs();

        return $userSettings->get($key, null);
    }

    /**
     * @return HasMany
     */
    public function labour(): HasMany
    {
        return $this->hasMany(\App\Models\Labour::class);
    }

    /**
     * @return Labour|null
     */
    public function activeLabour(): Labour|null
    {
        return $this->labour
            ->where('end', null)
            //     ->limit(1)
            ->first();
    }

    public function labourHistory()
    {
        return $this->labour()
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();
    }

    /*
     *
     */
    public function getHasActiveLabourAttribute(): bool
    {
        return ($this->activeLabour()) ? true : false;
    }

    /**
     * @param Carbon $date
     * @return HasMany
     */
    public function labourOnDate(Carbon $date): HasMany
    {
        return $this->hasMany(\App\Models\Labour::class)
            ->whereDate('start', $date);
    }

    /**
     * set the value of a preference and save
     *
     * @param string $key
     * @param $value
     * @return Collection
     */
    public function setPref(string $key, $value): Collection
    {
        $current = collect(json_decode($this->attributes['preferences']));
        $current = $current->merge([$key => $value]);
        $this->attributes['preferences'] = $current->toJson();
        $this->save();

        return $this->getPrefs();
    }


    /**
     * Get the format for database stored dates.
     *
     * @return string
     */
    public function getDateFormat(): string
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
        return $value;
    }

    public function setUpdatedAtAttribute($value)
    {
        //	dd ( $value );
        // dd($value->format('Y-m-d H:i:s.u')  );
        return $this->attributes['updated_at'] = $value->format('Y-m-d H:i:s.u');
    }

    public function setCreatedAtAttribute($value)
    {
        return $this->attributes['created_at'] = $value->format('Y-m-d H:i:s.u');
    }

    public function is_malley_staff()
    {
        return ($this->attributes['company_id'] == 2) ? true : false;
    }

    public function getIsMalleyStaffAttribute()
    {
        return $this->is_malley_staff();
    }

    /**
     * returns bug reports created by this user
     * @return HasMany
     */
    public function createdBugReports(): HasMany
    {
        return $this->hasMany(\App\Models\BugReport::class, 'user_id', 'id');
    }

    /**
     * returns bug reports assigned to the user
     * @return HasMany
     */
    public function assignedBugReports(): HasMany
    {
        return $this->hasMany(\App\Models\BugReport::class, 'assigned_user_id', 'id')
            ->where('status', '!=', 'Closed');
    }

    public function bugReportTasks(): HasMany
    {
        return $this->hasMany(\App\Models\BugReportActivity::class, 'assigned_user_id', 'id')
            ->where('completed', '!=', true);
    }

    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class);
    }

    public function blueprints()
    {
        return $this->hasMany(\App\Models\Blueprint::class);
    }

    public function department()
    {
        return $this->belongsTo(\App\Models\Department::class);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getIsEnabledAttribute()
    {
        return ($this->attributes['is_enabled']) ? true : false;
    }

    public function status()
    {
        return ($this->attributes['is_enabled']) ? 'Active' : 'Locked';
    }

    private function avatarColour()
    {
        $code = dechex(crc32($this->attributes['email']));
        $code = substr($code, 0, 5);

        return '1'.$code;
    }

    public function avatar()
    {
        return "
<div style='display:block;float:left; width:100px; padding:17px;text-align: center;' >
         <a href='/blueprint/myblueprints/".enc($this->attributes['id'])."'>
         <svg version='1.1' id='Layer_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px'
                 viewBox='0 0 125 125' style='enable-background:new 0 0 125 125;' xml:space='preserve'>

            <circle style='fill:#".$this->avatarColour().";' cx='62.5' cy='62.2' r='62.2' />
            <path style='fill:#ffffff;' d='M99,85.1C97.4,74.6,77.3,74,74.3,72.5c-3-1.5-1.2-7.8-1.2-7.8c5.9-0.6,18.1-16,10.6-35.6
                C76.3,9.5,62.5,11,62.5,11S48.7,9.5,41.2,29.1c-7.5,19.6,4.7,35,10.6,35.6c0,0,1.8,6.3-1.2,7.8c-3,1.5-23.1,2.1-24.7,12.7
                s-1.6,10.6-1.6,10.6h38.2h38.2C100.7,95.7,100.7,95.7,99,85.1z'/>
            </svg>
         <br /><strong>".$this->attributes['first_name'].'  '.$this->attributes['last_name'].'</strong></a>
         </div>
        ';
    }

    /**
     * @return array
     */
    public function access(): array
    {
        $can = [];
        if ($this->attributes['ambulance_access']) {
            $can[] = 'ambulance';
        }
        if ($this->attributes['mobility_access']) {
            $can[] = 'mobility';
        }
        if ($this->attributes['plastics_access']) {
            $can[] = 'plastics';
        }
        if ($this->attributes['blank_access']) {
            $can[] = 'blank';
        }

        return $can;
    }

    /**
     * @return array
     */
    public function getAccessAttribute(): array
    {
        return $this->access();
    }

    /**
     * @param string $category
     * @return bool
     */
    public function canAccess(string $category = null): bool
    {
        return in_array($category, $this->access());
    }

    public function getEmailAttribute()
    {
        return strtolower($this->attributes['email']);
    }
}
