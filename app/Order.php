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
    protected $fillable = ['number', 'price', 'total', 'status', 'operator', 'remake', 'user_id','payment_id'];


    public function payments(){
        return $this->belongsTo('App\Payment','payment_id');
    }
    
    public function users(){
        return $this->belongTo('App\User','user_id');
    }
    public function numbers(){
        return $this->belongTo('App\Number','number','number');
    }
}
