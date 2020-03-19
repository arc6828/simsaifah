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
    protected $fillable = ['number', 'price', 'operator','total'];

    public function order(){
        return $this->hasMany('App\User','user_id');
    }
    
}
