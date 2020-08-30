<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photographer extends Model
{
    protected $table = 'photographers';
    protected $primaryKey = 'id';

    public function role() {
        return $this->belongsTo('App\Role');
    }
    public function zipcodes() {
        return $this->belongsToMany('App\Zipcode');
    }
    public function quotations() {
        return $this->hasMany('App\Quotation');
    }
}
