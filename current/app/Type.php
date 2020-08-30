<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{

    protected $table = 'types';
    protected $primaryKey = 'id';

    public function contents() {
        return $this->hasMany('App\Content');
    }
    public function services() {
        return $this->hasMany('App\Service');
    }

}
