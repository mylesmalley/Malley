<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\PurchaseRequest
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $part_number
 * @property string $description
 * @property float $quantity
 * @property string $unit_of_measure
 * @property string|null $job
 * @property int $urgency
 * @property string|null $notes
 * @property bool $ordered
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $status
 * @property string|null $supplier_name
 * @property string|null $purchase_order
 * @property bool|null $stock
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseRequest whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseRequest whereJob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseRequest whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseRequest whereOrdered($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseRequest wherePartNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseRequest wherePurchaseOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseRequest whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseRequest whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseRequest whereSupplierName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseRequest whereUnitOfMeasure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseRequest whereUrgency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseRequest whereUserId($value)
 * @mixin \Eloquent
 */
class PurchaseRequest extends BaseModel
{

	protected string  $table = 'purchase_requests';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected array $fillable= [
        'id',

        // timestamps
	    'created_at',
	    'updated_at',

        // who created it
	    'user_id',

        // order details
	    'part_number',
        'description',
        'quantity',
        'unit_of_measure',
        'job',
        'urgency',
        'ordered',
        'notes',
        'status',
        'supplier_name',
        'purchase_order',
        'stock'
    ];

    public bool $timestamps= true;

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
     * @return array
     */
    public static function urgencies(): array
    {
        return [
            3 => "Normal",
            7 => "ASAP",

            10 => "Emergency (expedite)",
         //   5 => "Normal ",

       //     0 => "Nice to have"
        ];
    }


    /**
     * @return array
     */
    public static function statuses(): array
    {
        return [
            10 => "Ordered",
            5 => "Request Received",
            4 => "Waiting on supplier",
            3 => "On hold- See notes",
            1 => "Delivered",
        ];
    }



    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }

    /**
     * a function that tries to see if the requested parts have arrived
     *
     * @return bool
     */
    public function hasArrived(): bool
    {
        // if it has been marked as delivered, then it has arrived.
        if ( $this->attributes['status'] == 1 ) return true;

        // it can't be recieved if it hasn't been ordered.
        if ( !$this->attributes['purchase_order']
            || !$this->attributes['part_number'] ) return false;

        // check to see if it has been caught by Syspro
        $db = DB::connection('syspro')
            ->table('PorMasterDetail')
            ->select(['PurchaseOrder','MStockCode','MCompleteFlag'])
            ->where([
                    // grab the PO
                    ['PurchaseOrder','like','%'.$this->attributes['purchase_order'] ],
                    // grab the stock code from the PO
                    ['MStockCode', $this->attributes['part_number'] ]
                ])
            // hope that the first line from the PO that matches is representative
            ->first();

        // if a Y flag in Syspro, then the part has been received
        if ( $db && $db->MCompleteFlag === "Y") return true;

        // basically anything other than a y flag return false
        return false;
    }




}
