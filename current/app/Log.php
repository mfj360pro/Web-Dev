<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs';
    protected $primaryKey = 'id';

    public function Account() {
        return $this->belongsTo('App\Account');
    }
}
