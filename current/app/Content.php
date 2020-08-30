<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'contents';
    protected $primaryKey = 'id';

    public function type() {
        return $this->hasOne('App\Type');
    }
    
}
