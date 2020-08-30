<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';
    protected $primaryKey = 'id';
    public function roles() {
        return $this->belongsToMany('App\Role');
    }
}
