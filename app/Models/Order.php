<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_ip_address',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'service_id',
        'quantity',
        'price',
        'tax_percentage',
        'shipping_installation_cost',
        'subtotal',
        'total',
        'payment_status',
        'order_status',
    ];

    protected $casts = [
        'customer_ip_address' => 'string',
        'service_id' => 'integer',
        'customer_name' => 'string',
        'customer_email' => 'string',
        'customer_phone' => 'integer',
        'customer_address' => 'string',
        'quantity' => 'integer',
        'price' => 'float',
        'tax_percentage' => 'float',
        'shipping_installation_cost' => 'float',
        'subtotal' => 'float',
        'total' => 'float',
    ];

    /**
     * Relationship: Order belongs to a Service
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
