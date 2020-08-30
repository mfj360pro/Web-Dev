<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountZipcode extends Model
{
    protected $table = 'account_zipcode';
    protected $primaryKey = 'id';
    
    public function zipcodes() {
        $this->hasMany('App\Zipcode');
    }
    public function accounts() {
        $this->hasMany('App\Account');
    }
    public function shoots() {
        return $this->hasManyThrough(
            'App\Quotation',
            'App\Zipcode',
            'id',           // Foreign key on Zipcode table
            'zipcode_id',   // Foreign key on Quotation table
            'zipcode_id',   // Local key on this class
            'id'            // Local key on Zipcode table
        );
    }
}