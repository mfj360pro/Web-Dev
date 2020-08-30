<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $table = 'quotations';
    protected $primaryKey = 'id';

    public function accounts() {
        return $this->belongsToMany('App\Account');
    }
    public function breakdowns() {
        return $this->hasMany('App\Breakdown');
    }
    public function customer() {
        return $this->belongsTo('App\Account', 'customer_id');
    }
    public function handler() {
        return $this->belongsTo('App\Account', 'assigned_to');
    }
    public function status() {
        return $this->belongsTo('App\Status', 'current_status', 'flow');
    }
    public function uploads() {
        return $this->hasMany('App\Upload', 'owner_id');
    }
    public function zipcode() {
        return $this->belongsTo('App\Zipcode', 'zipcode_id');
    }

}