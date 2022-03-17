<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Opportunity
 *
 * @property int $id
 * @property string $description description of the project or opportunity
 * @property string $customer end customer if known
 * @property int $user_id
 * @property int|null $company_id dealer who sold the job if available. referencing companies table and dealers
 * @property int|null $base_van_id category of the job, if known. references the base van table and option index
 * @property int|null $blueprint_id link the opportunity to a blueprint if available
 * @property int $funnel_status_id funnel location
 * @property string|null $syspro_job_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $salesperson_number used by salesperson for their personal reference
 * @property int $value estimated sale price of the opportunity
 * @property int $chance_of_success
 * @property int $labour_hours
 * @property int $quantity number of units of product - probably will expand to individual lines hwen a job advances past the sales funnel
 * @property bool $paid have we been paid for the job?
 * @property string $currency currency to deal with
 * @property \Illuminate\Support\Carbon|null $chassis_order_date
 * @property \Illuminate\Support\Carbon|null $chassis_arrival_date
 * @property \Illuminate\Support\Carbon|null $material_needed_date
 * @property \Illuminate\Support\Carbon|null $material_order_date
 * @property \Illuminate\Support\Carbon|null $production_start_date
 * @property \Illuminate\Support\Carbon|null $production_completion_date
 * @property \Illuminate\Support\Carbon|null $shipping_date
 * @property \Illuminate\Support\Carbon|null $expected_win_date
 * @property int $production_priority
 * @property int|null $opportunity_category_id
 * @property string|null $city
 * @property string|null $province
 * @property string|null $country
 * @property int|null $material_cost
 * @property int|null $chassis_cost
 * @property int|null $other_cost
 * @property int $department_id
 * @property-read \App\Models\Blueprint|null $blueprint
 * @property-read \App\Models\BaseVan|null $category
 * @property-read \App\Models\Company|null $dealer
 * @property-read \App\Models\Department $department
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OpportunityNote[] $notes
 * @property-read int|null $notes_count
 * @property-read \App\Models\FunnelStatus $status
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity query()
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereBaseVanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereBlueprintId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereChanceOfSuccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereChassisArrivalDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereChassisCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereChassisOrderDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereCustomer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereExpectedWinDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereFunnelStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereLabourHours($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereMaterialCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereMaterialNeededDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereMaterialOrderDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereOpportunityCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereOtherCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity wherePaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereProductionCompletionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereProductionPriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereProductionStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereSalespersonNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereShippingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereSysproJobNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Opportunity whereValue($value)
 * @mixin \Eloquent
 */
class Opportunity extends Model
{
    /**
     * @var string
     */
    protected $table = 'opportunities';

    /**
     * @return string
     */
    public function getDateFormat()
    {
        return 'Y-m-d H:i:s.u0';
    }

    /**
     * @var array
     */
    protected $fillable = [
        'description',
        'customer',
        'user_id',
        'company_id',
        'base_van_id',
        'blueprint_id',
        'funnel_status_id',
        'syspro_job_number',
        'created_at',
        'updated_at',
        'salesperson_number',
        'value',
        'chance_of_success',
        'labour_hours',
        'quantity',
        'paid',
        'currency',
        'chassis_order_date',
        'chassis_arrival_date',
        'material_needed_date',
        'material_order_date',
        'production_start_date',
        'production_completion_date',
        'shipping_date',
        'expected_win_date',
        'production_priority',
        'department_id',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'chassis_order_date' => 'date',
        'chassis_arrival_date' => 'date',
        'material_needed_date' => 'date',
        'material_order_date' => 'date',
        'production_start_date' => 'date',
        'production_completion_date' => 'date',
        'shipping_date' => 'date',
        'expected_win_date' => 'date',
    ];

    /**
     * @var array
     */
    public static $mpsDates = [
        'chassis_order_date',
        'chassis_arrival_date',
        'material_needed_date',
        'material_order_date',
        'production_start_date',
        'production_completion_date',
        'shipping_date',
        'expected_win_date',
    ];

    /**
     * @return array
     */
    public function dates(): array
    {
        $output = [];
        for ($i = 0; $i < count(self::$mpsDates); $i++) {
            if ($this->attributes[self::$mpsDates[$i]]) {
                $output[strtotime($this->attributes[self::$mpsDates[$i]]) + $i] = [
                    'date',
                    $this->attributes[self::$mpsDates[$i]],
                    ucwords(str_replace('_', ' ', self::$mpsDates[$i])),
                ];
            }
        }
        ksort($output);

        return $output;
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(\App\Models\FunnelStatus::class, 'funnel_status_id');
    }

    /**
     * @return BelongsTo
     */
    public function blueprint(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Blueprint::class, 'blueprint_id');
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(\App\Models\BaseVan::class, 'base_van_id');
    }

    /**
     * @return BelongsTo
     */
    public function dealer(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Company::class, 'company_id');
    }

    /**
     * @return BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Department::class);
    }

    /**
     * @return HasMany
     */
    public function notes(): HasMany
    {
        return $this->hasMany(\App\Models\OpportunityNote::class)
            ->orderBy('created_at', 'DESC');
    }

    /**
     * @return array
     */
    public static function dateColumns() : array
    {
        return self::$mpsDates;
    }

    /**
     * @return array
     */
    private function colour(): array
    {
        $red = ($this->id * 315) % 255;
        $green = ($this->id * 558) % 255;
        $blue = ($this->id * 292) % 255;
        $intensity = (($red * 0.299 + $green * 0.587 + $blue * 0.114) > 186) ? false : true;

        return [$red, $green, $blue, $intensity];
    }

    /**
     * @return string
     */
    public function backgroundColour(): string
    {
        $parts = $this->colour();

        return "rgb({$parts[0]}, {$parts[1]}, {$parts[2]})";
    }

    /**
     * @return string
     */
    public function textColour(): string
    {
        $text = $this->colour();

        return ($text[3]) ? '#ffffff' : '#000000';
    }
}
