<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'units';
    protected $primaryKey = 'id';
    
    // pricings table contains unit_id
    public function pricings()
    {
        return $this->hasMany('App\Pricing');
    }
}
