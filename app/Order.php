<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['number', 'price', 'total', 'status', 'operator', 'remake', 'user_id','payment_id','bookedorder_at','successful_at','cancel_at','paid_at'];


    public function payment(){
        return $this->belongsTo('App\Payment','payment_id');
    }
    
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function number(){
        return $this->belongsTo('App\Number','number','number');
    }
}
