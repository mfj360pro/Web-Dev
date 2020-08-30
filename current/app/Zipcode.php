<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zipcode extends Model
{
    protected $table = 'zipcodes';
    protected $primaryKey = 'id';

    public function pricing() {
        return $this->hasMany('App\Pricing');
    }
    public function accounts() {
        return $this->belongsToMany('App\Account');
    }
    public function quotations() {
        return $this->hasMany('App\Quotation');
    }
}
