<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Breakdown extends Model
{
    protected $table = 'breakdowns';
    protected $primaryKey = 'id';

    public function pricing() {
        return $this->hasOne('App\Pricing');
    }
}
