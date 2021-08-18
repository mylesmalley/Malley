<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Inspection extends Model
{
    /**
     * @var string
     */
    protected $table = "inspections";


    /**
     * @var array
     */
    protected $fillable = [
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
