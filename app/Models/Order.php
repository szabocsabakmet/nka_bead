<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'order_date',
        'products_with_quantity',
        'state'
    ];

    protected $casts = [
        'products_with_quantity' => 'array',
        'order_date' => 'date'
    ];

    public function customer()
    {
        $this->belongsTo(User::class, 'customer_id', 'customer_id');
    }

    public function shipment()
    {
        $this->belongsTo(Shipment::class, 'order_id', 'order_id');
    }

}
