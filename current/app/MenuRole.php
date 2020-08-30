<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuRole extends Model
{
    protected $table = 'menu_role';
    protected $primaryKey = 'id';

    public function menu() {
        return $this->belongsTo('App\Menu');
    }
    public function role() {
        return $this->belongsTo('App\Role');
    }
    public function menus() {
        return $this->hasMany('App\Menu');
    }
    public function roles() {
        return $this->hasMany('App\Role');
    }
}
