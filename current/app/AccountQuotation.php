<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountQuotation extends Model
{    
    protected $table = 'account_quotation';
    protected $primaryKey = 'id';
    
    public function accounts() {
        $this->hasMany('App\Account');
    }
    public function quotations() {
        $this->hasMany('App\Quotation');
    }
}
