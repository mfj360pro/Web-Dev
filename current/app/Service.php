<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    
    protected $table = 'services';
    protected $primaryKey = 'id';
    
    public function pricings()
    {
        return $this->hasMany('App\Pricing');
    }
    public function type() {
        return $this->belongsTo('App\Type');
    }
    

}