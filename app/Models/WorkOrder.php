<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\hasMany;

/**
 * App\Models\WorkOrder
 *
 * @property int $id
 * @property int|null $vehicle_id
 * @property int|null $user_id
 * @property string|null $number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $warranty_claim_id
 * @property int|null $odometer
 * @property string|null $date
 * @property string|null $title
 * @property string|null $purchase_order_number
 * @property string|null $quote_number
 * @property string|null $expected_chassis_delivery_date
 * @property string|null $expected_customer_pickup_date
 * @property string|null $customer_address_1
 * @property string|null $customer_address_2
 * @property string|null $customer_city
 * @property string|null $customer_province
 * @property string|null $customer_postalcode
 * @property string|null $customer_email
 * @property string|null $customer_phone
 * @property string|null $customer_contact
 * @property string|null $customer_name
 * @property string|null $type
 * @property int|null $linecount
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WorkOrderLine[] $lines
 * @property-read int|null $lines_count
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\Vehicle|null $vehicle
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereCustomerAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereCustomerAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereCustomerCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereCustomerContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereCustomerEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereCustomerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereCustomerPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereCustomerPostalcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereCustomerProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereExpectedChassisDeliveryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereExpectedCustomerPickupDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereLinecount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereOdometer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder wherePurchaseOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereQuoteNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereVehicleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereWarrantyClaimId($value)
 * @mixin \Eloquent
 */
class WorkOrder extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'work_orders';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'vehicle_id',
        'user_id',
        'warranty_claim_id',
        'number',
        'created_at',
        'updated_at',
        'odometer',
        'date',
        'title',
        'purchase_order_number',
        'quote_number',
        'expected_chassis_delivery_date',
        'expected_customer_pickup_date',
        'type',
        'customer_address_1',
        'customer_address_2',
        'customer_city',
        'customer_province',
        'customer_postalcode',
        'customer_email',
        'customer_phone',
        'customer_contact',
        'customer_name',
        'linecount',
    ];

    /**
     * @return hasMany
     */
    public function lines(): hasMany
    {
        return $this->hasMany(\App\Models\WorkOrderLine::class)
            ->orderBy('order');
    }

    /**
     * @return BelongsTo
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Vehicle::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function getLinecountAttribute()
    {
        return $this->attributes['linecount'] ?? 18;
    }
}
