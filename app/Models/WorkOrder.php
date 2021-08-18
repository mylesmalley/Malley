<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        return $this->hasMany("\App\Models\WorkOrderLine")
            ->orderBy('order');
    }


    /**
     * @return BelongsTo
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo('\App\Models\Vehicle');
    }

    public function user()
    {
        return $this->belongsTo("\App\Models\User");
    }

    public function getLinecountAttribute()
    {
        return $this->attributes['linecount'] ?? 18;
    }

}
