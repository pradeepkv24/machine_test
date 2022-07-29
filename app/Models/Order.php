<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'customer_id','deliveryboy_id','pickup_address_id','delivery_address_id','pickup','delivered','expected_pickup','expected_delivered','status',
    ];
    protected $dates = ['deleted_at'];

    public function getGenOrderIdAttribute()
    {
        return 'ORD'.$this->id+25520;
    }
    public function convertOrderId($GenOrderId)
    {
        $order_id=substr($GenOrderId, 3);
        return $order_id-25520;
    }
    public function customer()
    {
        return $this->belongsTo(User::class,'customer_id','id');
    }
    public function deliveryboy()
    {
        return $this->belongsTo(User::class,'deliveryboy_id','id');
    }
    public function pickupAddress()
    {
        return $this->belongsTo(Address::class,'pickup_address_id','id');
    }
    public function deliveryAddress()
    {
        return $this->belongsTo(Address::class,'delivery_address_id','id');
    }
}
