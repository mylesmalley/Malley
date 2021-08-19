<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Models\User
 *
 * @method static find(mixed $user_id)
 * @method static where(string $string, bool $true)
 * @method static role(string $string)
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property int $company_id
 * @property string $role
 * @property bool $is_administrator
 * @property bool $can_create_template
 * @property bool $can_create_quote
 * @property bool $can_upload_file
 * @property bool $can_delete_file
 * @property bool $is_enabled
 * @property bool $can_edit_options
 * @property bool $can_edit_forms
 * @property bool $is_admin
 * @property bool $email_when_user_created
 * @property bool $email_when_blueprint_created
 * @property int $quote_permission_level
 * @property string|null $temp_data
 * @property bool $email_when_warranty_registered
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $mobility_access
 * @property bool $ambulance_access
 * @property bool $plastics_access
 * @property bool $show_blueprint_options
 * @property bool $show_question_tree
 * @property bool $show_option_pricing_in_index
 * @property bool $show_image_count_in_index
 * @property bool $email_when_quote_requested
 * @property bool $blank_access
 * @property bool $show_sales_in_index
 * @property bool $pricing_mode
 * @property bool $demo_mode
 * @property int $department_id
 * @property bool $can_edit_purchase_requests
 * @property bool|null $vdb_modify_dates
 * @property bool|null $vdb_modify_inspections
 * @property bool|null $vdb_modify_files
 * @property bool|null $vdb_modify_photos
 * @property bool|null $vdb_modify_info
 * @property bool|null $email_when_warranty_submitted
 * @property bool|null $vbd_modify_documents
 * @property bool|null $vbd_modify_finance
 * @property bool|null $vdb_work_orders
 * @property bool|null $email_when_requesting_incomplete_options
 * @property bool $bug_report_assignable
 * @property bool $bug_report_editor
 * @property bool|null $index_show_id_column
 * @property bool|null $index_show_obsolete_options
 * @property bool|null $index_show_blueprint_only_options
 * @property bool|null $index_show_phantom_column
 * @property bool|null $index_show_tags_column
 * @property bool|null $index_show_errors_column
 * @property bool|null $inventory_admin
 * @property bool|null $vdb_work_order_from_warranty_claim
 * @property bool|null $index_show_pricing_columns
 * @property array|null $preferences
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BugReport[] $assignedBugReports
 * @property-read int|null $assigned_bug_reports_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blueprint[] $blueprints
 * @property-read int|null $blueprints_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BugReportActivity[] $bugReportTasks
 * @property-read int|null $bug_report_tasks_count
 * @property-read \App\Models\Company $company
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BugReport[] $createdBugReports
 * @property-read int|null $created_bug_reports_count
 * @property-read \App\Models\Department $department
 * @property-read array $access
 * @property-read bool $has_active_labour
 * @property-read mixed $is_malley_staff
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Labour[] $labour
 * @property-read int|null $labour_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAmbulanceAccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBlankAccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBugReportAssignable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBugReportEditor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCanCreateQuote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCanCreateTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCanDeleteFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCanEditForms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCanEditOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCanEditPurchaseRequests($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCanUploadFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDemoMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailWhenBlueprintCreated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailWhenQuoteRequested($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailWhenRequestingIncompleteOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailWhenUserCreated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailWhenWarrantyRegistered($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailWhenWarrantySubmitted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIndexShowBlueprintOnlyOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIndexShowErrorsColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIndexShowIdColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIndexShowObsoleteOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIndexShowPhantomColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIndexShowPricingColumns($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIndexShowTagsColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereInventoryAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdministrator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMobilityAccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePlasticsAccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePreferences($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePricingMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereQuotePermissionLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereShowBlueprintOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereShowImageCountInIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereShowOptionPricingInIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereShowQuestionTree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereShowSalesInIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTempData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVbdModifyDocuments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVbdModifyFinance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVdbModifyDates($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVdbModifyFiles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVdbModifyInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVdbModifyInspections($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVdbModifyPhotos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVdbWorkOrderFromWarrantyClaim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVdbWorkOrders($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use HasRoles;

    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
    public function labourOnDate( Carbon $date ): HasMany
    {
        return $this->hasMany(\App\Models\Labour::class)
            ->whereDate('start', $date );
    }






    /**
     * set the value of a preference and save
     *
     * @param string $key
     * @param $value
     * @return Collection
     */
    public function setPref( string $key, $value ): Collection
    {
        $current = collect( json_decode( $this->attributes['preferences'] ) );
        $current = $current->merge( [ $key => $value ]);
        $this->attributes['preferences'] = $current->toJson();
        $this->save();

        return $this->getPrefs();
    }




    protected $dates = [
        'created_at',
        'updated_at',
    ];

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
        return $this->hasMany('App\Models\BugReport', 'user_id','id');
    }

    /**
     * returns bug reports assigned to the user
     * @return HasMany
     */
    public function assignedBugReports(): HasMany
    {
        return $this->hasMany('App\Models\BugReport', 'assigned_user_id','id')
            ->where('status','!=','Closed');
    }

    public function bugReportTasks(): HasMany
    {
        return $this->hasMany('App\Models\BugReportActivity', 'assigned_user_id','id')
            ->where('completed','!=',true );
    }


    public function company()
    {
        return $this->belongsTo("\App\Models\Company");
    }

    public function blueprints()
    {
        return $this->hasMany("\App\Models\Blueprint");
    }

    public function department()
    {
    	return $this->belongsTo('App\Models\Department');
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
        return ($this->attributes['is_enabled']) ? "Active" : "Locked";
    }

    private function avatarColour()
    {
        $code = dechex(crc32($this->attributes['email']));
        $code = substr($code, 0, 5);
        return '1' . $code;

    }

    public function avatar()
    {
        return "
<div style='display:block;float:left; width:100px; padding:17px;text-align: center;' >
         <a href='/blueprint/myblueprints/" . enc($this->attributes['id']) . "'>
         <svg version='1.1' id='Layer_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px'
                 viewBox='0 0 125 125' style='enable-background:new 0 0 125 125;' xml:space='preserve'>

            <circle style='fill:#" . $this->avatarColour() . ";' cx='62.5' cy='62.2' r='62.2' />
            <path style='fill:#ffffff;' d='M99,85.1C97.4,74.6,77.3,74,74.3,72.5c-3-1.5-1.2-7.8-1.2-7.8c5.9-0.6,18.1-16,10.6-35.6
                C76.3,9.5,62.5,11,62.5,11S48.7,9.5,41.2,29.1c-7.5,19.6,4.7,35,10.6,35.6c0,0,1.8,6.3-1.2,7.8c-3,1.5-23.1,2.1-24.7,12.7
                s-1.6,10.6-1.6,10.6h38.2h38.2C100.7,95.7,100.7,95.7,99,85.1z'/>
            </svg>
         <br /><strong>" . $this->attributes['first_name'] . "  " . $this->attributes['last_name'] . "</strong></a>
         </div>
        ";
    }


    /**
     * @return array
     */
	public function access(): array
	{
		$can = [];
		if ($this->attributes['ambulance_access']) $can[] = "ambulance";
		if ($this->attributes['mobility_access']) $can[] = "mobility";
		if ($this->attributes['plastics_access']) $can[] = "plastics";
		if ($this->attributes['blank_access']) $can[] = "blank";

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
	public function canAccess( string $category = null ): bool
	{
		return in_array( $category, $this->access() );
	}




	public function getEmailAttribute()
    {
        return strtolower( $this->attributes['email'] );
    }

}
