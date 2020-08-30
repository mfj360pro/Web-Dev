<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    protected $table = 'pricing';
    protected $primaryKey = 'id';

    // using zipcode_id
    public function zipcode() {
        return $this->belongsTo('App\Zipcode');
    }
    // using unit_id
    public function unit() {
        return $this->belongsTo('App\Unit');
    }
    // using service_id
    public function service() {
        return $this->belongsTo('App\Service');
    }
}

