<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'accounts';
    protected $primaryKey = 'id';

    public function roles() {
        return $this->belongsToMany('App\Role');
    }
    public function logs() {
        return $this->hasMany('App\Log');
    }
    public function promos() {
        return $this->belongsToMany('App\Promo');
    }
    public function quotations() {
        return $this->belongsToMany('App\Quotation');
    }
    public function zipcodes() {
        return $this->belongsToMany('App\Zipcode');
    }
    
    // // quotations
    // // quotations table contains customer_id
    public function customerQuotations() {
        return $this->hasMany('App\Quotation', 'customer_id');
    }
    // // quotations table contains photographer_id
    // public function photographerQuotations() {
    //     return $this->hasMany('App\Quotation', 'photographer_id');
    // }

}