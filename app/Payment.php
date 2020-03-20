<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payments';

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
    protected $fillable = ['category', 'discount', 'dept', 'total', 'status', 'tracking_number', 'bank', 'slip', 'order_id', 'user_id'];

    public function user(){
        return $this->belongTo('App\User','user_id');
    }

    public function orders(){
        return $this->hasMany('App\Order','payment_id');
    }
}
