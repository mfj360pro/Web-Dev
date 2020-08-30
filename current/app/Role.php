<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id';

    public function accounts() {
        return $this->belongsToMany('App\Account');
    }
    public function menus() {
        return $this->belongsToMany('App\Menu');
    }
}
