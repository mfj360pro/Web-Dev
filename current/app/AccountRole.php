<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountRole extends Model
{

    protected $table = 'account_role';
    protected $primaryKey = 'id';
    
    public function accounts() {
        $this->hasMany('App\Account');
    }
    public function roles() {
        $this->hasMany('App\Role');
    }

}
