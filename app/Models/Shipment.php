<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $primaryKey = 'shipment_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'shipment_date',
    ];

    protected $casts = [
        'shipment_date' => 'date'
    ];

    public function order()
    {
        return $this->hasOne(Order::class, 'order_id', 'order_id');
    }
}
