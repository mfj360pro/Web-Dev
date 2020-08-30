<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountPromo extends Model
{
    protected $table = 'account_promo';
    protected $primaryKey = 'id';
    
    public function accounts() {
        $this->hasMany('App\Account');
    }
    public function promos() {
        $this->hasMany('App\Promo');
    }
    // using promo_id
    public function promo() {
        return $this->belongsTo('App\Promo');
    }
}
