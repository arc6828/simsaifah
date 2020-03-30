<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Number extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'numbers';

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
    protected $fillable = ['number', 'price', 'operator','total','status'];

    public function orders(){
        return $this->hasMany('App\Order','number','number');
    }

    /*
    ถ้าเป็นปกติจะเขียนแบบนี้ (แบบเต็ม)
    public function orders(){
        return $this->hasMany('App\Order','number_id','id');
    }

    ถ้าเป็นปกติจะเขียนแบบนี้ (แบบย่อ)
    public function orders(){
        return $this->hasMany('App\Order','number_id');
    }
    */
}
