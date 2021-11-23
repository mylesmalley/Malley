<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

/**
 * App\Models\Inspection
 *
 * @property int $id
 * @property string|null $vin
 * @property string|null $date_entered
 * @property string|null $work_order
 * @property string|null $life_step
 * @property string $description
 * @property string|null $location
 * @property string|null $source
 * @property string|null $type
 * @property string|null $severity
 * @property string|null $month
 * @property float $cost
 * @property int $number_of_invoices
 * @property string|null $customer
 * @property string|null $sales_rep
 * @property string|null $job_type
 * @property string|null $notes
 * @property int $user_id
 * @property int|null $vehicle_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Vehicle|null $vehicle
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection query()
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereCustomer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereDateEntered($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereJobType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereLifeStep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereNumberOfInvoices($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereSalesRep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereSeverity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereVehicleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereVin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereWorkOrder($value)
 * @mixin \Eloquent
 */
class Inspection extends Model
{
    /**
     * @var string
     */
    protected string  $table = "inspections";


    /**
     * @var array
     */
    protected $fillable= [
        'vin',
        'date_entered',
        'work_order',
        'life_step', // inspection or warranty
        'description',
        'location',
        'source',
        'type',
        'severity',
        'month',
        'cost',
        'number_of_invoices',
        'customer',
        'sales_rep',
        'notes',
        'job_type',

        'vehicle_id',
        'user_id',
    ];


    /**
     * @return array
     */
    public static function types(): array
    {
        return [
            "Screws",
            "Inspection issue",
            "Work order issue",
            "Workmanship",
            "Torque",
            "Incorrect specification",
            "Engineering",
            "Damage",
            "Lack of work instruction",
            "Sharp",
            "N / A",
            "Purchased part",
            "Seal",
            "Cleaning issue",
            "Loose",
            "Part quality",
            "Missing",
        ];
    }

    public static function locations(): array
    {
        return [
            "N / A",
            "Assembly",
            "Decals",
            "Mill",
            "Electrical",
            "Upholstery",
            "Plastics",
            "Paint",
            "Metal Fabrication",
        ];
    }


    /**
     * @return array
     */
    public static function sources(): array
    {
        return [
            "In Process",
            "Engineering",
            "N / A",
            "Work Instructions",
            "Sales",
            "Supplier",
        ];
    }


    public function vehicle()
    {
        return $this->belongsTo('App\Models\Vehicle');
    }



}
