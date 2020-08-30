<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';
    
    public function promos() {
        return $this->belongsToMany('App\Promo');
    }
    // quotations table contains customer_id
    public function quotations() {
        return $this->hasMany('App\Quotation');
    }
    // using role_id
    public function role() {
        return $this->belongsTo('App\Role');
    }
}
